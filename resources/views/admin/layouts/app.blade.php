<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - SMP Tunas Harapan Bekasi</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@1.13.1/css/OverlayScrollbars.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap">

    <style>
        body { font-family: 'Source Sans Pro', sans-serif; }
        .sidebar-dark-primary { background-color: #1e293b !important; }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active:hover { background-color: #d97706 !important; color: #fff !important; }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover { background-color: rgba(255,255,255,0.08) !important; }
        .brand-link { background-color: #0f172a !important; }
        .nav-sidebar .nav-link i { color: #f9ad38 !important; }
        .nav-sidebar .nav-link.active i { color: #fff !important; }
        .card { border-radius: 12px; border: 1px solid #e2e8f0; }
        .card-header { border-radius: 12px 12px 0 0; border-bottom: 1px solid #e2e8f0; }
        .btn-primary { background-color: #d97706; border-color: #b45309; }
        .btn-primary:hover { background-color: #b45309; border-color: #92400e; }
        .btn-danger { border-radius: 8px; }
        .btn-flat { border-radius: 8px; }
        .table td, .table th { vertical-align: middle; }
        .small-box .icon > i { transition: all 0.3s; }
        .small-box:hover .icon > i { transform: scale(1.1); }
        .badge-status { font-size: 11px; padding: 4px 10px; border-radius: 6px; font-weight: 600; }
        .img-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; }
        .img-thumb-lg { width: 100%; max-height: 300px; object-fit: cover; border-radius: 12px; }
    </style>

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Unread Messages -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-envelope"></i>
                    @php $unread = \App\Models\Contact::unread()->count(); @endphp
                    @if($unread > 0)
                    <span class="badge badge-warning navbar-badge">{{ $unread }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ $unread }} Pesan Baru</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.contacts.index', ['filter' => 'unread']) }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> Lihat Pesan Masuk
                    </a>
                </div>
            </li>

            <!-- User -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-item text-center">
                        <strong>{{ auth()->user()->name }}</strong>
                        <br><small class="text-muted">{{ auth()->user()->email }}</small>
                    </div>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <div class="img-circle elevation-2 bg-amber-600 d-flex align-items-center justify-center text-white font-weight-bold" style="width:34px;height:34px;font-size:14px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header">KONTEN</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Galeri</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.programs.index') }}" class="nav-link {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-star"></i>
                            <p>Program Unggulan</p>
                        </a>
                    </li>
                    <li class="nav-header">SDM</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.teachers.index') }}" class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Guru & Staff</p>
                        </a>
                    </li>
                    <li class="nav-header">PPDB & KONTAK</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.registrations.index') }}" class="nav-link {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>Data Pendaftar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Pesan Masuk
                                @if($unread > 0)
                                <span class="badge badge-warning right">{{ $unread }}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">PENGATURAN</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Pengaturan Situs</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Breadcrumb -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark font-weight-bold">@yield('page_title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                @yield('content')
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer text-sm">
        <strong>&copy; {{ date('Y') }} SMP Tunas Harapan Bekasi.</strong> Admin Panel.
    </footer>
</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@1.13.1/js/jquery.overlayScrollbars.min.js"></script>

<!-- TinyMCE for rich text -->
<script src="https://cdn.tiny.cloud/1/byvnra3fq3p3q64qd39ypde1ai5l2wi8aq5b4yqamuhxajf1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: 'textarea.tinymce',
            height: 350,
            menubar: false,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen',
            toolbar: 'undo redo | formatselect bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link',
            content_style: 'body { font-family: Source Sans Pro, sans-serif; font-size: 14px; padding: 10px; }',
            branding: false,
            statusbar: true,
            // Memaksa sinkronisasi teks saat diketik
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            }
        });
    }

    // Confirm delete dialog
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-delete-confirm')) {
            e.preventDefault();
            const form = e.target.closest('.btn-delete-confirm').closest('form');
            if (confirm('Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.')) {
                form.submit();
            }
        }
    });
</script>

@stack('scripts')
</body>
</html>