@extends('layouts.auth')

@section('title', 'Sign Up - FitCore Gym Management')

@section('content')
<div class="glass-panel auth-card" style="box-shadow: var(--shadow-modal); max-width: 500px;">
    <div style="text-align: center; margin-bottom: 24px;">
        <div style="width: 52px; height: 52px; background: var(--primary); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; box-shadow: var(--glow-primary-lg); margin-bottom: 12px;">
            <span class="material-symbols-outlined" style="color: white; font-size: 28px;">fitness_center</span>
        </div>
        <h1 style="font-size: 26px; font-family: var(--font-heading); margin-bottom: 4px;">Join FIT<span style="color: var(--primary);">CORE</span></h1>
        <p style="color: var(--text-secondary); font-size: 13px;">Create your account to access your gym portal.</p>
    </div>

    @if(request('plan'))
    <div style="background: rgba(255, 95, 31, 0.15); border: 1px solid var(--primary); color: var(--primary); padding: 10px 14px; border-radius: var(--radius-md); font-size: 13px; margin-bottom: 20px; text-align: center; font-weight: 600;">
        ⚡ Selected Plan: {{ request('plan') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background: rgba(255, 77, 77, 0.15); border: 1px solid var(--error); color: var(--error); padding: 12px 16px; border-radius: var(--radius-md); font-size: 13px; margin-bottom: 20px;">
        <ul style="margin: 0; padding-left: 16px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('signup.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Account Role</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <label style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 10px; border-radius: var(--radius-md); text-align: center; cursor: pointer; color: white; font-size: 13px; font-weight: 600;">
                    <input type="radio" name="role" value="member" {{ old('role', 'member') === 'member' ? 'checked' : '' }} style="margin-right: 6px;"> Gym Member
                </label>
                <label style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 10px; border-radius: var(--radius-md); text-align: center; cursor: pointer; color: white; font-size: 13px; font-weight: 600;">
                    <input type="radio" name="role" value="trainer" {{ old('role') === 'trainer' ? 'checked' : '' }} style="margin-right: 6px;"> Fitness Trainer
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Membership Plan & Billing Cycle</label>
            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 10px;">
                <select name="plan_name" class="form-select">
                    <option value="Basic Fit" {{ old('plan_name', request('plan')) === 'Basic Fit' ? 'selected' : '' }}>Basic Fit ($49/mo)</option>
                    <option value="All-Access Pro" {{ old('plan_name', request('plan')) === 'All-Access Pro' || !request('plan') ? 'selected' : '' }}>All-Access Pro ($79/mo)</option>
                    <option value="VIP Performance" {{ old('plan_name', request('plan')) === 'VIP Performance' ? 'selected' : '' }}>VIP Performance ($129/mo)</option>
                </select>
                <select name="plan_type" class="form-select">
                    <option value="monthly" {{ old('plan_type') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ old('plan_type') === 'yearly' ? 'selected' : '' }}>Yearly (20% Off)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Full Name</label>
            <div class="input-wrapper">
                <span class="material-symbols-outlined">person</span>
                <input type="text" name="name" class="form-input" placeholder="Jordan Miller" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Email Address</label>
            <div class="input-wrapper">
                <span class="material-symbols-outlined">mail</span>
                <input type="email" name="email" class="form-input" placeholder="member@fitcore.gym" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Phone Number (WhatsApp enabled)</label>
            <div class="input-wrapper">
                <span class="material-symbols-outlined">call</span>
                <input type="text" name="phone" class="form-input" placeholder="+15559482011" value="{{ old('phone') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-wrapper">
                <span class="material-symbols-outlined">lock</span>
                <input type="password" name="password" class="form-input" placeholder="••••••••" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Profile Picture (Optional)</label>
            <input type="file" name="profile_photo" class="form-input">
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 15px; margin-top: 10px;">
            <span class="material-symbols-outlined">how_to_reg</span>
            <span>Create FitCore Account</span>
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center; font-size: 13px; color: var(--text-muted); display: flex; flex-direction: column; gap: 8px;">
        <div>Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Log In</a></div>
        <div><a href="{{ route('home') }}" style="color: var(--text-secondary); text-decoration: none; font-size: 12px;">← Return to Home Page</a></div>
    </div>
</div>
@endsection
