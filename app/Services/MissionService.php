<?php

namespace App\Services;

use App\Models\User;
use App\Models\Mission;
use App\Models\UserMission;
use Carbon\Carbon;

class MissionService
{
    public function assignMissions(User $user)
    {
        // Get available missions
        $missions = Mission::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->get();

        foreach ($missions as $mission) {
            // Check if user already has this mission
            $existingMission = UserMission::where('user_id', $user->UserID)
                ->where('mission_id', $mission->id)
                ->first();

            if (!$existingMission) {
                // Create new user mission
                UserMission::create([
                    'user_id' => $user->UserID,
                    'mission_id' => $mission->id,
                    'progress' => [],
                    'is_completed' => false
                ]);
            }
        }
    }

    public function updateDailyMissions(User $user)
    {
        // Reset daily missions at midnight
        $userMissions = UserMission::where('user_id', $user->UserID)
            ->whereHas('mission', function ($query) {
                $query->where('type', 'daily');
            })
            ->get();

        foreach ($userMissions as $userMission) {
            $userMission->delete();
        }

        // Assign new daily missions
        $this->assignMissions($user);
    }

    public function updateWeeklyMissions(User $user)
    {
        // Reset weekly missions at the start of each week
        $userMissions = UserMission::where('user_id', $user->UserID)
            ->whereHas('mission', function ($query) {
                $query->where('type', 'weekly');
            })
            ->get();

        foreach ($userMissions as $userMission) {
            $userMission->delete();
        }

        // Assign new weekly missions
        $this->assignMissions($user);
    }

    public function updateMissionProgress(User $user, string $type, int $value = 1)
    {
        $userMissions = UserMission::where('user_id', $user->UserID)
            ->where('is_completed', false)
            ->whereHas('mission', function ($query) {
                $query->where('is_active', true);
            })
            ->get();

        foreach ($userMissions as $userMission) {
            $requirements = $userMission->mission->requirements;
            
            if (isset($requirements[$type])) {
                $currentProgress = $userMission->progress[$type] ?? 0;
                $userMission->updateProgress($type, $currentProgress + $value);
            }
        }
    }

    public function checkAndUpdateMissions(User $user)
    {
        // Check if we need to reset daily missions
        $lastDailyReset = $user->last_daily_reset ?? Carbon::yesterday();
        if ($lastDailyReset->isPast() && !$lastDailyReset->isToday()) {
            $this->updateDailyMissions($user);
            $user->update(['last_daily_reset' => now()]);
        }

        // Check if we need to reset weekly missions
        $lastWeeklyReset = $user->last_weekly_reset ?? Carbon::now()->subWeek();
        if ($lastWeeklyReset->isPast() && $lastWeeklyReset->startOfWeek()->isPast()) {
            $this->updateWeeklyMissions($user);
            $user->update(['last_weekly_reset' => now()]);
        }
    }
} 