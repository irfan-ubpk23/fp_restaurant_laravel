@extends('layouts.default')

@section('body')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                            </div>
                            @if (session('message'))
                            <h6 class="text-danger">{{ session('message') }}</h6>
                            @endif
                            <form class="user" method="POST" action="/login">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        name="email"
                                        id="InputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address..."
                                        value="{{ old('email') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        name="password"
                                        id="InputPassword" placeholder="Password"
                                        value="{{ old('password') }}"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@stop

@push('js')
    <script>
    $("body").addClass("bg-gradient-primary");
    </script>
@endpush
