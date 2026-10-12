@extends('layouts.public')

@section('title', 'Pricing & Membership Plans - FitCore Gym Management')

@section('content')
<section style="padding: 60px 24px; max-width: 1200px; margin: 0 auto;">
    
    <div style="text-align: center; margin-bottom: 40px;">
        <span class="badge badge-primary" style="margin-bottom: 12px; font-size: 13px;">Simple & Transparent Pricing</span>
        <h1 style="font-size: 42px; font-family: var(--font-heading); text-transform: uppercase;">MEMBERSHIP <span style="color: var(--primary);">PLANS</span></h1>
        <p style="color: var(--text-secondary); font-size: 16px; margin-top: 6px; max-width: 600px; margin-left: auto; margin-right: auto;">
            Choose the training package that fits your goals. No hidden fees, no annual lock-ins.
        </p>

        <!-- Billing Cycle Switch Toggle -->
        <div style="margin-top: 28px; display: inline-flex; align-items: center; gap: 14px; background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 6px 16px; border-radius: 30px;">
            <span id="monthlyLabel" style="font-size: 14px; font-weight: 700; color: white;">Monthly Billing</span>
            <label style="position: relative; display: inline-block; width: 48px; height: 26px; cursor: pointer;">
                <input type="checkbox" id="billingToggle" onchange="toggleBillingCycle()" style="opacity: 0; width: 0; height: 0;">
                <span id="toggleSlider" style="position: absolute; cursor: pointer; inset: 0; background-color: var(--bg-dark-1); border: 1px solid var(--border-surface-variant); transition: .3s; border-radius: 30px;">
                    <span style="position: absolute; content: ''; height: 20px; width: 20px; left: 3px; bottom: 2px; background-color: var(--primary); transition: .3s; border-radius: 50%;"></span>
                </span>
            </label>
            <span id="yearlyLabel" style="font-size: 14px; font-weight: 600; color: var(--text-muted);">
                Yearly Billing <span class="badge badge-success" style="font-size: 11px; padding: 2px 8px; margin-left: 4px;">Save 20%</span>
            </span>
        </div>
    </div>

    <!-- Pricing Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px; align-items: stretch; margin-bottom: 60px;">
        
        <!-- Plan 1: Basic Gym -->
        <div class="fit-card" style="padding: 32px; display: flex; flex-direction: column;">
            <div style="margin-bottom: 20px;">
                <span class="badge badge-primary" style="margin-bottom: 8px;">Standard Tier</span>
                <h3 style="font-size: 24px; color: white; font-family: var(--font-heading);">BASIC FIT</h3>
                <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Essential gym equipment & cardio zone access.</p>
            </div>

            <div style="margin-bottom: 24px; display: flex; align-items: baseline;">
                <span style="font-size: 42px; font-family: var(--font-heading); color: white;" class="plan-price" data-monthly="49" data-yearly="39">$49</span>
                <span style="font-size: 14px; color: var(--text-muted); margin-left: 6px;" class="billing-period">/ month</span>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0 0 30px 0; display: flex; flex-direction: column; gap: 12px; font-size: 14px; flex: 1;">
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Standard Gym Floor & Cardio Access</li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Locker Room & Hot Shower Access</li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> FitCore Mobile Portal Login</li>
                <li style="display: flex; gap: 10px; align-items: center; color: var(--text-muted);"><span class="material-symbols-outlined" style="font-size: 20px;">cancel</span> Personal Trainer Allocation</li>
            </ul>

            <a href="{{ route('signup') }}?plan=Basic+Fit" class="btn-secondary" style="width: 100%; padding: 12px; font-size: 15px; text-align: center; text-decoration: none;">
                <span>Choose Basic Fit</span>
            </a>
        </div>

        <!-- Plan 2: All-Access Pro (Most Popular) -->
        <div class="fit-card" style="padding: 36px 32px; display: flex; flex-direction: column; border: 2px solid var(--primary); box-shadow: var(--shadow-modal); position: relative; background: linear-gradient(180deg, rgba(255, 95, 31, 0.12) 0%, var(--bg-card) 100%);">
            <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: var(--primary); color: white; padding: 4px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; box-shadow: var(--glow-primary);">
                MOST POPULAR
            </div>

            <div style="margin-bottom: 20px; margin-top: 8px;">
                <span class="badge badge-primary" style="margin-bottom: 8px;">Full Access Tier</span>
                <h3 style="font-size: 26px; color: white; font-family: var(--font-heading);">ALL-ACCESS PRO</h3>
                <p style="color: var(--text-secondary); font-size: 13px; margin-top: 4px;">Unlimited keycard entry, macro diet plans & coach assignment.</p>
            </div>

            <div style="margin-bottom: 24px; display: flex; align-items: baseline;">
                <span style="font-size: 48px; font-family: var(--font-heading); color: var(--primary);" class="plan-price" data-monthly="79" data-yearly="63">$79</span>
                <span style="font-size: 14px; color: var(--text-muted); margin-left: 6px;" class="billing-period">/ month</span>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0 0 30px 0; display: flex; flex-direction: column; gap: 12px; font-size: 14px; flex: 1;">
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> <strong>24/7 Keycard Facility Access</strong></li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Assigned Personal Trainer Support</li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Custom Macro Diet Plan Assignment</li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Unlimited Group Classes & Feed</li>
            </ul>

            <a href="{{ route('signup') }}?plan=All-Access+Pro" class="btn-primary" style="width: 100%; padding: 14px; font-size: 15px; text-align: center; text-decoration: none;">
                <span>Choose All-Access Pro</span>
                <span class="material-symbols-outlined">bolt</span>
            </a>
        </div>

        <!-- Plan 3: VIP Coaching -->
        <div class="fit-card" style="padding: 32px; display: flex; flex-direction: column;">
            <div style="margin-bottom: 20px;">
                <span class="badge badge-warning" style="margin-bottom: 8px;">Elite Tier</span>
                <h3 style="font-size: 24px; color: white; font-family: var(--font-heading);">VIP PERFORMANCE</h3>
                <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">1-on-1 daily master coaching & recovery suite access.</p>
            </div>

            <div style="margin-bottom: 24px; display: flex; align-items: baseline;">
                <span style="font-size: 42px; font-family: var(--font-heading); color: white;" class="plan-price" data-monthly="129" data-yearly="103">$129</span>
                <span style="font-size: 14px; color: var(--text-muted); margin-left: 6px;" class="billing-period">/ month</span>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0 0 30px 0; display: flex; flex-direction: column; gap: 12px; font-size: 14px; flex: 1;">
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> All Pro Tier Features Included</li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Dedicated 1-on-1 Daily Master Coach</li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Infrared Sauna & Cryotherapy Suite</li>
                <li style="display: flex; gap: 10px; align-items: center;"><span class="material-symbols-outlined" style="color: var(--success); font-size: 20px;">check_circle</span> Monthly Body Composition Scan</li>
            </ul>

            <a href="{{ route('signup') }}?plan=VIP+Performance" class="btn-secondary" style="width: 100%; padding: 12px; font-size: 15px; text-align: center; text-decoration: none;">
                <span>Choose VIP Performance</span>
            </a>
        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
function toggleBillingCycle() {
    const isYearly = document.getElementById('billingToggle').checked;
    const monthlyLabel = document.getElementById('monthlyLabel');
    const yearlyLabel = document.getElementById('yearlyLabel');
    const prices = document.querySelectorAll('.plan-price');
    const periods = document.querySelectorAll('.billing-period');

    if (isYearly) {
        monthlyLabel.style.color = 'var(--text-muted)';
        monthlyLabel.style.fontWeight = '600';
        yearlyLabel.style.color = 'white';
        yearlyLabel.style.fontWeight = '700';

        prices.forEach(el => {
            el.textContent = '$' + el.getAttribute('data-yearly');
        });
        periods.forEach(el => {
            el.textContent = '/ month (billed yearly)';
        });
    } else {
        monthlyLabel.style.color = 'white';
        monthlyLabel.style.fontWeight = '700';
        yearlyLabel.style.color = 'var(--text-muted)';
        yearlyLabel.style.fontWeight = '600';

        prices.forEach(el => {
            el.textContent = '$' + el.getAttribute('data-monthly');
        });
        periods.forEach(el => {
            el.textContent = '/ month';
        });
    }
}
</script>
@endsection
