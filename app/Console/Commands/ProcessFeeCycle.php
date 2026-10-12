<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Membership;
use App\Models\Notification;
use App\Models\Setting;
use Carbon\Carbon;

class ProcessFeeCycle extends Command
{
    protected $signature = 'fitcore:process-fees';
    protected $description = 'Process fee cycles, update statuses, send reminder emails, and generate admin notifications';

    public function handle()
    {
        $this->info('Starting FitCore fee cycle processing...');
        $today = Carbon::now()->startOfDay();
        $memberships = Membership::with('user')->get();
        $setting = Setting::instance();

        $processedCount = 0;
        $notificationCount = 0;

        foreach ($memberships as $membership) {
            if (!$membership->user || $membership->user->status === 'cancelled') {
                continue;
            }

            $lastPaid = Carbon::parse($membership->last_paid_date)->startOfDay();
            $daysPassed = (int) $lastPaid->diffInDays($today);

            $cycleDays = ($membership->plan_type === 'yearly') ? 365 : 30;
            $dueSoonThreshold = $cycleDays - 5;

            if ($daysPassed >= $cycleDays) {
                // Update membership status to unpaid (red badge)
                $membership->update(['status' => 'unpaid']);
                $processedCount++;

                // Check if unresolved notification already exists
                $existingNotice = Notification::where('member_id', $membership->user_id)
                    ->where('is_resolved', false)
                    ->where('type', 'fee_due')
                    ->first();

                if (!$existingNotice) {
                    Notification::create([
                        'type' => 'fee_due',
                        'member_id' => $membership->user_id,
                        'message' => "{$membership->user->name} has completed their cycle, payment due (\${$membership->monthly_fee})",
                        'is_resolved' => false,
                    ]);
                    $notificationCount++;
                }
            } elseif ($daysPassed >= $dueSoonThreshold && $daysPassed < $cycleDays) {
                // Set status to due_soon (yellow badge)
                $membership->update(['status' => 'due_soon']);
                $processedCount++;
            } else {
                $membership->update(['status' => 'paid']);
            }
        }

        $this->info("Completed! Processed {$processedCount} memberships. Created {$notificationCount} new fee due notifications.");
        return Command::SUCCESS;
    }
}
