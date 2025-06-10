<?php

namespace App\Services;

use App\Models\Reservasi;

use Illuminate\Support\Facades\Validator;

class ReservasiService
{

    public function all()
    {
        return Reservasi::all();
    }

    public function show($id) : Reservasi
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        return Reservasi::find($id);
    }


    public function store($user_id, $meja_id, $tanggal_dan_jam, $status_reservasi) : Reservasi
    {
        $params = [
            "user_id" => $user_id,
            "meja_id" => $meja_id,
            "tanggal_dan_jam" => $tanggal_dan_jam,
            "status_reservasi" => $status_reservasi
        ];
        
        $validator = Validator::make($params, [
            "user_id" => "required",
            "meja_id" => "required",
            "tanggal_dan_jam" => "required",
            "status_reservasi" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $reservasi = Reservasi::create($params);
        return $reservasi;
    }

    public function update($id, $user_id, $meja_id, $tanggal_dan_jam, $status_reservasi) : Reservasi
    {
        $params = [
            "id" => $id,
            "user_id" => $user_id,
            "meja_id" => $meja_id,
            "tanggal_dan_jam" => $tanggal_dan_jam,
            "status_reservasi" => $status_reservasi
        ];
        
        $validator = Validator::make($params, [
            "id" => "required",
            "user_id" => "required",
            "meja_id" => "required",
            "tanggal_dan_jam" => "required",
            "status_reservasi" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $reservasi = Reservasi::find($id);
        $reservasi->user_id = $params['user_id'];
        $reservasi->meja_id = $params['meja_id'];
        $reservasi->tanggal_dan_jam = $params['tanggal_dan_jam'];
        $reservasi->status_reservasi = $params['status_reservasi'];
        $reservasi->save();

        return $reservasi;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $reservasi = Reservasi::find($id);
        $reservasi->delete();
    }

}