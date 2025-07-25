<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Meja;
use App\Http\Resources\OrderResource;

use Illuminate\Support\Facades\Validator;

class OrderService
{

    public function all()
    {
        return OrderResource::collection(Order::all());
    }

    public function today(){
        return OrderResource::collection(Order::whereDate('created_at', date('Y-m-d'))->get());
    }

    public function show($id) : Order
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Order::find($id);
    }


    public function store($params) : Order
    {   
        $validator = Validator::make($params, [
            "user_id" => "required",
            "meja_id" => '',
            // "nomor_antrian" => "required",
            // "status_order" => "required",
            "jenis_order" => "required",
            "keterangan" => ""
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }
        if ($params["jenis_order"] != 'takeaway'){
            if (! isset($params["meja_id"])){
                throw new \Exception("membutuhkan Meja!");
            }else{
                $meja = Meja::find($params['meja_id']);
                $meja->status_meja = 'terisi';
                $meja->save();
            }
        }

        $last_order = Order::whereDate("created_at", "=", date("Y-m-d"))
            ->orderBy('nomor_antrian', 'desc')
            ->get();
        if (count($last_order) > 0){
            $params["nomor_antrian"] = intval($last_order[0]->nomor_antrian) + 1;
        }else{
            $params["nomor_antrian"] = 1;
        }
        $meja = Order::create($params);
        return $meja;
    }

    public function update($id, $params) : Order
    {
        $params["id"] = $id;
        
        $validator = Validator::make($params, [
            "id" => "required",
            "user_id" => "",
            "meja_id" => "",
            "nomor_antrian" => "",
            "status_order" => "",
            'jenis_order' => "",
            "keterangan" => ""
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $order = Order::find($id);
        if (isset($params["user_id"])){
            $order->user_id = $params['user_id'];
        }
        if (isset($params['meja_id'])){
            $order->meja_id = $params['meja_id'];
        }
        if (isset($params["nomor_antrian"])){
            $order->nomor_antrian = $params['nomor_antrian'];
        }
        if (isset($params["status_order"])){
            $order->status_order = $params['status_order'];
            
            if ($order->jenis_order != "takeaway"){
                $meja = Meja::find($order->meja_id);
                if ($order->status_order == 'selesai'){
                    $meja->status_meja = 'tersedia';
                }
                $meja->save();
            }
        }
        if (isset($params["jenis_order"])){
            $order->jenis_order = $params['jenis_order'];
        }
        if (isset($params["keterangan"])){
            $order->keterangan = $params['keterangan'];
        }
        $order->save();

        return $order;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $order = Order::find($id);
        $order->delete();
    }
}