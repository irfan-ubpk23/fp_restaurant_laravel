<?php

namespace App\Http\Controllers\API;

use App\Services\OrderService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends BaseController
{
    public function index(OrderService $order_service): JsonResponse
    {
        try{
            return $this->sendResponse($order_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request, OrderService $order_service) : JsonResponse
    {
        try{
            $order = $order_service->store($request->all());

            return $this->sendResponse($order, "Order berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, OrderService $order_service): JsonResponse
    {
        try{
            $order = $order_service->show($request->id);

            return $this->sendResponse($order, "Order berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, OrderService $order_service): JsonResponse
    {
        try{
            $order = $order_service->update($request->id, $request->all());

            return $this->sendResponse($order, "Order berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(Request $request, OrderService $order_service)
    {
        try{
            $order = $order_service->destroy($request->id);

            return $this->sendResponse($order, "Order berhasil dihapus");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
