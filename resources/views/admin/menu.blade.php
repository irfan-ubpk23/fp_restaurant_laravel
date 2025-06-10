@extends('layouts.admin')

@section('css')
@parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@stop

@section('content')
    @component("components.CRUDModal")
        @slot("input_fields")
            <label for="id_kategori">Kategori</label>
            <select class="form-select" id="id_kategori" name="id_kategori" placeholder="Kategori" required>
                @if($kategoris)
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
                @endif
            </select>

            <label for="nama_menu">Nama Menu</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Nama Menu" required>

            <label for="harga_menu">Harga Menu</label>
            <input type="number" class="form-control" id="harga_menu" name="harga_menu" placeholder="Harga Menu" required>
    
            <label for="status_menu">Status Menu</label>
            <select class="form-select" id="status_menu" name="status_menu" placeholder="Status Menu" required>
                <option value="ada">Ada</option>
                <option value="habis">Habis</option>
            </select>

            <label for="waktu_saji">Waktu Saji</label>
            <input type="number" class="form-control" id="waktu_saji" name="waktu_saji" placeholder="Waktu Saji" required>
            
        @endslot
    @endcomponent

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menu</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Menu Table</h6>
                </div>
                <div class="card-body" >
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Kategori</th>
                                <th>Nama Menu</th>
                                <th>Harga Menu</th>
                                <th>Status Menu</th>
                                <th>Waktu Saji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($menus)
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->kategori->nama_kategori }}</td>
                                    <td>{{ $menu->nama_menu }}</td>
                                    <td>{{ $menu->harga_menu }}</td>
                                    <td>{{ $menu->status_menu }}</td>
                                    <td>{{ $menu->waktu_saji }}</td>
                                    <td>
                                        <button type="button" id="delete-btn" data-id="{{ $menu->id }}" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" id="edit-btn" data-id="{{ $menu->id }}" data-datas="{{ $menu }}" class="btn btn-secondary btn-circle">
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

        var crud_target_url = "/menu/";
    </script>
    <script src="{{ asset('js/CRUDModal.js') }}"></script>
@stop
