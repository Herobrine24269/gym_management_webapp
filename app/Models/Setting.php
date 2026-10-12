<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'gym_name',
        'gym_logo_url',
        'gym_address',
        'default_monthly_fee',
        'email_reminder_subject',
        'email_reminder_body',
        'whatsapp_message_template',
    ];

    protected $casts = [
        'default_monthly_fee' => 'decimal:2',
    ];

    public static function instance()
    {
        return static::first() ?? static::create([
            'gym_name' => 'FitCore Fitness Hub',
            'gym_address' => '1044 Apex Boulevard, Metro Heights, NY',
            'default_monthly_fee' => 79.99,
            'email_reminder_subject' => 'FitCore Membership Renewal Reminder - {{due_date}}',
            'email_reminder_body' => 'Hi {{member_name}}, your monthly fee of ${{amount}} is due on {{due_date}}.',
            'whatsapp_message_template' => 'Hey {{member_name}}! 🏋️‍♂️ Your FitCore gym fee of ${{amount}} was due on {{due_date}}. Please renew your membership portal access.',
        ]);
    }
}
