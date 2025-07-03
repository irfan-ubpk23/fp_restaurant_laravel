<?php

namespace App\Http\Controllers;

use \Datetime;
use PDF;

use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\OrderDetail;
use App\Models\Reservasi;

use App\Services\TransaksiService;
use App\Services\OrderService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(){
        if (Auth::check()){
            return redirect("dashboard");
        }else{
            return redirect("login");
        }
    }

    public function dashboard(OrderService $order_service){
        $role = Auth::user()->role;
        if ($role === "admin"){
            $orders_count = Transaksi::where('status_pembayaran', 'selesai')->count();
            $total_all_transaksis = Transaksi::where('status_pembayaran', 'selesai')->sum('total_harga');
            $total_monthly_transaksis = Transaksi::where('status_pembayaran', 'selesai')->whereMonth('created_at', ">=", date('m'))->sum("total_harga");
            $total_annually_transaksis = Transaksi::where('status_pembayaran', 'selesai')->whereYear('created_at', ">=", date('Y'))->sum("total_harga");

            return view("admin.index", [
                "orders_count" => $orders_count,
                "total_all_transaksis" => $total_all_transaksis,
                "total_monthly_transaksis" => $total_monthly_transaksis,
                "total_annually_transaksis" => $total_annually_transaksis
            ]);
        }else if($role === "dapur"){
            return view("dapur.index", ["orders"=>$order_service->today()]);
        }else{
            return back();
        }
    }

    public function admin_laporan(Request $request, TransaksiService $transaksi_service){
        $dari_date = $this->get_date($request->dari);
        $sampai_date = $this->get_date($request->sampai);

        $transaksi_query = Transaksi::where('status_pembayaran', '=', 'selesai')->whereDate('created_at', '>=', implode('-', $dari_date))->whereDate('created_at', '<=', implode('-', $sampai_date));
        $transaksis = $transaksi_query->get();
        $pendapatan_transaksis = [];
        
        $all_menus = [];
        $nama_menus = [];
        $jumlah_menus = [];

        $all_kategoris = [];
        $nama_kategoris =[];
        $jumlah_kategoris = [];
        $total_pendapatan_kategoris = [];

        foreach($transaksis as $transaksi){
            foreach($transaksi->order->details as $detail){
                $menu = $detail->menu;
                if (! array_key_exists($menu->nama_menu, $nama_menus)){
                    array_push($nama_menus, $menu->nama_menu);
                    array_push($all_menus, $menu);
                    $jumlah_menus[$menu->id] = $detail->jumlah;
    
                    if (array_key_exists($menu->kategori->id, $jumlah_kategoris) == false){
                        array_push($all_kategoris, $menu->kategori);
                        array_push($nama_kategoris, $menu->kategori->nama_kategori);
                        $jumlah_kategoris[$menu->kategori->id] = 0;
                        $total_pendapatan_kategoris[$menu->kategori->id] = 0;
                    }
                }
                else{
                    $jumlah_menus[$menu->id] += $detail->jumlah;
                }
                $jumlah_kategoris[$menu->kategori->id] += $jumlah_menus[$menu->id];
                $total_pendapatan_kategoris[$menu->kategori->id] += $jumlah_menus[$menu->id] * $menu->harga_menu;
            }
        }

        // if ($dari_date[0] == $sampai_date[0]){
        //     for ($month_i=(int)$dari_date[1];$month_i<=(int)$sampai_date[1];$month_i++){
        //         $month_name = DateTime::createFromFormat('!m', $month_i + 1)->format('F');
        //         $pendapatan_transaksis[$month_name] = Transaksi::where('status_pembayaran', '=', 'selesai')->whereMonth('created_at', '=', (string)($month_i + 1))->sum("total_harga");
        //     }
        // }
        // else{
        //     for ($year_i=(int)$dari_date[1];$year_i<=(int)$sampai_date[1];$year_i++){
        //         $pendapatan_transaksis[$year_i] = Transaksi::where('status_pembayaran', '=', 'selesai')->whereYear('created_at', '=', (string)($year_i))->sum("total_harga");
        //     }
        // }

        $pdf = PDF::loadView('admin.laporan', [
            'dari_date' => implode('-', $dari_date),
            'sampai_date' => implode('-', $sampai_date),
            'transaksis'=>$transaksis,
            'menus' => $all_menus,
            'kategoris' => $all_kategoris,
            'jumlah_menus' => $jumlah_menus,
            'jumlah_kategoris' => $jumlah_kategoris,
            'total_pendapatan_kategoris' => $total_pendapatan_kategoris,

            // 'menu_chart' => urlencode($this->get_pie_option($nama_menus, array_values($jumlah_menus))),
            // 'kategori_chart' => urlencode($this->get_pie_option($nama_kategoris, array_values($jumlah_kategoris))),
            // 'transaksi_chart' => urlencode($this->get_area_option(array_keys($pendapatan_transaksis), array_values($pendapatan_transaksis)))
        ]);
        return $pdf->stream('Laporan Restaurant Laravel dari ' . implode('-', $dari_date) . ' sampai ' . implode('-', $sampai_date) . '.pdf');
    }

    public function get_pie_option($labels, $datas){
        $labels = implode("','", $labels);
        $datas = implode("','", $datas);
        return
        "{
            type: 'doughnut',
            data: {
                labels: ['$labels'],
                datasets: [{
                    data: ['$datas'],
                }],
            }
        }";
    }
    
    public function get_area_option($labels, $datas){
        $labels = implode("','", $labels);
        $datas = implode("','", $datas);
        return
        "{
            type: 'line',
            data: {
                labels: ['$labels'],
                datasets: [{
                    label: 'Earnings',
                    data: ['$datas'],
                }],
            }
        }";
    }

    public function get_date($from_date_string){
        return explode('-', substr($from_date_string, 0, 10));
    }
}
