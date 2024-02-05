<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/assets/image/unsap1.png') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    @laravelPWA
</head>

<body>

    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
    </div>

    <div id="main-wrapper">

        <div class="nav-header">
            <a href="{{ route('dashboard.index') }}" class="brand-logo">
                <img class="logo-abbr" src="https://ui-avatars.com/api/?name=R" style="width: 200px !important;">
                {{-- <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt=""> --}}
                <span class="brand-title" style="font-size:12px;font-weight: bold; color: rgb(150, 155, 160);">Risky
                    Tailor</span>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                @yield('title_menu')
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <img src="https://ui-avatars.com/api/?background=random&rounded=true&name=R"
                                        width="20" style="object-fit: cover;" alt="" />
                                    <div class="header-info">
                                        <span
                                            class="text-black"><strong>{{ Auth::guard('admin')->user()->username }}</strong></span>
                                        <p class="fs-12 mb-0">
                                            {{ ucwords(str_replace('_', ' ', Auth::guard('admin')->user()->role)) }}
                                        </p>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('admin.logout') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="deznav">
            <div class="deznav-scroll mm-active">
                <ul class="metismenu mm-show" id="menu">
                    <li class="">
                        <a class="ai-icon" href="{{ route('dashboard.index') }}" aria-expanded="false">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="ai-icon" href="{{ route('kemeja.index') }}" aria-expanded="false">
                            <i class="fas fa-shirt"></i>
                            <span class="nav-text">Kemeja</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="ai-icon" href="{{ route('kain.index') }}" aria-expanded="false">
                            <i class="fas fa-scroll"></i>
                            <span class="nav-text">Kain</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="ai-icon" href="{{ route('ukuran.index') }}" aria-expanded="false">
                            <i class="fas fa-expand"></i>
                            <span class="nav-text">Ukuran</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="ai-icon" href="{{ route('lengan.index') }}" aria-expanded="false">
                            <i class="fas fa-thumbs-up"></i>
                            <span class="nav-text">Lengan</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="ai-icon" href="{{ route('portpolio.index') }}" aria-expanded="false">
                            <i class="fas fa-shirt"></i>
                            <span class="nav-text">Portpolio</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="ai-icon" href="{{ route('estimasi.index') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <span class="nav-text">Pemesanan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a><i><b>Risky</b>Tailor</i></a> 2023</p>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

    @yield('js')
</body>

</html>
