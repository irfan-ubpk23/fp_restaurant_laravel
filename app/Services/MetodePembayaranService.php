<?php

namespace App\Services;

use App\Models\MetodePembayaran;

use Illuminate\Support\Facades\Validator;

class MetodePembayaranService
{

    public function all()
    {
        return MetodePembayaran::all();
    }

    public function show($id) : MetodePembayaran
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return MetodePembayaran::find($id);
    }


    public function store($params) : MetodePembayaran
    {
        $validator = Validator::make($params, [
            'nama_metode' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $metode_pembayaran = MetodePembayaran::create($params);
        return $metode_pembayaran;
    }

    public function update($id, $params) : MetodePembayaran
    {
        $params["id"] = $id;
        
        $validator = Validator::make($params, [
            "id" => "required",
            'nama_metode' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $metode_pembayaran = MetodePembayaran::find($id);
        $metode_pembayaran->nama_metode = $params['nama_metode'];
        $metode_pembayaran->save();

        return $metode_pembayaran;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $metode_pembayaran = MetodePembayaran::find($id);
        $metode_pembayaran->delete();
    }

}