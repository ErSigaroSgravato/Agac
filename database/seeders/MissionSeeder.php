<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mission;

class MissionSeeder extends Seeder
{
    public function run(): void
    {
        // Daily Missions
        Mission::create([
            'title' => 'Play 1 Game',
            'description' => 'Play any game for at least 10 minutes.',
            'type' => 'daily',
            'requirements' => json_encode(['playtime_minutes' => 10]),
            'points' => 10,
        ]);
        Mission::create([
            'title' => 'Win a Match',
            'description' => 'Win a match in any multiplayer game.',
            'type' => 'daily',
            'requirements' => json_encode(['wins' => 1]),
            'points' => 15,
        ]);
        Mission::create([
            'title' => 'Add a Friend',
            'description' => 'Add a new friend to your account.',
            'type' => 'daily',
            'requirements' => json_encode(['friends_added' => 1]),
            'points' => 5,
        ]);

        // Weekly Missions
        Mission::create([
            'title' => 'Play 5 Different Games',
            'description' => 'Play 5 different games this week.',
            'type' => 'weekly',
            'requirements' => json_encode(['unique_games_played' => 5]),
            'points' => 50,
        ]);
        Mission::create([
            'title' => 'Earn 100 Points',
            'description' => 'Earn a total of 100 points from missions this week.',
            'type' => 'weekly',
            'requirements' => json_encode(['points_earned' => 100]),
            'points' => 100,
        ]);
        Mission::create([
            'title' => 'Play 10 Hours',
            'description' => 'Play games for a total of 10 hours this week.',
            'type' => 'weekly',
            'requirements' => json_encode(['total_playtime_minutes' => 600]),
            'points' => 75,
        ]);

        // One-time Missions
        Mission::create([
            'title' => 'Connect Steam Account',
            'description' => 'Connect your Steam account to unlock this achievement.',
            'type' => 'one_time',
            'requirements' => json_encode(['steam_connected' => 1]),
            'points' => 25,
        ]);
        Mission::create([
            'title' => 'Own 10 Games',
            'description' => 'Own at least 10 games on Steam.',
            'type' => 'one_time',
            'requirements' => json_encode(['games_owned' => 10]),
            'points' => 30,
        ]);
        Mission::create([
            'title' => 'Reach 100 Hours',
            'description' => 'Reach 100 hours of total playtime.',
            'type' => 'one_time',
            'requirements' => json_encode(['total_playtime_minutes' => 6000]),
            'points' => 100,
        ]);
    }
} 