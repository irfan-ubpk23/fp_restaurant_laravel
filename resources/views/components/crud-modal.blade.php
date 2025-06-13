<!-- Show Modal -->
<x-modal modal-id="showModal" title="Show Data">
    <x-slot:body>
        <div class="row row-cols-2 align-items-center" id="showModalField">
            {{ $fields }}
        </div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </x-slot:footer>
</x-modal>

{{-- Input Modal --}}
<form action="" method="POST" class="w-100">
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
<form action="" id="editModalForm" method="POST" class="w-100">
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
        let crud_target_url = "{{ $targetUrl }}";
        let showModal = new bootstrap.Modal("#showModal");
        let inputModal = new bootstrap.Modal("#inputModal");
        let deleteModal = new bootstrap.Modal("#deleteModal");
        let editModal = new bootstrap.Modal("#editModal");
        
        let input_field_ids = [];
        let field_ids = [];
        let allowed_inputs = ["INPUT", "SELECT"];

        // initialize events
        if (document.getElementById("add-btn")){
            document.getElementById("add-btn").addEventListener("click", show_input_form);
        }
        
        document.querySelectorAll("#delete-btn").forEach((e) => {
            e.addEventListener("click", () => show_delete_form(e));
        });
        document.querySelectorAll("#edit-btn").forEach((e) => {
            e.addEventListener("click", () => show_edit_form(e));
        });
        document.querySelectorAll("#show-btn").forEach((e) => {
            e.addEventListener("click", () => show_modal(e));
        });
        
        // initialize input fields
        let show_modal_field_root = document.getElementById('showModalField');
        let fields = Array.from(show_modal_field_root.children);
        // show_modal_field_root.replaceChildren();
        
        for (let i = 0;i < fields.length;i++){
            let field = fields[i];
            show_modal_field_root.removeChild(field);
            if (field.classList.contains('field')){
                if (field.tagName == "LABEL" || field.tagName == 'DIV'){
                    field_ids.push(field.getAttribute('id'));
                    
                    if (field.tagName == "LABEL"){
                        ["input", "edit"].forEach((mode) => {
                            let root = document.getElementById(mode + "ModalField");
                            
                            let label = document.createElement('label');
                            label.innerText = field.getAttribute('id');
                            label.setAttribute('for', mode + field.getAttribute('id'));
                            root.appendChild(label);
                            
                            let input;
                            if (field.getAttribute("data-field-type") == "select"){
                                input = document.createElement('select');
                                input.setAttribute('class', 'form-select');

                                field.getAttribute('data-field-select-list').split(" ").forEach((option_datas) => {
                                    option_datas = option_datas.split(':');

                                    let option = document.createElement('option');
                                    option.setAttribute('value', option_datas[0]);
                                    option.innerText = option_datas[1];
                                    input.appendChild(option);
                                });
                            }
                            else{
                                input = document.createElement('input');
                                
                                let type = "text";
                                if (field.getAttribute('data-field-type') != ""){
                                    type = field.getAttribute('data-field-type');
                                }
                                input.setAttribute('type', type);
                                input.setAttribute('class', 'form-control');
                            }
                            input.setAttribute('id', mode + field.getAttribute('id'));
                            input.setAttribute('name', field.getAttribute('id'));
                            root.appendChild(input);
                        });
                        let show_label = document.createElement('label');
                        show_label.setAttribute('id', 'show_' + field.getAttribute('id'));
                        show_label.innerText = field.getAttribute('id');
                        show_modal_field_root.appendChild(show_label);
                    }
                }
            }
            show_modal_field_root.appendChild(field);
        };

        let inputs = document.getElementById("inputModalField").children;
        for (let i = 0;i < inputs.length;i++){
            let input = inputs[i];

            // if input is in the allowed list, then insert it.
            // will be used when in update modal for getting
            // data in table, because it is using the same name as the id.
            if (allowed_inputs.includes(input.tagName)){
                input_field_ids.push(input.getAttribute('id'));
                input.setAttribute("value", "");
            }
            
            // change label target to the newest id, which added
            // 'input_' in front.
            if (input.tagName == "LABEL"){
                input.setAttribute('for', 'input_' + input.getAttribute('for'));
            }
            input.setAttribute('id', 'input_' + input.getAttribute('id'));
        };

        function show_modal(button){
            showModal.show();

            let datas = JSON.parse(button.getAttribute("data-datas"));
            
            field_ids.forEach((field_id) => {
                let data = datas[field_id];
                
                if (typeof data === 'object'){
                    let base_row = document.getElementById(field_id).children[0];
                    
                    Array.from(document.getElementById(field_id).children).forEach((child)=>{
                        if(child != base_row){
                            child.remove();
                        }
                    });

                    data.forEach((row_data) =>{
                        let new_row = base_row.cloneNode(true);
                        base_row.after(new_row);

                        Object.keys(row_data).forEach(key=>{
                            let col = new_row.querySelectorAll("."+key);
                            if (col.length > 0){
                                col[0].innerText = row_data[key];
                            }
                        });
                    });
                    base_row.remove();
                }
                else{
                    document.getElementById(field_id).innerText = datas[field_id];
                }
                
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
                document.getElementById('edit' + field_id).value = datas[field_id];
            });
        }
    });
</script>
@endpush