@extends('layouts.admin')

@section('css')
@parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@stop

@section('content')
    @component("components.CRUDModal")
        @slot("fields")
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
        @endslot
        @slot("input_fields")
    @endcomponent

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order</h1>
        <!-- <button type="button" id="add-btn" class="btn btn-primary">
            <i class="fa-solid fa-plus fa-sm text-white-50"></i> Tambah Baru
        </button> -->
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
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Nomor Antrian</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->nomor_antrian }}</td>
                                    <td>{{ $order->status_order }}</td>
                                    <td>{{ $order->keterangan }}</td>
                                    <td>
                                        <!-- <button type="button" id="delete-btn" data-id="{{ $order->id }}" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" id="edit-btn" data-id="{{ $order->id }}" data-datas="{{ $order->toJson() }}" class="btn btn-secondary btn-circle">
                                            <i class="fa-solid fa-pen"></i>
                                        </button> -->

                                        <button type="button" id="show-btn" data-datas="{{ $order->toJson() }}" class="btn btn-primary btn-circle">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        $(document).ready( function() {
            $('#datatable').DataTable();
        });

        var crud_target_url = "/order/";
    </script>
    <script src="{{ asset('js/CRUDModal.js') }}"></script>
@stop
