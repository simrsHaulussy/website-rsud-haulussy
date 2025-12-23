<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZYFBJ69P0C"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZYFBJ69P0C');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Admin RSUD dr. M. Haulussy</title>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- ckeditor -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.0.0/ckeditor5.css" crossorigin>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/45.0.0/ckeditor5-premium-features.css" crossorigin>
    <link rel="stylesheet" href="{{ asset('plugins/ckeditor/style.css') }}">
    {{-- toastr --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Material Icons CDN (for modern icons) -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3182ce;
            --secondary-color: #4299e1;
            --accent-color: #7f9cf5;
            --dark-color: #2d3748;
            --light-color: #f8fafc;
            --success-color: #38a169;
            --warning-color: #ecc94b;
            --danger-color: #e53e3e;
            --info-color: #4299e1;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Improved sidebar styling */
        .main-sidebar {
            background: linear-gradient(180deg, #2c5282 0%, #3182ce 100%);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Active submenu styling - simplified */
        .sidebar-dark-primary .nav-treeview>.nav-item>.nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* Menu open state - simplified */
        .nav-item.menu-open > .nav-link {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Brand styling */
        .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 12px 10px;
            display: flex;
            align-items: center;
            height: 60px;
            overflow: hidden;
        }

        .brand-image {
            max-height: 30px;
            margin-right: 5px;
        }

        .brand-text {
            font-weight: 600 !important;
            letter-spacing: 0.2px;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* User panel styling */
        .user-panel {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 15px 10px;
        }

        .user-panel .info p {
            font-weight: 500;
            margin-bottom: 0;
        }

        .user-panel .image img {
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        /* Navbar styling */
        .main-header {
            background: #fff;
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s;
        }

        /* Improved menu icons */
        .nav-icon {
            margin-right: 8px !important;
            width: 20px;
            text-align: center;
        }

        /* Notification Animation */
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0, 0, 0);
            }
            40%, 43% {
                transform: translate3d(0, -15px, 0);
            }
            70% {
                transform: translate3d(0, -7px, 0);
            }
            90% {
                transform: translate3d(0, -2px, 0);
            }
        }

        .animate__animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .animate__bounce {
            animation-name: bounce;
            transform-origin: center bottom;
        }

        /* Notification sound toggle styling */
        #soundToggle {
            color: #6c757d !important;
            font-size: 0.875rem;
            padding: 8px 16px;
            transition: all 0.2s ease;
        }

        #soundToggle:hover {
            background-color: #f8f9fa;
            color: #495057 !important;
        }

        #soundToggle .material-icons-round {
            font-size: 18px;
            margin-right: 8px;
            vertical-align: middle;
        }

        /* Date display */
        .date-display {
            display: flex;
            align-items: center;
            background-color: #edf2f7;
            padding: 5px 12px;
            border-radius: 5px;
            margin-top: 5px;
        }

        .date-icon {
            font-size: 16px;
            color: #4a5568;
            margin-right: 6px;
        }

        .date-text {
            font-size: 13px;
            font-weight: 500;
            color: #4a5568;
        }

        /* Custom logout button */
        .btn-logout {
            background: linear-gradient(45deg, #e53e3e, #f56565);
            border: none;
            padding: 6px 16px;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(229, 62, 62, 0.2);
            display: flex;
            align-items: center;
            height: 34px;
            margin-right: 10px;
            margin-top : 3px;
        }

        .btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(229, 62, 62, 0.3);
        }

        .btn-logout i {
            font-size: 18px;
            margin-right: 6px;
        }

        .btn-logout span {
            font-size: 13px;
        }

        .nav-sidebar .nav-link p {
            white-space: normal;
            word-wrap: break-word;
            display: inline-block;
            vertical-align: middle;
            line-height: 1.2;
            margin-left: .2rem;
        }

        .nav-sidebar .nav-link i {
            vertical-align: middle;
            width: 1.6rem;
            text-align: center;
        }

        /* Notification styling */
        .navbar-badge {
            font-size: 0.7rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .dropdown-menu-lg {
            min-width: 320px;
            max-width: 380px;
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            background: white;
            padding: 0;
            margin-top: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: absolute;
            z-index: 1050;
            contain: layout;
        }

        .dropdown-menu-lg::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 24px;
            width: 12px;
            height: 12px;
            background: white;
            transform: rotate(45deg);
            box-shadow: -1px -1px 3px rgba(0, 0, 0, 0.08);
        }

        .dropdown-item.dropdown-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 18px 24px;
            margin: 0;
            border-radius: 12px 12px 0 0;
            border: none;
            position: relative;
            letter-spacing: 0.3px;
        }

        .dropdown-item.dropdown-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 24px;
            right: 24px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        }

        .notification-item {
            border: none;
            margin: 0;
            padding: 12px 16px;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
            position: relative;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 70px;
            width: 100%;
            box-sizing: border-box;
        }

        .notification-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transform: scaleY(0);
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .notification-item:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .notification-item:hover::before {
            transform: scaleY(1);
        }

        .notification-item:last-of-type {
            border-bottom: none;
        }

        .notification-icon {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-content {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 2px;
        }

        .notification-meta {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
        }

        .dropdown-item-title {
            font-size: 0.875rem;
            font-weight: 600;
            margin: 0;
            color: #1e293b;
            line-height: 1.3;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
        }

        .notification-item .text-sm {
            font-size: 0.85rem;
            line-height: 1.4;
            color: #2d3748;
            margin: 0;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
            font-weight: 400;
        }

        .notification-item .text-muted {
            font-size: 0.75rem;
            color: #4a5568;
            display: flex;
            align-items: center;
            gap: 3px;
            margin: 0;
            font-weight: 600;
        }

        /* Main notification icon (feedback/info) */
        .notification-icon .material-icons-round {
            font-size: 1.2rem;
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            padding: 8px;
            border-radius: 8px;
            transition: all 0.25s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-item:hover .notification-icon .material-icons-round {
            background: rgba(102, 126, 234, 0.15);
            transform: scale(1.05);
        }

        /* Small icons in content (schedule) */
        .notification-content .material-icons-round {
            font-size: 0.9rem;
            color: #2d3748;
            background: none;
            padding: 0;
            margin-right: 4px;
            width: auto;
            height: auto;
            display: inline;
            vertical-align: middle;
        }

        /* Star icon in meta */
        .notification-meta .material-icons-round {
            font-size: 0.85rem;
            color: #f59e0b;
            background: none;
            padding: 0;
            margin: 0;
            width: auto;
            height: auto;
            display: inline;
        }

        .dropdown-item.dropdown-footer {
            background: #f8fafc;
            color: #667eea;
            font-weight: 500;
            text-align: center;
            padding: 14px 24px;
            border-radius: 0 0 12px 12px;
            transition: all 0.25s ease;
            border-top: 1px solid rgba(0, 0, 0, 0.04);
            font-size: 0.85rem;
        }

        .dropdown-item.dropdown-footer:hover {
            background: #f1f5f9;
            color: #5b21b6;
            text-decoration: none;
        }

        .dropdown-divider {
            margin: 0;
            border-color: rgba(0, 0, 0, 0.04);
        }

        .notification-item .float-right {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 3px 8px;
            border-radius: 8px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            gap: 3px;
            font-weight: 500;
            flex-shrink: 0;
            margin-left: auto;
        }

        .notification-item .float-right .material-icons-round {
            font-size: 0.85rem;
            margin: 0;
            padding: 0;
            background: none;
            color: white;
        }

        /* Custom scrollbar for notification dropdown */
        .dropdown-menu-lg::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-menu-lg::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .dropdown-menu-lg::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #4299e1, #667eea);
            border-radius: 3px;
        }

        .dropdown-menu-lg::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #3182ce, #5a67d8);
        }

        /* Content wrapper styling */
        .content-wrapper {
            background-color: #f8fafc;
        }

        /* Card styling */
        .card {
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }


    </style>
    @yield('link')
</head>

@yield('style')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="material-icons-round">menu</i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown - Only for roles with access to suggestions and online information requests -->
                @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2 || Auth::user()->role_id === 6))
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" id="notificationDropdown">
                        <i class="material-icons-round">notifications</i>
                        <span class="badge badge-warning navbar-badge" id="notificationCount" style="display: none;">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificationDropdownMenu">
                        <span class="dropdown-item dropdown-header" id="notificationHeader">Tidak ada notifikasi baru</span>
                        <div class="dropdown-divider"></div>
                        <div id="notificationList">
                            <!-- Notifications will be loaded here -->
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer" id="markAllRead" style="display: none;">Tandai semua sudah dibaca</a>
                    </div>
                </li>
                @endif
                <li class="nav-item mr-3">
                    <div class="date-display">
                        <i class="material-icons-round date-icon">today</i>
                        <span class="date-text">{{ date('d M Y') }}</span>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-0" href="/logout">
                        <button class="btn-logout">
                            <i class="material-icons-round">logout</i>
                            <span>Logout</span>
                        </button>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="{{ asset('images/maluku.png') }}" class="brand-image">
                <span class="brand-text font-weight-light">RS dr. M. Haulussy</span>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <p class="d-block text-white">
                            <i class="material-icons-round mr-1" style="font-size: 14px; vertical-align: middle;">verified_user</i>
                            {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                        </p>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2))
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">dashboard</i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('visual-effects.index') }}" class="nav-link {{ request()->is('settings/visual-effects*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">auto_awesome</i>
                                    <p>
                                        Visual Effects
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2 || Auth::user()->role_id === 3))
                            <li class="nav-item">
                                <a href="/bed" class="nav-link {{ request()->is('bed*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">hotel</i>
                                    <p>
                                        Ketersediaan Bed
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2))
                            <li class="nav-item {{ request()->is('article*') || request()->is('news*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('article*') || request()->is('news*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">article</i>
                                    <p>
                                        Postingan
                                        <i class="material-icons-round right" style="font-size: 18px;">keyboard_arrow_down</i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="/article" class="nav-link {{ request()->is('article*') ? 'active' : '' }}">
                                            <i class="nav-icon material-icons-round">description</i>
                                            <p>
                                                Artikel
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/categories" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-tags"></i>
                                            <p>
                                                Kategori Artikel
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/news" class="nav-link {{ request()->is('news*') ? 'active' : '' }}">
                                            <i class="nav-icon material-icons-round">feed</i>
                                            <p>
                                                Berita
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @elseif (Auth::check() && Auth::user()->role_id === 4)
                            <li class="nav-item">
                                <a href="/article" class="nav-link {{ request()->is('article*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">description</i>
                                    <p>
                                        Artikel
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/categories" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Kategori Artikel
                                    </p>
                                </a>
                            </li>
                        @elseif (Auth::check() && Auth::user()->role_id === 5)
                            <li class="nav-item">
                                <a href="/news" class="nav-link {{ request()->is('news*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">feed</i>
                                    <p>
                                        Berita
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2 || Auth::user()->role_id === 7))
                            <li class="nav-item">
                                <a href="/event" class="nav-link {{ request()->is('event*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">photo_library</i>
                                    <p>
                                        Galeri Kegiatan
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2))
                            <li class="nav-item {{ request()->is('room*') || request()->is('treatment*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('room*') || request()->is('treatment*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">payments</i>
                                    <p>
                                        Tarif
                                        <i class="material-icons-round right" style="font-size: 18px;">keyboard_arrow_down</i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="/room" class="nav-link {{ request()->is('room*') ? 'active' : '' }}">
                                            <i class="nav-icon material-icons-round">meeting_room</i>
                                            <p>
                                                Ruangan
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/treatment" class="nav-link {{ request()->is('treatment*') ? 'active' : '' }}">
                                            <i class="nav-icon material-icons-round">healing</i>
                                            <p>
                                                Tindakan
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2))
                            <li class="nav-item {{ request()->is('download*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('download*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">download</i>
                                    <p>
                                        Download
                                        <i class="material-icons-round right" style="font-size: 18px;">keyboard_arrow_down</i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="/download" class="nav-link {{ request()->is('download') || request()->is('download/create') || request()->is('download/*/edit') ? 'active' : '' }}">
                                            <i class="nav-icon material-icons-round">insert_drive_file</i>
                                            <p>
                                                File
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/download-category" class="nav-link {{ request()->is('download-category*') ? 'active' : '' }}">
                                            <i class="nav-icon material-icons-round">category</i>
                                            <p>
                                                Kategori Download
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2 || Auth::user()->role_id === 6))
                            <li class="nav-item">
                                <a href="{{ route('suggestion.index') }}" class="nav-link {{ request()->is('suggestion*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">lightbulb</i>
                                    <p>
                                        Kritik dan Saran
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.request-online-information.index') }}" class="nav-link {{ request()->is('request-online-information*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">contact_support</i>
                                    <p>
                                        Permintaan Informasi Online
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2))
                            <li class="nav-item">
                                <a href="/promkes" class="nav-link {{ request()->is('promkes*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">local_hospital</i>
                                    <p>
                                        Promosi Kesehatan
                                    </p>
                                </a>
                            </li>
                        @endif

                        {{-- iklan --}}
                        @if (Auth::check() && (Auth::user()->role_id === 1 || Auth::user()->role_id === 2))
                        <li class="nav-item">
                            <a href="{{ route('iklan.index') }}" class="nav-link {{ request()->is('iklan*') ? 'active' : '' }}">
                                <i class="nav-icon material-icons-round">campaign</i>
                                <p>
                                    Manajemen Iklan
                                </p>
                            </a>
                        </li>
                        @endif
                        {{-- end of iklan --}}

                        @if (Auth::check() && Auth::user()->role_id === 1)
                            <li class="nav-item">
                                <a href="/account" class="nav-link {{ request()->is('account*') ? 'active' : '' }}">
                                    <i class="nav-icon material-icons-round">people</i>
                                    <p>
                                        Akun
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer" style="
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 15px 30px;
            margin-left: 250px;
        ">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                 <div class="text-muted" style="font-size: 13px;">
                     Made with
                                <svg class="bi bi-suit-heart-fill" xmlns="http://https://w3.org/2000/svg"
                                    width="12" height="12" fill="#F95C19" viewBox="0 0 16 16">
                                    <path
                                        d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z">
                                    </path>
                                </svg>&nbsp;by&nbsp;
                                <a class="fw-bold text-info" href="https://www.instagram.com/rsud.dr.m.haulussy.official/"
                                    target="_blank">RSUD dr. M. Haulussy Ambon</a>
                 </div>
                 <div style="color: #6c757d; font-size: 13px;">
                     © 2025 - All rights reserved
                 </div>
             </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- toastr --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="dist/js/pages/dashboard.js"></script> --}}

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/45.0.0/ckeditor5.umd.js" crossorigin></script>
    <script src="https://cdn.ckeditor.com/ckeditor5-premium-features/45.0.0/ckeditor5-premium-features.umd.js" crossorigin></script>
    <script src="https://cdn.ckbox.io/ckbox/2.6.1/ckbox.js" crossorigin></script>

    @yield('script')

    <!-- Notification Script -->
    <script>
        // Notification sound system using Web Audio API
        // Audio context will be created on first user interaction to comply with browser autoplay policy
        let previousNotificationCount = 0;
        let soundEnabled = localStorage.getItem('notificationSound') !== 'false';

        // Global flags for notification system
        window.playNotificationOnFirstInteraction = false;
        window.showWelcomeModalOnFirstInteraction = false;
        window.welcomeNotificationCount = 0;
        window.welcomeModalShown = false;

        // Check if welcome modal was already shown in this session
        const sessionWelcomeShown = sessionStorage.getItem('welcomeModalShown');
        if (sessionWelcomeShown === 'true') {
            window.welcomeModalShown = true;
        }

        // Create Web Audio API context on first user interaction
        function createAudioContext() {
            if (!window.notificationAudioContext) {
                try {
                    // Create audio context in suspended state to avoid autoplay warning
                    window.notificationAudioContext = new (window.AudioContext || window.webkitAudioContext)();

                    // Immediately suspend to prevent autoplay policy warning
                    if (window.notificationAudioContext.state === 'running') {
                        window.notificationAudioContext.suspend();
                    }
                } catch (error) {
                    console.error('Failed to create audio context:', error);
                }
            }
        }

        // Play notification sound
        function playNotificationSound() {
            if (!soundEnabled) return;

            try {
                // Create audio context if not exists
                createAudioContext();

                // Play Web Audio API beep
                if (window.notificationAudioContext) {
                    playWebAudioBeep();
                } else {
                    console.warn('Web Audio API not available');
                }
            } catch (error) {
                console.error('Audio play error:', error);
            }
        }

        // Play beep using Web Audio API
        function playWebAudioBeep() {
            try {
                const audioContext = window.notificationAudioContext;
                if (!audioContext) return;

                // Resume audio context if suspended (required by browser autoplay policy)
                if (audioContext.state === 'suspended') {
                    audioContext.resume().then(() => {
                        createAndPlayBeep(audioContext);
                    });
                } else {
                    createAndPlayBeep(audioContext);
                }
            } catch (error) {
                console.log('Web Audio API play error:', error);
            }
        }

        // Create and play beep sound
        function createAndPlayBeep(audioContext) {
            try {
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                // Create a pleasant notification sound (two-tone beep)
                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.setValueAtTime(1000, audioContext.currentTime + 0.1);

                gainNode.gain.setValueAtTime(0, audioContext.currentTime);
                gainNode.gain.linearRampToValueAtTime(0.3, audioContext.currentTime + 0.01);
                gainNode.gain.linearRampToValueAtTime(0.2, audioContext.currentTime + 0.1);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.4);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.4);

            } catch (error) {
                console.error('Beep creation error:', error);
            }
        }

        // Toggle sound setting
        function toggleNotificationSound() {
            soundEnabled = !soundEnabled;
            localStorage.setItem('notificationSound', soundEnabled);

            // Show feedback
            const message = soundEnabled ? 'Suara notifikasi diaktifkan' : 'Suara notifikasi dinonaktifkan';
            if (typeof toastr !== 'undefined') {
                toastr.info(message);
            } else {
                alert(message);
            }


        }

        // Show welcome notification modal on first login
        function showWelcomeNotificationModal(count) {
            // Prevent showing modal multiple times
            if (window.welcomeModalShown) {
                return;
            }
            window.welcomeModalShown = true;

            // Save to sessionStorage to prevent showing on refresh
            sessionStorage.setItem('welcomeModalShown', 'true');

            // Play notification sound immediately when showing modal
            if (soundEnabled) {
                playNotificationSound();
            }

            if (typeof toastr !== 'undefined') {
                const message = count === 1
                    ? 'Selamat datang! Anda memiliki 1 notifikasi yang belum dibaca.'
                    : `Selamat datang! Anda memiliki ${count} notifikasi yang belum dibaca.`;

                toastr.info(message, 'Notifikasi Menunggu', {
                    timeOut: 5000,
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    showDuration: 200,
                    hideDuration: 800,
                    extendedTimeOut: 1500,
                    showEasing: 'swing',
                    hideEasing: 'linear',
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut'
                });
            }

            // Also show browser notification if supported
            if ('Notification' in window && Notification.permission === 'granted') {
                const message = count === 1
                    ? 'Anda memiliki 1 notifikasi yang belum dibaca'
                    : `Anda memiliki ${count} notifikasi yang belum dibaca`;

                new Notification('RSUD Haulussy - Selamat Datang', {
                    body: message,
                    icon: '/favicon.ico',
                    tag: 'rsud-welcome-notification',
                    requireInteraction: false
                });
            }
        }

        $(document).ready(function() {
            // Request browser notification permission
            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission().then(function(permission) {
                    console.log('Notification permission:', permission);
                });
            }

            // Enable audio context on first user interaction
            function enableAudioOnInteraction() {
                createAudioContext();
                if (window.notificationAudioContext && window.notificationAudioContext.state === 'suspended') {
                    window.notificationAudioContext.resume().then(() => {
                        // Play notification sound if there were notifications on first load (backup)
                        if (window.playNotificationOnFirstInteraction && soundEnabled && !window.welcomeModalShown) {
                            setTimeout(() => {
                                playNotificationSound();
                                window.playNotificationOnFirstInteraction = false;
                            }, 200);
                        }

                        // Show welcome modal if there were notifications on first load (backup)
                        if (window.showWelcomeModalOnFirstInteraction && !window.welcomeModalShown) {
                            setTimeout(() => {
                                showWelcomeNotificationModal(window.welcomeNotificationCount);
                                window.showWelcomeModalOnFirstInteraction = false;
                            }, 500);
                        }
                    }).catch(() => {
                        // Ignore resume errors
                    });
                }
                // Remove event listeners after first interaction
                document.removeEventListener('click', enableAudioOnInteraction);
                document.removeEventListener('keydown', enableAudioOnInteraction);
                document.removeEventListener('touchstart', enableAudioOnInteraction);
            }

            // Add event listeners for user interaction
            document.addEventListener('click', enableAudioOnInteraction);
            document.addEventListener('keydown', enableAudioOnInteraction);
            document.addEventListener('touchstart', enableAudioOnInteraction);

            // Clear session storage when logout link is clicked
            $(document).on('click', 'a[href*="logout"]', function() {
                sessionStorage.removeItem('welcomeModalShown');
            });

            // Load notifications if notification elements exist
            if ($('#notificationDropdown').length > 0) {
                // Load initial notifications and set baseline count
                loadInitialNotifications();

                // Refresh notifications every 30 seconds
                setInterval(loadNotifications, 30000);

                // Mark all as read
                $('#markAllRead').click(function(e) {
                    e.preventDefault();
                    markAllAsRead();
                });

                // Add sound toggle button to notification dropdown
                const soundToggleBtn = `
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-center" id="soundToggle">
                        <i class="material-icons-round">${soundEnabled ? 'volume_up' : 'volume_off'}</i>
                        ${soundEnabled ? 'Matikan Suara' : 'Aktifkan Suara'}
                    </a>
                `;

                // Add sound toggle after notifications list
                $('#notificationList').after(soundToggleBtn);

                // Handle sound toggle click
                $(document).on('click', '#soundToggle', function(e) {
                    e.preventDefault();
                    toggleNotificationSound();

                    // Update button text and icon
                    const icon = soundEnabled ? 'volume_up' : 'volume_off';
                    const text = soundEnabled ? 'Matikan Suara' : 'Aktifkan Suara';
                    $(this).html(`<i class="material-icons-round">${icon}</i> ${text}`);
                });
            }
        });

        function loadInitialNotifications() {
            @if(Auth::check())
            $.get('{{ route("notifications.unread") }}', function(data) {
                // Set initial count and play sound if there are notifications
                previousNotificationCount = 0; // Start from 0 to trigger sound for existing notifications
                updateNotificationUI(data);

                // Show welcome modal if there are notifications and modal hasn't been shown in this session
                if (data.count > 0 && !window.welcomeModalShown) {
                    setTimeout(() => {
                        showWelcomeNotificationModal(data.count);
                    }, 300);

                    // Set backup flags for user interaction
                    window.showWelcomeModalOnFirstInteraction = true;
                    window.welcomeNotificationCount = data.count;
                    window.playNotificationOnFirstInteraction = true;
                }

                // Set the count for future comparisons
                previousNotificationCount = data.count;
            }).fail(function() {
                // Handle error silently
                previousNotificationCount = 0;
                updateNotificationUI({notifications: [], count: 0});
            });
            @else
            previousNotificationCount = 0;
            updateNotificationUI({notifications: [], count: 0});
            @endif
        }

        function loadNotifications() {
            @if(Auth::check())
            $.get('{{ route("notifications.unread") }}', function(data) {
                updateNotificationUI(data);
            }).fail(function() {
                // Handle error silently
                updateNotificationUI({notifications: [], count: 0});
            });
            @else
            updateNotificationUI({notifications: [], count: 0});
            @endif
        }

        function updateNotificationUI(data) {
            const count = data.count;
            const notifications = data.notifications;

            // Check for new notifications and play sound
            if (previousNotificationCount > 0 && count > previousNotificationCount) {
                // New notification detected, play sound
                playNotificationSound();

                // Add visual feedback - animate notification icon
                const notificationIcon = $('#notificationDropdown .material-icons-round');
                if (notificationIcon.length) {
                    notificationIcon.addClass('animate__animated animate__bounce');
                    setTimeout(() => {
                        notificationIcon.removeClass('animate__animated animate__bounce');
                    }, 1000);
                }

                // Show browser notification if supported and permitted
                if ('Notification' in window && Notification.permission === 'granted') {
                    const latestNotification = notifications[0];
                    if (latestNotification && latestNotification.data) {
                        new Notification('RSUD Haulussy - Notifikasi Baru', {
                            body: latestNotification.data.message || 'Ada notifikasi baru untuk Anda',
                            icon: '/favicon.ico',
                            tag: 'rsud-notification',
                            requireInteraction: false
                        });
                    }
                }

                // Show toast notification as fallback
                if (typeof toastr !== 'undefined') {
                    const latestNotification = notifications[0];
                    if (latestNotification && latestNotification.data) {
                        toastr.info(latestNotification.data.message || 'Ada notifikasi baru untuk Anda', 'Notifikasi Baru', {
                            timeOut: 5000,
                            closeButton: true,
                            progressBar: true
                        });
                    }
                }
            }

            // Update previous count for next comparison
            previousNotificationCount = count;

            // Update badge
            if (count > 0) {
                $('#notificationCount').text(count).show();
                $('#notificationHeader').text(count + ' notifikasi baru');
                $('#markAllRead').show();
            } else {
                $('#notificationCount').hide();
                $('#notificationHeader').text('Tidak ada notifikasi baru');
                $('#markAllRead').hide();
            }

            // Update notification list
            let notificationHtml = '';
            notifications.forEach(function(notification) {
                const data = notification.data;
                notificationHtml += `
                    <a href="#" class="dropdown-item notification-item" data-id="${notification.id}" data-url="${data.url || '#'}">
                        <div class="notification-icon">
                            <i class="material-icons-round">${data.type === 'suggestion' ? 'feedback' : 'info'}</i>
                        </div>
                        <div class="notification-content">
                            <div class="dropdown-item-title">${data.title}</div>
                            <div class="text-sm">${data.message}</div>
                            <div class="text-muted">
                                <i class="material-icons-round">schedule</i>
                                ${(() => {
                                    const date = new Date(notification.created_at);
                                    if (isNaN(date.getTime())) return 'Tanggal tidak valid';
                                    return date.toLocaleString('id-ID', {
                                        day: 'numeric',
                                        month: 'short',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        hour12: false
                                    });
                                })()}
                            </div>
                        </div>
                        <div class="notification-meta">
                            <span class="float-right"><i class="material-icons-round">star</i></span>
                        </div>
                    </a>
                `;
            });

            $('#notificationList').html(notificationHtml);

            // Add click handler for individual notifications
            $('.notification-item').click(function(e) {
                e.preventDefault();
                const notificationId = $(this).data('id');
                const notificationUrl = $(this).data('url');

                // Mark as read first
                markAsRead(notificationId);

                // Then redirect to the notification URL if available
                if (notificationUrl && notificationUrl !== '#') {
                    setTimeout(function() {
                        window.location.href = notificationUrl;
                    }, 500);
                }
            });
        }

        function markAsRead(notificationId) {
            $.post('{{ route("notifications.mark-read") }}', {
                notification_id: notificationId,
                _token: '{{ csrf_token() }}'
            }, function() {
                loadNotifications();
            });
        }

        function markAllAsRead() {
            $.post('{{ route("notifications.mark-read") }}', {
                _token: '{{ csrf_token() }}'
            }, function() {
                loadNotifications();
            });
        }
    </script>

</body>

</html>
