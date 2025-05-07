<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User; 
class UserController extends Controller
{


    public function store(Request $request_credentials){
        $valid_credentials = $request_credentials->validate([
            'nickname' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]); 

        User::create([
            'nickname' => $valid_credentials['nickname'], 
            'email' => $valid_credentials['email'],
            'passwordHash' => bcrypt($valid_credentials['password']),  
        ]); 

        return redirect('/')->with('success', 'Registration Successful!'); 
    }
    public function printCredentials(Request $c): String{
        return $c->input("nickname") . " " . $c->input("email") . " " . $c->input("password"); 
    }

    public function login(Request $request_credentials):String /* RedirectResponse*/{
        //controllo due volte le credenziali dell'utente, un controllo genrico su html e specifico su laravel 
        $valid_credentials = $request_credentials->validate([
            'nickname' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]); 
 
        $credentials = $request_credentials->only('email', 'passwordHash'); 
       // return $valid_credentials->input("nickname") . " " . $valid_credentials->input("email") ." " . $valid_credentials->input("password");  

        if(Auth::attempt($credentials)){
            
            return "successo" . $this->printCredentials($request_credentials); 
            //$request_credentials->session()->regenerate();

            //return redirect()->intended("welcome"); 
        }

        return "fallito" . $this->printCredentials($request_credentials); 
/*
        return back()->withErrors([
            'nickname' => 'Possibile che hai messo roba strana',
            'email' => 'Stai attento, mettila bene',
        ]); 
  
    */} 
}
