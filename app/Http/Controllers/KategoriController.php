<?php

namespace App\Http\Controllers;

use App\Services\KategoriService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(KategoriService $kategori_service)
    {
        return view('admin.kategori', ['kategoris' => $kategori_service->all()]);
    }

    public function store(Request $request, KategoriService $kategori_service){
        try{
            $kategori_service->store($request->nama_kategori);

            return redirect()->route("kategori")->with('message', 'Kategori telah dibuat');
        } catch (\Exception $e){
            return redirect()->route("kategori")->with("message", $e->getMessage());
        }
    }

    public function update(Request $request, KategoriService $kategori_service)
    {
        try{
            $kategori_service->update($request->id, $request->nama_kategori);

            return redirect()->route("kategori")->with('message', 'Kategori telah diupdate');
        } catch (\Exception $e){
            return redirect()->route("kategori")->with("message", $e->getMessage());
        }
    }

    public function destroy(Request $request, KategoriService $kategori_service)
    {
        try{
            $kategori_service->destroy($request->id);

            return redirect()->route("kategori")->with('message', 'Kategori telah dihapus');
        } catch (\Exception $e){
            return redirect()->route("kategori")->with("message", $e->getMessage());
        }
    }
}
