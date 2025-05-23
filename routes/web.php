<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SteamController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('my-games');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/test', function () {
    return view('test-stats');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/stats', [ProfileController::class, 'stats'])->name('profile.stats');

    // Games routes
    Route::get('/my-games', [GameController::class, 'myGames'])->name('my-games');
    Route::get('/browse-games', [GameController::class, 'browse'])->name('browse-games');
    Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');

    // Steam routes
    Route::get('/steam/connect', [SteamController::class, 'connect'])->name('steam.connect');
    Route::get('/steam/callback', [SteamController::class, 'callback'])->name('steam.callback');

    Route::get('/missions', [MissionController::class, 'index'])->name('missions.index');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
});

require __DIR__.'/auth.php';
