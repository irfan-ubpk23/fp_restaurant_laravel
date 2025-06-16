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
    <x-modal modalId="menuModal" title="Menu Data">
        <x-slot:body>
            <div id="menuField" class="container">
            </div>
        </x-slot:body>
    </x-modal>

    <x-modal modalId="statusModal" title="Edit Status">
        <x-slot:body>
            Apakah anda yakin?
        </x-slot:body>
        <x-slot:footer>
            <button type="button" class="btn btn-secondary" id="cancel-status-btn" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" id="save-status-btn">Save</button>
        </x-slot:footer>
    </x-modal>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Order Table</h6>
                </div>
                <div class="card-body">
                    <x-datatable>
                        <x-slot:head>
                            <tr>
                                <th>Nomor Antrian</th>
                                <th>Menu</th>
                                <th>Status Order</th>
                                <th>Keterangan</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->nomor_antrian }}</td>
                                    <td>
                                        <button type="button" id="show-menu-btn" data-datas="{{ $order->toJson() }}" class="btn btn-primary btn-circle">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <select name="" id="status-select" value="{{ $order->status_order }}" data-id="{{ $order->id }}" class="form-select">
                                            <option value="proses">Proses</option>
                                            <option value="sudah">Sudah</option>
                                        </select>
                                    </td>
                                    <td>{{ $order->keterangan }}</td>
                                </tr>
                            @endforeach
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("js")
<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        const menuModal = new bootstrap.Modal("#menuModal");
        const menuRow = document.getElementById("menuRow");
        const menuField = document.getElementById("menuField");
        const statusModal = new bootstrap.Modal("#statusModal");
        let current_status_button;

        document.getElementById("save-status-btn").addEventListener("click", save_status);
        document.getElementById("statusModal").addEventListener("hidden.bs.modal", cancel_status);

        document.querySelectorAll("#show-menu-btn").forEach((e) => {
            e.addEventListener("click", ()=>show_menu(e));
        });

        document.querySelectorAll("#status-select").forEach((e)=>{
            e.addEventListener("change", ()=>show_status(e));
        })
        
        function show_menu(button){
            menuField.innerHTML = "";
            menuModal.show();
            
            const fragment = document.createDocumentFragment();
            const row_datas = JSON.parse(button.getAttribute("data-datas"))["details"];

            for (let index = 0; index < row_datas.length; index++) {
                const row_data = row_datas[index];

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
                            case "jumlah":
                                child.innerText = ":" + row_data["jumlah"];
                                break;
                            default:
                                break;
                        }
                        child.id += index;
                    }
                });
                
                fragment.appendChild(row);
            };
            menuField.appendChild(fragment);
        }

        function show_status(button){
            statusModal.show();
            current_status_button = button;
        }

        function save_status(){            
            fetch("/api/order/" + current_status_button.getAttribute("data-id"), {
                headers: {
                    "Content-type" : "application/json",
                    "Accept" : "application/json, text-plain, */*",
                    "X-CSRF-Token" : "{{ csrf_token() }}",
                },
                method: "post",
                credentials:"same-origin",
                body: JSON.stringify({status_order : current_status_button.value})
            })
            .then((response)=>{
                
                return response.json().then((data) => {
                    show_message(data["message"]);
                })
            })
            
            statusModal.hide();
            cancel_status();
        }

        function cancel_status(){
            current_status_button.value = current_status_button.value === "proses" ? "sudah" : "proses";
        }
    });
</script>
@endpush