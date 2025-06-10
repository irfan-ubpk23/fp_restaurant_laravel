<?php

namespace App\Http\Controllers;

use App\Services\OrderService;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderService $order_service){
        return view('admin.order', ["orders" => $order_service->all()]);
    }
}
