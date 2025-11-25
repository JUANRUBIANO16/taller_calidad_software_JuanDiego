<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function show(){
        

        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials=$request->getCredentials();

        if(!Auth::validate($credentials)){
           return redirect()->to('/login')->withErrors(['auth' => 'Las credenciales proporcionadas no son correctas.']);
        }

        $user=Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);
        return $this->authenticated($request,$user);
    }

    public function authenticated(Request $request,$user){
           
        return Redirect('/users');

    }
}
