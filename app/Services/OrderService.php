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
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return Order::find($id);
    }


    public function store($params) : Order
    {   
        $validator = Validator::make($params, [
            "user_id" => "required",
            // "nomor_antrian" => "required",
            // "status_order" => "required",
            "jenis_order" => "required",
            "keterangan" => ""
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $last_order = Order::whereDay("created_at", "=", date("d"))
            ->orderBy('nomor_antrian', 'desc')
            ->get();
        if (count($last_order) > 0){
            $params["nomor_antrian"] = intval($last_order[0]->nomor_antrian) + 1;
        }else{
            $params["nomor_antrian"] = 1;
        }

        if (! isset($params["status_order"])){
            $params["status_order"] = 'proses';
        }
        if (! isset($params["keterangan"])){
            $params["keterangan"] = " ";
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
        if (isset($params["nomor_antrian"])){
            $order->nomor_antrian = $params['nomor_antrian'];
        }
        if (isset($params["status_order"])){
            $order->status_order = $params['status_order'];
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

    protected function calculate_nomor_antrian() : int
    {
        
    }

}