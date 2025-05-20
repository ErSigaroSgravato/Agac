<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Temporary development solution - always create test user
        $user = User::firstOrCreate(
            ['nickname' => 'test_user'],
            [
                'passwordHash' => Hash::make('password'),
                'steam_id' => '76561198123456789',
                'email' => 'test@example.com'
            ]
        );

        Auth::login($user);
        return redirect()->route('profile');
    }

    public function printCredentials(Request $c): String{
        return $c->input("nickname") . " " . $c->input("email") . " " . $c->input("password"); 
    }

    public function login(Request $request)
    {
        // Temporary development solution - always log in as test user
        $user = User::firstOrCreate(
            ['nickname' => 'test_user'],
            [
                'passwordHash' => Hash::make('password'),
                'steam_id' => '76561198123456789',
                'email' => 'test@example.com'
            ]
        );

        Auth::login($user);
        return redirect()->route('profile');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    public function profile()
    {
        // Temporary development solution - always get test user
        $user = User::firstOrCreate(
            ['nickname' => 'test_user'],
            [
                'passwordHash' => Hash::make('password'),
                'steam_id' => '76561198123456789',
                'email' => 'test@example.com'
            ]
        );

        return view('profile', ['user' => $user]);
    }
}
