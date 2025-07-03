<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ asset('css/bootstrap.min.css') }}">
    <style>
         .mt-2{
            margin-top: 20px;
         }
         .mb-5{
            margin-bottom: :20px;
         }
         .text-center{
            text-align: center;
         }
    </style>
</head>
<body>
    <div class="mt-2 mb-5 text-center">
        <h2>Laporan Restaurant</h2>
        <h4>dari tanggal {{$dari_date}} sampai {{$sampai_date}}</h4>
    </div>
    <div class="mx-4">
        <h4 class="bold">Transaksi Tabel</h4>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Dipesan Oleh</th>
                    <th>Menu</th>
                    <th>Jenis Order</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_harga = 0; ?>
                @foreach ($transaksis as $transaksi)
                    <?php $total_harga += $transaksi->total_harga ?>
                    <tr>
                        <td class="table-dark">{{ $transaksi->id }}</td>
                        <td>{{$transaksi->kode_transaksi}}</td>
                        <td>{{ $transaksi->created_at }}</td>
                        <td>{{ $transaksi->user->username }} ( {{ $transaksi->user->role }} ) </td>
                        <td>
                            @foreach ($transaksi->order->details as $detail)
                                @if (count($transaksi->order->details) > 1)
                                    , 
                                @endif
                                {{ $detail->menu->nama_menu }}
                                ( x{{ $detail->jumlah }} )
                            @endforeach
                        </td>
                        <td>{{ $transaksi->order->jenis_order }}</td>
                        <td>{{ $transaksi->metode_pembayaran }}</td>
                        <td>Rp.{{ number_format($transaksi->total_harga) }}</td>
                    </tr>
                @endforeach
                @if (count($transaksis) > 0)
                    <tr class="table-dark fw-bold">
                        <td class="text-center" colspan='7'>Total Harga</td>
                        <td>Rp.{{ number_format($total_harga) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        
        <h4 class="bold mt-5">Popularitas Menu</h4>
        <table class="table table-striped table-bordered border-dark">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Jumlah dibeli</th>
                    <th>Total pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td class="table-dark">{{ $menu->id }}</td>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>Rp.{{ number_format($menu->harga_menu) }}</td>
                        <td>
                            {{ $jumlah_menus[$menu->id] }}
                        </td>
                        <td>Rp.{{ number_format($jumlah_menus[$menu->id] * $menu->harga_menu) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="bold mt-5">Popularitas Kategori</h4>
        <table class="table table-striped table-bordered border-dark">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah dibeli</th>
                    <th>Total pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $kategori)
                    <tr>
                        <td class="table-dark">{{ $kategori->id }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>
                            {{ $jumlah_kategoris[$kategori->id] }}
                        </td>
                        <td>Rp.{{ number_format($total_pendapatan_kategoris[$kategori->id]) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
