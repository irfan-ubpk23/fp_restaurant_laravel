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
            throw new \Exception("Id harus terisi!");
        }

        return Pembayaran::find($id);
    }

    public function store($order_id, $metode_pembayaran_id, $total_harga, $kode_transaksi, $status_pembayaran,$bukti_pembayaran) : Pembayaran
    {
        $params = [
            "order_id" => $order_id,
            "metode_pembayaran_id" => $metode_pembayaran_id,
            "total_harga" => $total_harga,
            "kode_transaksi" => $kode_transaksi,
            "status_pembayaran" => $status_pembayaran,
            "bukti_pembayaran" => $bukti_pembayaran
        ];
        
        $validator = Validator::make($params, [
            "order_id" => "required",
            "metode_pembayaran_id" => "required",
            "total_harga" => "required",
            "kode_transaksi" => "required",
            "status_pembayaran" => "required",
            "bukti_pembayaran" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Nama Pembayaran harus terisi!");
        }

        $pembayaran = Pembayaran::create($params);
        return $pembayaran;
    }

    public function update($id, $order_id, $metode_pembayaran_id, $total_harga, $kode_transaksi, $status_pembayaran,$bukti_pembayaran) : Pembayaran
    {
        $params = [
            "order_id" => $order_id,
            "metode_pembayaran_id" => $metode_pembayaran_id,
            "total_harga" => $total_harga,
            "kode_transaksi" => $kode_transaksi,
            "status_pembayaran" => $status_pembayaran,
            "bukti_pembayaran" => $bukti_pembayaran
        ];
        
        $validator = Validator::make($params, [
            "id" => "required",
            "order_id" => "required",
            "metode_pembayaran_id" => "required",
            "total_harga" => "required",
            "kode_transaksi" => "required",
            "status_pembayaran" => "required",
            "bukti_pembayaran" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id dan Nama Pembayaran harus terisi!");
        }

        $pembayaran = Pembayaran::find($id);
        $pembayaran->order_id = $params['order_id'];
        $pembayaran->metode_pembayaran_id = $params['metode_pembayaran_id'];
        $pembayaran->total_harga = $params['total_harga'];
        $pembayaran->kode_transaksi = $params['kode_transaksi'];
        $pembayaran->status_pembayaran = $params['status_pembayaran'];
        $pembayaran->bukti_pembayaran = $params['bukti_pembayaran'];
        $pembayaran->save();

        return $pembayaran;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
    }
}