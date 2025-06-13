@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pembayaran Table</h6>
                </div>
                <div class="card-body" >
                    <x-datatable datatable-id="datatable">
                        <x-slot:head>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Metode Pembayaran</th>
                                <th>Total Harga</th>
                                <th>Kode Transaksi</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($pembayarans as $pembayaran)
                                <tr>
                                    <td>{{ $pembayaran->id }}</td>
                                    <td>{{ $pembayaran->order_id }}</td>
                                    <td>{{ $pembayaran->metode_pembayaran->nama_metode }}</td>
                                    <td>{{ $pembayaran->total_harga }}</td>
                                    <td>{{ $pembayaran->kode_transaksi }}</td>
                                    <td>{{ $pembayaran->status_pembayaran }}</td>
                                    <td>{{ $pembayaran->bukti_pembayaran }}</td>
                                </tr>
                            @endforeach
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@stop