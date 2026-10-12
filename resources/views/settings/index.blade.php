@extends('layouts.app')

@section('title', 'Settings - FitCore Gym Management')
@section('header_title', 'System & Gym Settings')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">

    <!-- Tab Navigation Bar -->
    <div style="display: flex; gap: 12px; border-bottom: 1px solid var(--border-surface-variant); padding-bottom: 16px; margin-bottom: 30px; overflow-x: auto;">
        <button onclick="switchTab('trainers')" id="tab-btn-trainers" class="btn-secondary tab-btn active-tab" style="padding: 10px 20px; font-size: 14px;">
            <span class="material-symbols-outlined">badge</span>
            <span>Manage Trainers</span>
        </button>
        <button onclick="switchTab('fees')" id="tab-btn-fees" class="btn-secondary tab-btn" style="padding: 10px 20px; font-size: 14px;">
            <span class="material-symbols-outlined">payments</span>
            <span>Gym Fees</span>
        </button>
        <button onclick="switchTab('communications')" id="tab-btn-communications" class="btn-secondary tab-btn" style="padding: 10px 20px; font-size: 14px;">
            <span class="material-symbols-outlined">mark_email_unread</span>
            <span>Communications</span>
        </button>
        <button onclick="switchTab('info')" id="tab-btn-info" class="btn-secondary tab-btn" style="padding: 10px 20px; font-size: 14px;">
            <span class="material-symbols-outlined">storefront</span>
            <span>Gym Info</span>
        </button>
    </div>

    <!-- TAB 1: Manage Trainers -->
    <div id="tab-content-trainers" class="tab-pane" style="display: block;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h3 style="font-size: 20px;">Trainer Staff Roster</h3>
                <p style="color: var(--text-muted); font-size: 13px;">Manage active fitness coaches and assign client rosters.</p>
            </div>
            <button class="btn-primary" onclick="alert('Add Trainer modal opened')">
                <span class="material-symbols-outlined">person_add</span>
                <span>Add New Trainer</span>
            </button>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px;">
            <!-- Trainer Card 1 -->
            <div class="fit-card" style="padding: 20px;">
                <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 16px;">
                    <img src="https://images.unsplash.com/photo-1567013127542-490d757e51fc?auto=format&fit=crop&w=150&q=80" alt="Trainer" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                    <div>
                        <h4 style="font-size: 18px; color: white;">Marcus Vance</h4>
                        <p style="color: var(--text-secondary); font-size: 13px;">Strength & Conditioning Specialist</p>
                        <span class="badge badge-primary" style="margin-top: 4px;">18 Active Clients</span>
                    </div>
                </div>
                <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 16px;">
                    <div><strong style="color: var(--text-primary);">Email:</strong> m.vance@fitcore.gym</div>
                    <div><strong style="color: var(--text-primary);">Phone:</strong> +1 (555) 234-5678</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button class="btn-secondary" style="flex: 1; padding: 8px; font-size: 12px;">Edit Profile</button>
                    <button class="btn-secondary" style="padding: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: var(--error);">delete</span></button>
                </div>
            </div>

            <!-- Trainer Card 2 -->
            <div class="fit-card" style="padding: 20px;">
                <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 16px;">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" alt="Trainer" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                    <div>
                        <h4 style="font-size: 18px; color: white;">Elena Rostova</h4>
                        <p style="color: var(--text-secondary); font-size: 13px;">HIIT & Sports Nutritionist</p>
                        <span class="badge badge-success" style="margin-top: 4px;">24 Active Clients</span>
                    </div>
                </div>
                <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 16px;">
                    <div><strong style="color: var(--text-primary);">Email:</strong> e.rostova@fitcore.gym</div>
                    <div><strong style="color: var(--text-primary);">Phone:</strong> +1 (555) 876-5432</div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button class="btn-secondary" style="flex: 1; padding: 8px; font-size: 12px;">Edit Profile</button>
                    <button class="btn-secondary" style="padding: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: var(--error);">delete</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: Gym Fees -->
    <div id="tab-content-fees" class="tab-pane" style="display: none;">
        <!-- Card 1: Fee History Overview Stats -->
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 18px; margin-bottom: 14px;">Fee History Overview</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <div class="fit-card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(34, 197, 94, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--success);">
                        <span class="material-symbols-outlined" style="font-size: 28px;">account_balance_wallet</span>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Total Collected This Month</div>
                        <div style="font-size: 24px; font-family: var(--font-heading); color: white; margin-top: 2px;">$18,450.00</div>
                    </div>
                </div>

                <div class="fit-card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(245, 158, 11, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--warning);">
                        <span class="material-symbols-outlined" style="font-size: 28px;">pending_actions</span>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Pending Amount</div>
                        <div style="font-size: 24px; font-family: var(--font-heading); color: white; margin-top: 2px;">$3,120.00</div>
                    </div>
                </div>

                <div class="fit-card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(255, 77, 77, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--error);">
                        <span class="material-symbols-outlined" style="font-size: 28px;">warning</span>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Overdue Amount</div>
                        <div style="font-size: 24px; font-family: var(--font-heading); color: white; margin-top: 2px;">$840.00</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Fee Settings Form -->
        <div class="fit-card" style="padding: 30px;">
            <h3 style="font-size: 20px; margin-bottom: 20px;">Default Fee Structure</h3>
            <form onsubmit="event.preventDefault(); alert('Gym fee settings saved!');">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-bottom: 24px;">
                    <div class="form-group">
                        <label class="form-label">Default Monthly Fee ($)</label>
                        <div class="input-wrapper">
                            <span class="material-symbols-outlined">attach_money</span>
                            <input type="number" step="0.01" class="form-input" value="79.99" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Late Fee / Grace Period (Days)</label>
                        <div class="input-wrapper">
                            <span class="material-symbols-outlined">schedule</span>
                            <input type="number" class="form-input" value="5" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Default Currency</label>
                        <select class="form-select">
                            <option value="USD" selected>USD - US Dollar ($)</option>
                            <option value="EUR">EUR - Euro (€)</option>
                            <option value="GBP">GBP - British Pound (£)</option>
                            <option value="CAD">CAD - Canadian Dollar ($)</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined">save</span>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TAB 3: Communications -->
    <div id="tab-content-communications" class="tab-pane" style="display: none;">
        <div style="display: flex; flex-direction: column; gap: 24px;">
            <!-- Card 1: 30-Day Reminder Email Template -->
            <div class="fit-card" style="padding: 30px;">
                <div style="display: flex; items-center; gap: 12px; margin-bottom: 20px;">
                    <span class="material-symbols-outlined" style="color: var(--primary); font-size: 28px;">mail</span>
                    <div>
                        <h3 style="font-size: 20px;">30-Day Reminder Email Template</h3>
                        <p style="color: var(--text-muted); font-size: 13px;">Sent automatically 5 days before membership renewal is due.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Subject Line</label>
                    <input type="text" class="form-input" value="FitCore Membership Renewal Reminder - @{{due_date}}">
                </div>

                <div class="form-group">
                    <label class="form-label">Email Body Content</label>
                    <textarea class="form-textarea" rows="6">Hi @{{member_name}},

This is a friendly reminder from FitCore Gym that your monthly membership fee of $@{{amount}} is scheduled for renewal on @{{due_date}}.

To ensure uninterrupted access to the gym, locker facilities, and personal training sessions, please review your payment details or use the Pay Now button in your member portal.

Keep pushing your limits!
- The FitCore Team</textarea>
                </div>

                <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 12px 16px; border-radius: var(--radius-md); font-size: 13px; color: var(--text-muted);">
                    <strong style="color: var(--text-primary);">Available Placeholders:</strong> 
                    <span class="badge badge-primary" style="margin-left: 8px;">@{{member_name}}</span>
                    <span class="badge badge-primary">@{{due_date}}</span>
                    <span class="badge badge-primary">@{{amount}}</span>
                </div>
            </div>

            <!-- Card 2: WhatsApp Message Template -->
            <div class="fit-card" style="padding: 30px;">
                <div style="display: flex; items-center; gap: 12px; margin-bottom: 20px;">
                    <span class="material-symbols-outlined" style="color: var(--success); font-size: 28px;">chat</span>
                    <div>
                        <h3 style="font-size: 20px;">WhatsApp Message Template</h3>
                        <p style="color: var(--text-muted); font-size: 13px;">Default message used when sending instant WhatsApp fee notifications to members.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Unpaid WhatsApp Message Text</label>
                    <textarea class="form-textarea" rows="4">Hey @{{member_name}}! 🏋️‍♂️ Your FitCore gym fee of $@{{amount}} was due on @{{due_date}}. Please complete your payment in your portal to avoid late access restriction. Reply to this message if you have any questions!</textarea>
                </div>

                <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 12px 16px; border-radius: var(--radius-md); font-size: 13px; color: var(--text-muted);">
                    <strong style="color: var(--text-primary);">Available Placeholders:</strong> 
                    <span class="badge badge-primary" style="margin-left: 8px;">@{{member_name}}</span>
                    <span class="badge badge-primary">@{{due_date}}</span>
                    <span class="badge badge-primary">@{{amount}}</span>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button class="btn-primary" onclick="alert('Communication templates updated!')">
                    <span class="material-symbols-outlined">save</span>
                    <span>Save Templates</span>
                </button>
            </div>
        </div>
    </div>

    <!-- TAB 4: Gym Info -->
    <div id="tab-content-info" class="tab-pane" style="display: none;">
        <div class="fit-card" style="padding: 30px;">
            <h3 style="font-size: 20px; margin-bottom: 20px;">Gym Location & Brand Details</h3>
            <form onsubmit="event.preventDefault(); alert('Gym Info updated successfully!');">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Gym Name</label>
                        <div class="input-wrapper">
                            <span class="material-symbols-outlined">fitness_center</span>
                            <input type="text" class="form-input" value="FitCore Fitness & Performance Hub" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Phone</label>
                        <div class="input-wrapper">
                            <span class="material-symbols-outlined">call</span>
                            <input type="text" class="form-input" value="+1 (800) 555-CORE" required>
                        </div>
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">Contact Email</label>
                        <div class="input-wrapper">
                            <span class="material-symbols-outlined">mail</span>
                            <input type="email" class="form-input" value="contact@fitcore.gym" required>
                        </div>
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">Gym Physical Address</label>
                        <div class="input-wrapper">
                            <span class="material-symbols-outlined">location_on</span>
                            <input type="text" class="form-input" value="1044 Apex Boulevard, Metro Heights, NY 10001" required>
                        </div>
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">Gym Brand Logo Upload</label>
                        <div class="dropzone" id="logoDropzone" onclick="document.getElementById('logoFileInput').click()">
                            <span class="material-symbols-outlined" style="font-size: 40px; color: var(--primary); margin-bottom: 8px;">cloud_upload</span>
                            <h4 style="font-size: 16px; margin-bottom: 4px; color: white;">Drag & Drop Gym Logo PNG / SVG</h4>
                            <p style="font-size: 12px; color: var(--text-muted);">Recommended resolution: 512x512px transparent background</p>
                            <input type="file" id="logoFileInput" style="display: none;" onchange="handleLogoSelect(this)">
                            <div id="selectedLogoName" style="font-size: 13px; color: var(--success); margin-top: 8px; font-weight: 600;"></div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 24px;">
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined">save</span>
                        <span>Save Info</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
function switchTab(tabName) {
    // Hide all tab panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.style.display = 'none';
    });
    // Remove active class from buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active-tab');
        btn.style.background = 'transparent';
        btn.style.borderColor = 'var(--border-surface-variant)';
        btn.style.color = 'var(--text-primary)';
    });

    // Show target tab pane
    const targetPane = document.getElementById('tab-content-' + tabName);
    if (targetPane) {
        targetPane.style.display = 'block';
    }

    // Highlight active button
    const activeBtn = document.getElementById('tab-btn-' + tabName);
    if (activeBtn) {
        activeBtn.classList.add('active-tab');
        activeBtn.style.background = 'var(--primary-container)';
        activeBtn.style.borderColor = 'var(--primary)';
        activeBtn.style.color = '#ffffff';
    }
}

function handleLogoSelect(input) {
    if (input.files && input.files[0]) {
        document.getElementById('selectedLogoName').textContent = 'Selected File: ' + input.files[0].name;
    }
}

// Initial active tab style setup
document.addEventListener('DOMContentLoaded', () => {
    switchTab('trainers');
});
</script>
@endsection
