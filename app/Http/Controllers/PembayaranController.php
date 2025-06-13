<?php

namespace App\Http\Controllers;

use App\Services\PembayaranService;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(PembayaranService $pembayaran_service){
        return view('admin.pembayaran', ["pembayarans" => $pembayaran_service->all()]);
    }
}
