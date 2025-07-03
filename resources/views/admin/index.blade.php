@extends('layouts.admin')

@section('content')
    <x-modal modalId="printLaporanModal" title="Print Laporan">
        @csrf
        <x-slot:body>
            <form action="/laporan" method="GET" id="print-laporan-form">
                <div class="row row-cols-2">
                    <label for="dari">Dari: </label>
                    <input class="form-control" required type="date" name="dari" id="dari">
    
                    <label for="sampai">Sampai: </label>
                    <input class="form-control" required type="date" name="sampai" id="sampai">
                </div>
            </form>
            </x-slot:body>
            <x-slot:footer>
                <button type="submit" id="print-laporan-btn" class="btn btn-primary">Print</button>
            </x-slot:footer>
    </x-modal>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <button id="show-print-modal-btn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Print Laporan
        </button>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Transaksi (Bulanan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{ number_format($total_monthly_transaksis) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Transaksi (Tahunan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{ number_format($total_annually_transaksis) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{ number_format($total_all_transaksis) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Order</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Item Terlaris</h6>
                    <div>
                        <select id="item-terlaris-select" class="form-select">
                            <option value="bulan">Bulan</option>
                            <option value="tahun">Tahun</option>
                        </select>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <x-item-terlaris-pie divId="terlarisPie"></x-item-terlaris-pie>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Overview</h6>
                    <div>
                        <select id="transaksi-overview-select" class="form-select">
                            <option value="bulan">Bulan</option>
                            <option value="tahun">Tahun</option>
                        </select>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <x-transaksi-overview-area divId="overviewArea"></x-transaksi-overview-area>
                </div>
            </div>
        </div>

        
    </div>
@stop

@push('js')
<script>
    const printLaporanModal = new bootstrap.Modal('#printLaporanModal');
    const terlarisPie = new ItemTerlarisPie('terlarisPie');
    const overviewArea = new TransaksiOverviewArea('overviewArea');
    
    terlarisPie.load_data("bulan");
    overviewArea.load_data("bulan");

    document.getElementById("show-print-modal-btn").addEventListener("click", ()=>{
        printLaporanModal.show();
    })
    document.getElementById("print-laporan-btn").addEventListener("click", ()=>{
        const form = document.getElementById('print-laporan-form');
        const inputs = form.querySelectorAll('input');
        
        if (inputs[0].value != '' && inputs[1].value != ''){
            form.submit();
        }
        else{
            alert("Dari dan sampai tidak boleh kosong!");
        }
    })
    document.getElementById("item-terlaris-select").addEventListener("change", (event)=>{
        terlarisPie.load_data(event.target.value);
    })
    document.getElementById("transaksi-overview-select").addEventListener("change", (event)=>{
        overviewArea.load_data(event.target.value);
    })
</script>
@endpush