<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePlaytime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        // Overall Statistics
        $totalUsers = User::count();
        $totalGames = Game::count();
        $totalHours = GamePlaytime::sum('hours_played');
        
        // Most Played Games
        $mostPlayedGames = GamePlaytime::join('games', 'game_playtimes.game_id', '=', 'games.id')
            ->select('games.name', DB::raw('SUM(hours_played) as total_hours'))
            ->groupBy('games.id', 'games.name')
            ->orderByDesc('total_hours')
            ->limit(5)
            ->get();

        // Most Active Users
        $mostActiveUsers = GamePlaytime::join('users', 'game_playtimes.user_id', '=', 'users.id')
            ->select('users.nickname', DB::raw('SUM(hours_played) as total_hours'))
            ->groupBy('users.id', 'users.nickname')
            ->orderByDesc('total_hours')
            ->limit(5)
            ->get();

        // Playtime Distribution by Day of Week
        $playtimeByDay = GamePlaytime::select(
                DB::raw('DAYOFWEEK(played_at) as day'),
                DB::raw('SUM(hours_played) as total_hours')
            )
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Recent Activity
        $recentActivity = GamePlaytime::with(['user', 'game'])
            ->orderByDesc('played_at')
            ->limit(10)
            ->get();

        // Genre Distribution
        $genreDistribution = Game::select('genres', DB::raw('COUNT(*) as count'))
            ->groupBy('genres')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return view('stats.index', compact(
            'totalUsers',
            'totalGames',
            'totalHours',
            'mostPlayedGames',
            'mostActiveUsers',
            'playtimeByDay',
            'recentActivity',
            'genreDistribution'
        ));
    }
} 