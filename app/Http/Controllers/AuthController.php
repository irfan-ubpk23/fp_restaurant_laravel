<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }


    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('login_token')->plainTextToken;
            $success['username'] = $user->username;

            return redirect()->intended('dashboard');
        } else
        {
            return $this->sendError('Unauthorised', ['error'=>'Unauthorised']);
        }
    }


    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
