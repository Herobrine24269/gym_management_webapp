<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class PublicController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = (object) [
                'whatsapp_phone' => '+15559482011',
                'gym_name' => 'FitCore Gym',
            ];
        }
        return view('pages.contact', compact('setting'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        return back()->with('success', 'Thank you! Your contact message has been sent to FitCore Admin. We will get back to you shortly.');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }
}
