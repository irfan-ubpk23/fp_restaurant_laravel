<?php

namespace App\Http\Controllers;

use App\Services\KategoriService;
use App\Services\MenuService;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(MenuService $menu_service, KategoriService $kategori_service)
    {
        return view("admin.menu", [
            "menus" => $menu_service->all(),
            "kategoris" => $kategori_service->all()
        ]);
    }

    public function store(Request $request, MenuService $menu_service)
    {
        try{
            $menu_service->store(
                $request->id_kategori,
                $request->nama_menu,
                $request->harga_menu,
                $request->status_menu,
                $request->waktu_saji
            );

            return redirect()->route("menu")->with('message', 'Menu telah dibuat');
        } catch (\Exception $e){
            return redirect()->route("menu")->with("message", $e->getMessage());
        }
    }

    public function update(Request $request, MenuService $menu_service)
    {
        try{
            $menu_service->update(
                $request->id,
                $request->id_kategori,
                $request->nama_menu,
                $request->harga_menu,
                $request->status_menu,
                $request->waktu_saji
            );

            return redirect()->route("menu")->with('message', 'Menu telah diupdate');
        } catch (\Exception $e){
            return redirect()->route("menu")->with("message", $e->getMessage());
        }
    }

    public function destroy(Request $request, MenuService $menu_service)
    {
        try{
            $menu_service->destroy($request->id);

            return redirect()->route("menu")->with('message', 'Menu telah dihapus');
        } catch (\Exception $e){
            return redirect()->route("menu")->with("message", $e->getMessage());
        }
    }

}
