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
            throw new \Exception("Id harus terisi!");
        }

        return MetodePembayaran::find($id);
    }


    public function store($nama_metode) : MetodePembayaran
    {
        $params = ["nama_metode" => $nama_metode];
        
        $validator = Validator::make($params, [
            'nama_metode' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception("nama_metode harus terisi!");
        }

        $metode_pembayaran = MetodePembayaran::create($params);
        return $metode_pembayaran;
    }

    public function update($id, $nama_metode) : MetodePembayaran
    {
        $params = ["id" => $id, "nama_metode" => $nama_metode];
        
        $validator = Validator::make($params, [
            "id" => "required",
            'nama_metode' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception("Id dan nama_metode harus terisi!");
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
            throw new \Exception("Id harus terisi!");
        }

        $metode_pembayaran = MetodePembayaran::find($id);
        $metode_pembayaran->delete();
    }

}