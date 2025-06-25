<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UserService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    public function index(UserService $user_service): JsonResponse
    {
        try{
            return $this->sendResponse($user_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, UserService $user_service): JsonResponse
    {
        try{
            $user = $user_service->show($request->id);

            return $this->sendResponse($user, "User berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, UserService $user_service): JsonResponse
    {
        try{
            $user = $user_service->update($request->id, $request->all());

            return $this->sendResponse($user, "User berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
