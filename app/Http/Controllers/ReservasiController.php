<?php

namespace App\Http\Controllers;

use App\Services\ReservasiService;

use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index(ReservasiService $reservasi_service)
    {
        return view('admin.reservasi', ['reservasis' => $reservasi_service->all()]);
    }
}
