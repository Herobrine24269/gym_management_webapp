<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'profile_photo_url',
        'join_date',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    public function membership()
    {
        return $this->hasOne(Membership::class, 'user_id');
    }

    public function assignedMemberships()
    {
        return $this->hasMany(Membership::class, 'assigned_trainer_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class, 'trainer_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'member_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTrainer(): bool
    {
        return $this->role === 'trainer';
    }

    public function isMember(): bool
    {
        return $this->role === 'member';
    }
}
