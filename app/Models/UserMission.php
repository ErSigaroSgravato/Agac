<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMission extends Model
{
    protected $fillable = [
        'user_id',
        'mission_id',
        'progress',
        'is_completed',
        'completed_at'
    ];

    protected $casts = [
        'progress' => 'array',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function updateProgress($key, $value)
    {
        $progress = $this->progress ?? [];
        $progress[$key] = $value;
        $this->progress = $progress;
        $this->save();

        // Check if mission is completed
        if ($this->checkCompletion()) {
            $this->complete();
        }
    }

    public function checkCompletion()
    {
        $requirements = $this->mission->requirements;
        $progress = $this->progress;

        foreach ($requirements as $key => $required) {
            if (!isset($progress[$key]) || $progress[$key] < $required) {
                return false;
            }
        }

        return true;
    }

    public function complete()
    {
        if (!$this->is_completed) {
            $this->is_completed = true;
            $this->completed_at = now();
            $this->save();

            // Award points to user
            $this->user->increment('points', $this->mission->points);
        }
    }
} 