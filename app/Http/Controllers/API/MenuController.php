<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\MenuService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MenuController extends BaseController
{
    public function index(MenuService $menu_service): JsonResponse
    {
        try{
            return $this->sendResponse($menu_service->all());
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request, MenuService $menu_service) : JsonResponse
    {
        try{
            $menu = $menu_service->store($request->all());

            return $this->sendResponse($menu, "Menu berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function show(Request $request, MenuService $menu_service): JsonResponse
    {
        try{
            $menu = $menu_service->show($request->id);

            return $this->sendResponse($menu, "Menu berhasil dibuat");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update(Request $request, MenuService $menu_service): JsonResponse
    {
        try{
            $menu = $menu_service->update($request->id, $request->all());

            return $this->sendResponse($menu, "Menu berhasil diupdate");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(Request $request, MenuService $menu_service)
    {
        try{
            $menu = $menu_service->destroy($request->id);

            return $this->sendResponse($menu, "Menu berhasil dihapus");
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function terlaris(Request $request, MenuService $menu_service){
        try{
            $menus = $menu_service->terlaris($request->range);

            return $this->sendResponse($menus);
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
