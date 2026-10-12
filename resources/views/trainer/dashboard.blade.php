@extends('layouts.app')

@section('title', 'Trainer Dashboard - FitCore Gym Management')
@section('header_title', 'Trainer Control Center')

@section('content')
<div style="max-width: 1100px; margin: 0 auto;">

    <!-- Welcome Card -->
    <div class="fit-card" style="padding: 24px; margin-bottom: 24px; background: radial-gradient(circle at top right, rgba(255, 95, 31, 0.2), var(--bg-card));">
        <h2 style="font-size: 26px; color: white;">Trainer Dashboard</h2>
        <p style="color: var(--text-secondary); font-size: 14px;">Welcome back, {{ auth()->user()->name }}! Managing your assigned athlete roster.</p>
    </div>

    <!-- Assigned Clients List -->
    <div class="fit-card" style="padding: 24px; margin-bottom: 24px;">
        <h3 style="font-size: 20px; margin-bottom: 16px;">My Assigned Members ({{ count($assignedMemberships) }})</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @forelse($assignedMemberships as $membership)
            @php $member = $membership->user; @endphp
            @if($member)
            <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); border-radius: var(--radius-lg); padding: 18px;">
                <div style="display: flex; gap: 14px; align-items: center; margin-bottom: 14px;">
                    <img src="{{ $member->profile_photo_url ?? 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80' }}" alt="Member Avatar" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                    <div>
                        <h4 style="font-size: 16px; color: white;">{{ $member->name }}</h4>
                        <div style="font-size: 12px; color: var(--text-muted);">{{ $member->email }}</div>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; margin-bottom: 14px; background: var(--bg-dark-2); padding: 8px 12px; border-radius: var(--radius-md);">
                    <span style="color: var(--text-muted);">Fee Status:</span>
                    @if($membership->status === 'paid')
                        <span class="badge badge-success">Paid</span>
                    @else
                        <span class="badge badge-warning">{{ ucfirst($membership->status) }}</span>
                    @endif
                </div>

                <div style="display: flex; gap: 8px;">
                    <a href="mailto:{{ $member->email }}?subject=FitCore%20Training%20Update" class="btn-primary" style="flex: 1; padding: 8px; font-size: 12px; text-decoration: none; text-align: center;">
                        <span class="material-symbols-outlined" style="font-size: 16px;">mail</span>
                        <span>Send Gmail</span>
                    </a>
                    <a href="{{ route('member.profile', $member->id) }}" class="btn-secondary" style="padding: 8px; font-size: 12px; text-decoration: none;">
                        <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                    </a>
                </div>
            </div>
            @endif
            @empty
            <div style="grid-column: 1 / -1; padding: 20px; text-align: center; color: var(--text-muted);">
                No members currently assigned to your roster.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
