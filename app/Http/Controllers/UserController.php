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

        $user = User::make([
            'nickname' => $valid_credentials['nickname'], 
            'email' => $valid_credentials['email'],
            'passwordHash' => bcrypt($valid_credentials['password']),  
        ]); 

        $user->save(); 

        Auth::login($user); 


        session([
            'nickname' => $valid_credentials['nickname'],
           // 'profile_picture' => $user->profile_picture,
        ]);
        

        return redirect('/welcome');  
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
   

        if(Auth::attempt($valid_credentials)){
            session([
                'nickname' => $valid_credentials['nickname'],
               // 'profile_picture' => $user->profile_picture,
            ]); 

            $request_credentials->session()->regenerate();

            return redirect('/welcome'); 
        }

        //return "fallito" . " ". $this->printCredentials($request_credentials); 

        return back()->withErrors([
            'nickname' => 'Possibile che hai messo roba strana',
            'email' => 'Stai attento, mettila bene',
        ]); 
  
    } 

    public function logout(Request $request): RedirectResponse{
        Auth::logout(); 

        $request->session()->invalidate(); 

        $request->session()->regenerateToken(); 

        return redirect("/welcome"); 
    }
}
