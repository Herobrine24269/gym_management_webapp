@extends('layouts.auth')

@section('title', 'Login - FitCore Gym Management')

@section('content')
<div class="glass-panel auth-card" style="box-shadow: var(--shadow-modal);">
    <div style="text-align: center; margin-bottom: 24px;">
        <div style="width: 56px; height: 56px; background: var(--primary); border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; box-shadow: var(--glow-primary-lg); margin-bottom: 16px;">
            <span class="material-symbols-outlined" style="color: white; font-size: 32px;">fitness_center</span>
        </div>
        <h1 style="font-size: 28px; font-family: var(--font-heading); margin-bottom: 4px; letter-spacing: -0.02em;">FIT<span style="color: var(--primary);">CORE</span></h1>
        <p style="color: var(--text-secondary); font-size: 14px;">Welcome Back! Log in to your portal.</p>
    </div>

    @if(session('success'))
    <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid var(--success); color: var(--success); padding: 12px; border-radius: var(--radius-md); font-size: 13px; margin-bottom: 20px; text-align: center; font-weight: 600;">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background: rgba(255, 77, 77, 0.15); border: 1px solid var(--error); color: var(--error); padding: 12px; border-radius: var(--radius-md); font-size: 13px; margin-bottom: 20px; text-align: center;">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <div class="input-wrapper">
                <span class="material-symbols-outlined">mail</span>
                <input type="email" name="email" id="emailInput" class="form-input" placeholder="Enter your registered email..." value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <label class="form-label" style="margin-bottom: 0;">Password</label>
                <a href="{{ route('forgot-password') }}" style="color: var(--primary); font-size: 12px; text-decoration: none; font-weight: 500;">Forgot Password?</a>
            </div>
            <div class="input-wrapper">
                <span class="material-symbols-outlined">lock</span>
                <input type="password" name="password" id="passwordInput" class="form-input" placeholder="Enter your password..." required>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; padding: 14px; font-size: 15px; margin-top: 10px;">
            <span class="material-symbols-outlined">login</span>
            <span>Log In to FitCore</span>
        </button>
    </form>

    <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border-surface-variant); text-align: center; font-size: 13px; color: var(--text-muted);">
        <strong>Demo Quick Logins:</strong>
        <div style="display: flex; gap: 8px; justify-content: center; margin-top: 10px; flex-wrap: wrap;">
            <button onclick="fillLogin('admin@fitcore.gym')" class="btn-secondary" style="font-size: 12px; padding: 6px 12px;">Fill Admin</button>
            <button onclick="fillLogin('m.vance@fitcore.gym')" class="btn-secondary" style="font-size: 12px; padding: 6px 12px;">Fill Trainer</button>
            <button onclick="fillLogin('jordan.m@fitcore.gym')" class="btn-secondary" style="font-size: 12px; padding: 6px 12px;">Fill Member</button>
        </div>
    </div>

    <div style="margin-top: 16px; text-align: center; font-size: 13px; color: var(--text-muted); display: flex; flex-direction: column; gap: 8px;">
        <div>Don't have an account? <a href="{{ route('signup') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Sign Up</a></div>
        <div><a href="{{ route('home') }}" style="color: var(--text-secondary); text-decoration: none; font-size: 12px;">← Return to Home Page</a></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function fillLogin(email) {
    document.getElementById('emailInput').value = email;
    document.getElementById('passwordInput').value = 'password123';
}
</script>
@endsection
