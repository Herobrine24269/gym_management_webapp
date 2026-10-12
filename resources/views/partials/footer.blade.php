<footer style="background: var(--bg-dark-0); border-top: 1px solid var(--border-surface-variant); padding: 60px 24px 30px 24px; color: var(--text-secondary); margin-top: auto;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 40px; margin-bottom: 40px;">
        
        <!-- Brand Info -->
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <div style="width: 36px; height: 36px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: var(--glow-primary);">
                    <span class="material-symbols-outlined" style="color: white; font-size: 22px;">fitness_center</span>
                </div>
                <h2 style="font-size: 22px; line-height: 1; letter-spacing: -0.02em; color: white;">FIT<span style="color: var(--primary);">CORE</span></h2>
            </div>
            <p style="font-size: 14px; line-height: 1.6; color: var(--text-muted); margin-bottom: 20px;">
                FitCore is a high-performance fitness center engineered for discipline, momentum, and results. Experience modern strength training and custom macro nutrition.
            </p>
            <div style="display: flex; gap: 12px;">
                <a href="#" style="width: 36px; height: 36px; background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">share</span>
                </a>
                <a href="#" style="width: 36px; height: 36px; background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">photo_camera</span>
                </a>
            </div>
        </div>

        <!-- Navigation Links -->
        <div>
            <h4 style="font-size: 16px; color: white; margin-bottom: 16px; font-family: var(--font-heading);">QUICK NAVIGATION</h4>
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 10px; font-size: 14px;">
                <li><a href="{{ route('home') }}" style="color: var(--text-secondary); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-secondary)'">Home Landing</a></li>
                <li><a href="{{ route('about') }}" style="color: var(--text-secondary); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-secondary)'">About FitCore</a></li>
                <li><a href="{{ route('pricing') }}" style="color: var(--text-secondary); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-secondary)'">Membership Plans</a></li>
                <li><a href="{{ route('contact') }}" style="color: var(--text-secondary); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-secondary)'">Contact & Support</a></li>
                <li><a href="{{ route('login') }}" style="color: var(--text-secondary); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-secondary)'">Member Login</a></li>
            </ul>
        </div>

        <!-- Gym Hours -->
        <div>
            <h4 style="font-size: 16px; color: white; margin-bottom: 16px; font-family: var(--font-heading);">FACILITY HOURS</h4>
            <div style="display: flex; flex-direction: column; gap: 10px; font-size: 14px; color: var(--text-muted);">
                <div style="display: flex; justify-content: space-between;">
                    <span>Mon - Fri:</span>
                    <strong style="color: white;">5:00 AM - 11:00 PM</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Saturday:</span>
                    <strong style="color: white;">6:00 AM - 10:00 PM</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Sunday:</span>
                    <strong style="color: var(--primary);">24/7 Keycard Access</strong>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div>
            <h4 style="font-size: 16px; color: white; margin-bottom: 16px; font-family: var(--font-heading);">GYM LOCATION</h4>
            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
                <div style="display: flex; gap: 10px; align-items: flex-start;">
                    <span class="material-symbols-outlined" style="color: var(--primary); font-size: 20px;">location_on</span>
                    <span>1044 Apex Boulevard, Metro Heights, NY 10001</span>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <span class="material-symbols-outlined" style="color: var(--primary); font-size: 20px;">call</span>
                    <span>+1 (800) 555-CORE</span>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <span class="material-symbols-outlined" style="color: var(--primary); font-size: 20px;">mail</span>
                    <span>contact@fitcore.gym</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Copyright Bar -->
    <div style="max-width: 1200px; margin: 0 auto; border-top: 1px solid var(--border-surface-variant); padding-top: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; font-size: 13px; color: var(--text-muted);">
        <div>&copy; {{ date('Y') }} FitCore Gym Management System. All rights reserved.</div>
        <div style="display: flex; gap: 20px;">
            <a href="#" style="color: var(--text-muted); text-decoration: none;">Privacy Policy</a>
            <a href="#" style="color: var(--text-muted); text-decoration: none;">Terms of Service</a>
        </div>
    </div>
</footer>
