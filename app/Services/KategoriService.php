<?php

namespace App\Services;

use App\Models\Kategori;

use Illuminate\Support\Facades\Validator;

class KategoriService
{

    public function all()
    {
        $kategoris = Kategori::all();
        return $kategoris;
    }

    public function show($id) : Kategori
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Kategori::find($id);
    }

    public function store($params) : Kategori
    {
        $validator = Validator::make($params, [
            'nama_kategori' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $kategori = Kategori::create($params);
        return $kategori;
    }

    public function update($id, $params) : Kategori
    {
        $params["id"] = $id;
        $validator = Validator::make($params, [
            "id" => "required",
            'nama_kategori' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $params['nama_kategori'];
        $kategori->save();

        return $kategori;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $kategori = Kategori::find($id);
        $kategori->delete();
    }
}