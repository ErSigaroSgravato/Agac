<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GamePlaytime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserStatsController extends Controller
{
    public function getTotalHours()
    {
        $totalHours = GamePlaytime::where('user_id', auth()->id())
            ->sum('hours_played');

        $recentHours = GamePlaytime::where('user_id', auth()->id())
            ->where('played_at', '>=', Carbon::now()->subDays(14))
            ->sum('hours_played');

        return response()->json([
            'total_hours' => $totalHours,
            'recent_hours' => $recentHours
        ]);
    }

    public function getRecentActivity()
    {
        $recentActivity = GamePlaytime::where('user_id', auth()->id())
            ->with('game')
            ->orderByDesc('played_at')
            ->limit(10)
            ->get();

        return response()->json($recentActivity);
    }

    public function getUserAchievements()
    {
        $achievements = auth()->user()->achievements()
            ->with('game')
            ->orderByDesc('achievement_user.completed_at')
            ->get();

        return response()->json($achievements);
    }

    public function getGameDistribution()
    {
        $distribution = GamePlaytime::where('user_id', auth()->id())
            ->join('games', 'game_playtimes.game_id', '=', 'games.id')
            ->select('games.name', DB::raw('SUM(hours_played) as total_hours'))
            ->groupBy('games.id', 'games.name')
            ->orderByDesc('total_hours')
            ->get();

        return response()->json($distribution);
    }
} 