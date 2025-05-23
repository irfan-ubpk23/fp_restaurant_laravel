<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class KategoriController extends BaseController
{
    public function index(): JsonResponse
    {
        $kategoris = Kategori::all();

        return $this->sendResponse(KategoriResource::collection($kategoris));
    }

    public function store(Request $request) : JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_kategori' => 'required'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $kategori = Kategori::create($input);

        return $this->sendResponse(new KategoriResource($kategori));
    }

    public function show($id): JsonResponse
    {
        $kategori = Kategori::find($id);

        if (is_null($kategori)){
            return $this->sendError('Kategori not Found.');
        }

        return $this->sendResponse(new KategoriResource($kategori));
    }

    public function update(Request $request, Kategori $kategori): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_kategori' => 'required'
        ]);

        if ($validator->fails()){
            $this->sendError('Kategori not found.');
        }

        $kategori->nama_kategori = $input['nama_kategori'];
        $kategori->save();

        return $this->sendResponse(new KategoriResource($kategori));
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return $this->sendResponse([]);
    }
}
