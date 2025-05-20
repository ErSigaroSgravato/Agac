<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'steam_appid',
        'name',
        'rawg_id',
        'rawg_data',
        'image_url'
    ];

    protected $casts = [
        'rawg_data' => 'array'
    ];

    public function playtimes()
    {
        return $this->hasMany(GamePlaytime::class);
    }
} 