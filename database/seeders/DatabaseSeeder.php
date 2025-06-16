<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('123'),
        //     'no_hp' => '123125'
        // ]);

        DB::table('users')->insert([
            'username' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'no_hp' => '123125',
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'username' => 'dapur',
            'email' => 'dapur@gmail.com',
            'password' => bcrypt('123'),
            'no_hp' => '123125',
            'role' => 'dapur'
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => 'makanan'
        ]);

        DB::table('menu')->insert([
            "id_kategori" => "1",
            "nama_menu" => "mie ayam",
            "gambar_menu" => "images/cocaine.jpeg",
            "harga_menu" => "15000",
            "status_menu" => "ada",
            "waktu_saji" => "5"
        ]);

        DB::table('meja')->insert([
            "nama_meja" => "1",
            'batas_orang' => '2'
        ]);

        DB::table('metode_pembayaran')->insert([
            'nama_metode' => 'qris'
        ]);

        DB::table('reservasi')->insert([
            'user_id' => '1',
            'meja_id' => '1',
            'tanggal_dan_jam' => '2025-06-1 15:00:00',
            'status_reservasi' => 'menunggu',
        ]);

        DB::table('order')->insert([
            "user_id" => '1',
            'nomor_antrian' => '1',
            'status_order' => 'proses',
            'keterangan' => 'asd'
        ]);

        DB::table('order_detail')->insert([
            "order_id" => '1',
            'menu_id' => '1',
            'jumlah' => '2'
        ]);

        DB::table('order_detail')->insert([
            "order_id" => '1',
            'menu_id' => '1',
            'jumlah' => '5'
        ]);

        DB::table('pembayaran')->insert([
            'order_id' => '1',
            'metode_pembayaran_id' => '1',
            'total_harga' => '2000',
            'kode_transaksi' => '12516',
            'status_pembayaran' => 'belum',
            'bukti_pembayaran' => 'asdasd'
        ]);
    }
}
