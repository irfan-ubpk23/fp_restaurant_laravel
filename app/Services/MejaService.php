<?php

namespace App\Services;

use App\Models\Meja;

use Illuminate\Support\Facades\Validator;

class MejaService
{

    public function all()
    {
        return Meja::all();
    }

    public function show($id) : Meja
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Meja::find($id);
    }


    public function store($params) : Meja
    {
        $validator = Validator::make($params, [
            "nama_meja" => "required",
            'batas_orang' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $meja = Meja::create($params);
        return $meja;
    }

    public function update($id, $params) : Meja
    {
        $params["id"] = $id;
        $validator = Validator::make($params, [
            "id" => "required",
            "nama_meja" => "",
            'batas_orang' => ''
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $meja = Meja::find($id);
        if (isset($params["nama_meja"])){
            $meja->nama_meja = $params["nama_meja"];
        }
        if (isset($params["batas_orang"])){
            $meja->batas_orang = $params['batas_orang'];
        }
        $meja->save();

        return $meja;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $meja = Meja::find($id);
        $meja->delete();
    }

}