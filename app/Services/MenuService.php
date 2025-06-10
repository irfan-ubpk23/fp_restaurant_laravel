<?php

namespace App\Services;

use App\Models\Menu;

use Illuminate\Support\Facades\Validator;

class MenuService
{

    public function all()
    {
        $menus = Menu::all();
        return $menus;
    }

    public function show($id) : Menu
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        return Menu::find($id);
    }

    public function store($id_kategori, $nama_menu, $harga_menu, $status_menu, $waktu_saji) : Menu
    {
        $params = [
            "id_kategori" => $id_kategori,
            "nama_menu" => $nama_menu,
            "harga_menu" => $harga_menu,
            "status_menu" => $status_menu,
            "waktu_saji" => $waktu_saji
        ];

        $validator = Validator::make($params, [
            'id_kategori' => 'required',
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'status_menu' => 'required',
            'waktu_saji' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception("Kolom harus diisi semua!");
        }

        $menu = Menu::create($params);
        return $menu;
    }

    public function update($id, $id_kategori, $nama_menu, $harga_menu, $status_menu, $waktu_saji) : Menu
    {
        $params = [
            "id" => $id,
            "id_kategori" => $id_kategori,
            "nama_menu" => $nama_menu,
            "harga_menu" => $harga_menu,
            "status_menu" => $status_menu,
            "waktu_saji" => $waktu_saji
        ];

        $validator = Validator::make($params, [
            'id_kategori' => 'required',
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'status_menu' => 'required',
            'waktu_saji' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception("Kolom harus diisi semua!");
        }

        $menu = Menu::find($id);
        $menu->id_kategori = $params['id_kategori'];
        $menu->nama_menu = $params['nama_menu'];
        $menu->harga_menu = $params['harga_menu'];
        $menu->status_menu = $params['status_menu'];
        $menu->waktu_saji = $params['waktu_saji'];
        $menu->save();

        return $menu;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $menu = Menu::find($id);
        $menu->delete();
    }

}