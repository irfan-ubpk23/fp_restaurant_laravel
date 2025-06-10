if (crud_target_url){
    // initialize
    let showModal = new bootstrap.Modal(document.getElementById("showModal"));
    let inputModal = new bootstrap.Modal(document.getElementById("inputModal"));
    let deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
    let editModal = new bootstrap.Modal(document.getElementById('editModal'));
    
    let input_field_ids = [];
    let field_ids = [];
    let allowed_inputs = ["INPUT", "SELECT"];

    // initialize events
    document.getElementById("add-btn").addEventListener("click", show_input_form);
    
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
    let fields = document.getElementById("showModalField").children;
    for (let i = 0;i < fields.length;i++){
        let field = fields[i];
        
        if (field.classList.contains('field')){
            if (field.tagName == "LABEL" || field.tagName == 'DIV'){
                field_ids.push(field.getAttribute('id'));
                
                if (field.tagName == "LABEL"){
                    ["input", "edit"].forEach((mode) => {
                        let root = document.getElementById(mode + "ModalField");
                        console.log(root);
                        
                        let label = document.createElement('label');
                        label.innerText = field.getAttribute('id');
                        label.setAttribute('for', mode + field.getAttribute('id'));
                        root.appendChild(label);
                        
                        let input = document.createElement('input');
                        input.setAttribute('id', mode + field.getAttribute('id'));
                        input.setAttribute('class', 'form-control');
                        root.appendChild(input);
                    })
                }
            }
        }
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
        editModal.show()
        // change form's action
        document.getElementById("editModalForm").action = crud_target_url + button.getAttribute('data-id');
        // parse json object data from table
        let datas = JSON.parse(button.getAttribute("data-datas"));
        
        input_field_ids.forEach((input_field_id) => {
            document.getElementById(input_field_id).value = datas[input_field_id];
        });
        // document.getElementById("nama_kategori").value = datas.nama_kategori;
    }
}