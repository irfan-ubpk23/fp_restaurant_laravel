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
            throw new \Exception("Id harus terisi!");
        }

        return Meja::find($id);
    }


    public function store($batas_orang) : Meja
    {
        $params = ["batas_orang" => $batas_orang];
        
        $validator = Validator::make($params, [
            'batas_orang' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception("Batas Orang harus terisi!");
        }

        $meja = Meja::create($params);
        return $meja;
    }

    public function update($id, $batas_orang) : Meja
    {
        $params = ["id" => $id, "batas_orang" => $batas_orang];
        
        $validator = Validator::make($params, [
            "id" => "required",
            'batas_orang' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception("Id dan Batas Orang harus terisi!");
        }

        $meja = Meja::find($id);
        $meja->batas_orang = $params['batas_orang'];
        $meja->save();

        return $meja;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $meja = Meja::find($id);
        $meja->delete();
    }

}