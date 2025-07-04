<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService 
{
    public function login($email, $password, $expect_roles=[]) : User
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
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }
        
        $user = User::where('email', $email)->first();
        
        if ($user == null){
            throw new \Exception("Password atau Email Salah!");
        }

        if (sizeof($expect_roles) > 0 && in_array($user->role, $expect_roles) == false){
            throw new \Exception("Role tidak sesuai!");
        }

        if (Auth::attempt($params) == false){
            throw new \Exception("Password atau Email Salah!");
        }
        
        return Auth::user();
    }

    public function check_user($username, $password)
    {
        $user = User::where('username', $username)->first();
        if ($user){
            if (Hash::check($password, $user->password)){
                return "Password is Correct";
            }
            throw new \Exception("Password is not Correct");
        }
        throw new \Exception("User Doesnt Exist");
        
    }
}