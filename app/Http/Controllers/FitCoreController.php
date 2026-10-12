<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FitCoreController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function memberDashboard()
    {
        return view('member.dashboard');
    }

    public function memberProfile()
    {
        return view('member.profile');
    }

    public function settings()
    {
        return view('settings.index');
    }

    public function dietPlans()
    {
        return view('diet-plans.index');
    }

    public function posts()
    {
        return view('posts.index');
    }

    public function notifications()
    {
        return view('notifications.index');
    }
}
