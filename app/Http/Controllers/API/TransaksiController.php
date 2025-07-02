<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TransaksiService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransaksiController extends BaseController
{
    public function index(TransaksiService $transaksi_service): JsonResponse
    {
        try{
            return $this->sendResponse($transaksi_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request, TransaksiService $transaksi_service) : JsonResponse
    {
        try{
            $transaksi = $transaksi_service->store($request->all());

            return $this->sendResponse($transaksi, "Transaksi berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, TransaksiService $transaksi_service): JsonResponse
    {
        try{
            $transaksi = $transaksi_service->show($request->id);

            return $this->sendResponse($transaksi, "Transaksi berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, TransaksiService $transaksi_service): JsonResponse
    {
        try{
            // return $this->sendResponse($request->hasFile('bukti_pembayaran'));
            $transaksi = $transaksi_service->update($request->id, $request->all());

            return $this->sendResponse($transaksi, "Transaksi berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(Request $request, TransaksiService $transaksi_service)
    {
        try{
            $transaksi = $transaksi_service->destroy($request->id);

            return $this->sendResponse($transaksi, "Transaksi berhasil dihapus");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function overview(Request $request, TransaksiService $transaksi_service)
    {
        try{
            $transaksis = $transaksi_service->overview($request->mode);

            return $this->sendResponse($transaksis);
        }
        catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function where_user_id(Request $request, TransaksiService $transaksi_service)
    {
        try{
            $transaksis = $transaksi_service->where_user_id($request->id);

            return $this->sendResponse($transaksis);
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function where_kode_transaksi(Request $request, TransaksiService $transaksi_service){
        try{
            $transaksis = $transaksi_service->where_kode_transaksi($request->id);

            return $this->sendResponse($transaksis);
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
