@extends('layouts.app')

@section('title', 'Diet Plans - FitCore Gym Management')
@section('header_title', 'Nutrition & Diet Plans')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">

    <!-- Category Filter Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('diet-plans.index', ['category' => 'all']) }}" class="btn-secondary {{ $category === 'all' ? 'btn-primary' : '' }}" style="padding: 8px 16px; font-size: 13px;">All Plans</a>
            <a href="{{ route('diet-plans.index', ['category' => 'weight_loss']) }}" class="btn-secondary {{ $category === 'weight_loss' ? 'btn-primary' : '' }}" style="padding: 8px 16px; font-size: 13px;">Weight Loss</a>
            <a href="{{ route('diet-plans.index', ['category' => 'muscle_gain']) }}" class="btn-secondary {{ $category === 'muscle_gain' ? 'btn-primary' : '' }}" style="padding: 8px 16px; font-size: 13px;">Muscle Gain</a>
            <a href="{{ route('diet-plans.index', ['category' => 'maintenance']) }}" class="btn-secondary {{ $category === 'maintenance' ? 'btn-primary' : '' }}" style="padding: 8px 16px; font-size: 13px;">Maintenance</a>
        </div>

        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isTrainer()))
        <button class="btn-primary" onclick="document.getElementById('createDietPlanModal').classList.add('active')">
            <span class="material-symbols-outlined">add</span>
            <span>Create Diet Plan</span>
        </button>
        @endif
    </div>

    <!-- Bento Grid of Diet Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 24px;">
        @forelse($dietPlans as $plan)
        <div class="fit-card">
            <div style="height: 180px; position: relative; overflow: hidden;">
                <img src="{{ $plan->image_url ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $plan->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, var(--bg-card) 0%, transparent 60%);"></div>
                <span class="badge badge-primary" style="position: absolute; top: 14px; left: 14px; text-transform: capitalize;">{{ str_replace('_', ' ', $plan->category) }}</span>
            </div>
            <div style="padding: 20px;">
                <h3 style="font-size: 20px; color: white; margin-bottom: 6px;">{{ $plan->title }}</h3>
                <p style="color: var(--text-secondary); font-size: 13px; margin-bottom: 16px; line-height: 1.5;">{{ $plan->description }}</p>
                <div style="font-size: 12px; color: var(--text-muted); margin-bottom: 16px;">Trainer: {{ $plan->trainer->name ?? 'Marcus Vance' }}</div>

                <button class="btn-primary" style="width: 100%;" onclick="openDietPlanModal('{{ addslashes($plan->title) }}', '{{ addslashes(str_replace('_', ' ', $plan->category)) }}', '{{ $plan->image_url }}', '{{ addslashes($plan->breakfast) }}', '{{ addslashes($plan->lunch) }}', '{{ addslashes($plan->snacks) }}', '{{ addslashes($plan->dinner) }}', '{{ $plan->id }}')">
                    <span class="material-symbols-outlined">visibility</span>
                    <span>View Full Plan</span>
                </button>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: var(--text-muted);" class="fit-card">
            No diet plans found under this category.
        </div>
        @endforelse
    </div>
</div>
@endsection

@section('modals')
<!-- View Full Plan Modal Overlay -->
<div class="modal-overlay" id="viewPlanModal">
    <div class="modal-card" style="max-width: 680px;">
        <div style="position: relative; height: 180px; overflow: hidden; border-radius: var(--radius-xl) var(--radius-xl) 0 0;">
            <img id="modalPlanImage" src="" alt="Plan Banner" style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; inset: 0; background: linear-gradient(to top, var(--bg-card) 10%, rgba(0,0,0,0.4) 100%);"></div>
            
            <button onclick="closeDietPlanModal()" style="position: absolute; top: 16px; right: 16px; background: rgba(0,0,0,0.6); border: 1px solid var(--border-surface-variant); color: white; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                <span class="material-symbols-outlined">close</span>
            </button>

            <div style="position: absolute; bottom: 16px; left: 24px; right: 24px;">
                <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 4px;">
                    <span class="badge badge-primary" id="modalCategoryBadge">Active Template</span>
                </div>
                <h2 id="modalPlanTitle" style="font-size: 26px; color: white;">Plan Title</h2>
            </div>
        </div>

        <div class="modal-body" style="display: flex; flex-direction: column; gap: 16px;">
            <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 16px; border-radius: var(--radius-lg);">
                <div style="font-weight: 600; color: var(--primary); margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                    <span class="material-symbols-outlined">wb_sunny</span> Breakfast
                </div>
                <p id="modalBreakfast" style="color: white; font-size: 14px;"></p>
            </div>

            <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 16px; border-radius: var(--radius-lg);">
                <div style="font-weight: 600; color: var(--primary); margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                    <span class="material-symbols-outlined">wb_twilight</span> Lunch
                </div>
                <p id="modalLunch" style="color: white; font-size: 14px;"></p>
            </div>

            <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 16px; border-radius: var(--radius-lg);">
                <div style="font-weight: 600; color: var(--primary); margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                    <span class="material-symbols-outlined">local_cafe</span> Snacks
                </div>
                <p id="modalSnacks" style="color: white; font-size: 14px;"></p>
            </div>

            <div style="background: var(--bg-dark-3); border: 1px solid var(--border-surface-variant); padding: 16px; border-radius: var(--radius-lg);">
                <div style="font-weight: 600; color: var(--primary); margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                    <span class="material-symbols-outlined">bedtime</span> Dinner
                </div>
                <p id="modalDinner" style="color: white; font-size: 14px;"></p>
            </div>
        </div>

        <div class="modal-footer" style="justify-content: space-between;">
            <form id="assignPlanForm" action="" method="POST" style="display: flex; align-items: center; gap: 10px; flex: 1;">
                @csrf
                <select name="member_id" class="form-select" style="max-width: 240px; font-size: 13px;" required>
                    <option value="">Select Member...</option>
                    @foreach($members as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary" style="padding: 10px 16px; font-size: 13px;">
                    <span class="material-symbols-outlined">assignment_ind</span>
                    <span>Assign to Member</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Create Diet Plan Modal -->
<div class="modal-overlay" id="createDietPlanModal">
    <div class="modal-card" style="max-width: 600px;">
        <div class="modal-header">
            <h3 style="font-size: 20px; color: white;">Create New Diet Plan</h3>
            <button onclick="document.getElementById('createDietPlanModal').classList.remove('active')" style="background: none; border: none; color: white; cursor: pointer;">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form action="{{ route('diet-plans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body" style="display: flex; flex-direction: column; gap: 14px;">
                <div class="form-group">
                    <label class="form-label">Plan Title</label>
                    <input type="text" name="title" class="form-input" placeholder="e.g. Muscle Recomp Plan" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <option value="muscle_gain">Muscle Gain</option>
                        <option value="weight_loss">Weight Loss</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Summary Description</label>
                    <textarea name="description" class="form-textarea" rows="2" required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Breakfast Menu</label>
                    <input type="text" name="breakfast" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Lunch Menu</label>
                    <input type="text" name="lunch" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Snacks Menu</label>
                    <input type="text" name="snacks" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Dinner Menu</label>
                    <input type="text" name="dinner" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Image Upload</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="document.getElementById('createDietPlanModal').classList.remove('active')">Cancel</button>
                <button type="submit" class="btn-primary">Save Diet Plan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openDietPlanModal(title, category, imgUrl, breakfast, lunch, snacks, dinner, planId) {
    document.getElementById('modalPlanTitle').textContent = title;
    document.getElementById('modalCategoryBadge').textContent = category;
    document.getElementById('modalPlanImage').src = imgUrl || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80';
    document.getElementById('modalBreakfast').textContent = breakfast || 'Balanced breakfast option';
    document.getElementById('modalLunch').textContent = lunch || 'Lean protein & carbs';
    document.getElementById('modalSnacks').textContent = snacks || 'Healthy snack';
    document.getElementById('modalDinner').textContent = dinner || 'Light dinner';
    
    document.getElementById('assignPlanForm').action = '/diet-plans/' + planId + '/assign';
    document.getElementById('viewPlanModal').classList.add('active');
}

function closeDietPlanModal() {
    document.getElementById('viewPlanModal').classList.remove('active');
}
</script>
@endsection
