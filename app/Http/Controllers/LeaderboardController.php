<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GamePlaytime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get top 10 users by points
        $pointsLeaderboard = User::select('nickname', 'points')
            ->orderBy('points', 'desc')
            ->limit(10)
            ->get();

        // Get top 10 users by total playtime
        $hoursLeaderboard = User::select('users.nickname', DB::raw('SUM(game_playtimes.playtime_forever) as total_minutes'))
            ->join('game_playtimes', 'users.id', '=', 'game_playtimes.user_id')
            ->groupBy('users.id', 'users.nickname')
            ->orderBy('total_minutes', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                $user->total_hours = round($user->total_minutes / 60, 1);
                return $user;
            });

        // Get user's position in points leaderboard
        $userPointsRank = User::where('points', '>', $user->points)->count() + 1;

        // Get user's position in hours leaderboard
        $userHoursRank = User::select(DB::raw('COUNT(*) + 1 as rank'))
            ->join('game_playtimes', 'users.id', '=', 'game_playtimes.user_id')
            ->groupBy('users.id')
            ->having(DB::raw('SUM(game_playtimes.playtime_forever)'), '>', 
                GamePlaytime::where('user_id', $user->id)->sum('playtime_forever'))
            ->count() + 1;

        // Get user's total hours
        $userTotalHours = round(GamePlaytime::where('user_id', $user->id)->sum('playtime_forever') / 60, 1);

        return view('leaderboard.index', compact(
            'pointsLeaderboard',
            'hoursLeaderboard',
            'userPointsRank',
            'userHoursRank',
            'userTotalHours'
        ));
    }
} 