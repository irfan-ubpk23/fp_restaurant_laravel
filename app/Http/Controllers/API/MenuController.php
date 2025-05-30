<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class MenuController extends BaseController
{
    public function index(): JsonResponse
    {
        $menus = Menu::all();

        return $this->sendResponse(MenuResource::collection($menus));
    }

    public function store(Request $request) : JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kategori' => 'required',
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'status_menu' => 'required',
            'waktu_saji' => 'required'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $menu = Menu::create($input);

        return $this->sendResponse(new MenuResource($menu));
    }

    public function show($id): JsonResponse
    {
        $menu = Menu::find($id);

        if (is_null($menu)){
            return $this->sendError('Menu not Found.');
        }

        return $this->sendResponse(new MenuResource($menu));
    }

    public function update(Request $request, Menu $menu): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kategori' => 'required',
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'status_menu' => 'required',
            'waktu_saji' => 'required'
        ]);

        if ($validator->fails()){
            $this->sendError('Menu not found.');
        }

        $menu->id_kategori = $input['id_kategori'];
        $menu->nama_menu = $input['nama_menu'];
        $menu->harga_menu = $input['harga_menu'];
        $menu->status_menu = $input['status_menu'];
        $menu->waktu_saji = $input['waktu_saji'];
        $menu->save();

        return $this->sendResponse(new MenuResource($menu));
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return $this->sendResponse([]);
    }
}
