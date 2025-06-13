<?php

namespace App\Http\Controllers;

use App\Services\UserService;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserService $user_service)
    {
        return view('admin.user', ["users" => $user_service->all()]);
    }

    public function store(Request $request, UserService $user_service){
        try{
            $user_service->store(
                $request->username,
                $request->email,
                $request->no_hp,
                $request->password,
                $request->role
            );

            return redirect()->route("user")->with('message', 'User telah dibuat');
        } catch (\Exception $e){
            return redirect()->route("user")->with("message", $e->getMessage());
        }
    }

    public function update(Request $request, UserService $user_service)
    {
        try{
            $user_service->update(
                $request->id, 
                $request->username,
                $request->email,
                $request->no_hp,
                $request->password,
                $request->role);

            return redirect()->route("user")->with('message', 'User telah diupdate');
        } catch (\Exception $e){
            return redirect()->route("user")->with("message", $e->getMessage());
        }
    }

    public function destroy(Request $request, UserService $user_service)
    {
        try{
            $user_service->destroy($request->id);

            return redirect()->route("user")->with('message', 'User telah dihapus');
        } catch (\Exception $e){
            return redirect()->route("user")->with("message", $e->getMessage());
        }
    }
}
