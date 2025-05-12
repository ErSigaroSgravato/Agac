<?php

namespace App\Http\Controllers;

use App\Services\RawgApiService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $rawgApi;

    public function __construct(RawgApiService $rawgApi)
    {
        $this->rawgApi = $rawgApi;
    }

    public function index()
    {
        $data = $this->rawgApi->getGames(1);

        return view('games.index', [
            'games' => $data['results'],
            'nextPage' => $data['next'] ? parse_url($data['next'], PHP_URL_QUERY) : null
        ]);
    }

    public function show($id)
    {
        $game = $this->rawgApi->getGameDetails($id);

        return view('games.show', compact('game'));
    }
}