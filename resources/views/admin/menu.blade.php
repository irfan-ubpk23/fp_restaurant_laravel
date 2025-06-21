@extends('layouts.admin')

@section('content')
    <x-crud-modal target-url="/menu/">
        <x-slot:fields>
            <select name="id_kategori" id="id_kategori" placeholder="Kategori" class="form-select">
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>

            <input type="text" name="nama_menu" id="nama_menu" placeholder="Nama Menu" class="form-control">
            <input type="number" name="harga_menu" id="harga_menu" placeholder="Harga Menu" class="form-control">
            <input type="file" name="gambar_menu" id="gambar_menu" placeholder="Gambar Menu" class="form-control">

            <select name="status_menu" id="status_menu" placeholder="Status Menu" class="form-select">
                <option value="ada">Ada</option>
                <option value="habis">Habis</option>
            </select>

            <input type="number" name="waktu_saji" id="waktu_saji" placeholder="Waktu Saji" class="form-control">
        </x-slot:fields>
    </x-crud-modal>

    <x-modal modalId="imgModal" title="Gambar Menu">
        <x-slot:body>
            <img src="" alt="" id="imgModalImg" class="img-fluid">
        </x-slot:body>
        <x-slot:footer>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </x-slot:footer>
    </x-modal>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menu</h1>
        <button type="button" id="add-btn" class="btn btn-primary">
            <i class="fa-solid fa-plus fa-sm text-white-50"></i> Tambah Baru
        </button>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
            </div>
            <div class="card-body" id="datatable-filter-row">
                
            </div>
        </div>
    </div>
    <div class="row">
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
                            <th>Gambar Menu</th>
                            <th>Harga Menu</th>
                            <th>Status Menu</th>
                            <th>Waktu Saji</th>
                            <th>Aksi</th>
                            <th>Created At</th>
                        </tr>
                    </x-slot:head>
                    <x-slot:body>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->kategori->nama_kategori }}</td>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>
                                    <button type="button" id="show-img-btn" class="btn btn-circle btn-primary" data-img-url="{{ asset($menu->gambar_menu) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                                <td>{{ $menu->harga_menu }}</td>
                                <td>{{ $menu->status_menu }}</td>
                                <td>{{ $menu->waktu_saji }}</td>
                                <td>
                                    <button type="button" id="delete-btn" data-id="{{ $menu->id }}" class="btn btn-danger btn-circle">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <button type="button" id="edit-btn" data-id="{{ $menu->id }}" data-datas="{{ $menu->toJson() }}" class="btn btn-secondary btn-circle">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                                <td>{{ $menu->created_at }} </td>
                            </tr>
                        @endforeach
                    </x-slot:body>
                </x-datatable>
            </div>
        </div>
    </div>
@stop

@push("js")
<script>
    let imgModal = new bootstrap.Modal("#imgModal");

    document.querySelectorAll("#show-img-btn").forEach((e)=>{
        e.addEventListener("click", ()=>show_img_modal(e));
    })

    function show_img_modal(button){
        imgModal.show();
        let imgModalImg = document.getElementById("imgModalImg");

        imgModalImg.setAttribute("src", button.getAttribute("data-img-url"));
    }
</script>
@endpush