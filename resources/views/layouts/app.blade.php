<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel Kampus') }}</title>
    <link rel="icon" type="image/x-icon"
        href="{{ asset(isset($settings->icon_meta) ? 'storage/' . $settings->icon_meta : 'icon/icon.svg') }}">
    <!-- In your <head> section -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Tabler Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/css/tabler.min.css" />
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <style>
        .nav-link-custom:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg" style="background-color: #1e293b;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset(isset($settings->logo_dashboard) ? 'storage/' . $settings->logo_dashboard : 'icon/icon.svg') }}"
                            width="200" height="60" alt="Tabler" class="navbar-brand-image">
                        <span class="text-white">{{ $settings->nama_logo_dashboard ?? 'KampusApp' }}</span>
                    </a>
                </h1>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        @if (Auth::user()->usertype == 'admin')
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom text-white" href="{{ route('dashboard') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-home"></i>
                                    </span>
                                    <span class="nav-link-title">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown {{ request()->routeIs('users.*') ? 'show' : '' }}">
                                <a class="nav-link dropdown-toggle nav-link-custom text-white {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                    href="#navbar-admin" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    role="button"
                                    aria-expanded="{{ request()->routeIs('users.*') ? 'true' : 'false' }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-user-shield"></i>
                                    </span>
                                    <span class="nav-link-title">Users</span>
                                </a>
                                <div class="dropdown-menu {{ request()->routeIs('users.*') ? 'show' : '' }}">
                                    <a class="dropdown-item {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                        href="{{ route('users.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-users"></i>
                                        </span>
                                        Data Users
                                    </a>
                                </div>
                            </li>
                            <li
                                class="nav-item dropdown {{ request()->routeIs('pembayaran-mahasiswa.*') ? 'show' : '' }}">
                                <a class="nav-link dropdown-toggle nav-link-custom text-white {{ request()->routeIs('pembayaran-mahasiswa.*') ? 'active' : '' }}"
                                    href="#navbar-admin" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    role="button"
                                    aria-expanded="{{ request()->routeIs('pembayaran-mahasiswa.*') ? 'true' : 'false' }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-list"></i>
                                    </span>
                                    <span class="nav-link-title">Pembayaran</span>
                                </a>
                                <div
                                    class="dropdown-menu {{ request()->routeIs('pembayaran-mahasiswa.*') ? 'show' : '' }}">
                                    <a class="dropdown-item {{ request()->routeIs('pembayaran-mahasiswa.*') ? 'active' : '' }}"
                                        href="{{ route('pembayaran-mahasiswa.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-list"></i>
                                        </span>
                                        Data Pembayaran
                                    </a>
                                </div>
                            </li>
                        @endif

                        @if (Auth::user()->usertype == 'mahasiswa')
                            <li class="nav-item dropdown {{ request()->routeIs('mahasiswa.*') ? 'show' : '' }}">
                                <a class="nav-link dropdown-toggle nav-link-custom text-white {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}"
                                    href="#navbar-mahasiswa" data-bs-toggle="dropdown" data-bs-auto-close="false"
                                    role="button"
                                    aria-expanded="{{ request()->routeIs('mahasiswa.*') ? 'true' : 'false' }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-school"></i>
                                    </span>
                                    <span class="nav-link-title">Mahasiswa</span>
                                </a>
                                <div class="dropdown-menu {{ request()->routeIs('mahasiswa.*') ? 'show' : '' }}">
                                    <a class="dropdown-item {{ request()->routeIs('mahasiswa.create') ? 'active' : '' }}"
                                        href="{{ route('mahasiswa.create') }}">
                                        <i class="ti ti-plus me-1"></i>
                                        Input Pembayaran
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('mahasiswa.index') ? 'active' : '' }}"
                                        href="{{ route('mahasiswa.index') }}">
                                        <i class="ti ti-list me-1"></i>
                                        List Pembayaran
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('mahasiswa.materi.*') ? 'active' : '' }}"
                                        href="{{ route('mahasiswa.materi.index') }}">
                                        <i class="ti ti-book me-1"></i>
                                        Materi Perkuliahan
                                    </a>
                                </div>
                            </li>
                        @endif

                        @if (Auth::user()->usertype == 'dosen')
                            <li class="nav-item dropdown {{ request()->routeIs('dosen.*') ? 'show' : '' }}">
                                <a class="nav-link dropdown-toggle nav-link-custom text-white {{ request()->routeIs('dosen.*') ? 'active' : '' }}"
                                    href="#navbar-dosen" data-bs-toggle="dropdown" data-bs-auto-close="false"
                                    role="button"
                                    aria-expanded="{{ request()->routeIs('dosen.*') ? 'true' : 'false' }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-chalkboard"></i>
                                    </span>
                                    <span class="nav-link-title">Dosen</span>
                                </a>
                                <div class="dropdown-menu {{ request()->routeIs('dosen.*') ? 'show' : '' }}">
                                    <a class="dropdown-item {{ request()->routeIs('dosen.index') ? 'active' : '' }}"
                                        href="{{ route('dosen.index') }}">
                                        <i class="ti ti-list me-1"></i>
                                        RPS Mata Kuliah
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('dosen.create') ? 'active' : '' }}"
                                        href="{{ route('dosen.create') }}">
                                        <i class="ti ti-upload me-1"></i>
                                        Upload RPS Mata Kuliah
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->routeIs('materi.*') ? 'show' : '' }}">
                                <a class="nav-link dropdown-toggle nav-link-custom text-white {{ request()->routeIs('materi.*') ? 'active' : '' }}"
                                    href="#navbar-materi" data-bs-toggle="dropdown" data-bs-auto-close="false"
                                    role="button"
                                    aria-expanded="{{ request()->routeIs('materi.*') ? 'true' : 'false' }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-book"></i>
                                    </span>
                                    <span class="nav-link-title">Materi Ajar</span>
                                </a>
                                <div class="dropdown-menu {{ request()->routeIs('materi.*') ? 'show' : '' }}">
                                    <a class="dropdown-item {{ request()->routeIs('materi.index') ? 'active' : '' }}"
                                        href="{{ route('materi.index') }}">
                                        <i class="ti ti-list me-1"></i>
                                        List Materi Ajar
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('materi.create') ? 'active' : '' }}"
                                        href="{{ route('materi.create') }}">
                                        <i class="ti ti-upload me-1"></i>
                                        Upload Materi Ajar
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->routeIs('absensi.*') ? 'show' : '' }}">
                                <a class="nav-link dropdown-toggle nav-link-custom text-white {{ request()->routeIs('absensi.*') ? 'active' : '' }}"
                                    href="#navbar-absensi" data-bs-toggle="dropdown" data-bs-auto-close="false"
                                    role="button"
                                    aria-expanded="{{ request()->routeIs('absensi.*') ? 'true' : 'false' }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-clipboard-check"></i>
                                    </span>
                                    <span class="nav-link-title">Absensi</span>
                                </a>
                                <div class="dropdown-menu {{ request()->routeIs('absensi.*') ? 'show' : '' }}">
                                    <a class="dropdown-item {{ request()->routeIs('absensi.index') ? 'active' : '' }}"
                                        href="{{ route('absensi.index') }}">
                                        <i class="ti ti-list me-1"></i>
                                        Daftar Absensi
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('absensi.create') ? 'active' : '' }}"
                                        href="{{ route('absensi.create') }}">
                                        <i class="ti ti-plus me-1"></i>
                                        Buat Absensi Baru
                                    </a>
                                </div>
                            </li>
                        @endif

                        <li class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <a class="nav-link nav-link-custom text-white" href="{{ route('profile.edit') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-user-circle"></i>
                                </span>
                                <span class="nav-link-title">Profil</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="nav-link nav-link-custom text-white" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-logout"></i>
                                    </span>
                                    <span class="nav-link-title">Logout</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <div class="page-wrapper">
            <!-- Header -->
            <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-nav flex-row order-md-last">
                        {{-- <div class="d-none d-md-flex me-3">
                            <a href="#" class="nav-link px-0 toggle-theme" title="Toggle theme"
                                data-bs-toggle="tooltip" data-bs-placement="bottom">
                                <i class="ti ti-moon"></i>
                            </a>
                        </div> --}}

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                aria-label="Open user menu">
                                <span class="avatar avatar-sm"
                                    style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random)"></span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ auth()->user()->name }}</div>
                                    <div class="mt-1 small text-muted">{{ ucfirst(auth()->user()->role) }}</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                @if (auth()->user()->usertype === 'admin')
                                    <a href="{{ route('settings') }}" class="dropdown-item">Settings</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <div>
                            {{-- <form action="./" method="get" autocomplete="off" novalidate>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" value="" class="form-control" placeholder="Search…"
                                        aria-label="Search">
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <div class="page-body">
                <div class="container-fluid">
                    {{-- breadcrumb --}}
                    <div class="row g-2 mb-2 mb-lg-3">
                        <div class="col-auto">
                            <h2 class="page-title">
                                @yield('menus', 'Dashboard')
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        @yield('page-subtitle', 'Selamat datang di Aplikasi Kampus')
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- Page title -->
                    <div class="page-header d-print-none mb-4">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    @yield('page-title', 'Dashboard')
                                </h2>
                                <div class="text-muted mt-1">
                                    @yield('page-subtitle', 'Selamat datang di Aplikasi Kampus')
                                </div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                @yield('page-actions')
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="fade-in">
                        @yield('content')
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-fluid">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="#" class="link-secondary">Dokumentasi</a>
                                </li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">Bantuan</a>
                                </li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">Kontak</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ date('Y') }}
                                    <a href="." class="link-secondary">Aplikasi Kampus</a>
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/js/tabler.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <!-- Chart.js for data visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.0/dist/chart.umd.min.js"></script>

    <script>
        // Toggle between light and dark modes
        document.addEventListener('DOMContentLoaded', function() {
            const toggleThemeBtn = document.querySelector('.toggle-theme');
            if (toggleThemeBtn) {
                toggleThemeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (document.body.classList.contains('theme-dark')) {
                        document.body.classList.remove('theme-dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        document.body.classList.add('theme-dark');
                        localStorage.setItem('theme', 'dark');
                    }
                });

                // Check for saved theme preference
                const savedTheme = localStorage.getItem('theme');
                if (savedTheme === 'dark') {
                    document.body.classList.add('theme-dark');
                }
            }

            // Delete confirmation with SweetAlert
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('delete-confirm')) {
                    e.preventDefault();
                    const form = e.target.closest('form');
                    const name = e.target.dataset.name || 'item';

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: `Apakah Anda yakin ingin menghapus ${name}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Handle form submission with loading state
            document.querySelectorAll('form').forEach(form => {
                if (!form.classList.contains('no-submit-handling')) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const submitBtn = form.querySelector('[type="submit"]');
                        if (submitBtn) {
                            Swal.fire({
                                title: 'Loading...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Submit form after showing loading
                            setTimeout(() => {
                                form.submit();
                            }, 500);

                            // Reset loading after 15 seconds in case something goes wrong
                            setTimeout(() => {
                                Swal.close();
                            }, 15000);
                        }
                    });
                }
            });
        });

        // Flash message handling with SweetAlert
        @if (session('swal_success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('swal_success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('swal_error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('swal_error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    @stack('scripts')
</body>

</html>
