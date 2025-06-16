<?php

namespace App\Http\Controllers;

use App\Services\MetodePembayaranService;

use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index(MetodePembayaranService $metode_pembayaran_service){
        
        return view('admin.metode_pembayaran', ["metode_pembayarans" => $metode_pembayaran_service->all()]);
    }


    public function store(Request $request, MetodePembayaranService $metode_pembayaran_service){
        try{
            $metode_pembayaran_service->store($request->all());

            return redirect()->route("metode_pembayaran")->with('message', 'Metode Pembayaran telah dibuat');
        } catch (\Exception $e){
            return redirect()->route("metode_pembayaran")->with("message", $e->getMessage());
        }
    }

    public function update(Request $request, MetodePembayaranService $metode_pembayaran_service)
    {
        try{
            $metode_pembayaran_service->update($request->id, $request->all());

            return redirect()->route("metode_pembayaran")->with('message', 'Metode Pembayaran telah diupdate');
        } catch (\Exception $e){
            return redirect()->route("metode_pembayaran")->with("message", $e->getMessage());
        }
    }

    public function destroy(Request $request, MetodePembayaranService $metode_pembayaran_service)
    {
        try{
            $metode_pembayaran_service->destroy($request->id);

            return redirect()->route("metode_pembayaran")->with('message', 'Metode Pembayaran telah dihapus');
        } catch (\Exception $e){
            return redirect()->route("metode_pembayaran")->with("message", $e->getMessage());
        }
    }

}
