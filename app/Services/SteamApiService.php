<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SteamApiService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.steam.base_url');
        $this->apiKey = config('services.steam.api_key');
    }

    public function getPlayerSummaries($steamIds)
    {
        if (is_array($steamIds)) {
            $steamIds = implode(',', $steamIds);
        }

        return Http::get("{$this->baseUrl}ISteamUser/GetPlayerSummaries/v0002/", [
            'key' => $this->apiKey,
            'steamids' => $steamIds,
        ])->json();
    }

    // Add more methods for different API endpoints as needed
}