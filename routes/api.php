<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameStatsController;
use App\Http\Controllers\Api\UserStatsController;

Route::middleware('auth:sanctum')->group(function () {
    // Game Statistics
    Route::get('/stats/games/{gameId}/hours', [GameStatsController::class, 'getGameHours']);
    Route::get('/stats/games/{gameId}/leaderboard', [GameStatsController::class, 'getGameLeaderboard']);
    Route::get('/stats/games/{gameId}/achievements', [GameStatsController::class, 'getGameAchievements']);
    
    // User Statistics
    Route::get('/stats/user/total-hours', [UserStatsController::class, 'getTotalHours']);
    Route::get('/stats/user/recent-activity', [UserStatsController::class, 'getRecentActivity']);
    Route::get('/stats/user/achievements', [UserStatsController::class, 'getUserAchievements']);
    Route::get('/stats/user/game-distribution', [UserStatsController::class, 'getGameDistribution']);
}); 