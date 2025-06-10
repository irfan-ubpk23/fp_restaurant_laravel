@extends('layouts.admin')

@section('css')
@parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@stop

@section('content')
    @component("components.CRUDModal")
        @slot("fields")
        <label id="batas_orang" class="field" data-field-type="number"></label>
        @endslot
    @endcomponent

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Meja</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Meja Table</h6>
                </div>
                <div class="card-body" >
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Batas Orang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($mejas)
                            @foreach ($mejas as $meja)
                                <tr>
                                    <td>{{ $meja->id }}</td>
                                    <td>{{ $meja->batas_orang }}</td>
                                    <td>
                                        <button type="button" id="delete-btn" data-id="{{ $meja->id }}" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" id="edit-btn" data-id="{{ $meja->id }}" data-datas="{{ $meja }}" class="btn btn-secondary btn-circle">
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

        var crud_target_url = "/meja/";
    </script>
    <script src="{{ asset('js/CRUDModal.js') }}"></script>
@stop
