@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Menu Table</h6>
                </div>
                <div class="card-body">
                    <x-datatable>
                        <x-slot:head>
                            <tr>
                                <th>Nomor Antrian</th>
                                <th>Menu</th>
                                <th>Status Order</th>
                                <th>Keterangan</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->nomor_antrian }}</td>
                                    <td>
                                        <button type="button" id="show-menu-btn" data-datas="{{ $order->toJson() }}" class="btn btn-primary btn-circle">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        {{ $order->status_order }}
                                        <button type="button" id="edit-status-btn" data-datas="{{ $order->toJson() }}" class="btn btn-secondary btn-circle">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                    <td>{{ $order->keterangan }}</td>
                                </tr>
                            @endforeach
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@endsection