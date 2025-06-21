<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Reservasi;

use App\Services\OrderService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if ($role === "admin"){
            $orders_count = Transaksi::count();
            $total_all_transaksis = Transaksi::sum('total_harga');
            $total_monthly_transaksis = Transaksi::whereMonth('created_at', ">=", date('m'))->sum("total_harga");
            $total_annually_transaksis = Transaksi::whereYear('created_at', ">=", date('Y'))->sum("total_harga");

            return view("admin.index", [
                "orders_count" => $orders_count,
                "total_all_transaksis" => $total_all_transaksis,
                "total_monthly_transaksis" => $total_monthly_transaksis,
                "total_annually_transaksis" => $total_annually_transaksis
            ]);
        }else if($role === "dapur"){
            return view("dapur.index", ["orders"=>$order_service->all()]);
        }else{
            return back();
        }
    }

    
}
