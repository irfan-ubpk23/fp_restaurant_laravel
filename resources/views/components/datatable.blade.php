@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@endpush

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
        new DataTable("#{{ $datatableId }}", {
            scrollX:true,
            stateSave:true
        });
    });
</script>
@endpush