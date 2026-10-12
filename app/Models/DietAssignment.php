<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'diet_plan_id',
        'member_id',
        'assigned_on',
    ];

    protected $casts = [
        'assigned_on' => 'date',
    ];

    public function dietPlan()
    {
        return $this->belongsTo(DietPlan::class, 'diet_plan_id');
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
