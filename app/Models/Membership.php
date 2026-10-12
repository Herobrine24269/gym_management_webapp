<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_name',
        'plan_type',
        'monthly_fee',
        'last_paid_date',
        'next_due_date',
        'status',
        'assigned_trainer_id',
    ];

    protected $casts = [
        'last_paid_date' => 'date',
        'next_due_date' => 'date',
        'monthly_fee' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'assigned_trainer_id');
    }

    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class, 'membership_id');
    }

    public function getDaysRemainingAttribute(): int
    {
        if (!$this->next_due_date) return 0;
        $now = Carbon::now()->startOfDay();
        $due = Carbon::parse($this->next_due_date)->startOfDay();
        return (int) $now->diffInDays($due, false);
    }
}
