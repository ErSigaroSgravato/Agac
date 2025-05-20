<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GamePlaytime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameStatsController extends Controller
{
    public function getGameHours($gameId)
    {
        $game = Game::findOrFail($gameId);
        $playtimes = GamePlaytime::where('game_id', $gameId)
            ->select('user_id', DB::raw('SUM(hours_played) as total_hours'))
            ->groupBy('user_id')
            ->orderByDesc('total_hours')
            ->get();

        return response()->json([
            'game' => $game,
            'playtimes' => $playtimes
        ]);
    }

    public function getGameLeaderboard($gameId)
    {
        $leaderboard = GamePlaytime::where('game_id', $gameId)
            ->join('users', 'game_playtimes.user_id', '=', 'users.id')
            ->select('users.nickname', DB::raw('SUM(hours_played) as total_hours'))
            ->groupBy('users.id', 'users.nickname')
            ->orderByDesc('total_hours')
            ->limit(10)
            ->get();

        return response()->json($leaderboard);
    }

    public function getGameAchievements($gameId)
    {
        $game = Game::findOrFail($gameId);
        $achievements = $game->achievements()
            ->withCount(['users' => function($query) {
                $query->where('achievement_user.completed', true);
            }])
            ->get();

        return response()->json([
            'game' => $game,
            'achievements' => $achievements
        ]);
    }
} 