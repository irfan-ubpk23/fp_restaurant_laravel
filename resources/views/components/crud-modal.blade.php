<div style="display:none" id="crudModalFields">
    {{ $fields }}
</div>

<!-- Show Modal -->
<x-modal modal-id="showModal" title="Show Data">
    <x-slot:body>
        <div class="row row-cols-2 align-items-center" id="showModalField"></div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </x-slot:footer>
</x-modal>

{{-- Input Modal --}}
<form action="" method="POST" class="w-100" enctype="multipart/form-data">
@csrf
<x-modal modal-id="inputModal" title="Input Data">
    <x-slot:body>
        <div class="row row-cols-2 align-items-center" id="inputModalField"></div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Save</button>
    </x-slot:footer>
</x-modal>
</form>

{{-- Edit Modal --}}
<form action="" id="editModalForm" method="POST" class="w-100" enctype="multipart/form-data">
@csrf
@method("PUT")
<x-modal modal-id="editModal" title="Edit Data">
    <x-slot:body>
        <div class="row row-cols-2 align-items-center" id="editModalField"></div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Save</button>
    </x-slot:footer>
</x-modal>
</form>

<!-- Delete Modal -->
<x-modal modal-id="deleteModal" title="Hapus Data">
    <x-slot:body>
        .Apakah anda yakin?
    </x-slot:body>
    <x:slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="" id="deleteModalForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </x:slot:footer>
</x-modal>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // initialize
        const crud_target_url = "{{ $targetUrl }}";
        const showModal = new bootstrap.Modal("#showModal");
        const inputModal = new bootstrap.Modal("#inputModal");
        const deleteModal = new bootstrap.Modal("#deleteModal");
        const editModal = new bootstrap.Modal("#editModal");

        // initialize fields
        let field_ids = [];
        const fields = Array.from(document.getElementById("crudModalFields").children);
        const allowed_fields = ["INPUT", "SELECT"];
        
        ["show", "input", "edit"].forEach((mode) =>{
            const field_root = document.getElementById(mode + "ModalField");
            const field_fragment = document.createDocumentFragment();

            fields.forEach((field)=>{
                if (allowed_fields.includes(field.tagName)){
                    field_ids.push(field.getAttribute("id"));

                    let label = document.createElement("label");
                    label.id = mode + field.getAttribute("id") + "Label";
                    label.htmlFor = mode + field.getAttribute("id");
                    label.innerText = field.getAttribute("placeholder");
                    field_fragment.appendChild(label);
                    
                    let input;
                    if (mode === "show"){
                        input = document.createElement("p");
                        input.classList.add("d-block");
                        input.classList.add("col");
                    }
                    else{
                        input = field.cloneNode(true);
                    }
                    input.id = mode + field.getAttribute("id");
                    field_fragment.appendChild(input);
                }
            });
            
            field_root.appendChild(field_fragment);
        });

        // initialize events
        if (document.getElementById("add-btn")){
            document.getElementById("add-btn").addEventListener("click", show_input_form);
        }
        
        document.querySelectorAll("#show-btn").forEach((e) => {
            e.addEventListener("click", () => show_modal(e));
        });
        document.querySelectorAll("#delete-btn").forEach((e) => {
            e.addEventListener("click", () => show_delete_form(e));
        });
        document.querySelectorAll("#edit-btn").forEach((e) => {
            e.addEventListener("click", () => show_edit_form(e));
        });

        function show_modal(button){
            showModal.show();

            let datas = JSON.parse(button.getAttribute("data-datas"));
            
            field_ids.forEach((field_id) => {
                let data = datas[field_id];
                
                document.getElementById(field_id).innerText = datas[field_id];
            })
        }
        
        function show_input_form(){
            inputModal.show();
        }
        
        function show_delete_form(button){
            deleteModal.show();
            // change form's action
            document.getElementById("deleteModalForm").action = crud_target_url + button.getAttribute('data-id');
        }
        
        function show_edit_form(button){
            editModal.show();
            // change form's action
            document.getElementById("editModalForm").action = crud_target_url + button.getAttribute('data-id');
            // parse json object data from table
            let datas = JSON.parse(button.getAttribute("data-datas"));
            
            field_ids.forEach((field_id) => {
                if (datas[field_id]){
                    document.getElementById('edit' + field_id).value = datas[field_id];
                }
            });
        }
    });
</script>
@endpush