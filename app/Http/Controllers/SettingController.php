<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::instance();
        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::instance();
        
        $validated = $request->validate([
            'gym_name' => 'nullable|string',
            'gym_address' => 'nullable|string',
            'default_monthly_fee' => 'nullable|numeric',
            'email_reminder_subject' => 'nullable|string',
            'email_reminder_body' => 'nullable|string',
            'whatsapp_message_template' => 'nullable|string',
            'gym_logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gym_logo')) {
            $path = $request->file('gym_logo')->store('logos', 'public');
            $validated['gym_logo_url'] = asset('storage/' . $path);
        }

        $setting->update(array_filter($validated));

        return back()->with('success', 'Settings updated successfully!');
    }
}
