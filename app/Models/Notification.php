<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'member_id',
        'message',
        'is_resolved',
        'resolved_action',
        'resolved_at',
    ];

    protected $casts = [
        'is_resolved' => 'boolean',
        'resolved_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
