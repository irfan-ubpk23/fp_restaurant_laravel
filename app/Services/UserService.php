<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function all()
    {
        return User::all();
    }

    public function show($id) : User
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return User::find($id);
    }

    public function store($params) : User
    {
        $validator = Validator::make($params, [
            "username" => "required",
            "email" => "required",
            "no_hp" => "required",
            "password" => "required",
            "role" => ""
        ]);
        
        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }
        
        $params["password"] = bcrypt($params["password"]);
        // erase asap and change to sql handling
        if (isset($params['role']) == false)
        {
            $params['role'] = 'pembeli';
        }
        $user = User::create($params);
        return $user;
    }

    public function update($id, $params) : User
    {
        $params["id"] = $id;
        
        $validator = Validator::make($params, [
            "id" => "required",
            "username" => "",
            "email" => "",
            "no_hp" => "",
            "password" => "",
            "role" => ""
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $user = User::find($id);
        if (isset($params["username"])){
            $user->username = $params['username'];
        }
        if (isset($params["email"])){
            $user->email = $params['email'];
        }
        if (isset($params["no_hp"])){
            $user->no_hp = $params['no_hp'];
        }
        if (isset($params["password"])){
            $user->password = bcrypt($params["password"]);
        }
        if (isset($params["role"])){
            $user->role = $params['role'];
        }
        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $user = User::find($id);
        $user->delete();
    }
}