<?php

namespace App\Http\Controllers;

use App\Services\RawgApiService;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    protected $rawgApi;

    public function __construct(RawgApiService $rawgApi)
    {
        $this->rawgApi = $rawgApi;
    }

    public function myGames()
    {
        $user = Auth::user();
        
        // Get user's owned games with pagination
        $games = Game::whereHas('playtimes', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['playtimes' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->paginate(12);

        // Update RAWG data for each game if needed
        foreach ($games as $game) {
            if (!$game->rawg_data || !$game->image_url) {
                try {
                    $response = Http::get("https://api.rawg.io/api/games", [
                        'key' => $this->rawgApi->apiKey,
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

        return view('games.index', [
            'games' => $games,
            'isMyGames' => true,
            'user' => $user
        ]);
    }

    public function browse(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        if ($search) {
            // Search in RAWG API
            $data = $this->rawgApi->getGames($request->input('page', 1), $search);
            $games = collect($data['results'])->map(function ($game) {
                return new Game([
                    'name' => $game['name'],
                    'rawg_id' => $game['id'],
                    'rawg_data' => json_encode($game),
                    'image_url' => $game['background_image'] ?? null,
                ]);
            });

            // Create a custom paginator
            $games = new \Illuminate\Pagination\LengthAwarePaginator(
                $games,
                $data['count'],
                12,
                $request->input('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            // Get popular games from RAWG with pagination
            $data = $this->rawgApi->getGames($request->input('page', 1));
            $games = collect($data['results'])->map(function ($game) {
                return new Game([
                    'name' => $game['name'],
                    'rawg_id' => $game['id'],
                    'rawg_data' => json_encode($game),
                    'image_url' => $game['background_image'] ?? null,
                ]);
            });

            // Create a custom paginator
            $games = new \Illuminate\Pagination\LengthAwarePaginator(
                $games,
                $data['count'],
                12,
                $request->input('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        return view('games.index', [
            'games' => $games,
            'isMyGames' => false,
            'user' => $user
        ]);
    }

    public function show($id)
    {
        $game = $this->rawgApi->getGameDetails($id);
        return view('games.show', compact('game'));
    }
}