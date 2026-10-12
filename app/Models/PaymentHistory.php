<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'amount',
        'paid_on',
        'payment_method',
        'transaction_id',
        'invoice_no',
        'marked_by',
    ];

    protected $casts = [
        'paid_on' => 'date',
        'amount' => 'decimal:2',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }
}
