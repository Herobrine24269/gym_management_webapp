@extends('layouts.public')

@section('title', 'About Us - FitCore Gym Management')

@section('content')
<!-- Header Banner -->
<section style="padding: 80px 24px 40px 24px; text-align: center; background: radial-gradient(circle at top, rgba(255, 95, 31, 0.15), transparent 60%);">
    <div style="max-width: 800px; margin: 0 auto;">
        <span class="badge badge-primary" style="margin-bottom: 14px; font-size: 13px;">Our Mission & Ethos</span>
        <h1 style="font-size: 44px; font-family: var(--font-heading); text-transform: uppercase;">ABOUT <span style="color: var(--primary);">FITCORE</span></h1>
        <p style="color: var(--text-secondary); font-size: 16px; margin-top: 10px; line-height: 1.6;">
            We built FitCore to eliminate distraction and create a high-trust, data-driven environment for athletes, beginners, and powerlifters.
        </p>
    </div>
</section>

<!-- Brand Story & Values -->
<section style="padding: 40px 24px 60px 24px; max-width: 1200px; margin: 0 auto;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; margin-bottom: 60px;">
        <div class="fit-card" style="padding: 36px;">
            <h2 style="font-size: 28px; color: white; margin-bottom: 16px;">BUILT FOR DISCIPLINE & RESULTS</h2>
            <p style="color: var(--text-secondary); font-size: 15px; line-height: 1.7; margin-bottom: 16px;">
                Founded in 2024, FitCore set out to redefine commercial gym standards. By combining dark aesthetic industrial design with precision lifting gear and automated member portals, we ensure every athlete focuses entirely on their progress.
            </p>
            <p style="color: var(--text-secondary); font-size: 15px; line-height: 1.7;">
                Whether your goal is powerlifting, body recomposition, or cardiovascular endurance, our master trainers build structured roadmaps backed by custom macro nutrition.
            </p>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80" alt="FitCore Facility" style="width: 100%; border-radius: var(--radius-xl); border: 1px solid var(--border-surface-variant); box-shadow: var(--shadow-card); height: 360px; object-fit: cover;">
        </div>
    </div>

    <!-- Staff Trainer Roster Section -->
    <div style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-size: 32px; font-family: var(--font-heading); text-transform: uppercase;">MEET OUR MASTER <span style="color: var(--primary);">TRAINERS</span></h2>
        <p style="color: var(--text-muted); font-size: 15px; margin-top: 6px;">Certified strength specialists dedicated to your coaching roadmap.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
        <!-- Trainer 1 -->
        <div class="fit-card" style="padding: 24px; text-align: center;">
            <img src="https://images.unsplash.com/photo-1567013127542-490d757e51fc?auto=format&fit=crop&w=200&q=80" alt="Marcus Vance" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary); margin-bottom: 16px;">
            <h3 style="font-size: 20px; color: white;">Marcus Vance</h3>
            <span class="badge badge-primary" style="margin: 6px 0 12px 0;">Head Strength Coach</span>
            <p style="color: var(--text-secondary); font-size: 13px; line-height: 1.5;">Specializes in Olympic weightlifting, hypertrophy mechanics, and injury rehabilitation protocols.</p>
        </div>

        <!-- Trainer 2 -->
        <div class="fit-card" style="padding: 24px; text-align: center;">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80" alt="Elena Rostova" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary); margin-bottom: 16px;">
            <h3 style="font-size: 20px; color: white;">Elena Rostova</h3>
            <span class="badge badge-success" style="margin: 6px 0 12px 0;">HIIT & Sports Nutritionist</span>
            <p style="color: var(--text-secondary); font-size: 13px; line-height: 1.5;">Expert in fat-oxidation diet plans, metabolic conditioning, and cardiovascular endurance tracking.</p>
        </div>
    </div>
</section>
@endsection
