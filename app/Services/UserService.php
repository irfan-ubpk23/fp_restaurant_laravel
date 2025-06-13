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
            throw new \Exception("Id harus terisi!");
        }

        return User::find($id);
    }

    public function store($username, $email, $no_hp, $password, $role) : User
    {
        $params = [
            "username" => $username,
            "email" => $email,
            "no_hp" => $no_hp,
            "password" => bcrypt($password),
            "role" => $role
        ];
        
        $validator = Validator::make($params, [
            "username" => "required",
            "email" => "required",
            "no_hp" => "required",
            "password" => "required",
            "role" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Nama User harus terisi!");
        }

        $user = User::create($params);
        return $user;
    }

    public function update($id, $username, $email, $no_hp, $password, $role) : User
    {
        $params = [
            "id" => $id,
            "username" => $username,
            "email" => $email,
            "no_hp" => $no_hp,
            "password" => bcrypt($password),
            "role" => $role
        ];
        
        $validator = Validator::make($params, [
            "id" => "required",
            "username" => "required",
            "email" => "required",
            "no_hp" => "required",
            "password" => "required",
            "role" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id dan Nama User harus terisi!");
        }

        $user = User::find($id);
        $user->username = $params['username'];
        $user->email = $params['email'];
        $user->no_hp = $params['no_hp'];
        $user->password = $params['password'];
        $user->role = $params['role'];
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