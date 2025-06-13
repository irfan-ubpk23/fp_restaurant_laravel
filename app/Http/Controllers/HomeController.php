<?php

namespace App\Http\Controllers;

use App\Services\OrderService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (Auth::check()){
            return redirect("dashboard");
        }else{
            return redirect("login");
        }
    }

    public function dashboard(OrderService $order_service){
        $role = Auth::user()->role;
        if ($role == "admin"){
            return view("admin.index");
        }else if($role == "dapur"){
            return view("dapur.index", ["orders"=>$order_service->all()]);
        }
    }

    
}
