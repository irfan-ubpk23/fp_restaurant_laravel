@extends('layouts.admin')

@push('css')
<style>
    .center-text-force{
        text-align:center !important;
        vertical-align: middle !important;
    }
    .my-child-0 *{
        margin: 0px 0px 0px 0px;
    }
</style>
@endpush

@section('content')
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
                    <x-datatable datatable-id="datatable" init-on-ready='false'>
                        <x-slot:head>
                            <tr>
                                <th>Nomor Antrian</th>
                                <th>Menu</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="center-text-force">
                                        <p>{{ $order->nomor_antrian }}</p>
                                    </td>
                                    <td>
                                        @if ($order->details)
                                        @foreach($order->details as $detail)
                                        <div class="row row-cols-2 my-child-0">
                                            <p>{{ $detail->menu->nama_menu }}</p>
                                            <p>x{{ $detail->jumlah }}</p>
                                        </div>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $order->keterangan }}</td>
                                    <td>
                                        @if ($order->status_order === "proses")
                                            <button id="ask-update-status-btn" data-id="{{ $order->id }}" class="btn btn-primary">Sudah dibuat</button>
                                        @endif
                                    </td>
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
        const datatable = new DataTable("#datatable", {
            order : [[0, 'desc']],
            scrollX : true,
            stateSave: true
        })
        const statusModal = new bootstrap.Modal("#statusModal");
        let current_status_button;

        document.getElementById("save-status-btn").addEventListener("click", save_status);

        document.querySelectorAll("#ask-update-status-btn").forEach((e)=>{
            e.addEventListener("click", ()=>show_status(e));
        })
        
        function show_status(button){
            statusModal.show();
            current_status_button = button;
        }

        function save_status(){            
            fetch("/api/orders/" + current_status_button.getAttribute("data-id"), {
                headers: {
                    "Content-type" : "application/json",
                    "Accept" : "application/json, text-plain, */*",
                    "X-CSRF-Token" : "{{ csrf_token() }}",
                },
                method: "put",
                credentials:"same-origin",
                body: JSON.stringify({status_order : "sudah dibuat"})
            })
            .then((response)=>{
                return response.json().then((data) => {
                    // location.reload()
                    show_message(data["message"]);
                    // document.querySelector("#messageModal .btn-close").bind(document);
                    document.querySelector("#messageModal .btn-close").addEventListener('click', ()=>{
                        location.reload();
                    });
                })
            })
            
            statusModal.hide();
        }

        setInterval(() => {
            if (! document.querySelector("body").classList.contains('modal-open')){
                location.reload();
            }
        }, 5000);
    });
</script>
@endpush