@extends('layouts.app')

@section('title', 'Notifications - FitCore Gym Management')
@section('header_title', 'System & Fee Alerts')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="font-size: 20px;">30-Day Fee Alerts</h3>
        <span class="badge badge-primary">{{ count($notifications) }} Total Alerts</span>
    </div>

    <div style="display: flex; flex-direction: column; gap: 14px;">
        @forelse($notifications as $notice)
        @php $userMembership = $notice->member ? $notice->member->membership : null; @endphp
        <div class="fit-card" style="padding: 18px 22px; display: flex; align-items: center; justify-content: space-between; gap: 16px; border-left: 4px solid {{ $notice->is_resolved ? 'var(--success)' : 'var(--primary)' }};">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 44px; height: 44px; background: rgba(255, 95, 31, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <div>
                    <div style="font-weight: 600; color: white; font-size: 15px;">{{ $notice->message }}</div>
                    <div style="font-size: 12px; color: var(--text-muted);">
                        Created {{ $notice->created_at->diffForHumans() }}
                        @if($notice->is_resolved)
                            · <span style="color: var(--success); font-weight: 600;">Resolved ({{ strtoupper($notice->resolved_action) }})</span>
                        @endif
                    </div>
                </div>
            </div>

            @if(!$notice->is_resolved && $userMembership)
            <div style="display: flex; gap: 8px;">
                <form action="{{ route('admin.mark-paid', $userMembership->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary" style="padding: 8px 14px; font-size: 12px;">
                        <span class="material-symbols-outlined" style="font-size: 16px;">check_circle</span>
                        <span>Paid</span>
                    </button>
                </form>

                <a href="{{ route('admin.mark-unpaid', $userMembership->id) }}" target="_blank" class="btn-secondary" style="padding: 8px 14px; font-size: 12px; border-color: var(--success); color: var(--success);">
                    <span class="material-symbols-outlined" style="font-size: 16px;">chat</span>
                    <span>Unpaid (WhatsApp)</span>
                </a>
            </div>
            @endif
        </div>
        @empty
        <div class="fit-card" style="padding: 40px; text-align: center; color: var(--text-muted);">
            No fee notifications currently present.
        </div>
        @endforelse
    </div>

</div>
@endsection
