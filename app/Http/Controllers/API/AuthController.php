<?php

namespace App\Http\Controllers\API;

use App\Services\AuthService;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function login(Request $request, AuthService $auth_service)
    {
        try{
            $user = $auth_service->login($request->email, $request->password);
            
            $user = Auth::user();
            $success['token'] = $user->createToken('login_token')->plainTextToken;
            $success['username'] = $user->username;
            return $this->sendResponse($success, "Login Successful.");
        }catch(\Exception $e){
            return $this->sendError("Login Failed", $e->getMessage());
        }
    }

    public function check_user(Request $request, AuthService $auth_service){
        try{
            $result = $auth_service->check_user($request->username, $request->password);
            return $this->sendResponse("Password Correct");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
