<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DietPlan;
use App\Models\DietAssignment;
use App\Models\User;
use Carbon\Carbon;

class DietPlanController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');
        $query = DietPlan::with('trainer');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $dietPlans = $query->latest()->get();
        $members = User::where('role', 'member')->where('status', 'active')->get();

        return view('diet-plans.index', compact('dietPlans', 'category', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|in:weight_loss,muscle_gain,maintenance',
            'description' => 'required|string',
            'breakfast' => 'nullable|string',
            'lunch' => 'nullable|string',
            'dinner' => 'nullable|string',
            'snacks' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageUrl = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('diets', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        DietPlan::create([
            'trainer_id' => auth()->id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'breakfast' => $validated['breakfast'],
            'lunch' => $validated['lunch'],
            'dinner' => $validated['dinner'],
            'snacks' => $validated['snacks'],
            'image_url' => $imageUrl,
        ]);

        return back()->with('success', 'New Diet Plan template created!');
    }

    public function assign(Request $request, $planId)
    {
        $request->validate(['member_id' => 'required|exists:users,id']);

        DietAssignment::create([
            'diet_plan_id' => $planId,
            'member_id' => $request->input('member_id'),
            'assigned_on' => Carbon::now()->toDateString(),
        ]);

        return back()->with('success', 'Diet Plan assigned to member!');
    }
}
