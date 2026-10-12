<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Membership;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->isAdmin()) return redirect()->route('admin.dashboard');
            if ($user->isTrainer()) return redirect()->route('trainer.dashboard');
            return redirect()->route('member.dashboard');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string',
            'role' => 'required|in:member,trainer',
            'profile_photo' => 'nullable|file|max:5120',
        ]);

        $photoUrl = 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80';
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $photoUrl = asset('storage/' . $path);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'profile_photo_url' => $photoUrl,
            'join_date' => Carbon::now()->toDateString(),
            'status' => 'active',
        ]);

        $planName = $request->input('plan_name', 'All-Access Pro');
        $planType = $request->input('plan_type', 'monthly');

        $baseFee = 79.99;
        if ($planName === 'Basic Fit') $baseFee = 49.99;
        if ($planName === 'VIP Performance') $baseFee = 129.99;

        if ($planType === 'yearly') {
            $fee = round($baseFee * 0.8 * 12, 2);
            $days = 365;
        } else {
            $fee = $baseFee;
            $days = 30;
        }

        if ($user->isMember()) {
            Membership::create([
                'user_id' => $user->id,
                'plan_name' => $planName,
                'plan_type' => $planType,
                'monthly_fee' => $fee,
                'last_paid_date' => Carbon::now()->toDateString(),
                'next_due_date' => Carbon::now()->addDays($days)->toDateString(),
                'status' => 'paid',
            ]);
        }

        return redirect()->route('login')->with('success', 'Account created successfully! Please log in with your email and password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
