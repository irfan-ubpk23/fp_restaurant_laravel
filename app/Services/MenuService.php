<?php

namespace App\Services;

use App\Models\Menu;
use App\Http\Resources\MenuResource;

use Illuminate\Support\Facades\Validator;

class MenuService
{

    public function all()
    {
        return MenuResource::collection(Menu::all());
    }

    public function show($id) : Menu
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Menu::find($id);
    }

    public function store($params) : Menu
    {
        $validator = Validator::make($params, [
            'id_kategori' => 'required',
            'nama_menu' => 'required',
            'gambar_menu' => 'required',
            'harga_menu' => 'required',
            'status_menu' => 'required',
            'waktu_saji' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $nama_gambar = time() . '.' . $params['gambar_menu']->extension();
        $params['gambar_menu']->move(public_path("images"), $nama_gambar);
        $params['gambar_menu'] = "images/" . $nama_gambar;
        $menu = Menu::create($params);
        return $menu;
    }

    public function update($id, $params) : Menu
    {
        $params["id"] = $id;
        $validator = Validator::make($params, [
            "id" => "required",
            'id_kategori' => '',
            'nama_menu' => '',
            'gambar_menu' => 'image|mimes:jpeg,png,jpg|max:2048',
            'harga_menu' => '',
            'status_menu' => '',
            'waktu_saji' => ''
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $menu = Menu::find($id);
        if (isset($params["id_kategori"])){
            $menu->id_kategori = $params['id_kategori'];
        }
        if (isset($params["nama_menu"])){
            $menu->harga_menu = $params['harga_menu'];
        }
        if (isset($params["gambar_menu"])){
            $nama_gambar = time() . '.' . $params['gambar_menu']->extension();
            $params['gambar_menu']->move(public_path("images"), $nama_gambar);
            $menu->gambar_menu = "images/" . $nama_gambar;
        }
        if (isset($params["harga_menu"])){
            $menu->harga_menu = $params['harga_menu'];
        }
        if (isset($params["status_menu"])){
            $menu->status_menu = $params['status_menu'];
        }
        if (isset($params["waktu_saji"])){
            $menu->waktu_saji = $params['waktu_saji'];
        }
        $menu->save();

        return $menu;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $menu = Menu::find($id);
        $menu->delete();
    }

}