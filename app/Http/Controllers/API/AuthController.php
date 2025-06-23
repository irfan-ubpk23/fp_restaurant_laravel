<?php

namespace App\Http\Controllers\API;

use App\Services\AuthService;
use App\Services\UserService;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function register(Request $request, UserService $user_service){
        try{
            $user_service->store($request->all());
            return $this->sendResponse("Register Berhasil", "Register Successful.");
        } catch (\Exception $e){
            return $this->sendError("Register Gagal", $e->getMessage());
        }
    }

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

    public function logout(Request $request){
        try{
            $request->user()->tokens()->delete();

            if ($request->user()->tokens()->count() > 0){
                throw new \Exception("Token not erased!");
            }

            return $this->sendResponse("Logout Successful");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
