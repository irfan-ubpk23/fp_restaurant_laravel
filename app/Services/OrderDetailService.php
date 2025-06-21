<?php

namespace App\Services;

use App\Models\OrderDetail;

use Illuminate\Support\Facades\Validator;

class OrderDetailService
{

    public function all()
    {
        $order_details = OrderDetail::all();
        return $order_details;
    }

    public function show($id) : OrderDetail
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        return OrderDetail::find($id);
    }

    public function store($params) : OrderDetail
    {
        $validator = Validator::make($params, [
            'order_id' => 'required',
            'menu_id' => 'required',
            'jumlah' => 'required'
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $order_detail = OrderDetail::create($params);
        return $order_detail;
    }

    public function update($id, $params) : OrderDetail
    {
        $params["id"] = $id;
        $validator = Validator::make($params, [
            "id" => "required",
            'order_id' => '',
            'menu_id' => '',
            'jumlah' => ''
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $order_detail = OrderDetail::find($id);
        if (isset($params["order_id"])){
            $order_detail->order_id = $params["order_id"];
        }
        if (isset($params["menu_id"])){
            $order_detail->menu_id = $params["menu_id"];
        }
        if (isset($params["jumlah"])){
            $order_detail->jumlah = $params["jumlah"];
        }
        $order_detail->save();

        return $order_detail;
    }

    public function destroy($id)
    {
        $validator = Validator::make(["id"=>$id], [
            "id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $order_detail = OrderDetail::find($id);
        $order_detail->delete();
    }
}