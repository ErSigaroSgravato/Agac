<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Game;
use App\Models\GamePlaytime;
use App\Models\Mission;
use App\Models\UserMission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users with different points and playtimes
        $users = [
            [
                'nickname' => 'GamingPro',
                'email' => 'pro@example.com',
                'passwordHash' => Hash::make('password123'),
                'steam_id' => '123456789',
                'points' => 1500,
                'playtime' => 500 // hours
            ],
            [
                'nickname' => 'CasualGamer',
                'email' => 'casual@example.com',
                'passwordHash' => Hash::make('password123'),
                'steam_id' => '234567890',
                'points' => 800,
                'playtime' => 200 // hours
            ],
            [
                'nickname' => 'WeekendWarrior',
                'email' => 'weekend@example.com',
                'passwordHash' => Hash::make('password123'),
                'steam_id' => '345678901',
                'points' => 1200,
                'playtime' => 350 // hours
            ],
            [
                'nickname' => 'GameMaster',
                'email' => 'master@example.com',
                'passwordHash' => Hash::make('password123'),
                'steam_id' => '456789012',
                'points' => 2000,
                'playtime' => 800 // hours
            ],
            [
                'nickname' => 'NewPlayer',
                'email' => 'new@example.com',
                'passwordHash' => Hash::make('password123'),
                'steam_id' => '567890123',
                'points' => 300,
                'playtime' => 50 // hours
            ],
        ];

        // Create users and their playtimes
        foreach ($users as $userData) {
            $user = User::create([
                'nickname' => $userData['nickname'],
                'email' => $userData['email'],
                'passwordHash' => $userData['passwordHash'],
                'steam_id' => $userData['steam_id'],
                'points' => $userData['points'],
            ]);

            // Create some games for each user
            for ($i = 0; $i < 5; $i++) {
                $game = Game::create([
                    'name' => "Game {$i} for {$user->nickname}",
                    'rawg_id' => rand(1000, 9999),
                    'rawg_data' => json_encode(['name' => "Game {$i}"]),
                    'image_url' => 'https://via.placeholder.com/400x225?text=Game',
                    'steam_appid' => rand(1000, 9999),
                ]);

                // Create playtime for each game
                GamePlaytime::create([
                    'user_id' => $user->id,
                    'game_id' => $game->id,
                    'playtime_forever' => ($userData['playtime'] * 60) / 5, // Convert hours to minutes and divide by number of games
                    'playtime_2weeks' => rand(0, 120), // Random 2-week playtime
                ]);
            }
        }

        // Run mission seeder
        $this->call([
            MissionSeeder::class,
        ]);

        // Assign missions to all users
        $missions = Mission::all();
        foreach (User::all() as $user) {
            $i = 0;
            foreach ($missions as $mission) {
                $progress = [];
                $is_completed = false;
                $completed_at = null;

                foreach (json_decode($mission->requirements, true) as $key => $required) {
                    if ($i % 3 === 0) {
                        $progress[$key] = 0;
                    } elseif ($i % 3 === 1) {
                        $progress[$key] = (int)($required / 2);
                    } else {
                        $progress[$key] = $required;
                        $is_completed = true;
                        $completed_at = now();
                    }
                }

                UserMission::create([
                    'user_id' => $user->id,
                    'mission_id' => $mission->id,
                    'progress' => $progress,
                    'is_completed' => $is_completed,
                    'completed_at' => $completed_at,
                ]);
                $i++;
            }
        }
    }
}
