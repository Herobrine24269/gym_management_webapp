@extends('layouts.public')

@section('title', 'Contact Us - FitCore Gym Management')

@section('content')
<section style="padding: 60px 24px; max-width: 1100px; margin: 0 auto;">
    
    <div style="text-align: center; margin-bottom: 40px;">
        <span class="badge badge-primary" style="margin-bottom: 12px; font-size: 13px;">Get in Touch</span>
        <h1 style="font-size: 40px; font-family: var(--font-heading); text-transform: uppercase;">CONTACT <span style="color: var(--primary);">FITCORE</span></h1>
        <p style="color: var(--text-secondary); font-size: 15px; margin-top: 6px;">Have questions about memberships, trainer booking, or facility tours? Send us a message.</p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid var(--success); color: var(--success); padding: 14px 20px; border-radius: var(--radius-md); font-size: 14px; margin-bottom: 24px; text-align: center; font-weight: 600;">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background: rgba(255, 77, 77, 0.15); border: 1px solid var(--error); color: var(--error); padding: 14px 20px; border-radius: var(--radius-md); font-size: 14px; margin-bottom: 24px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 32px;" class="contact-grid">
        
        <!-- Contact Form Card -->
        <div class="fit-card" style="padding: 32px;">
            <h3 style="font-size: 22px; color: white; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <span class="material-symbols-outlined" style="color: var(--primary);">mail</span>
                <span>Send Us a Direct Message</span>
            </h3>

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-input" placeholder="Jordan Miller" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-input" placeholder="jordan@example.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input" placeholder="+1 (555) 948-2011" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Subject *</label>
                        <input type="text" name="subject" class="form-input" placeholder="Membership Inquiry" value="{{ old('subject') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Message *</label>
                    <textarea name="message" class="form-textarea" rows="5" placeholder="How can we help you achieve your fitness goals?" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; padding: 14px; font-size: 15px;">
                    <span class="material-symbols-outlined">send</span>
                    <span>Submit Contact Message</span>
                </button>
            </form>
        </div>

        <!-- Gym Info & WhatsApp Chat Card -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- WhatsApp Chat Card -->
            <div class="fit-card" style="padding: 28px; background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, var(--bg-dark-1) 100%); border: 1px solid rgba(34, 197, 94, 0.4);">
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 14px;">
                    <div style="width: 48px; height: 48px; background: #25d366; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 15px rgba(37, 211, 102, 0.4);">
                        <span class="material-symbols-outlined" style="color: white; font-size: 28px;">chat</span>
                    </div>
                    <div>
                        <h4 style="font-size: 18px; color: white;">Instant WhatsApp Support</h4>
                        <p style="font-size: 12px; color: var(--text-muted);">Available 24/7 for quick assistance</p>
                    </div>
                </div>
                <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.5; margin-bottom: 18px;">
                    Need immediate answers regarding membership pricing, personal training slots, or keycard access? Chat directly with our gym manager on WhatsApp.
                </p>
                
                @php
                    $whatsappNumber = preg_replace('/[^0-9]/', '', $setting->whatsapp_phone ?? '+15559482011');
                    $whatsappMsg = urlencode("Hi FitCore Gym! I have a quick question about membership and plans.");
                @endphp
                
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappMsg }}" target="_blank" rel="noopener noreferrer" class="btn-success" style="width: 100%; padding: 12px; font-size: 14px; display: inline-flex; justify-content: center; text-decoration: none;">
                    <span class="material-symbols-outlined">forum</span>
                    <span>Chat on WhatsApp Now</span>
                </a>
            </div>

            <!-- Direct Contact Info Card -->
            <div class="fit-card" style="padding: 28px;">
                <h4 style="font-size: 18px; color: white; margin-bottom: 16px;">Gym Information</h4>
                <div style="display: flex; flex-direction: column; gap: 14px; font-size: 14px; color: var(--text-secondary);">
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <span class="material-symbols-outlined" style="color: var(--primary);">location_on</span>
                        <span>1044 Apex Blvd, Metro Heights, NY 10001</span>
                    </div>
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <span class="material-symbols-outlined" style="color: var(--primary);">call</span>
                        <span>+1 (800) 555-CORE / {{ $setting->whatsapp_phone ?? '+1 (555) 948-2011' }}</span>
                    </div>
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <span class="material-symbols-outlined" style="color: var(--primary);">mail</span>
                        <span>contact@fitcore.gym</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<style>
@media (max-width: 900px) {
    .contact-grid { grid-template-columns: 1fr !important; }
}
</style>
@endsection
