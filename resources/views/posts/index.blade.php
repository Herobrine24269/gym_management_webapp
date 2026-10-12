@extends('layouts.app')

@section('title', 'Posts & Feed - FitCore Gym Management')
@section('header_title', 'Community Feed & Announcements')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">

    <!-- Compose New Post Card (Visible for Admin & Trainer) -->
    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isTrainer()))
    <div class="fit-card" style="padding: 24px; margin-bottom: 24px;">
        <h3 style="font-size: 18px; margin-bottom: 14px;">Publish Announcement</h3>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="title" class="form-input" placeholder="Announcement Title..." required>
            </div>
            <div class="form-group">
                <textarea name="description" class="form-textarea" rows="3" placeholder="Share workout tips, gym class updates, or motivational posts..." required></textarea>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <input type="file" name="image" id="postImageInput" accept="image/*" style="display: none;" onchange="document.getElementById('postFileName').textContent = this.files[0].name">
                <button type="button" class="btn-secondary" onclick="document.getElementById('postImageInput').click()" style="padding: 8px 14px; font-size: 12px;">
                    <span class="material-symbols-outlined" style="font-size: 18px; color: var(--primary);">add_photo_alternate</span>
                    <span>Attach Image</span>
                </button>
                <span id="postFileName" style="font-size: 12px; color: var(--success); font-weight: 600;"></span>

                <button type="submit" class="btn-primary">
                    <span class="material-symbols-outlined">send</span>
                    <span>Post Announcement</span>
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Feed Posts -->
    @forelse($posts as $post)
    <div class="fit-card" style="padding: 24px; margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img src="{{ $post->author->profile_photo_url ?? 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?auto=format&fit=crop&w=100&q=80' }}" alt="Author" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                <div>
                    <div style="font-weight: 600; color: white;">{{ $post->author->name ?? 'Staff Coach' }}</div>
                    <div style="font-size: 12px; color: var(--text-muted); text-transform: capitalize;">{{ $post->author->role ?? 'Trainer' }} · {{ $post->created_at->diffForHumans() }}</div>
                </div>
            </div>

            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $post->author_id))
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: none; border: none; color: var(--error); cursor: pointer;" title="Delete Post">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </form>
            @endif
        </div>

        <h3 style="font-size: 18px; color: white; margin-bottom: 8px;">{{ $post->title }}</h3>
        <p style="color: var(--text-primary); font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
            {{ $post->description }}
        </p>

        @if($post->image_url)
        <img src="{{ $post->image_url }}" alt="Post Image" style="width: 100%; max-height: 360px; object-fit: cover; border-radius: var(--radius-lg); margin-bottom: 14px;">
        @endif
    </div>
    @empty
    <div class="fit-card" style="padding: 40px; text-align: center; color: var(--text-muted);">
        No feed announcements posted yet.
    </div>
    @endforelse

</div>
@endsection
