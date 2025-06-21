<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\MejaService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MejaController extends BaseController
{
    public function index(MejaService $meja_service): JsonResponse
    {
        try{
            return $this->sendResponse($meja_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request, MejaService $meja_service) : JsonResponse
    {
        try{
            $meja = $meja_service->store($request->all());

            return $this->sendResponse($meja, "Meja berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, MejaService $meja_service): JsonResponse
    {
        try{
            $meja = $meja_service->show($request->id);

            return $this->sendResponse($meja, "Meja berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, MejaService $meja_service): JsonResponse
    {
        try{
            $meja = $meja_service->update($request->id, $request->all());

            return $this->sendResponse($meja, "Meja berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(Request $request, MejaService $meja_service)
    {
        try{
            $meja = $meja_service->destroy($request->id);

            return $this->sendResponse($meja, "Meja berhasil dihapus");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
