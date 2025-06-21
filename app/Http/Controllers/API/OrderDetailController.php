<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderDetailController extends BaseController
{
    public function index(OrderDetailService $order_detail_service): JsonResponse
    {
        try{
            return $this->sendResponse($order_detail_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request, OrderDetailService $order_detail_service) : JsonResponse
    {
        try{
            $order_detail = $order_detail_service->store($request->all());

            return $this->sendResponse($order_detail, "OrderDetail berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, OrderDetailService $order_detail_service): JsonResponse
    {
        try{
            $order_detail = $order_detail_service->show($request->id);

            return $this->sendResponse($order_detail, "OrderDetail berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, OrderDetailService $order_detail_service): JsonResponse
    {
        try{
            $order_detail = $order_detail_service->update($request->id, $request->all());

            return $this->sendResponse($order_detail, "OrderDetail berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(Request $request, OrderDetailService $order_detail_service)
    {
        try{
            $order_detail = $order_detail_service->destroy($request->id);

            return $this->sendResponse($order_detail, "OrderDetail berhasil dihapus");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
