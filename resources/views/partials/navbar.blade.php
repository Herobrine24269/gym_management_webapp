<nav style="background: rgba(18, 19, 26, 0.95); backdrop-filter: blur(16px); border-bottom: 1px solid var(--border-surface-variant); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 16px 24px; display: flex; align-items: center; justify-content: space-between;">
        
        <!-- FitCore Logo -->
        <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none;">
            <div style="width: 38px; height: 38px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: var(--glow-primary);">
                <span class="material-symbols-outlined" style="color: white; font-size: 24px;">fitness_center</span>
            </div>
            <div>
                <h2 style="font-size: 22px; line-height: 1; letter-spacing: -0.02em; color: white;">FIT<span style="color: var(--primary);">CORE</span></h2>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-top: 2px;">Fitness & Performance</span>
            </div>
        </a>

        <!-- Desktop Navigation Links -->
        <div class="desktop-nav-links" style="display: flex; align-items: center; gap: 28px;">
            <a href="{{ route('home') }}" style="color: {{ request()->routeIs('home') ? 'var(--primary)' : 'var(--text-primary)' }}; text-decoration: none; font-weight: 600; font-size: 15px; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="if (!{{ request()->routeIs('home') ? 'true' : 'false' }}) this.style.color='var(--text-primary)'">Home</a>
            <a href="{{ route('about') }}" style="color: {{ request()->routeIs('about') ? 'var(--primary)' : 'var(--text-primary)' }}; text-decoration: none; font-weight: 600; font-size: 15px; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="if (!{{ request()->routeIs('about') ? 'true' : 'false' }}) this.style.color='var(--text-primary)'">About Us</a>
            <a href="{{ route('pricing') }}" style="color: {{ request()->routeIs('pricing') ? 'var(--primary)' : 'var(--text-primary)' }}; text-decoration: none; font-weight: 600; font-size: 15px; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="if (!{{ request()->routeIs('pricing') ? 'true' : 'false' }}) this.style.color='var(--text-primary)'">Pricing</a>
            <a href="{{ route('contact') }}" style="color: {{ request()->routeIs('contact') ? 'var(--primary)' : 'var(--text-primary)' }}; text-decoration: none; font-weight: 600; font-size: 15px; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="if (!{{ request()->routeIs('contact') ? 'true' : 'false' }}) this.style.color='var(--text-primary)'">Contact Us</a>
        </div>

        <!-- Auth Action Buttons -->
        <div class="desktop-auth-btns" style="display: flex; align-items: center; gap: 12px;">
            @if(auth()->check())
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn-primary" style="padding: 9px 18px; font-size: 14px;">Dashboard</a>
                @elseif(auth()->user()->isTrainer())
                    <a href="{{ route('trainer.dashboard') }}" class="btn-primary" style="padding: 9px 18px; font-size: 14px;">Dashboard</a>
                @else
                    <a href="{{ route('member.dashboard') }}" class="btn-primary" style="padding: 9px 18px; font-size: 14px;">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-secondary" style="padding: 9px 18px; font-size: 14px;">Log In</a>
                <a href="{{ route('signup') }}" class="btn-primary" style="padding: 9px 18px; font-size: 14px;">Sign Up</a>
            @endif

            <!-- Mobile Hamburger Menu Button -->
            <button onclick="toggleMobileMenu()" class="mobile-menu-btn" style="display: none; background: none; border: 1px solid var(--border-surface-variant); color: white; border-radius: var(--radius-md); padding: 6px; cursor: pointer;">
                <span class="material-symbols-outlined" style="font-size: 24px;">menu</span>
            </button>
        </div>

    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobileMenu" style="display: none; background: var(--bg-dark-1); border-bottom: 1px solid var(--border-surface-variant); padding: 16px 24px; flex-direction: column; gap: 14px;">
        <a href="{{ route('home') }}" style="color: white; text-decoration: none; font-weight: 600;">Home</a>
        <a href="{{ route('about') }}" style="color: white; text-decoration: none; font-weight: 600;">About Us</a>
        <a href="{{ route('pricing') }}" style="color: white; text-decoration: none; font-weight: 600;">Pricing</a>
        <a href="{{ route('contact') }}" style="color: white; text-decoration: none; font-weight: 600;">Contact Us</a>
        <div style="display: flex; gap: 10px; margin-top: 10px;">
            <a href="{{ route('login') }}" class="btn-secondary" style="flex: 1; text-align: center; text-decoration: none;">Log In</a>
            <a href="{{ route('signup') }}" class="btn-primary" style="flex: 1; text-align: center; text-decoration: none;">Sign Up</a>
        </div>
    </div>
</nav>

<style>
@media (max-width: 768px) {
    .desktop-nav-links { display: none !important; }
    .desktop-auth-btns a { display: none !important; }
    .mobile-menu-btn { display: block !important; }
}
</style>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'flex';
    } else {
        menu.style.display = 'none';
    }
}
</script>
