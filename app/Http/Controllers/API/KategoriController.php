<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Kategori;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KategoriController extends BaseController
{
    public function index(KategoriService $kategori_service): JsonResponse
    {
        try{
            return $this->sendResponse($kategori_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request, KategoriService $kategori_service) : JsonResponse
    {
        try{
            $kategori = $kategori_service->store($request->all());

            return $this->sendResponse($kategori, "Kategori berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, KategoriService $kategori_service): JsonResponse
    {
        try{
            $kategori = $kategori_service->show($request->id);

            return $this->sendResponse($kategori, "Kategori berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, KategoriService $kategori_service): JsonResponse
    {
        try{
            $kategori = $kategori_service->show($request->id, $request->all());

            return $this->sendResponse($kategori, "Kategori berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(Request $request, KategoriService $kategori_service)
    {
        try{
            $kategori = $kategori_service->destroy($request->id);

            return $this->sendResponse($kategori, "Kategori berhasil dihapus");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
