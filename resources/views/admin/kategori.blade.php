@extends('layouts.admin')

@section('css')
@parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@stop

@section('content')
    @component("components.CRUDModal")
        @slot("fields")
        <!-- <label for="nama_kategori">Nama Kategori</label>     -->
        <label id="nama_kategori" class="field"></label>
        <!-- <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori" required> -->
        @endslot
    @endcomponent

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Kategori Table</h6>
                </div>
                <div class="card-body" >
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($kategoris)
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td>{{ $kategori->id }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <button type="button" id="delete-btn" data-id="{{ $kategori->id }}" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" id="edit-btn" data-id="{{ $kategori->id }}" data-datas="{{ $kategori }}" class="btn btn-secondary btn-circle">
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

        var crud_target_url = "/kategori/";
    </script>
    <script src="{{ asset('js/CRUDModal.js') }}"></script>
@stop
