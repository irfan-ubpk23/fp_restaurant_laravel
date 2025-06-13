@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reservasi</h1>
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
                    <x-datatable datatable-id="datatable">
                        <x-slot:head>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Meja</th>
                                <th>Tanggal dan Jam</th>
                                <th>Status Reservasi</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($reservasis as $reservasi)
                                <tr>
                                    <td>{{ $reservasi->id }}</td>
                                    <td>{{ $reservasi->user->username }}</td>
                                    <td>{{ $reservasi->meja_id }}</td>
                                    <td>{{ $reservasi->tanggal_dan_jam }}</td>
                                    <td>{{ $reservasi->status_reservasi }}</td>
                                </tr>
                            @endforeach
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@stop