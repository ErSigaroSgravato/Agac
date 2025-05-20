<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    protected $fillable = [
        'game_id',
        'name',
        'description',
        'icon_url',
        'rarity_percentage',
    ];

    protected $casts = [
        'rarity_percentage' => 'float',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('completed', 'completed_at')
            ->withTimestamps();
    }
} 