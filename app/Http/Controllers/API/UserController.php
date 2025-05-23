<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('login_token')->plainTextToken;
            $success['username'] = $user->username;

            return $this->sendResponse($success, "Login Successful");
        } else
        {
            return $this->sendError('Unauthorised', ['error'=>'Unauthorised']);
        }
    }
}
