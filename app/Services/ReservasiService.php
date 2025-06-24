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
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Reservasi::find($id);
    }


    public function store($params) : Reservasi
    {   
        $validator = Validator::make($params, [
            "user_id" => "required",
            "meja_id" => "required",
            'order_id' => 'required',
            "tanggal_dan_jam" => "required",
            // "status_reservasi" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        if (! isset($params["status_reservasi"])){
            $params["status_reservasi"] = 'menunggu';
        }
        $reservasi = Reservasi::create($params);
        return $reservasi;
    }

    public function update($id, $params) : Reservasi
    {
        $params["id"] = $id;
        
        $validator = Validator::make($params, [
            "id" => "required",
            "user_id" => "",
            "meja_id" => "",
            'order_id' => '',
            "tanggal_dan_jam" => "",
            "status_reservasi" => ""
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $reservasi = Reservasi::find($id);
        if (isset($params["user_id"])){
            $reservasi->user_id = $params['user_id'];
        }
        if (isset($params["meja_id"])){
            $reservasi->meja_id = $params['meja_id'];
        }
        if (isset($params["order_id"])){
            $reservasi->order_id = $params['order_id'];
        }
        if (isset($params["tanggal_dan_jam"])){
            $reservasi->tanggal_dan_jam = $params['tanggal_dan_jam'];
        }
        if (isset($params["status_reservasi"])){
            $reservasi->status_reservasi = $params['status_reservasi'];
        }
        $reservasi->save();

        return $reservasi;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $reservasi = Reservasi::find($id);
        $reservasi->delete();
    }

}