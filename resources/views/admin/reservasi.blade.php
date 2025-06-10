@extends('layouts.admin')

@section('css')
@parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@stop

@section('content')
    {{-- @component("components.CRUDModal")
    @slot("input_fields")
    @endslot
    @endcomponent --}}

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reservasi</h1>
        {{-- <button type="button" id="add-btn" class="btn btn-primary">
            <i class="fa-solid fa-plus fa-sm text-white-50"></i> Tambah Baru
        </button> --}}
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Reservasi Table</h6>
                </div>
                <div class="card-body" >
                    <table id="datatable" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Meja</th>
                                <th>Tanggal dan Jam</th>
                                <th>Status Reservasi</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reservasis)
                            @foreach ($reservasis as $reservasi)
                                <tr>
                                    <td>{{ $reservasi->id }}</td>
                                    <td>{{ $reservasi->user->username }}</td>
                                    <td>{{ $reservasi->meja_id }}</td>
                                    <td>{{ $reservasi->tanggal_dan_jam }}</td>
                                    <td>{{ $reservasi->status_reservasi }}</td>
                                    {{-- <td>
                                        <button type="button" id="delete-btn" data-id="{{ $reservasi->id }}" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" id="edit-btn" data-id="{{ $reservasi->id }}" data-datas="{{ $reservasi }}" class="btn btn-secondary btn-circle">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td> --}}
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

        var crud_target_url = "/reservasi/";
    </script>
    {{-- <script src="{{ asset('js/CRUDModal.js') }}"></script> --}}
@stop
