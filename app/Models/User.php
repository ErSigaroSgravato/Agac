<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

protected $table = 'users'; 
protected $primaryKey = 'id'; 
    protected $fillable = [
        'nickname',
        'email',
        'passwordHash',
        'steam_id',
        'points',
        'last_daily_reset',
        'last_weekly_reset'
    ];

    public $timestamps = false; 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'passwordHash',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'passwordHash' => 'hashed',
        'last_daily_reset' => 'datetime',
        'last_weekly_reset' => 'datetime'
    ];

    public function getAuthPassword()
    {
        return $this->passwordHash;
    }

    // Tell Laravel to use password instead of password
    public function getPasswordAttribute()
    {
        return $this->passwordHash;
    }

    public function setPasswordAttribute($value)
    {
        $this->passwordHash = $value;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function validateCredentials($user, $credentials)
    {
        return Hash::check($credentials['password'], $user->passwordHash);
    }

    public function gamePlaytimes()
    {
        return $this->hasMany(GamePlaytime::class);
    }

    public function missions()
    {
        return $this->hasMany(UserMission::class, 'user_id', 'UserID');
    }

    public function getActiveMissions()
    {
        return $this->missions()
            ->whereHas('mission', function ($query) {
                $query->where('is_active', true);
            })
            ->with('mission')
            ->get();
    }

    public function playtimes()
    {
        return $this->hasMany(GamePlaytime::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)
            ->withPivot('completed', 'completed_at')
            ->withTimestamps();
    }
}
