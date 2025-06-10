<?php

namespace App\Services;

use App\Models\Order;
use App\Http\Resources\OrderResource;

use Illuminate\Support\Facades\Validator;

class OrderService
{

    public function all()
    {
        return OrderResource::collection(Order::all());
    }

    public function show($id) : Order
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        return Order::find($id);
    }


    public function store($user_id, $nomor_antrian, $status_order, $keterangan) : Order
    {
        $params = [
            "user_id" => $user_id,
            "nomor_antrian" => $nomor_antrian,
            "status_order" => $status_order,
            "keterangan" => $keterangan,
        ];
        
        $validator = Validator::make($params, [
            "user_id" => "required",
            "nomor_antrian" => "required",
            "status_order" => "required",
            "keterangan" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Batas Orang harus terisi!");
        }

        $meja = Order::create($params);
        return $meja;
    }

    public function update($id, $user_id, $nomor_antrian, $status_order, $keterangan) : Order
    {
        $params = [
            "id" => $id,
            "user_id" => $user_id,
            "nomor_antrian" => $nomor_antrian,
            "status_order" => $status_order,
            "keterangan" => $keterangan,
        ];
        
        $validator = Validator::make($params, [
            "id" => "required",
            "user_id" => "required",
            "nomor_antrian" => "required",
            "status_order" => "required",
            "keterangan" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id dan Batas Orang harus terisi!");
        }

        $order = Order::find($id);
        $order->user_id = $params['user_id'];
        $order->nomor_antrian = $params['nomor_antrian'];
        $order->status_order = $params['status_order'];
        $order->keterangan = $params['keterangan'];
        $order->save();

        return $order;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception("Id harus terisi!");
        }

        $order = Order::find($id);
        $order->delete();
    }

}