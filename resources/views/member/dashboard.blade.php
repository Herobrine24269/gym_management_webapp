@extends('layouts.app')

@section('title', 'Member Dashboard - FitCore Gym Management')
@section('header_title', 'My Member Portal')

@section('content')
<div style="max-width: 1100px; margin: 0 auto;">

    @if(session('success'))
    <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid var(--success); color: var(--success); padding: 16px 20px; border-radius: var(--radius-lg); font-size: 14px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <span class="material-symbols-outlined" style="font-size: 24px;">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @if(session('latest_payment_id'))
        <a href="{{ route('receipt.download', session('latest_payment_id')) }}" target="_blank" class="btn-primary" style="padding: 8px 16px; font-size: 13px; text-decoration: none;">
            <span class="material-symbols-outlined">receipt_long</span>
            <span>Download Fee Receipt (PDF)</span>
        </a>
        @endif
    </div>
    @endif

    <!-- Welcome & Status Banner -->
    <div class="fit-card" style="padding: 28px; margin-bottom: 24px; background: radial-gradient(circle at top right, rgba(255, 95, 31, 0.2), var(--bg-card)); border: 1px solid var(--border-surface-variant);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    @if($membership && $membership->status === 'paid')
                        <span class="badge badge-success">Active Paid Membership</span>
                    @elseif($membership && $membership->status === 'due_soon')
                        <span class="badge badge-warning">Renewal Due Soon</span>
                    @else
                        <span class="badge" style="background: rgba(255, 77, 77, 0.15); color: var(--error);">Payment Overdue</span>
                    @endif
                    <span class="badge badge-primary" style="text-transform: uppercase;">{{ ucfirst($membership->plan_type ?? 'monthly') }} Plan</span>
                </div>
                
                <h2 style="font-size: 28px; color: white; margin-bottom: 4px;">Welcome back, {{ auth()->user()->name }}! 💪</h2>
                <p style="color: var(--text-secondary); font-size: 14px;">
                    Active Plan: <strong style="color: var(--primary);">{{ $membership->plan_name ?? 'All-Access Pro' }} (${{ number_format($membership->monthly_fee ?? 79.99, 2) }}/{{ $membership->plan_type ?? 'mo' }})</strong>
                </p>
            </div>
            
            <!-- Pay Now Trigger Card -->
            <div style="background: rgba(18, 19, 26, 0.9); border: 1px solid var(--border-surface-variant); padding: 18px 24px; border-radius: var(--radius-lg); text-align: right;">
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Payment Due Date</div>
                <div style="font-size: 20px; font-family: var(--font-heading); color: {{ $membership && $membership->status === 'paid' ? 'var(--success)' : 'var(--warning)' }}; margin: 4px 0 10px 0;">
                    {{ $membership && $membership->next_due_date ? $membership->next_due_date->format('M d, Y') : 'N/A' }}
                </div>
                <button class="btn-primary" style="padding: 10px 20px; font-size: 14px; width: 100%;" onclick="openPayNowModal()">
                    <span class="material-symbols-outlined">payments</span>
                    <span>Pay Fee Now</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Member Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;" class="member-grid">

        <!-- Workout Tracker Card -->
        <div class="fit-card" style="padding: 24px;">
            <h3 style="font-size: 18px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: var(--primary);">fitness_center</span>
                <span>Today's Assigned Workout</span>
            </h3>
            
            <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 16px; border-radius: var(--radius-md); margin-bottom: 14px;">
                <div style="font-weight: 600; color: white; font-size: 16px; margin-bottom: 4px;">Hypertrophy Chest & Triceps</div>
                <div style="font-size: 13px; color: var(--text-secondary);">4 Sets Heavy Bench Press · 3 Sets Incline Dumbbell · Cable Flyes</div>
            </div>

            <button class="btn-secondary" style="width: 100%; font-size: 13px;" onclick="alert('Workout completed & logged in your portal!')">
                <span class="material-symbols-outlined">check</span>
                <span>Log Completed Workout</span>
            </button>
        </div>

        <!-- Assigned Nutrition Card -->
        <div class="fit-card" style="padding: 24px;">
            <h3 style="font-size: 18px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: var(--primary);">restaurant_menu</span>
                <span>My Active Diet Plan</span>
            </h3>

            <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 16px; border-radius: var(--radius-md); margin-bottom: 14px;">
                <div style="font-weight: 600; color: white; font-size: 16px; margin-bottom: 4px;">Lean Muscle Shred Plan</div>
                <div style="font-size: 13px; color: var(--text-muted);">2,800 kcal / day · Assigned by {{ $membership->trainer->name ?? 'Marcus Vance' }}</div>
            </div>

            <a href="{{ route('diet-plans.index') }}" class="btn-secondary" style="width: 100%; font-size: 13px; text-align: center; text-decoration: none;">
                <span class="material-symbols-outlined">visibility</span>
                <span>View Full Meal Breakdown</span>
            </a>
        </div>

    </div>

    <!-- Payment History Table Card -->
    <div class="fit-card" style="padding: 24px;">
        <h3 style="font-size: 18px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <span class="material-symbols-outlined" style="color: var(--primary);">history</span>
            <span>Payment History & Downloadable Fee Receipts</span>
        </h3>

        @if($membership && $membership->paymentHistories->count() > 0)
        <div style="overflow-x: auto;">
            <table class="fit-table">
                <thead>
                    <tr>
                        <th>Date Paid</th>
                        <th>Invoice #</th>
                        <th>Payment Method</th>
                        <th>Transaction ID</th>
                        <th>Amount Paid</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($membership->paymentHistories->sortByDesc('id') as $history)
                    <tr>
                        <td style="color: white; font-weight: 600;">{{ $history->paid_on ? $history->paid_on->format('M d, Y') : 'N/A' }}</td>
                        <td><span class="badge badge-primary">{{ $history->invoice_no ?? 'FC-INV-2026' }}</span></td>
                        <td>
                            @if(in_array($history->payment_method, ['jazzcash', 'easypaisa']))
                                <span class="badge badge-warning" style="text-transform: uppercase;">🇵🇰 {{ $history->payment_method }}</span>
                            @elseif($history->payment_method === 'bank_transfer')
                                <span class="badge" style="background: rgba(59, 130, 246, 0.15); color: #3b82f6;">Bank Transfer</span>
                            @elseif($history->payment_method === 'cash')
                                <span class="badge" style="background: rgba(168, 85, 247, 0.15); color: #a855f7;">Cash at Gym</span>
                            @else
                                <span class="badge badge-success">Credit Card</span>
                            @endif
                        </td>
                        <td style="font-family: monospace; font-size: 13px; color: var(--text-secondary);">{{ $history->transaction_id ?? 'TRX-1092837' }}</td>
                        <td style="color: var(--success); font-weight: 700;">${{ number_format($history->amount, 2) }}</td>
                        <td style="text-align: right;">
                            <a href="{{ route('receipt.download', $history->id) }}" target="_blank" class="btn-secondary" style="padding: 6px 12px; font-size: 12px; text-decoration: none;">
                                <span class="material-symbols-outlined" style="font-size: 16px;">receipt_long</span>
                                <span>PDF Receipt</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color: var(--text-muted); font-size: 14px;">No past payment histories recorded yet.</p>
        @endif
    </div>

</div>
@endsection

@section('modals')
<!-- Pakistani Local Payment Channels Modal -->
<div class="modal-overlay" id="payNowModal">
    <div class="modal-card" style="max-width: 580px;">
        
        <div class="modal-header">
            <h3 style="font-size: 20px; color: white; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: var(--primary);">payments</span>
                <span>Select Fee Payment Channel</span>
            </h3>
            <button onclick="closePayNowModal()" style="background: none; border: none; color: var(--text-secondary); cursor: pointer;">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form action="{{ route('member.pay-now') }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" id="selectedPaymentMethod" value="jazzcash">

            <div class="modal-body" style="display: flex; flex-direction: column; gap: 20px;">
                <!-- Fee Summary Box -->
                <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 16px; border-radius: var(--radius-lg);">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                        <span style="color: var(--text-muted); font-size: 13px;">Membership Plan</span>
                        <strong style="color: white; font-size: 14px;">{{ $membership->plan_name ?? 'All-Access Pro' }} ({{ ucfirst($membership->plan_type ?? 'monthly') }})</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                        <span style="color: var(--text-muted); font-size: 13px;">Renewal Extension</span>
                        <span style="color: var(--success); font-size: 13px; font-weight: 600;">+{{ $membership && $membership->plan_type === 'yearly' ? '365 Days' : '30 Days' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-top: 1px dashed var(--border-surface-variant); padding-top: 8px; margin-top: 8px;">
                        <span style="color: var(--text-primary); font-weight: 600;">Total Amount Due</span>
                        <strong style="color: var(--primary); font-size: 22px; font-family: var(--font-heading);">${{ number_format($membership->monthly_fee ?? 79.99, 2) }}</strong>
                    </div>
                </div>

                <!-- Payment Channel Options Selector -->
                <div>
                    <label class="form-label" style="margin-bottom: 10px;">Choose Payment Method (Pakistan & International)</label>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                        
                        <!-- JazzCash -->
                        <div onclick="switchPayChannel('jazzcash')" id="payTab-jazzcash" class="pay-tab active-tab" style="background: var(--surface-container); border: 2px solid var(--primary); padding: 12px 8px; border-radius: var(--radius-md); text-align: center; cursor: pointer;">
                            <div style="font-size: 16px;">🇵🇰</div>
                            <div style="font-size: 13px; font-weight: 700; color: white; margin-top: 2px;">JazzCash</div>
                        </div>

                        <!-- EasyPaisa -->
                        <div onclick="switchPayChannel('easypaisa')" id="payTab-easypaisa" class="pay-tab" style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 12px 8px; border-radius: var(--radius-md); text-align: center; cursor: pointer;">
                            <div style="font-size: 16px;">🇵🇰</div>
                            <div style="font-size: 13px; font-weight: 700; color: var(--text-secondary); margin-top: 2px;">EasyPaisa</div>
                        </div>

                        <!-- Bank Transfer -->
                        <div onclick="switchPayChannel('bank_transfer')" id="payTab-bank_transfer" class="pay-tab" style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 12px 8px; border-radius: var(--radius-md); text-align: center; cursor: pointer;">
                            <span class="material-symbols-outlined" style="color: var(--text-secondary); font-size: 20px;">account_balance</span>
                            <div style="font-size: 12px; font-weight: 600; color: var(--text-secondary); margin-top: 2px;">Bank Transfer</div>
                        </div>

                        <!-- Credit Card -->
                        <div onclick="switchPayChannel('card')" id="payTab-card" class="pay-tab" style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 12px 8px; border-radius: var(--radius-md); text-align: center; cursor: pointer;">
                            <span class="material-symbols-outlined" style="color: var(--text-secondary); font-size: 20px;">credit_card</span>
                            <div style="font-size: 12px; font-weight: 600; color: var(--text-secondary); margin-top: 2px;">Debit/Card</div>
                        </div>

                        <!-- Cash -->
                        <div onclick="switchPayChannel('cash')" id="payTab-cash" class="pay-tab" style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 12px 8px; border-radius: var(--radius-md); text-align: center; cursor: pointer;">
                            <span class="material-symbols-outlined" style="color: var(--text-secondary); font-size: 20px;">payments</span>
                            <div style="font-size: 12px; font-weight: 600; color: var(--text-secondary); margin-top: 2px;">Cash at Gym</div>
                        </div>

                    </div>
                </div>

                <!-- JazzCash Form View -->
                <div id="channelView-jazzcash">
                    <div style="background: rgba(255, 95, 31, 0.1); border: 1px solid var(--primary); padding: 12px; border-radius: var(--radius-md); font-size: 13px; margin-bottom: 14px;">
                        Send payment to FitCore JazzCash Account: <strong style="color: white;">0300-1234567 (FitCore Gym)</strong>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Your JazzCash Mobile Number *</label>
                        <input type="text" name="jazzcash_number" class="form-input" placeholder="03001234567" value="03009482011">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">12-Digit JazzCash Transaction ID (TRX ID) *</label>
                        <input type="text" name="transaction_id" class="form-input" placeholder="e.g. JC8492019482" value="JC{{ mt_rand(1000000000, 9999999999) }}">
                    </div>
                </div>

                <!-- EasyPaisa Form View -->
                <div id="channelView-easypaisa" style="display: none;">
                    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid var(--success); padding: 12px; border-radius: var(--radius-md); font-size: 13px; margin-bottom: 14px;">
                        Send payment to FitCore EasyPaisa Account: <strong style="color: white;">0333-7654321 (FitCore Gym)</strong>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Your EasyPaisa Mobile Number *</label>
                        <input type="text" class="form-input" placeholder="03331234567" value="03339482011">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">EasyPaisa Transaction ID (TRX ID) *</label>
                        <input type="text" class="form-input" placeholder="e.g. EP9482018471" value="EP{{ mt_rand(1000000000, 9999999999) }}">
                    </div>
                </div>

                <!-- Bank Transfer Form View -->
                <div id="channelView-bank_transfer" style="display: none;">
                    <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid #3b82f6; padding: 12px; border-radius: var(--radius-md); font-size: 13px; margin-bottom: 14px;">
                        Meezan Bank IBAN: <strong style="color: white;">PK36MEZN0001001001234567</strong> (Title: FitCore Gym)
                    </div>
                    <div class="form-group">
                        <label class="form-label">Your Bank Name *</label>
                        <input type="text" class="form-input" placeholder="Meezan Bank / HBL / Alfalah" value="Meezan Bank">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Bank Reference / Transaction Ref Number *</label>
                        <input type="text" class="form-input" placeholder="e.g. FT20260830102" value="FT{{ mt_rand(10000000, 99999999) }}">
                    </div>
                </div>

                <!-- Credit Card Form View -->
                <div id="channelView-card" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">Cardholder Name</label>
                        <input type="text" class="form-input" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Card Number</label>
                        <input type="text" class="form-input" value="•••• •••• •••• 4242">
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 0;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Expiry (MM/YY)</label>
                            <input type="text" class="form-input" value="09/28">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">CVV Code</label>
                            <input type="password" class="form-input" value="•••">
                        </div>
                    </div>
                </div>

                <!-- Cash Form View -->
                <div id="channelView-cash" style="display: none;">
                    <div style="background: rgba(168, 85, 247, 0.1); border: 1px solid #a855f7; padding: 16px; border-radius: var(--radius-md); font-size: 13px; text-align: center;">
                        <span class="material-symbols-outlined" style="font-size: 32px; color: #a855f7; margin-bottom: 6px;">storefront</span>
                        <div style="color: white; font-weight: 600; font-size: 15px;">Pay Cash at Gym Reception Desk</div>
                        <div style="color: var(--text-muted); margin-top: 4px;">Show your Member ID (#FC-{{ str_pad(auth()->id(), 4, '0', STR_PAD_LEFT) }}) to reception staff.</div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closePayNowModal()">Cancel</button>
                <button type="submit" class="btn-primary" style="flex: 1; font-size: 15px; padding: 12px;">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>Submit & Get Fee Receipt</span>
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
function openPayNowModal() {
    document.getElementById('payNowModal').classList.add('active');
}

function closePayNowModal() {
    document.getElementById('payNowModal').classList.remove('active');
}

function switchPayChannel(channel) {
    document.getElementById('selectedPaymentMethod').value = channel;

    document.querySelectorAll('.pay-tab').forEach(tab => {
        tab.style.background = 'var(--bg-dark-3)';
        tab.style.border = '1px solid var(--border-surface-variant)';
        const text = tab.querySelector('div:last-child');
        if (text) text.style.color = 'var(--text-secondary)';
    });

    const activeTab = document.getElementById('payTab-' + channel);
    if (activeTab) {
        activeTab.style.background = 'var(--surface-container)';
        activeTab.style.border = '2px solid var(--primary)';
        const text = activeTab.querySelector('div:last-child');
        if (text) text.style.color = 'white';
    }

    const channels = ['jazzcash', 'easypaisa', 'bank_transfer', 'card', 'cash'];
    channels.forEach(ch => {
        const view = document.getElementById('channelView-' + ch);
        if (view) {
            view.style.display = (ch === channel) ? 'block' : 'none';
        }
    });
}
</script>
<style>
@media (max-width: 768px) {
    .member-grid { grid-template-columns: 1fr !important; }
}
</style>
@endsection
