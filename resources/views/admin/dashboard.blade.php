@extends('layouts.app')

@section('title', 'Admin Dashboard - FitCore Gym Management')
@section('header_title', 'Admin Control Center')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">

    <!-- Overview Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="fit-card" style="padding: 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 52px; height: 52px; background: rgba(255, 95, 31, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                <span class="material-symbols-outlined" style="font-size: 32px;">group</span>
            </div>
            <div>
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Total Active Members</div>
                <div style="font-size: 28px; font-family: var(--font-heading); color: white; margin-top: 2px;">{{ $totalMembers }}</div>
            </div>
        </div>

        <div class="fit-card" style="padding: 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 52px; height: 52px; background: rgba(34, 197, 94, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--success);">
                <span class="material-symbols-outlined" style="font-size: 32px;">payments</span>
            </div>
            <div>
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Paid This Month</div>
                <div style="font-size: 28px; font-family: var(--font-heading); color: white; margin-top: 2px;">{{ $paidCount }}</div>
            </div>
        </div>

        <div class="fit-card" style="padding: 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 52px; height: 52px; background: rgba(255, 77, 77, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--error);">
                <span class="material-symbols-outlined" style="font-size: 32px;">warning</span>
            </div>
            <div>
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Unpaid / Due Soon</div>
                <div style="font-size: 28px; font-family: var(--font-heading); color: white; margin-top: 2px;">{{ $unpaidCount }}</div>
            </div>
        </div>

        <div class="fit-card" style="padding: 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 52px; height: 52px; background: rgba(245, 158, 11, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--warning);">
                <span class="material-symbols-outlined" style="font-size: 32px;">badge</span>
            </div>
            <div>
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Active Staff Trainers</div>
                <div style="font-size: 28px; font-family: var(--font-heading); color: white; margin-top: 2px;">{{ $activeTrainers }}</div>
            </div>
        </div>
    </div>

    <!-- Active Notifications Section -->
    @if(count($unresolvedNotifications) > 0)
    <div class="fit-card" style="padding: 20px; margin-bottom: 30px; border-left: 4px solid var(--primary);">
        <h3 style="font-size: 18px; color: white; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
            <span class="material-symbols-outlined" style="color: var(--primary);">notifications_active</span>
            <span>Fee Action Alerts ({{ count($unresolvedNotifications) }})</span>
        </h3>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            @foreach($unresolvedNotifications as $notice)
            @php
                $userMembership = $notice->member->membership;
            @endphp
            <div style="background: var(--bg-dark-3); padding: 14px 18px; border-radius: var(--radius-lg); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div>
                    <strong style="color: white; font-size: 14px;">{{ $notice->message }}</strong>
                    <div style="font-size: 12px; color: var(--text-muted);">Created {{ $notice->created_at->diffForHumans() }}</div>
                </div>
                @if($userMembership)
                <div style="display: flex; gap: 8px;">
                    <form action="{{ route('admin.mark-paid', $userMembership->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary" style="padding: 6px 14px; font-size: 12px;">
                            <span class="material-symbols-outlined" style="font-size: 16px;">check_circle</span>
                            <span>Mark Paid</span>
                        </button>
                    </form>

                    <a href="{{ route('admin.mark-unpaid', $userMembership->id) }}" target="_blank" class="btn-secondary" style="padding: 6px 14px; font-size: 12px; border-color: var(--success); color: var(--success);">
                        <span class="material-symbols-outlined" style="font-size: 16px;">chat</span>
                        <span>Unpaid (WhatsApp)</span>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Full Member Roster Table Card with Search & Filter -->
    <div class="fit-card" style="padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="font-size: 20px;">Gym Member Management</h3>
                <p style="color: var(--text-muted); font-size: 13px;">Manage 30-day fee status, trainer assignments, and profile actions.</p>
            </div>

            <!-- Search & Filter Controls -->
            <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <div class="input-wrapper" style="width: 220px;">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" name="search" class="form-input" placeholder="Search name/phone..." value="{{ $searchQuery }}">
                </div>

                <select name="status" class="form-select" style="width: 140px;" onchange="this.form.submit()">
                    <option value="all" {{ $filterStatus === 'all' ? 'selected' : '' }}>All Status</option>
                    <option value="paid" {{ $filterStatus === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="due_soon" {{ $filterStatus === 'due_soon' ? 'selected' : '' }}>Due Soon</option>
                    <option value="unpaid" {{ $filterStatus === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>

                <button type="submit" class="btn-secondary" style="padding: 10px 14px;">Filter</button>
            </form>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-surface-variant); color: var(--text-muted); font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 12px;">Member</th>
                        <th style="padding: 12px;">Phone</th>
                        <th style="padding: 12px;">Fee Status</th>
                        <th style="padding: 12px;">Days Remaining</th>
                        <th style="padding: 12px;">Assigned Trainer</th>
                        <th style="padding: 12px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($memberships as $membership)
                    @php $member = $membership->user; @endphp
                    @if($member && $member->status === 'active')
                    <tr style="border-bottom: 1px solid var(--border-surface-variant);">
                        <td style="padding: 14px 12px; display: flex; align-items: center; gap: 12px;">
                            <img src="{{ $member->profile_photo_url ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=80&q=80' }}" alt="Member" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <div style="font-weight: 600; color: white;">{{ $member->name }}</div>
                                <div style="font-size: 12px; color: var(--text-muted);">{{ $member->email }}</div>
                            </div>
                        </td>
                        <td style="padding: 12px; color: var(--text-secondary);">{{ $member->phone ?? 'N/A' }}</td>
                        <td style="padding: 12px;">
                            @if($membership->status === 'paid')
                                <span class="badge badge-success">Paid ($79.99)</span>
                            @elseif($membership->status === 'due_soon')
                                <span class="badge badge-warning">Due Soon (5 Days)</span>
                            @else
                                <span class="badge" style="background: rgba(255,77,77,0.15); color: var(--error); border: 1px solid rgba(255,77,77,0.3);">Unpaid / Overdue</span>
                            @endif
                        </td>
                        <td style="padding: 12px; font-weight: 600;">
                            @if($membership->days_remaining > 0)
                                <span style="color: var(--success);">{{ $membership->days_remaining }} Days Left</span>
                            @else
                                <span style="color: var(--error);">{{ abs($membership->days_remaining) }} Days Overdue</span>
                            @endif
                        </td>
                        <td style="padding: 12px;">
                            <form action="{{ route('admin.assign-trainer', $membership->id) }}" method="POST">
                                @csrf
                                <select name="trainer_id" class="form-select" style="font-size: 12px; padding: 6px 10px;" onchange="this.form.submit()">
                                    <option value="">No Trainer Assigned</option>
                                    @foreach($trainers as $trainer)
                                        <option value="{{ $trainer->id }}" {{ $membership->assigned_trainer_id == $trainer->id ? 'selected' : '' }}>
                                            {{ $trainer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <div style="display: flex; gap: 6px; justify-content: flex-end;">
                                <form action="{{ route('admin.mark-paid', $membership->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-primary" style="padding: 6px 10px; font-size: 12px;" title="Mark Paid">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">check</span>
                                    </button>
                                </form>

                                <a href="{{ route('admin.mark-unpaid', $membership->id) }}" target="_blank" class="btn-secondary" style="padding: 6px 10px; font-size: 12px; border-color: var(--success); color: var(--success);" title="Unpaid (WhatsApp Chat)">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">chat</span>
                                </a>

                                <a href="{{ route('member.profile', $member->id) }}" class="btn-secondary" style="padding: 6px 10px; font-size: 12px;" title="View Profile">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 30px; text-align: center; color: var(--text-muted);">
                            No members found matching your search filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
