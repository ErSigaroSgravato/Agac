<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\UserMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Check if we need to reset missions
        $this->checkAndResetMissions($user);
        
        // Get active missions with their progress
        $missions = $user->missions()
            ->with('mission')
            ->get();
        
        return view('missions.index', compact('missions'));
    }

    private function checkAndResetMissions(User $user)
    {
        $now = now();
        
        // Check daily missions
        if (!$user->last_daily_reset || $user->last_daily_reset->startOfDay()->lt($now->startOfDay())) {
            $this->resetMissions($user, 'daily');
            $user->update(['last_daily_reset' => $now]);
        }
        
        // Check weekly missions
        if (!$user->last_weekly_reset || $user->last_weekly_reset->startOfWeek()->lt($now->startOfWeek())) {
            $this->resetMissions($user, 'weekly');
            $user->update(['last_weekly_reset' => $now]);
        }
    }

    private function resetMissions(User $user, string $type)
    {
        // Get available missions of the specified type
        $availableMissions = Mission::where('type', $type)
            ->whereDoesntHave('userMissions', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('is_completed', true);
            })
            ->get();

        // Assign new missions
        foreach ($availableMissions as $mission) {
            UserMission::create([
                'user_id' => $user->id,
                'mission_id' => $mission->id,
                'progress' => [],
                'is_completed' => false
            ]);
        }
    }
} 