<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService 
{
    public function login($email, $password) : User
    {
        $params = [
            "email" => $email,
            "password" => $password
        ];

        $validator = Validator::make($params, [
            "email" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Email dan Password harus terisi!");
        }
        
        if (Auth::attempt($params) == false){
            throw new \Exception("Password atau Email Salah!");
        }

        return Auth::user();

    }
}