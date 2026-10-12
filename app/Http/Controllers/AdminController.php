<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Membership;
use App\Models\PaymentHistory;
use App\Models\Notification;
use App\Models\Setting;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalMembers = User::where('role', 'member')->where('status', 'active')->count();
        $paidCount = Membership::where('status', 'paid')->count();
        $unpaidCount = Membership::whereIn('status', ['unpaid', 'due_soon'])->count();
        $activeTrainers = User::where('role', 'trainer')->where('status', 'active')->count();

        // Search & Filter members
        $filterStatus = $request->query('status', 'all');
        $searchQuery = $request->query('search', '');

        $query = Membership::with(['user', 'trainer']);

        if ($filterStatus !== 'all') {
            $query->where('status', $filterStatus);
        }

        if ($searchQuery) {
            $query->whereHas('user', function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('email', 'like', "%{$searchQuery}%")
                  ->orWhere('phone', 'like', "%{$searchQuery}%");
            });
        }

        $memberships = $query->orderBy('next_due_date', 'asc')->get();
        $trainers = User::where('role', 'trainer')->where('status', 'active')->get();
        $unresolvedNotifications = Notification::with('member')->where('is_resolved', false)->latest()->get();

        return view('admin.dashboard', compact(
            'totalMembers',
            'paidCount',
            'unpaidCount',
            'activeTrainers',
            'memberships',
            'trainers',
            'filterStatus',
            'searchQuery',
            'unresolvedNotifications'
        ));
    }

    public function markPaid(Request $request, $membershipId)
    {
        $membership = Membership::findOrFail($membershipId);
        $today = Carbon::now()->toDateString();
        $nextDue = Carbon::now()->addDays(30)->toDateString();

        $membership->update([
            'last_paid_date' => $today,
            'next_due_date' => $nextDue,
            'status' => 'paid',
        ]);

        PaymentHistory::create([
            'membership_id' => $membership->id,
            'amount' => $membership->monthly_fee,
            'paid_on' => $today,
            'marked_by' => auth()->id(),
        ]);

        // Resolve notification if exists
        Notification::where('member_id', $membership->user_id)
            ->where('is_resolved', false)
            ->update([
                'is_resolved' => true,
                'resolved_action' => 'paid',
                'resolved_at' => Carbon::now(),
            ]);

        return back()->with('success', "{$membership->user->name}'s membership fee marked as Paid. 30-day cycle restarted!");
    }

    public function markUnpaid(Request $request, $membershipId)
    {
        $membership = Membership::with('user')->findOrFail($membershipId);
        $membership->update(['status' => 'unpaid']);
        $setting = Setting::instance();

        // Resolve notification
        Notification::where('member_id', $membership->user_id)
            ->where('is_resolved', false)
            ->update([
                'is_resolved' => true,
                'resolved_action' => 'unpaid_whatsapp',
                'resolved_at' => Carbon::now(),
            ]);

        $phone = preg_replace('/[^0-9]/', '', $membership->user->phone ?? '');
        $template = str_replace(
            ['{{member_name}}', '{{amount}}', '{{due_date}}'],
            [$membership->user->name, $membership->monthly_fee, $membership->next_due_date->format('M d, Y')],
            $setting->whatsapp_message_template
        );

        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($template);

        return redirect()->away($whatsappUrl);
    }

    public function assignTrainer(Request $request, $membershipId)
    {
        $membership = Membership::findOrFail($membershipId);
        $membership->update(['assigned_trainer_id' => $request->input('trainer_id')]);
        return back()->with('success', 'Trainer assigned successfully!');
    }

    public function cancelMembership(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['status' => 'cancelled']);
        return back()->with('success', "{$user->name}'s membership has been cancelled.");
    }
}
