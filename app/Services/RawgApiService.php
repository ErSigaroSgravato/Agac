<?php

namespace App\Services;

use GuzzleHttp\Client;

class RawgApiService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.rawg.io/api/ ',
        ]);

        $this->apiKey = config('services.rawg.key');
    }

    public function getGames($page = 1, $search = null)
    {
        $query = [
            'key' => $this->apiKey,
            'page' => $page,
            'page_size' => 12
        ];

        if ($search) {
            $query['search'] = $search;
        }

        $response = $this->client->get("games", [
            'query' => $query
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getGameDetails($id)
    {
        $response = $this->client->get("games/{$id}", [
            'query' => [
                'key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}