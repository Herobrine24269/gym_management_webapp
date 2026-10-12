@extends('layouts.auth')

@section('title', 'Forgot Password - FitCore Gym Management')

@section('content')
<div class="glass-panel auth-card" style="box-shadow: var(--shadow-modal);">
    <!-- Logo & Brand Header -->
    <div style="text-align: center; margin-bottom: 30px;">
        <div style="width: 56px; height: 56px; background: var(--primary); border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; box-shadow: var(--glow-primary-lg); margin-bottom: 16px;">
            <span class="material-symbols-outlined" style="color: white; font-size: 32px;">fitness_center</span>
        </div>
        <h1 style="font-size: 28px; font-family: var(--font-heading); margin-bottom: 4px; letter-spacing: -0.02em;">FIT<span style="color: var(--primary);">CORE</span></h1>
        <p style="color: var(--text-secondary); font-size: 14px;">Gym Management System</p>
    </div>

    <!-- State 1: Request Form -->
    <div id="resetFormState">
        <div style="margin-bottom: 24px; text-align: center;">
            <h2 style="font-size: 22px; font-family: var(--font-heading); margin-bottom: 8px;">Reset Your Password</h2>
            <p style="color: var(--text-muted); font-size: 13px;">Enter your registered email address and we'll send you instructions to reset your password.</p>
        </div>

        <form id="forgotForm" onsubmit="handleForgotSubmit(event)">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="email" name="email" id="emailInput" class="form-input" placeholder="member@fitcore.gym" required>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 14px; font-size: 15px; margin-top: 10px;">
                <span class="material-symbols-outlined">send</span>
                <span>Send Reset Link</span>
            </button>
        </form>
    </div>

    <!-- State 2: Check Your Email Confirmation (Hidden initially, shown after submit) -->
    <div id="confirmationState" style="display: none; text-align: center; padding: 10px 0;">
        <div style="width: 64px; height: 64px; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
            <span class="material-symbols-outlined" style="color: var(--success); font-size: 36px;">mark_email_read</span>
        </div>
        <h2 style="font-size: 22px; font-family: var(--font-heading); margin-bottom: 8px; color: white;">Check Your Email</h2>
        <p style="color: var(--text-secondary); font-size: 14px; margin-bottom: 20px; line-height: 1.6;">
            We have sent a password reset link to <br>
            <strong id="sentEmailDisplay" style="color: var(--primary);">member@fitcore.gym</strong>
        </p>
        <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 14px; border-radius: var(--radius-md); font-size: 13px; color: var(--text-muted); margin-bottom: 24px;">
            Didn't receive the email? Check your spam folder or try again in a few minutes.
        </div>
        <button onclick="resendEmail()" class="btn-secondary" style="width: 100%; padding: 12px; margin-bottom: 12px;">
            <span class="material-symbols-outlined">refresh</span>
            <span>Resend Email</span>
        </button>
    </div>

    <!-- Footer Back to Login Link -->
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-surface-variant); text-align: center;">
        <a href="{{ route('login') }}" style="color: var(--text-secondary); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-secondary)'">
            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
            <span>Back to Login</span>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
function handleForgotSubmit(e) {
    e.preventDefault();
    const email = document.getElementById('emailInput').value;
    if (email) {
        document.getElementById('sentEmailDisplay').textContent = email;
        document.getElementById('resetFormState').style.display = 'none';
        document.getElementById('confirmationState').style.display = 'block';
    }
}

function resendEmail() {
    alert('A new reset link has been sent to your email!');
}
</script>
@endsection
