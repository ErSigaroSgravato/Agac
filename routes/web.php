<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name("login");

Route::post('/login', [UserController::class, "login"])->name("login");

Route::get('/register', function () {
    return view('register');
})->name("register");

Route::post('/register', [UserController::class, "store"])->name("register");

Route::post('/logout', [UserController::class, "logout"])->name("logout");

Route::get('/logout', function (){
    return redirect("/welcome"); 
})->name("logout");
