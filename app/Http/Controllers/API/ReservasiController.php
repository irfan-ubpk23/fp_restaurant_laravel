<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ReservasiService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReservasiController extends BaseController
{
    public function index(ReservasiService $reservasi_service): JsonResponse
    {
        try{
            return $this->sendResponse($reservasi_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request, ReservasiService $reservasi_service) : JsonResponse
    {
        try{
            $reservasi = $reservasi_service->store($request->all());

            return $this->sendResponse($reservasi, "Reservasi berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, ReservasiService $reservasi_service): JsonResponse
    {
        try{
            $reservasi = $reservasi_service->show($request->id);

            return $this->sendResponse($reservasi, "Reservasi berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, ReservasiService $reservasi_service): JsonResponse
    {
        try{
            $reservasi = $reservasi_service->update($request->id, $request->all());

            return $this->sendResponse($reservasi, "Reservasi berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(Request $request, ReservasiService $reservasi_service)
    {
        try{
            $reservasi = $reservasi_service->destroy($request->id);

            return $this->sendResponse($reservasi, "Reservasi berhasil dihapus");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
