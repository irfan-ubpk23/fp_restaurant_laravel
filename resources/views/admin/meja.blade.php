@extends('layouts.admin')

@section('content')
    <x-crud-modal target-url="/meja/">
        <x-slot:fields>
            <input type="text" name="nama_meja" id="nama_meja" placeholder="Nama Meja" class="form-control">
            <input type="number" name="batas_orang" id="batas_orang" placeholder="Batas Orang" class="form-control">
        </x-slot:fields>
    </x-crud-modal>

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
                    <x-datatable datatable-id="datatable">
                        <x-slot:head>
                            <tr>
                                <th>Id</th>
                                <th>Nama Meja</th>
                                <th>Batas Orang</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($mejas as $meja)
                                <tr>
                                    <td>{{ $meja->id }}</td>
                                    <td>{{ $meja->nama_meja }}</td>
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
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@stop