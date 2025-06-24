@extends('layouts.admin')

@section('content')
    <div class="row row-cols-2 border" id="menuRow" style="display:none">
        <img data-field-src="{{ asset("") }}" alt="" id="gambar_menu" class="col-4 field">

        <div class="col-8 row row-cols-2 my-auto">
            <label for="nama_menu" class="col field">Menu</label>
            <p id="nama_menu" class="col field"></p>
    
            <label for="jumlah" class="col field">Jumlah</label>
            <p id="jumlah" class="col field"></p>
        </div>
    </div>
    <x-modal modalId="orderModal" title="Order Data">
        <x-slot:body>
            <div class="container">
                <div class="row row-cols-2" id="orderField">
                    <label for="user">User</label>
                    <p id="user" class="order-field"></p>
                    
                    <label for="nomor_antrian">Nomor Antrian</label>
                    <p id="nomor_antrian" class="order-field"></p>
                    
                    <label for="status_order">Status Order</label>
                    <p id="status_order" class="order-field"></p>
                    
                    <label for="jenis_order">Jenis Order</label>
                    <p id="jenis_order" class="order-field"></p>

                    <label for="keterangan">Keterangan</label>
                    <p id="keterangan" class="order-field"></p>

                    <p class="mt-3">Item: </p>
                    <div class="col-12" id="menuField"></div>
                </div>
            </div>
        </x-slot:body>
    </x-modal>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Table</h6>
            </div>
            <div class="card-body" >
                <x-datatable datatable-id="datatable">
                    <x-slot:head>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Order</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Kode Transaksi</th>
                            <th>Status Pembayaran</th>
                            <th>Created At</th>
                        </tr>
                    </x-slot:head>
                    <x-slot:body>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->id }}</td>
                                <td>{{ $transaksi->user->username }} </td>
                                <td>
                                    <button class="btn btn-circle btn-primary" id="show-order-btn" data-datas="{{ $transaksi->toJson() }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                                <td>{{ $transaksi->metode_pembayaran }}</td>
                                <td>{{ $transaksi->total_harga }}</td>
                                <td>{{ $transaksi->kode_transaksi }}</td>
                                <td>{{ $transaksi->status_pembayaran }}</td>
                                <td>{{ $transaksi->created_at }} </td>
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
    document.addEventListener("DOMContentLoaded", ()=>{
        const orderModal = new bootstrap.Modal("#orderModal");
        const menuRow = document.getElementById("menuRow");
        const menuField = document.getElementById("menuField");

        document.querySelectorAll("#show-order-btn").forEach((e) => {
            e.addEventListener("click", ()=>show_order(e));
        });
        
        function show_order(button){
            orderModal.show();
            const order_data = JSON.parse(button.getAttribute("data-datas"))["order"];
            
            document.querySelectorAll("#orderField .order-field").forEach((e)=>{
                if (e.id == "user"){
                    e.innerText = ":" + order_data["user"]["username"] + "(" + order_data["user"]["role"] + ")";
                }else{
                    e.innerText = ":" + order_data[e.id];
                }
            })

            menuField.innerHTML = "";
            const detail_fragment = document.createDocumentFragment();
            for (let index = 0; index < order_data['details'].length; index++) {
                const row_data = order_data['details'][index];

                const row = menuRow.cloneNode(true);
                row.style.cssText="";
                
                row.querySelectorAll(".field").forEach((child) => {
                    if (child.tagName == "LABEL"){
                        child.htmlFor += index;
                    }else{
                        switch (child.id) {
                            case "gambar_menu":
                                child.src = child.getAttribute("data-field-src") + row_data["menu"]["gambar_menu"];
                                break;
                            case "nama_menu":
                                child.innerText = ":" + row_data["menu"]["nama_menu"];
                                break;
                            default:
                                child.innerText = ":" + row_data[child.id];
                                break;
                        }
                        child.id += index;
                    }
                });
                
                detail_fragment.appendChild(row);
            };
            menuField.appendChild(detail_fragment);
        }
    });
</script>
@endpush