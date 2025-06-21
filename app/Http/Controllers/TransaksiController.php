<?php

namespace App\Http\Controllers;

use App\Services\TransaksiService;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(TransaksiService $transaksi_service){
        return view('admin.transaksi', ["transaksis" => $transaksi_service->all()]);
    }
}
