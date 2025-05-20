<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'points',
        'requirements',
        'is_active',
        'starts_at',
        'ends_at'
    ];

    protected $casts = [
        'requirements' => 'array',
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime'
    ];

    public function userMissions()
    {
        return $this->hasMany(UserMission::class);
    }

    public function isAvailable()
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();
        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }
        if ($this->ends_at && $now->gt($this->ends_at)) {
            return false;
        }

        return true;
    }
} 