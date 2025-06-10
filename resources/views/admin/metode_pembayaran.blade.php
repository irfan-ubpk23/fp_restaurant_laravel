@extends('layouts.admin')

@section('css')
@parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@stop

@section('content')
    @component("components.CRUDModal")
        @slot("input_fields")
        <label for="nama_metode">Nama Metode</label>    
        <input type="text" class="form-control" id="nama_metode" name="nama_metode" placeholder="Nama Metode Pembayaran" required>
        @endslot
    @endcomponent

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Metode Pembayaran</h1>
        <button type="button" id="add-btn" class="btn btn-primary">
            <i class="fa-solid fa-plus fa-sm text-white-50"></i> Tambah Baru
        </button>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Metode Pembayaran Table</h6>
                </div>
                <div class="card-body" >
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Metode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($metode_pembayarans)
                            @foreach ($metode_pembayarans as $metode_pembayaran)
                                <tr>
                                    <td>{{ $metode_pembayaran->id }}</td>
                                    <td>{{ $metode_pembayaran->nama_metode }}</td>
                                    <td>
                                        <button type="button" id="delete-btn" data-id="{{ $metode_pembayaran->id }}" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" id="edit-btn" data-id="{{ $metode_pembayaran->id }}" data-datas="{{ $metode_pembayaran }}" class="btn btn-secondary btn-circle">
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

        var crud_target_url = "/metode_pembayaran/";
    </script>
    <script src="{{ asset('js/CRUDModal.js') }}"></script>
@stop
