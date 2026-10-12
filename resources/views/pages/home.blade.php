@extends('layouts.public')

@section('title', 'FitCore - High Performance Fitness & Gym Center')

@section('content')
<!-- Hero Section -->
<section style="position: relative; padding: 90px 24px 70px 24px; background: radial-gradient(circle at top right, rgba(255, 95, 31, 0.2), transparent 50%), radial-gradient(circle at bottom left, rgba(18, 19, 26, 0.9), #000000); overflow: hidden;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;" class="hero-grid">
        <div>
            <span class="badge badge-primary" style="margin-bottom: 16px; font-size: 13px; padding: 6px 14px;">⚡ High-Performance Gym & Performance Hub</span>
            <h1 style="font-size: 52px; line-height: 1.1; margin-bottom: 20px; font-family: var(--font-heading); text-transform: uppercase;">
                TRANSFORM YOUR <br><span style="color: var(--primary);">BODY & MIND</span>
            </h1>
            <p style="font-size: 18px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 30px; max-width: 520px;">
                Engineered for serious athletes and fitness enthusiasts. Access state-of-the-art strength equipment, personalized macro nutrition, and expert 1-on-1 coaching.
            </p>

            <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('pricing') }}" class="btn-primary" style="padding: 14px 28px; font-size: 16px;">
                    <span>Explore Pricing & Plans</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="{{ route('signup') }}" class="btn-secondary" style="padding: 14px 24px; font-size: 16px;">
                    <span>Start Free Trial</span>
                </a>
            </div>

            <!-- Stats Counters -->
            <div style="display: flex; gap: 32px; margin-top: 48px; border-top: 1px solid var(--border-surface-variant); padding-top: 24px;">
                <div>
                    <div style="font-size: 32px; font-family: var(--font-heading); color: white;">480+</div>
                    <div style="font-size: 13px; color: var(--text-muted);">Active Athletes</div>
                </div>
                <div>
                    <div style="font-size: 32px; font-family: var(--font-heading); color: var(--primary);">14+</div>
                    <div style="font-size: 13px; color: var(--text-muted);">Master Trainers</div>
                </div>
                <div>
                    <div style="font-size: 32px; font-family: var(--font-heading); color: white;">24/7</div>
                    <div style="font-size: 13px; color: var(--text-muted);">Keycard Access</div>
                </div>
            </div>
        </div>

        <div style="position: relative; text-align: center;">
            <div style="position: absolute; inset: 0; background: var(--glow-primary-lg); border-radius: 50%; filter: blur(60px); opacity: 0.3;"></div>
            <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?auto=format&fit=crop&w=800&q=80" alt="FitCore Gym Action" style="width: 100%; max-width: 540px; border-radius: var(--radius-xl); border: 1px solid var(--border-surface-variant); box-shadow: var(--shadow-modal); position: relative; z-index: 2; object-fit: cover; height: 440px;">
        </div>
    </div>
</section>

<!-- Gym Photo Gallery Sliding Carousel Section -->
<section style="padding: 70px 24px; max-width: 1200px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 40px;">
        <span class="badge badge-primary" style="margin-bottom: 12px; font-size: 13px;">Facility Showcase</span>
        <h2 style="font-size: 36px; font-family: var(--font-heading); text-transform: uppercase;">EXPLORE OUR <span style="color: var(--primary);">WORLD-CLASS GYM</span></h2>
        <p style="color: var(--text-muted); font-size: 16px; margin-top: 8px;">Take a visual tour inside FitCore's premium lifting platforms, cardio zones, and recovery suites.</p>
    </div>

    <!-- Carousel Container -->
    <div style="position: relative; overflow: hidden; border-radius: var(--radius-xl); border: 1px solid var(--border-surface-variant); box-shadow: var(--shadow-card); height: 480px; background: var(--bg-dark-1);" id="gymCarousel">
        
        <!-- Slides Track -->
        <div id="carouselTrack" style="display: flex; transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1); height: 100%;">
            
            <!-- Slide 1 -->
            <div style="min-width: 100%; height: 100%; position: relative;">
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1200&q=80" alt="Olympic Power Racks" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.85) 100%);"></div>
                <div style="position: absolute; bottom: 32px; left: 32px; right: 32px;">
                    <span class="badge badge-primary" style="margin-bottom: 8px;">Strength Arena</span>
                    <h3 style="font-size: 28px; color: white; font-family: var(--font-heading);">Olympic Power Racks & Deadlift Platforms</h3>
                    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 4px;">Calibrated powerlifting plates, heavy steel racks, and shock-absorbing rubber flooring.</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div style="min-width: 100%; height: 100%; position: relative;">
                <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?auto=format&fit=crop&w=1200&q=80" alt="Free Weights Zone" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.85) 100%);"></div>
                <div style="position: absolute; bottom: 32px; left: 32px; right: 32px;">
                    <span class="badge badge-success" style="margin-bottom: 8px;">Free Weights</span>
                    <h3 style="font-size: 28px; color: white; font-family: var(--font-heading);">5lb - 150lb Urethane Dumbbell Section</h3>
                    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 4px;">Fully stocked dumbbell racks, adjustable incline benches, and cable crossover stations.</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div style="min-width: 100%; height: 100%; position: relative;">
                <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?auto=format&fit=crop&w=1200&q=80" alt="Cardio & Functional Floor" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.85) 100%);"></div>
                <div style="position: absolute; bottom: 32px; left: 32px; right: 32px;">
                    <span class="badge badge-warning" style="margin-bottom: 8px;">Cardio & HIIT</span>
                    <h3 style="font-size: 28px; color: white; font-family: var(--font-heading);">High-Performance Cardio & Functional Turf</h3>
                    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 4px;">Concept2 rowers, assault bikes, sled push turf, and curved treadmills.</p>
                </div>
            </div>

            <!-- Slide 4 -->
            <div style="min-width: 100%; height: 100%; position: relative;">
                <img src="https://images.unsplash.com/photo-1540497077202-7c8a3999166f?auto=format&fit=crop&w=1200&q=80" alt="Recovery Suite" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.85) 100%);"></div>
                <div style="position: absolute; bottom: 32px; left: 32px; right: 32px;">
                    <span class="badge badge-primary" style="margin-bottom: 8px;">Recovery Suite</span>
                    <h3 style="font-size: 28px; color: white; font-family: var(--font-heading);">Infrared Sauna & Post-Workout Cryo Suite</h3>
                    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 4px;">Accelerate muscle recovery with therapeutic heat treatment and cold plunge tubs.</p>
                </div>
            </div>

        </div>

        <!-- Navigation Buttons -->
        <button onclick="prevSlide()" style="position: absolute; top: 50%; left: 20px; transform: translateY(-50%); width: 44px; height: 44px; border-radius: 50%; background: rgba(18, 19, 26, 0.7); backdrop-filter: blur(8px); border: 1px solid var(--border-surface-variant); color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.2s;" onmouseover="this.style.background='var(--primary)'" onmouseout="this.style.background='rgba(18, 19, 26, 0.7)'">
            <span class="material-symbols-outlined" style="font-size: 24px;">chevron_left</span>
        </button>

        <button onclick="nextSlide()" style="position: absolute; top: 50%; right: 20px; transform: translateY(-50%); width: 44px; height: 44px; border-radius: 50%; background: rgba(18, 19, 26, 0.7); backdrop-filter: blur(8px); border: 1px solid var(--border-surface-variant); color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.2s;" onmouseover="this.style.background='var(--primary)'" onmouseout="this.style.background='rgba(18, 19, 26, 0.7)'">
            <span class="material-symbols-outlined" style="font-size: 24px;">chevron_right</span>
        </button>

        <!-- Carousel Indicator Dots -->
        <div style="position: absolute; bottom: 20px; right: 32px; display: flex; gap: 8px; z-index: 10;">
            <span class="carousel-dot active" onclick="goToSlide(0)"></span>
            <span class="carousel-dot" onclick="goToSlide(1)"></span>
            <span class="carousel-dot" onclick="goToSlide(2)"></span>
            <span class="carousel-dot" onclick="goToSlide(3)"></span>
        </div>

    </div>
</section>

<!-- Features Bento Grid -->
<section style="padding: 60px 24px; max-width: 1200px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 50px;">
        <h2 style="font-size: 36px; font-family: var(--font-heading); text-transform: uppercase;">WHY ATHLETES CHOOSE <span style="color: var(--primary);">FITCORE</span></h2>
        <p style="color: var(--text-muted); font-size: 16px; margin-top: 8px;">Built from the ground up for peak training performance.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
        <div class="fit-card" style="padding: 30px;">
            <div style="width: 52px; height: 52px; background: rgba(255, 95, 31, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 20px;">
                <span class="material-symbols-outlined" style="font-size: 32px;">fitness_center</span>
            </div>
            <h3 style="font-size: 22px; color: white; margin-bottom: 10px;">Pro Equipment</h3>
            <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6;">Heavy-duty power racks, Olympic lifting platforms, and calibrated plates built for maximum output.</p>
        </div>

        <div class="fit-card" style="padding: 30px;">
            <div style="width: 52px; height: 52px; background: rgba(255, 95, 31, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 20px;">
                <span class="material-symbols-outlined" style="font-size: 32px;">badge</span>
            </div>
            <h3 style="font-size: 22px; color: white; margin-bottom: 10px;">Certified Master Coaches</h3>
            <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6;">Personalized 1-on-1 coaching, form analysis, and custom programming to break plateau boundaries.</p>
        </div>

        <div class="fit-card" style="padding: 30px;">
            <div style="width: 52px; height: 52px; background: rgba(255, 95, 31, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 20px;">
                <span class="material-symbols-outlined" style="font-size: 32px;">restaurant_menu</span>
            </div>
            <h3 style="font-size: 22px; color: white; margin-bottom: 10px;">Macro Diet Protocols</h3>
            <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6;">Customized meal breakdown templates for muscle recomposition, keto fat loss, and athletic maintenance.</p>
        </div>

        <div class="fit-card" style="padding: 30px;">
            <div style="width: 52px; height: 52px; background: rgba(255, 95, 31, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 20px;">
                <span class="material-symbols-outlined" style="font-size: 32px;">groups</span>
            </div>
            <h3 style="font-size: 22px; color: white; margin-bottom: 10px;">Active Community Feed</h3>
            <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6;">Stay connected with gym announcements, high-intensity weekend group sessions, and member PRs.</p>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section style="padding: 60px 24px; max-width: 1200px; margin: 0 auto 60px auto;">
    <div class="fit-card" style="padding: 50px 40px; background: linear-gradient(135deg, rgba(255, 95, 31, 0.25) 0%, var(--bg-dark-1) 100%); border: 1px solid var(--primary); text-align: center;">
        <h2 style="font-size: 38px; font-family: var(--font-heading); color: white; margin-bottom: 12px;">READY TO ELEVATE YOUR FITNESS JOURNEY?</h2>
        <p style="font-size: 16px; color: var(--text-secondary); max-width: 600px; margin: 0 auto 28px auto;">Join FitCore today and unlock full access to world-class coaching, custom diet plans, and 24/7 facility entry.</p>
        <a href="{{ route('signup') }}" class="btn-primary" style="padding: 14px 32px; font-size: 16px; display: inline-flex;">
            <span>Get Started Now</span>
            <span class="material-symbols-outlined">bolt</span>
        </a>
    </div>
</section>

<style>
.carousel-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    transition: all 0.3s ease;
}
.carousel-dot.active {
    background: var(--primary);
    width: 28px;
    border-radius: 10px;
    box-shadow: var(--glow-primary);
}
@media (max-width: 900px) {
    .hero-grid { grid-template-columns: 1fr !important; text-align: center; }
    .hero-grid p { margin-left: auto; margin-right: auto; }
    .hero-grid div:first-child { display: flex; flex-direction: column; align-items: center; }
    #gymCarousel { height: 380px !important; }
}
</style>

@endsection

@section('scripts')
<script>
let currentSlide = 0;
const totalSlides = 4;
let autoSlideInterval;

function updateCarousel() {
    const track = document.getElementById('carouselTrack');
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
    
    const dots = document.querySelectorAll('.carousel-dot');
    dots.forEach((dot, index) => {
        if (index === currentSlide) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateCarousel();
    resetAutoSlide();
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateCarousel();
    resetAutoSlide();
}

function goToSlide(index) {
    currentSlide = index;
    updateCarousel();
    resetAutoSlide();
}

function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }, 4000);
}

function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

document.addEventListener('DOMContentLoaded', () => {
    startAutoSlide();
});
</script>
@endsection
