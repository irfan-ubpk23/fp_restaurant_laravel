@extends('layouts.default')

@section('body')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-desktop"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ Auth::user()->role }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @if(Auth::user()->role == "admin")
                <!-- Nav Item - Dashboard -->
                <li class="nav-item
                @if (Request::path() == "dashboard")
                    active
                @endif
                ">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    CRUD
                </div>

                <li class="nav-item
                @if (Request::path() == "kategori")
                    active
                @endif
                ">
                    <a class="nav-link" href="/kategori">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Kategori</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item
                @if (Request::path() == "menu")
                    active
                @endif
                ">
                    <a class="nav-link" href="/menu">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Menu</span></a>
                </li>

                <li class="nav-item
                @if (Request::path() == "user")
                    active
                @endif
                ">
                    <a class="nav-link" href="/user">
                        <i class="fas fa-fw fa-table"></i>
                        <span>User</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item
                @if (Request::path() == "meja")
                    active
                @endif
                ">
                    <a class="nav-link" href="/meja">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Meja</span></a>
                </li>

                <div class="sidebar-heading">
                    Transaksi
                </div>

                
                <li class="nav-item
                @if (Request::path() == "transaksi")
                    active
                @endif
                ">
                    <a class="nav-link" href="/transaksi">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Transaksi</span></a>
                </li>

                <li class="nav-item
                @if (Request::path() == "reservasi")
                    active
                @endif
                ">
                    <a class="nav-link" href="/reservasi">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Reservasi</span></a>
                </li>

                
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            @endif

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield("content")

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <x-modal modal-id="messageModal" title="Pesan">
        <x-slot:body>
            <div id="messageModalBody">

            </div>
        </x-slot:body>
    </x-modal>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script>
        $("body").addClass('page-top');
        
        const messageModal = (new bootstrap.Modal("#messageModal"));
        const messageModalbody = document.getElementById("messageModalBody");

        function show_message(message) {
            messageModal.show();
            messageModalbody.innerText = message;
        }
    </script>
    @if (session('message'))
    <script>
        show_message("{{ session('message') }}");
    </script>
    @endif
@endpush
