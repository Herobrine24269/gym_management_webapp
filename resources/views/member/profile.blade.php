@extends('layouts.app')

@section('title', 'Member Profile - FitCore Gym Management')
@section('header_title', 'Member Profile & Membership')

@section('content')
<div style="max-width: 1100px; margin: 0 auto;">

    <!-- Top Profile Banner & Info Header -->
    <div class="fit-card" style="margin-bottom: 24px;">
        <div style="height: 140px; background: position: relative;"></div>
        
        <div style="padding: 0 30px 24px 30px; margin-top: -50px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
            <div style="display: flex; align-items: flex-end; gap: 20px;">
                <img src="{{ $member->profile_photo_url ?? 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80' }}" alt="{{ $member->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid var(--bg-card); box-shadow: var(--shadow-card);">
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                        <h2 style="font-size: 26px; color: white;" id="memberNameTitle">{{ $member->name }}</h2>
                        @if($member->status === 'cancelled')
                            <span class="badge" style="background: rgba(255,77,77,0.15); color: var(--error);">Cancelled</span>
                        @elseif($member->membership && $member->membership->status === 'paid')
                            <span class="badge badge-success">Active Paid Member</span>
                        @elseif($member->membership && $member->membership->status === 'due_soon')
                            <span class="badge badge-warning">Due Soon</span>
                        @else
                            <span class="badge" style="background: rgba(255,77,77,0.15); color: var(--error);">Unpaid / Overdue</span>
                        @endif
                    </div>
                    <p style="color: var(--text-secondary); font-size: 13px;">Member ID: #FC-{{ str_pad($member->id, 4, '0', STR_PAD_LEFT) }} · Joined {{ $member->join_date ? $member->join_date->format('M d, Y') : 'Recently' }}</p>
                </div>
            </div>

            <!-- Profile Action Buttons (Triggers for Modals) -->
            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isTrainer()))
            <div style="display: flex; gap: 12px; align-items: center;">
                <button class="btn-primary" onclick="openSendMessageModal('{{ $member->email }}')">
                    <span class="material-symbols-outlined">mail</span>
                    <span>Send Message</span>
                </button>
                @if(auth()->user()->isAdmin() && $member->status !== 'cancelled')
                <button class="btn-danger" onclick="openCancelMembershipModal('{{ addslashes($member->name) }}')">
                    <span class="material-symbols-outlined">person_remove</span>
                    <span>Cancel Membership</span>
                </button>
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Details Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">

        <!-- Personal & Membership Details Card -->
        <div class="fit-card" style="padding: 24px;">
            <h3 style="font-size: 18px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: var(--primary);">id_card</span>
                <span>Membership Details</span>
            </h3>

            <div style="display: flex; flex-direction: column; gap: 14px; font-size: 14px;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-surface-variant); padding-bottom: 10px;">
                    <span style="color: var(--text-muted);">Email Address</span>
                    <strong style="color: white;">{{ $member->email }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-surface-variant); padding-bottom: 10px;">
                    <span style="color: var(--text-muted);">Phone Number</span>
                    <strong style="color: white;">{{ $member->phone ?? 'Not provided' }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-surface-variant); padding-bottom: 10px;">
                    <span style="color: var(--text-muted);">Current Tier</span>
                    <strong style="color: var(--primary);">FitCore All-Access Pro</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-surface-variant); padding-bottom: 10px;">
                    <span style="color: var(--text-muted);">Monthly Fee</span>
                    <strong style="color: white;">${{ number_format($member->membership->monthly_fee ?? 79.99, 2) }} / month</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: var(--text-muted);">Next Renewal Date</span>
                    <strong style="color: var(--success);">{{ $member->membership && $member->membership->next_due_date ? $member->membership->next_due_date->format('M d, Y') : 'N/A' }}</strong>
                </div>
            </div>
        </div>

        <!-- Attendance Stats Card -->
        <div class="fit-card" style="padding: 24px;">
            <h3 style="font-size: 18px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: var(--primary);">query_stats</span>
                <span>Attendance & Activity</span>
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 14px; border-radius: var(--radius-md); text-align: center;">
                    <div style="font-size: 28px; font-family: var(--font-heading); color: var(--primary);">18</div>
                    <div style="font-size: 12px; color: var(--text-muted);">Check-ins This Month</div>
                </div>
                <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 14px; border-radius: var(--radius-md); text-align: center;">
                    <div style="font-size: 28px; font-family: var(--font-heading); color: white;">94%</div>
                    <div style="font-size: 12px; color: var(--text-muted);">Workout Consistency</div>
                </div>
            </div>

            <div style="font-size: 13px; color: var(--text-secondary);">
                <strong style="color: white;">Assigned Personal Coach:</strong> {{ $member->membership && $member->membership->trainer ? $member->membership->trainer->name : 'Unassigned' }}
            </div>
        </div>

    </div>

</div>
@endsection

@section('modals')
<!-- Send Message Gmail-Style Compose Popup Card -->
<div class="compose-modal" id="sendMessageModal">
    <div class="compose-header">
        <div style="display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 14px; color: white;">
            <span class="material-symbols-outlined" style="color: var(--primary); font-size: 18px;">mail</span>
            <span>New Message</span>
        </div>
        <div style="display: flex; gap: 6px;">
            <button onclick="closeSendMessageModal()" style="background: none; border: none; color: var(--text-secondary); cursor: pointer;">
                <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
            </button>
        </div>
    </div>

    <form onsubmit="handleSendMessageSubmit(event)" style="padding: 16px; display: flex; flex-direction: column; gap: 12px;">
        <div style="display: flex; align-items: center; border-bottom: 1px solid var(--border-surface-variant); padding-bottom: 8px;">
            <span style="font-size: 13px; color: var(--text-muted); width: 60px;">To:</span>
            <input type="email" id="composeToInput" class="form-input" style="border: none; background: transparent; padding: 4px 0;" readonly value="{{ $member->email }}">
        </div>

        <div style="display: flex; align-items: center; border-bottom: 1px solid var(--border-surface-variant); padding-bottom: 8px;">
            <span style="font-size: 13px; color: var(--text-muted); width: 60px;">Subject:</span>
            <input type="text" class="form-input" style="border: none; background: transparent; padding: 4px 0; font-weight: 600; color: white;" value="FitCore Gym Reminder">
        </div>

        <div>
            <textarea class="form-textarea" rows="6" style="border: none; background: transparent; padding: 8px 0; resize: none;" required>Hi {{ $member->name }},

This is a message from FitCore Gym regarding your membership and workout activity.

Please let us know if you have any questions!

Best regards,
FitCore Team</textarea>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-surface-variant); padding-top: 12px; margin-top: 8px;">
            <button type="submit" class="btn-primary" style="padding: 8px 18px; font-size: 13px;">
                <span class="material-symbols-outlined">send</span>
                <span>Send</span>
            </button>
            <button type="button" onclick="closeSendMessageModal()" style="background: none; border: none; color: var(--text-muted); cursor: pointer;" title="Discard">
                <span class="material-symbols-outlined" style="font-size: 20px;">delete</span>
            </button>
        </div>
    </form>
</div>

<!-- Cancel Membership Confirmation Modal -->
<div class="modal-overlay" id="cancelMembershipModal">
    <div class="modal-card" style="max-width: 480px; text-align: center; overflow: hidden;">
        <form action="{{ route('admin.cancel-membership', $member->id) }}" method="POST">
            @csrf
            <div style="padding: 30px 24px 20px 24px;">
                <div style="width: 64px; height: 64px; background: rgba(255, 77, 77, 0.15); border: 1px solid rgba(255, 77, 77, 0.3); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <span class="material-symbols-outlined" style="color: var(--error); font-size: 36px;">warning</span>
                </div>

                <h2 style="font-size: 22px; font-family: var(--font-heading); margin-bottom: 8px; color: white;" id="cancelMemberModalHeading">Cancel {{ $member->name }}'s Membership?</h2>
                <p style="color: var(--text-secondary); font-size: 14px; margin-bottom: 20px; line-height: 1.6;">
                    Are you sure you want to cancel this membership? This action will immediately <strong style="color: var(--error);">deactivate gym keycard access</strong> and stop recurring monthly billing.
                </p>

                <div class="form-group" style="text-align: left; margin-bottom: 0;">
                    <label class="form-label">Reason for Cancellation</label>
                    <select class="form-select" name="cancellation_reason">
                        <option value="Relocation">Relocation / Moved away</option>
                        <option value="Cost">Cost / Financial reasons</option>
                        <option value="Dissatisfaction">Dissatisfaction with gym equipment/services</option>
                        <option value="Other">Other reason</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer" style="justify-content: space-between; background: var(--bg-dark-1);">
                <button type="button" class="btn-secondary" style="flex: 1;" onclick="closeCancelMembershipModal()">
                    <span>Go Back</span>
                </button>
                <button type="submit" class="btn-danger" style="flex: 1;">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>Confirm Cancellation</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openSendMessageModal(email) {
    document.getElementById('composeToInput').value = email;
    document.getElementById('sendMessageModal').classList.add('active');
}

function closeSendMessageModal() {
    document.getElementById('sendMessageModal').classList.remove('active');
}

function handleSendMessageSubmit(e) {
    e.preventDefault();
    alert('Message sent successfully to ' + document.getElementById('composeToInput').value + '!');
    closeSendMessageModal();
}

function openCancelMembershipModal(memberName) {
    document.getElementById('cancelMemberModalHeading').textContent = `Cancel ${memberName}'s Membership?`;
    document.getElementById('cancelMembershipModal').classList.add('active');
}

function closeCancelMembershipModal() {
    document.getElementById('cancelMembershipModal').classList.remove('active');
}
</script>
@endsection
