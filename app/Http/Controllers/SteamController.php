<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Game;
use App\Models\GamePlaytime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SteamController extends Controller
{
    private $steamApiKey;
    private $rawgApiKey;
    private $isDevelopment = true; // Set to true for development mode

    public function __construct()
    {
        $this->steamApiKey = env('STEAM_API_KEY');
        $this->rawgApiKey = env('RAWG_API_KEY');
    }

    public function connect()
    {
        if ($this->isDevelopment) {
            // For development, skip Steam auth and use a test Steam ID
            $user = Auth::user();
            $user->steam_id = '76561198123456789'; // Test Steam ID
            $user->save();
            
            // Simulate fetching games
            $this->fetchAndSaveGames($user->steam_id);
            
            return redirect()->route('profile.edit')->with('success', 'Steam account connected successfully! (Development Mode)');
        }

        $redirectUrl = route('steam.callback');
        
        return redirect("https://steamcommunity.com/openid/login?" . http_build_query([
            'openid.ns' => 'http://specs.openid.net/auth/2.0',
            'openid.mode' => 'checkid_setup',
            'openid.return_to' => $redirectUrl,
            'openid.realm' => url('/'),
            'openid.identity' => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
        ]));
    }

    public function callback(Request $request)
    {
        if ($this->isDevelopment) {
            return redirect()->route('profile.edit');
        }

        try {
            $steamId = $this->validateSteamLogin($request);
            
            if (!$steamId) {
                return redirect()->route('profile.edit')->with('error', 'Failed to validate Steam login');
            }

            // Get user's Steam profile data
            $response = Http::get("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/", [
                'key' => $this->steamApiKey,
                'steamids' => $steamId
            ]);

            if ($response->failed()) {
                Log::error('Steam API request failed', ['response' => $response->body()]);
                return redirect()->route('profile.edit')->with('error', 'Failed to fetch Steam profile data');
            }

            $steamData = $response->json();
            
            if (empty($steamData['response']['players'])) {
                return redirect()->route('profile.edit')->with('error', 'No Steam profile found');
            }

            $steamProfile = $steamData['response']['players'][0];

            // Update user's Steam ID
            $user = Auth::user();
            $user->steam_id = $steamId;
            $user->save();

            // Get user's owned games
            $this->fetchAndSaveGames($steamId);

            return redirect()->route('profile.edit')->with('success', 'Steam account connected successfully!');
        } catch (\Exception $e) {
            Log::error('Steam connection error', ['error' => $e->getMessage()]);
            return redirect()->route('profile.edit')->with('error', 'Failed to connect Steam account');
        }
    }

    private function validateSteamLogin(Request $request)
    {
        $params = $request->all();
        
        if (!isset($params['openid_assoc_handle']) || !isset($params['openid_signed'])) {
            return false;
        }

        $params['openid.mode'] = 'check_authentication';
        
        $response = Http::post('https://steamcommunity.com/openid/login', $params);
        
        if (strpos($response->body(), 'is_valid:true') !== false) {
            preg_match('#^https://steamcommunity.com/openid/id/([0-9]{17,25})#', $params['openid_claimed_id'], $matches);
            return $matches[1] ?? false;
        }
        
        return false;
    }

    private function getSteamId($claimedId)
    {
        preg_match('/^https?:\/\/steamcommunity\.com\/openid\/id\/(\d+)$/', $claimedId, $matches);
        return $matches[1] ?? null;
    }

    private function fetchAndSaveGames($steamId)
    {
        if ($this->isDevelopment) {
            // Create some test games with RAWG data
            $testGames = [
                [
                    'appid' => 1091500,
                    'name' => 'Cyberpunk 2077',
                    'playtime_forever' => 1500,
                    'playtime_2weeks' => 75,
                    'rawg_data' => [
                        'id' => 41494,
                        'name' => 'Cyberpunk 2077',
                        'background_image' => 'https://media.rawg.io/media/games/26d/26d4437715bee60138dab5a7c8c59c92.jpg',
                        'genres' => [
                            ['id' => 4, 'name' => 'Action'],
                            ['id' => 5, 'name' => 'RPG']
                        ],
                        'rating' => 4.3,
                        'released' => '2020-12-10'
                    ]
                ],
                [
                    'appid' => 1174180,
                    'name' => 'Red Dead Redemption 2',
                    'playtime_forever' => 3000,
                    'playtime_2weeks' => 120,
                    'rawg_data' => [
                        'id' => 28,
                        'name' => 'Red Dead Redemption 2',
                        'background_image' => 'https://media.rawg.io/media/games/511/5118aff5091cb3efec399c808f8c598f.jpg',
                        'genres' => [
                            ['id' => 3, 'name' => 'Adventure'],
                            ['id' => 4, 'name' => 'Action']
                        ],
                        'rating' => 4.7,
                        'released' => '2019-11-05'
                    ]
                ],
                [
                    'appid' => 1245620,
                    'name' => 'Elden Ring',
                    'playtime_forever' => 2000,
                    'playtime_2weeks' => 150,
                    'rawg_data' => [
                        'id' => 326243,
                        'name' => 'Elden Ring',
                        'background_image' => 'https://media.rawg.io/media/games/5ec/5ecac5cb026ec26a56efcc546364e348.jpg',
                        'genres' => [
                            ['id' => 4, 'name' => 'Action'],
                            ['id' => 5, 'name' => 'RPG']
                        ],
                        'rating' => 4.8,
                        'released' => '2022-02-25'
                    ]
                ],
                [
                    'appid' => 1085660,
                    'name' => 'Destiny 2',
                    'playtime_forever' => 5000,
                    'playtime_2weeks' => 200,
                    'rawg_data' => [
                        'id' => 2,
                        'name' => 'Destiny 2',
                        'background_image' => 'https://media.rawg.io/media/games/587/587588c64afbff80e6f444eb2e46f9da.jpg',
                        'genres' => [
                            ['id' => 2, 'name' => 'Shooter'],
                            ['id' => 4, 'name' => 'Action']
                        ],
                        'rating' => 4.2,
                        'released' => '2019-10-01'
                    ]
                ],
                [
                    'appid' => 1244460,
                    'name' => 'Hogwarts Legacy',
                    'playtime_forever' => 800,
                    'playtime_2weeks' => 60,
                    'rawg_data' => [
                        'id' => 3272,
                        'name' => 'Hogwarts Legacy',
                        'background_image' => 'https://media.rawg.io/media/games/4cf/4cfc6b7f1850590a4634b2bfbb88f8ce.jpg',
                        'genres' => [
                            ['id' => 3, 'name' => 'Adventure'],
                            ['id' => 5, 'name' => 'RPG']
                        ],
                        'rating' => 4.5,
                        'released' => '2023-02-10'
                    ]
                ]
            ];

            foreach ($testGames as $game) {
                try {
                    Log::info('Processing game', [
                        'name' => $game['name'],
                        'image_url' => $game['rawg_data']['background_image']
                    ]);

                    // Save or update game
                    $gameModel = Game::updateOrCreate(
                        ['steam_appid' => $game['appid']],
                        [
                            'name' => $game['name'],
                            'rawg_id' => $game['rawg_data']['id'],
                            'rawg_data' => json_encode($game['rawg_data']),
                            'image_url' => $game['rawg_data']['background_image'],
                        ]
                    );

                    Log::info('Game saved', [
                        'id' => $gameModel->id,
                        'image_url' => $gameModel->image_url
                    ]);

                    // Save playtime
                    GamePlaytime::updateOrCreate(
                        [
                            'user_id' => Auth::id(),
                            'game_id' => $gameModel->id
                        ],
                        [
                            'playtime_forever' => $game['playtime_forever'],
                            'playtime_2weeks' => $game['playtime_2weeks'],
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error('Error processing game ' . $game['name'] . ': ' . $e->getMessage());
                    continue;
                }
            }
            return;
        }

        $response = Http::get("https://api.steampowered.com/IPlayerService/GetOwnedGames/v1/", [
            'key' => $this->steamApiKey,
            'steamid' => $steamId,
            'include_appinfo' => 1,
            'include_played_free_games' => 1
        ]);

        if ($response->successful()) {
            $games = $response->json()['response']['games'] ?? [];
            
            foreach ($games as $game) {
                try {
                    // Search for game in RAWG API
                    $rawgResponse = Http::get("https://api.rawg.io/api/games", [
                        'key' => $this->rawgApiKey,
                        'search' => $game['name'],
                        'page_size' => 1
                    ]);

                    $rawgData = $rawgResponse->json()['results'][0] ?? null;

                    // Save or update game
                    $gameModel = Game::updateOrCreate(
                        ['steam_appid' => $game['appid']],
                        [
                            'name' => $game['name'],
                            'rawg_id' => $rawgData['id'] ?? null,
                            'rawg_data' => $rawgData ? json_encode($rawgData) : null,
                            'image_url' => $rawgData['background_image'] ?? null,
                        ]
                    );

                    // Save playtime
                    GamePlaytime::updateOrCreate(
                        [
                            'user_id' => Auth::id(),
                            'game_id' => $gameModel->id
                        ],
                        [
                            'playtime_forever' => $game['playtime_forever'] ?? 0,
                            'playtime_2weeks' => $game['playtime_2weeks'] ?? 0,
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error('Error processing game ' . $game['name'] . ': ' . $e->getMessage());
                    continue;
                }
            }
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        if ($search) {
            // Search in RAWG API
            $response = Http::get("https://api.rawg.io/api/games", [
                'key' => $this->rawgApiKey,
                'search' => $search,
                'page_size' => 20
            ]);

            if ($response->successful()) {
                $rawgGames = $response->json()['results'] ?? [];
                
                // Convert RAWG games to our format
                $games = collect($rawgGames)->map(function ($rawgGame) {
                    return new Game([
                        'name' => $rawgGame['name'],
                        'rawg_id' => $rawgGame['id'],
                        'rawg_data' => json_encode($rawgGame),
                        'image_url' => $rawgGame['background_image'] ?? null,
                    ]);
                });
            } else {
                $games = collect([]);
            }
        } else {
            // Get user's owned games
            $games = Game::with(['playtimes' => function($query) use ($user) {
                $query->where('user_id', $user->id);
            }])->get();

            // Update RAWG data for each game
            foreach ($games as $game) {
                if (!$game->rawg_data || !$game->image_url) {
                    try {
                        $response = Http::get("https://api.rawg.io/api/games", [
                            'key' => $this->rawgApiKey,
                            'search' => $game->name,
                            'page_size' => 1
                        ]);

                        if ($response->successful()) {
                            $rawgData = $response->json()['results'][0] ?? null;
                            if ($rawgData) {
                                $game->rawg_id = $rawgData['id'];
                                $game->rawg_data = json_encode($rawgData);
                                $game->image_url = $rawgData['background_image'];
                                $game->save();
                            }
                        }
                    } catch (\Exception $e) {
                        Log::error('Error updating RAWG data for game ' . $game->name . ': ' . $e->getMessage());
                    }
                }
            }
        }

        return view('games.index', [
            'user' => $user,
            'games' => $games,
            'isMyGames' => !$search
        ]);
    }
} 