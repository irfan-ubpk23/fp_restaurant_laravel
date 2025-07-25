<?php

namespace App\Services;

use \DateTime;

use App\Models\Transaksi;
use App\Http\Resources\TransaksiResource;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class TransaksiService
{

    public function all()
    {
        return TransaksiResource::collection(Transaksi::all());
    }

    public function today(){
        return TransaksiResource::collection(Transaksi::whereDate('created_at', date('Y-m-d'))->get());
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
            'user_id' => "required",
            "order_id" => "required",
            "metode_pembayaran" => "required",
            "total_harga" => "required",
            "bukti_pembayaran" => ""
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        if (isset($params["bukti_pembayaran"])){
            $params["bukti_pembayaran"] = $this->uploadImageAndGetPath($params["bukti_pembayaran"]);
        }

        $params["kode_transaksi"] = $params['order_id'] + date('YmdHis');
        $transaksi = Transaksi::create($params);
        return $transaksi;
    }

    public function update($id, $params) : Transaksi
    {
        $params["id"] = $id;
        
        $validator = Validator::make($params, [
            "id" => "required",
            'user_id' => '',
            "order_id" => "",
            "metode_pembayaran" => "",
            "total_harga" => "",
            "kode_transaksi" => "",
            "status_pembayaran" => "",
            "bukti_pembayaran" => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $transaksi = Transaksi::find($id);
        if (isset($params["user_id"])){
            $transaksi->user_id = $params["user_id"];
        }
        if (isset($params["order_id"])){
            $transaksi->order_id = $params['order_id'];
        }
        if (isset($params["metode_pembayaran"])){
            $transaksi->metode_pembayaran = $params['metode_pembayaran'];
        }
        if (isset($params["total_harga"])){
            $transaksi->total_harga = $params['total_harga'];
        }
        if (isset($params["kode_transaksi"])){
            $transaksi->kode_transaksi = $params['kode_transaksi'];
        }
        if (isset($params["status_pembayaran"])){
            $transaksi->status_pembayaran = $params['status_pembayaran'];
        }
        if (isset($params["bukti_pembayaran"])){
            // throw new \Exception(count($params['bukti_pembayaran']));
            $transaksi->bukti_pembayaran = $this->uploadImageAndGetPath($params["bukti_pembayaran"]);
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

    public function where_user_id($user_id)
    {
        $validator = Validator::make(["user_id"=>$user_id], [
            "user_id" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $transaksis = Transaksi::where('user_id', $user_id)->get();
        return TransaksiResource::collection($transaksis);
    }

    public function where_kode_transaksi($kode_transaksi)
    {
        $validator = Validator::make(["kode_transaksi"=>$kode_transaksi], [
            "kode_transaksi" => "required"
        ]);

        if ($validator->fails()){
            throw new \Exception(implode("\n", $validator->errors()->all()));
        }

        $transaksis = Transaksi::where('kode_transaksi', $kode_transaksi)->get();
        return TransaksiResource::collection($transaksis);
    }

    public function overview($mode){
        $datas = [];

        if ($mode == "bulan"){
            for ($i=0;$i<12;$i++){
                $month_name = DateTime::createFromFormat('!m', $i + 1)->format('F');
                $datas[$month_name] = Transaksi::where('status_pembayaran', '=', 'selesai')->whereMonth('created_at', '=', $i + 1)->sum("total_harga");
            }
        }else{
            $latest = $this->get_date(Transaksi::latest()->first()->created_at);
            $oldest = $this->get_date(Transaksi::oldest()->first()->created_at);
            for ($i=(int) $oldest[0];$i<=(int) $latest[0];$i++){
                $datas[$i] = Transaksi::where('status_pembayaran', '=', 'selesai')->whereYear('created_at', '=', $i)->sum('total_harga');
            }
        }

        return $datas;
    }

    public function get_date($from_date_string){
        return explode('-', substr($from_date_string, 0, 10));
    }

    public function uploadImageAndGetPath($imageFile){
        $nama_gambar = time() . '.' . $imageFile->extension();
        $imageFile->move(public_path("images"), $nama_gambar);
        return URL::to("/images/" . $nama_gambar);
    }
}