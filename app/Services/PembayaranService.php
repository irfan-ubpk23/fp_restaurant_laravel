<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Http\Resources\PembayaranResource;

use Illuminate\Support\Facades\Validator;

class PembayaranService
{

    public function all()
    {
        return PembayaranResource::collection(Pembayaran::all());
    }

    public function show($id) : Pembayaran
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Pembayaran::find($id);
    }

    public function store($params) : Pembayaran
    {
        $validator = Validator::make($params, [
            "order_id" => "required",
            "metode_pembayaran_id" => "required",
            "total_harga" => "required",
            "kode_transaksi" => "required",
            "status_pembayaran" => "required",
            "bukti_pembayaran" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $pembayaran = Pembayaran::create($params);
        return $pembayaran;
    }

    public function update($id, $params) : Pembayaran
    {
        $params["id"] = $id;
        
        $validator = Validator::make($params, [
            "id" => "required",
            "order_id" => "",
            "metode_pembayaran_id" => "",
            "total_harga" => "",
            "kode_transaksi" => "",
            "status_pembayaran" => "",
            "bukti_pembayaran" => ""
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $pembayaran = Pembayaran::find($id);
        if ($params["order_id"]){
            $pembayaran->order_id = $params['order_id'];
        }
        if ($params["metode_pembayaran_id"]){
            $pembayaran->metode_pembayaran_id = $params['metode_pembayaran_id'];
        }
        if ($params["total_harga"]){
            $pembayaran->total_harga = $params['total_harga'];
        }
        if ($params["kode_transaksi"]){
            $pembayaran->kode_transaksi = $params['kode_transaksi'];
        }
        if ($params["status_pembayaran"]){
            $pembayaran->status_pembayaran = $params['status_pembayaran'];
        }
        if ($params["bukti_pembayaran"]){
            $pembayaran->bukti_pembayaran = $params['bukti_pembayaran'];
        }
        $pembayaran->save();

        return $pembayaran;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
    }
}