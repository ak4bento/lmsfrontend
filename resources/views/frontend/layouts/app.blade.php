<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="/sejawat-logo-mobile.png">
    @include('frontend.layouts.datatables_css')

    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white fixed-top">
            <div class="container">
                <a href="{{ url('home') }}" class="navbar-brand py-4">
                    <img src="{{ asset('dist/img/Logo.png') }}" alt="Sejawat"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Sejawat LMS</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('classes') }}" class="nav-link">Classrooms</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backpack') }}" class="nav-link">Backpack</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="schedule.html" class="nav-link">Schedule</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ url('discover') }}" class="nav-link">Discover</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('flash-card') }}" class="nav-link">Flash Card</a>
                        </li>


                    </ul>

                    {{-- <!-- SEARCH FORM -->
                    <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                    @if (Route::has('login'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->email }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{-- <a type="button" class=" dropdown-item py-2" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    Ganti Password
                                </a> --}}
                                @auth
                                    <a href="#" class="nav-link"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endauth
                            </div>
                        </li>
                        <li class="nav-item">

                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" >
            <!-- Content Header (Page header) -->
            <section class="content" style="margin-top: 90px" >
                <div class="container-fluid" >
                    <div class="row mb-2">
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content" style="margin-top: 20px">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Temukan semua kebutuhan pembelajaran dan keprofesian kesehatan di Sejawat Indonesia.
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021 <a href="https://sejawat.co.id">Sejawat</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @include('frontend.layouts.datatables_js')
    @include('sweetalert::alert')

    @yield('third_party_scripts')

    @stack('page_scripts')
</body>

</html>
