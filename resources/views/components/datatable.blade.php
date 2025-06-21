@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@endpush

<div class="row row-cols-2" id="filter-row" style="display:none;">
    <div class="col">
        <label for="">Dari</label>
        <input type="date" id="dibuat-dari" class="form-control filter-field">
    </div>

    <div class="col">
        <label for="">Sampai</label>
        <input type="date" id="dibuat-sampai" class="form-control filter-field">
    </div>

    <div></div>
    <div class="mt-2 row row-cols-2 mx-0 px-0">
        <div></div>
        <div class="w-100 col">
            <button class="btn btn-primary ms-auto w-100" id="filter-row-clear">Clear</button>
        </div>
    </div>
</div>
<table id="{{ $datatableId }}" class="table table-striped cell-border nowrap">
    <thead>
        {{ $head }}
    </thead>
    <tbody>
        {{ $body }}
    </tbody>
</table>

@push('js')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script>
    $(document).ready( function() {
        const datatableId = "#{{ $datatableId }}";
        const datatable = new DataTable(datatableId, {
            scrollX:true,
            stateSave:true
        });
        
        const filterRow = document.getElementById("filter-row");
        const filterRowPlacement = document.getElementById("{{ $filterRowPlacement }}");
        const filterRowClear = document.getElementById("filter-row-clear");
        const dibuatDari = document.getElementById("dibuat-dari");
        const dibuatSampai = document.getElementById("dibuat-sampai");

        dibuatDari.addEventListener("input", datatable.draw);
        dibuatSampai.addEventListener("input", datatable.draw);
        filterRowClear.addEventListener("click", () => {
            dibuatDari.value = '';
            dibuatSampai.value = '';
            datatable.draw();
        });

        filterRow.remove();
        filterRowPlacement.appendChild(filterRow);
        filterRow.style = "display:block";

        datatable.search.fixed('range', function (searchStr, data, index) {
            const min = new Date(dibuatDari.value);
            const max = new Date(dibuatSampai.value);
            const created_at = new Date(data[data.length-1]);

            if (
                (isNaN(min) && isNaN(max)) ||
                (created_at >= min && isNaN(max)) ||
                (isNaN(min) && created_at <= max) ||
                (created_at >= min && created_at <= max)
            ){
                return true;
            }
            return false;
        })
    });
</script>
@endpush