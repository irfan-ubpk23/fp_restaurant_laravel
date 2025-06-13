@extends('layouts.admin')

@section('content')
    <x-crud-modal target-url="/menu/">
        <x-slot:fields>
            <label id="id_kategori" class="field" data-field-type="select" 
                data-field-select-list="@foreach($kategoris as $kategori){{$kategori->id}}:{{$kategori->nama_kategori}} @endforeach"
            ></label>
            
            <label id="nama_menu" class="field"></label>
            <label id="harga_menu" class="field" data-field-type="number"></label>
            <label id="status_menu" class="field" data-field-type="select"
                data-field-select-list="ada:Ada habis:Habis"
            ></label>
            <label id="waktu_saji" class="field" data-field-type="number"></label>
        </x-slot:fields>
    </x-crud-modal>

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
                    <x-datatable datatable-id="datatable">
                        <x-slot:head>
                            <tr>
                                <th>Id</th>
                                <th>Kategori</th>
                                <th>Nama Menu</th>
                                <th>Harga Menu</th>
                                <th>Status Menu</th>
                                <th>Waktu Saji</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
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
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@stop
