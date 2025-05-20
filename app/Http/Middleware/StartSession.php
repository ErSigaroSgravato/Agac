<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StartSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::isStarted()) {
            Session::start();
        }

        return $next($request);
    }
} 