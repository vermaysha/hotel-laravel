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
                            <a href="{{ route('fo.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Halaman Utama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ url('kamar') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Kamar</p>
                            </a> --}}
                            <a href="{{ route('fo.history') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Riwayat</p>
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kamar</th>
                                        <th>Tipe Kamar</th>
                                        <th>Tarif Awal</th>
                                        <th>Tarif Terpasang</th>
                                        <th>Ukuran kamar</th>
                                        <th>Kapasitas Kamar</th>
                                        <th>Rincian Kamar</th>
                                        <th>Detail Kamar</th>
                                        <th>Status</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kamars as $kamar)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kamar->jenis_kamar }}</td>
                                            <td>{{ $kamar->tipe_tempat_tidur }}</td>
                                            <td>{{ $kamar->tarif_awal }}</td>
                                            <td>{{ $kamar->tarifs->tarif_terpasang }}</td>
                                            <td>{{ $kamar->ukuran_kamar }}</td>
                                            <td>{{ $kamar->kapasitas_kamar }}</td>
                                            <td>{{ $kamar->rincian_kamar }}</td>
                                            <td>{{ $kamar->detail_kamar }}</td>
                                            <td>
                                                @if (isset($kamar->booking[0]))
                                                    <span class="badge badge-primary">Sudah Dibooking</span>
                                                    <br/>
                                                    Mulai <span class="badge badge-success">{{ $kamar?->booking[0]?->start_at }}</span>
                                                    <br/>
                                                    Selesai <span class="badge badge-success">{{ $kamar?->booking[0]?->end_at }}</span>
                                                @else
                                                    <span class="badge badge-danger">Belum Dibooking</span>
                                                @endif
                                            </td>
                                            <td class="btn btn-group">
                                                @if (empty($kamar->booking[0]))
                                                    <a href="{{ route('fo.checkin', ['id' => $kamar->id]) }}" class="btn btn-success">Check-in</a>
                                                @elseif (isset($kamar->booking[0]) && $kamar?->booking[0]?->status === 'checkin')
                                                    <a href="{{ route('fo.checkout', ['id' => $kamar->id]) }}" class="btn btn-warning">Check-out</a>
                                                    <a href="{{ route('fo.print-nota', ['id' => $kamar->booking[0]->id]) }}" class="btn btn-info">Cetak Nota</a>
                                                @endif
                                            </td>
                                        </tr>
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
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline"> NPM_PRAKTIKAN
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">AdminLTE.io</a>. </strong> All rights
            reserved.
        </footer>
    </div>
@endsection
