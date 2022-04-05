<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('dashboard/img/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ Request::path() }}
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('dashboard/css/material-dashboard.css?v=3.0.1') }}" rel="stylesheet" />
    @livewireStyles
</head>

<body class="g-sidenav-show  bg-gray-200">

    @if($user = Auth::user())

    @if($user->role_id == 1 && $user->role = "admin")
    <!--Begin::Sidebar-->
    @include('livewire.admin.dashboard.partials.sidebar')
    <!--Begin::Sidebar-->
    @endif

    @if($user->role_id == 2 && $user->role = "business")
    <!--Begin::Sidebar-->
    @include('livewire.business.dashboard.partials.sidebar')
    <!--Begin::Sidebar-->
    @endif

    @if($user->role_id == 3 && $user->role = "client")
    <!--Begin::Sidebar-->
    @include('livewire.client.dashboard.partials.sidebar')
    <!--Begin::Sidebar-->
    @endif

    @endif

    <!--Begin::Main-->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!--Begin::Top Bar-->
        @include('livewire.admin.dashboard.partials.top-bar')
        <!--End::Top Bar-->

        <!--Begin::Section-->
        @yield('content')
        <!--Begin::Section-->

    </main>
    <!--End::Main-->

    <!--   Core JS Files   -->
    <script src="{{ asset('dashboard/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('dashboard/js/material-dashboard.min.js?v=3.0.1') }}"></script>
    @livewireScripts
</body>

</html>
