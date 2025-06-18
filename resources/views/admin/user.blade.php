@extends('layouts.admin')

@section('content')
    <x-crud-modal target-url="/user/">
        <x-slot:fields>
            <input type="text" id="username" name="username" placeholder="Username" class="form-control">
            <input type="email" id="email" name="email" placeholder="Email" class="form-control">
            <input type="text" id="no_hp" name="no_hp" placeholder="No Hp" class="form-control">
            <input type="text" id="password" name="password" placeholder="Password" class="form-control">
            <select name="role" id="role" class="form-select" placeholder="Role">
                <option value="pembeli">Pembeli</option>
                <option value="pelayan">Pelayan</option>
                <option value="dapur">Dapur</option>
                <option value="admin">Admin</option>
            </select>
        </x-slot:fields>
    </x-crud-modal>

    <x-modal modalId="askPasswordModal" title="Authenticate">
        <x-slot:body>
            <input id="askPasswordPassword" type="password" class="form-control" placeholder="Masukan Password anda">
        </x-slot:body>
        <x-slot:footer>
            <button type="button" onclick="ask_password()" class="btn btn-primary">Enter</button>
        </x-slot:footer>
    </x-modal>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <button type="button" id="add-btn" class="btn btn-primary">
            <i class="fa-solid fa-plus fa-sm text-white-50"></i> Tambah Baru
        </button>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
                </div>
                <div class="card-body" >
                    <x-datatable datatable-id="datatable">
                        <x-slot:head>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot:head>
                        <x-slot:body>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_hp }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <button type="button" id="delete-btn" data-id="{{ $user->id }}" class="btn btn-danger btn-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" id="edit-btn" data-id="{{ $user->id }}" data-datas="{{ $user }}" class="btn btn-secondary btn-circle">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot:body>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    let askPasswordModal;
    let askPasswordPassword;
    let current_askPassword_func;
    document.addEventListener("DOMContentLoaded", ()=>{
        askPasswordModal = new bootstrap.Modal("#askPasswordModal");
        askPasswordPassword = document.getElementById("askPasswordPassword");
    
        if (document.getElementById("add-btn")){
            const add_btn = document.getElementById("add-btn");
            add_btn.onclick = () => show_ask_password(show_input_form);
        }
        
        document.querySelectorAll("#delete-btn").forEach((e) => {
            e.onclick = () => show_ask_password(() => show_delete_form(e));
        });
        document.querySelectorAll("#edit-btn").forEach((e) => {
            e.onclick = () => show_ask_password(() => show_edit_form(e));
        });
    
        function show_ask_password(func){
            askPasswordModal.show();
            current_askPassword_func = func;
        }
    });

    function ask_password(){
        fetch("{{ route('check_user') }}", {
            headers: {
                "Content-type" : "application/json",
                "Accept" : "application/json, text-plain, */*",
                "url" : "/api/check_user",
                "X-CSRF-Token" : "{{ csrf_token() }}"
            },
            method: "post",
            credentials:"same-origin",
            body: JSON.stringify({username : "{{ Auth::user()->username }}", password : askPasswordPassword.value})
        })
        .then((response)=>{
            askPasswordPassword.value = "";
            askPasswordModal.hide();    
            
            if (response["status"] == 200){
                current_askPassword_func();
            }else{
                return response.json().then((data) => {
                    show_message(data["message"]);
                })
            }
        })
    }
    
</script>
@endpush