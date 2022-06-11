@include('admin.header')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <a href="{!! route('user.change-language', ['jp']) !!}"><i class="flag-icon flag-icon-jp mr-2" style="border:solid 1px #ccc"></i></a>
        <a href="{!! route('user.change-language', ['vi']) !!}"><i class="flag-icon flag-icon-vn mr-2" style="border:solid 1px #ccc"></i></a>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item">
                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>{{ __('message.user.logout')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('adminInfo') }}" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> {{ __('message.user.info')}}
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('admin.footer')
</body>
</html>
