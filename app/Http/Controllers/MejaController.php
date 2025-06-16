<?php

namespace App\Http\Controllers;

use App\Services\MejaService;

use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index(MejaService $meja_service)
    {
        return view('admin.meja', ['mejas' => $meja_service->all()]);
    }

    public function store(Request $request, MejaService $meja_service){
        try{
            $meja_service->store($request->all());

            return redirect()->route("meja")->with('message', 'Meja telah dibuat');
        } catch (\Exception $e){
            return redirect()->route("meja")->with("message", $e->getMessage());
        }
    }

    public function update(Request $request, MejaService $meja_service)
    {
        try{
            $meja_service->update($request->id, $request->all());

            return redirect()->route("meja")->with('message', 'Meja telah diupdate');
        } catch (\Exception $e){
            return redirect()->route("meja")->with("message", $e->getMessage());
        }
    }

    public function destroy(Request $request, MejaService $meja_service)
    {
        try{
            $meja_service->destroy($request->id);

            return redirect()->route("meja")->with('message', 'Meja telah dihapus');
        } catch (\Exception $e){
            return redirect()->route("meja")->with("message", $e->getMessage());
        }
    }
}
