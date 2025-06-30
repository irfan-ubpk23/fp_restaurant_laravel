<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\OrderDetail;
use App\Http\Resources\MenuResource;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

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

        $params['gambar_menu'] = $this->uploadImageAndGetPath($params['gambar_menu']);
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
            $menu->nama_menu = $params['nama_menu'];
        }
        if (isset($params["gambar_menu"])){
            $menu->gambar_menu = $this->uploadImageAndGetPath($params['gambar_menu']);;
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

    public function terlaris($params){
        $validator = Validator::make($params, [
            "range" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $menus = Menu::all();
        $menus_terlaris = [];

        foreach ($menus as $menu){
            $order_detail_query;
            if ($params['range'] == 'bulan'){
                $order_detail_query = OrderDetail::whereMonth('created_at', '=', date('m'));
            }else{
                $order_detail_query = OrderDetail::whereYear('created_at', '=', date('Y'));
            }
            array_push($menus_terlaris, [
                $menu->id,
                $menu->nama_menu,
                $order_detail_query->where("menu_id", $menu->id)->sum("jumlah")
            ]);
        }
        return $menus_terlaris;
    }

    public function uploadImageAndGetPath($imageFile){
        $nama_gambar = time() . '.' . $imageFile->extension();
        $imageFile->move(public_path("images"), $nama_gambar);
        return URL::to("/images/" . $nama_gambar);
    }

}