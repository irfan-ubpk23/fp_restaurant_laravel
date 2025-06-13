@extends('layouts.admin')

@section('content')
    <x-crud-modal target-url="/order/">
        <x-slot:fields>
            <label id="user_id" class="field"></label>
            <label id="nomor_antrian" class="field"></label>
            <label id="status_order" class="field" data-field-type='select' data-field-select-list='proses sudah'></label>
            <label id="keterangan" class="field"></label>

            <label for="" class="col mt-4">Details</label>
            <br>
            <div class="col-12 field" id="details">
                <div class="row row-cols-2 border mx-2" id="detail">
                    <label for="menu_id">Menu Id</label>
                    <label class="menu_id"></label>
            
                    <label for="jumlah">Jumlah</label>
                    <label class="jumlah"></label>
                </div>
            </div>
        </x-slot:fields>
    </x-crud-modal>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Order Table</h6>
                </div>
                <div class="card-body" >
                    <x-datatable datatable-id="datatable">
                        <x-slot:head>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Nomor Antrian</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->nomor_antrian }}</td>
                                    <td>{{ $order->status_order }}</td>
                                    <td>{{ $order->keterangan }}</td>
                                    <td>
                                        <button type="button" id="show-btn" data-datas="{{ $order->toJson() }}" class="btn btn-primary btn-circle">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@stop
