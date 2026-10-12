<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\DietPlan;
use App\Models\Post;

class TrainerController extends Controller
{
    public function dashboard()
    {
        $trainerId = auth()->id();
        $assignedMemberships = Membership::with('user')
            ->where('assigned_trainer_id', $trainerId)
            ->get();
        
        $ownDietPlans = DietPlan::where('trainer_id', $trainerId)->get();

        return view('trainer.dashboard', compact('assignedMemberships', 'ownDietPlans'));
    }
}
