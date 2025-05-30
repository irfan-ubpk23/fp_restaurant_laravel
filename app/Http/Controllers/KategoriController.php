<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        return view('kategori.index', ['kategoris' => $kategoris]);
    }

    public function store(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_kategori' => 'required'
        ]);

        if ($validator->fails()){
            return redirect()->route("kategori")->with("success", "Nama Kategori harus diisi!");
        }

        $kategori = Kategori::create($input);

        return redirect()->route("kategori")->with('success', 'Kategori telah dibuat');
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_kategori' => 'required'
        ]);

        if ($validator->fails()){
            return redirect()->route("kategori")->with("success", "Nama Kategori harus diisi!");
        }

        $kategori = Kategori::find($request->id);
        $kategori->nama_kategori = $input['nama_kategori'];
        $kategori->save();

        return redirect()->route("kategori")->with('success', 'Kategori telah diupdate');
    }

    public function destroy(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $kategori->delete();

        return redirect()->route("kategori")->with('success', 'Kategori telah dihapus');
    }
}
