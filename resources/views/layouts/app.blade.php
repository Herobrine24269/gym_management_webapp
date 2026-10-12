<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FitCore Gym Management')</title>
    <link rel="stylesheet" href="{{ asset('css/fitcore.css') }}">
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div style="display: flex; align-items: center; gap: 12px; padding: 10px 0 24px 8px;">
                <div style="width: 38px; height: 38px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: var(--glow-primary);">
                    <span class="material-symbols-outlined" style="color: white; font-size: 24px;">fitness_center</span>
                </div>
                <div class="logo-text">
                    <h2 style="font-size: 22px; line-height: 1; letter-spacing: -0.02em;">FIT<span style="color: var(--primary);">CORE</span></h2>
                    <span style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Gym Management</span>
                </div>
            </div>

            <nav style="flex: 1;">
                <div class="nav-section-title">MAIN MENU</div>
                @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="nav-text">Admin Dashboard</span>
                </a>
                @elseif(auth()->check() && auth()->user()->isTrainer())
                <a href="{{ route('trainer.dashboard') }}" class="nav-link {{ request()->is('trainer/dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="nav-text">Trainer Dashboard</span>
                </a>
                @else
                <a href="{{ route('member.dashboard') }}" class="nav-link {{ request()->is('member/dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">person</span>
                    <span class="nav-text">Member Dashboard</span>
                </a>
                <a href="{{ route('member.profile') }}" class="nav-link {{ request()->is('member/profile*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">account_box</span>
                    <span class="nav-text">My Profile</span>
                </a>
                @endif

                <div class="nav-section-title">MANAGEMENT</div>
                <a href="{{ route('diet-plans.index') }}" class="nav-link {{ request()->is('diet-plans') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">restaurant_menu</span>
                    <span class="nav-text">Diet Plans</span>
                </a>
                <a href="{{ route('posts.index') }}" class="nav-link {{ request()->is('posts') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">article</span>
                    <span class="nav-text">Posts & Feed</span>
                </a>
                @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('notifications.index') }}" class="nav-link {{ request()->is('notifications') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="nav-text">Notifications</span>
                </a>
                @endif

                <div class="nav-section-title">SYSTEM</div>
                @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('settings.index') }}" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="nav-text">Settings</span>
                </a>
                @endif
            </nav>

            <div style="padding-top: 20px; border-top: 1px solid var(--border-surface-variant);">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; color: var(--error); cursor: pointer;">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="nav-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <header class="top-header">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <h2 style="font-size: 20px;">@yield('header_title', 'Dashboard')</h2>
                </div>

                <div style="display: flex; align-items: center; gap: 20px;">
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('notifications.index') }}" style="position: relative; color: var(--text-secondary); text-decoration: none;">
                        <span class="material-symbols-outlined">notifications</span>
                        @php
                            $unresolvedCount = \App\Models\Notification::where('is_resolved', false)->count();
                        @endphp
                        @if($unresolvedCount > 0)
                        <span style="position: absolute; top: -6px; right: -6px; background: var(--primary); color: white; border-radius: 50%; width: 16px; height: 16px; font-size: 10px; font-weight: 700; display: flex; align-items: center; justify-content: center; box-shadow: var(--glow-primary);">{{ $unresolvedCount }}</span>
                        @endif
                    </a>
                    @endif

                    <div style="display: flex; align-items: center; gap: 12px; padding-left: 16px; border-left: 1px solid var(--border-surface-variant);">
                        <img src="{{ auth()->user()->profile_photo_url ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80' }}" alt="Avatar" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                        <div>
                            <div style="font-weight: 600; font-size: 14px; color: white;">{{ auth()->user()->name ?? 'Alex Rivera' }}</div>
                            <div style="font-size: 11px; color: var(--text-muted); text-transform: capitalize;">{{ auth()->user()->role ?? 'Admin' }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-body">
                @if(session('success'))
                <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid var(--success); color: var(--success); padding: 14px 18px; border-radius: var(--radius-lg); margin-bottom: 20px; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @yield('modals')
    @yield('scripts')
</body>
</html>
