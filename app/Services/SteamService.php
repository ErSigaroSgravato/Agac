<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class SteamService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $redirectUri;

    public function __construct()
    {
        $this->baseUrl = config('services.steam.base_url');
        $this->apiKey = config('services.steam.api_key');
        $this->redirectUri = config('services.steam.redirect_uri');
    }

    public function getAuthUrl()
    {
        return 'https://steamcommunity.com/openid/login?' . http_build_query([
            'openid.ns' => 'http://specs.openid.net/auth/2.0',
            'openid.mode' => 'checkid_setup',
            'openid.return_to' => $this->redirectUri,
            'openid.realm' => url('/'),
            'openid.identity' => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
        ]);
    }

    public function validateAuthResponse($params)
    {
        $params['openid.mode'] = 'check_authentication';
        $params['openid.ns'] = 'http://specs.openid.net/auth/2.0';

        $response = Http::post('https://steamcommunity.com/openid/login', $params);
        
        if (str_contains($response->body(), 'is_valid:true')) {
            preg_match('#^https://steamcommunity.com/openid/id/([0-9]{17,25})#', $params['openid.claimed_id'], $matches);
            return $matches[1] ?? null;
        }

        return null;
    }

    public function getPlayerSummaries($steamIds)
    {
        if (is_array($steamIds)) {
            $steamIds = implode(',', $steamIds);
        }

        $response = Http::get("{$this->baseUrl}ISteamUser/GetPlayerSummaries/v0002/", [
            'key' => $this->apiKey,
            'steamids' => $steamIds,
        ]);

        return $response->json();
    }

    public function getOwnedGames($steamId)
    {
        $response = Http::get("{$this->baseUrl}IPlayerService/GetOwnedGames/v0001/", [
            'key' => $this->apiKey,
            'steamid' => $steamId,
            'include_appinfo' => true,
            'include_played_free_games' => true,
        ]);

        return $response->json();
    }

    public function getPlayerAchievements($steamId, $appId)
    {
        $response = Http::get("{$this->baseUrl}ISteamUserStats/GetPlayerAchievements/v0001/", [
            'key' => $this->apiKey,
            'steamid' => $steamId,
            'appid' => $appId,
        ]);

        return $response->json();
    }
} 