<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Http\Resources\TransaksiResource;

use Illuminate\Support\Facades\Validator;

class TransaksiService
{

    public function all()
    {
        return TransaksiResource::collection(Transaksi::all());
    }

    public function show($id) : Transaksi
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Transaksi::find($id);
    }

    public function store($params) : Transaksi
    {
        $validator = Validator::make($params, [
            "order_id" => "required",
            "metode_pembayaran" => "required",
            "total_harga" => "required",
            // "kode_transaksi" => "required",
            // "status_pembayaran" => "required",
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $params["kode_transaksi"] = date('YmdHisu');
        if (! isset($params["status_pembayaran"])){
            $params["status_pembayaran"] = "belum";
        }
        $transaksi = Transaksi::create($params);
        return $transaksi;
    }

    public function update($id, $params) : Transaksi
    {
        $params["id"] = $id;
        
        $validator = Validator::make($params, [
            "id" => "required",
            "order_id" => "",
            "metode_pembayaran" => "",
            "total_harga" => "",
            "kode_transaksi" => "",
            "status_pembayaran" => "",
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $transaksi = Transaksi::find($id);
        if ($params["order_id"]){
            $transaksi->order_id = $params['order_id'];
        }
        if ($params["metode_pembayaran"]){
            $transaksi->metode_pembayaran = $params['metode_pembayaran'];
        }
        if ($params["total_harga"]){
            $transaksi->total_harga = $params['total_harga'];
        }
        if ($params["kode_transaksi"]){
            $transaksi->kode_transaksi = $params['kode_transaksi'];
        }
        if ($params["status_pembayaran"]){
            $transaksi->status_pembayaran = $params['status_pembayaran'];
        }
        $transaksi->save();

        return $transaksi;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $transaksi = Transaksi::find($id);
        $transaksi->delete();
    }
}