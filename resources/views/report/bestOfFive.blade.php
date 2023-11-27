@extends('layouts.dashboard')

@section('sidebar')
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>


                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>



            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src=" {{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Amsang
                    Tech</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Nama Praktikan</a>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->


                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            {{-- <a href="{{ url('kamar') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Kamar</p>
                            </a> --}}
                            <a href="{{ route('report.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Halaman Utama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ url('kamar') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Kamar</p>
                            </a> --}}
                            <a href="{{ route('report.newCust') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Pelanggan Baru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ url('kamar') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Kamar</p>
                            </a> --}}
                            <a href="{{ route('report.pendapatan') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Pendapatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ url('kamar') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Kamar</p>
                            </a> --}}
                            <a href="{{ route('report.jumlahTamu') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Jumlah Tamu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ url('kamar') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Kamar</p>
                            </a> --}}
                            <a href="{{ route('report.bestOfFive') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Pelanggan terbaik</p>
                            </a>
                        </li>
                    </ul>
                </nav>


                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <div class="row p-4">
                <div class="card col-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h2 class="text-center m-4">TOP 5 Pelanggan</h2>
                            <div class="text-right m-4 d-print-none">
                                <button onclick="window.print()" class="btn btn-primary">Print</button>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat</th>
                                        <th>Jumlah Pemesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($custs as $kamar)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kamar['nama_pelanggan'] }}</td>
                                            <td>{{ $kamar['alamat'] ?? '-' }}</td>
                                            <td>{{ $kamar['total'] }}</td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer  d-print-none">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline"> NPM_PRAKTIKAN
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">AdminLTE.io</a>. </strong> All rights
            reserved.
        </footer>
    </div>
    <script>
        (() => {
            setTimeout(() => {
                window.print()
            }, 1000);
        })()
    </script>
@endsection
