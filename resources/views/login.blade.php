@extends('layouts.default')

@section('body')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
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
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
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

</div>

@stop

@push('js')
    <script>
    $("body").addClass("bg-gradient-primary");
    </script>
@endpush
