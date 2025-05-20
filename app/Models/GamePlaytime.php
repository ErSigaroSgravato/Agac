<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GamePlaytime extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'playtime_forever',
        'playtime_2weeks',
        'played_at'
    ];

    protected $casts = [
        'played_at' => 'datetime',
        'playtime_forever' => 'float',
        'playtime_2weeks' => 'float'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
} 