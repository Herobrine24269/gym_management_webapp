<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Membership;
use App\Models\PaymentHistory;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $membership = Membership::with('trainer', 'paymentHistories')->where('user_id', $user->id)->first();

        return view('member.dashboard', compact('user', 'membership'));
    }

    public function profile($id = null)
    {
        $userId = $id ?? auth()->id();
        $member = User::with('membership.trainer')->findOrFail($userId);
        return view('member.profile', compact('member'));
    }

    public function payNow(Request $request)
    {
        $user = auth()->user();
        $membership = Membership::where('user_id', $user->id)->first();

        if ($membership) {
            $today = Carbon::now()->toDateString();
            $daysToAdd = ($membership->plan_type === 'yearly') ? 365 : 30;
            $nextDue = Carbon::now()->addDays($daysToAdd)->toDateString();

            $membership->update([
                'last_paid_date' => $today,
                'next_due_date' => $nextDue,
                'status' => 'paid',
            ]);

            $method = $request->input('payment_method', 'card');
            $trxId = $request->input('transaction_id');
            if (!$trxId) {
                $trxId = strtoupper($method) . '-' . mt_rand(100000, 999999);
            }

            $invoiceNo = 'FC-INV-' . date('Y') . '-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            $payment = PaymentHistory::create([
                'membership_id' => $membership->id,
                'amount' => $membership->monthly_fee,
                'paid_on' => $today,
                'payment_method' => $method,
                'transaction_id' => $trxId,
                'invoice_no' => $invoiceNo,
                'marked_by' => $user->id,
            ]);

            return back()->with('success', 'Payment successful via ' . ucfirst($method) . '! Your membership is renewed.')
                        ->with('latest_payment_id', $payment->id);
        }

        return back()->withErrors(['msg' => 'Membership account record not found.']);
    }

    public function receipt($id)
    {
        $payment = PaymentHistory::with('membership.user', 'membership.trainer')->findOrFail($id);
        return view('receipts.show', compact('payment'));
    }
}
