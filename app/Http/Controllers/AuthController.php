<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }


    public function login(Request $request, AuthService $authService){
        try {
            $user = $authService->login($request->email, $request->password);
            Log::info("User log in", ['user_id' => $user->id]);

            return redirect()->intended('dashboard');
        } catch (\Exception $e){
            return back()->with("message", $e->getMessage())->withInput();
        }
    }


    public function logout(Request $request){
        $user = Auth::user();
        Auth::logout();
        Log::info("User log out", ['user_id' => $user->id]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
