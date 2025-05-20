<?php

namespace App\Providers;

use App\Services\SteamService;
use Illuminate\Support\ServiceProvider;

class SteamServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('steam-service', function () {
            return new SteamService();
        });
    }

    public function boot()
    {
        //
    }
}