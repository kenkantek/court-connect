<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="shortcut icon" href="/resources/admin/img/favicon.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @foreach ($stylesheets as $style)
            {!! HTML::style($style) !!}
        @endforeach

        @foreach ($headScripts as $script)
        @if (is_array($script))
            {!! HTML::script($script['url']) !!}
            @if ($script['fallback'])
            <script>window.{!! $script['fallback'] !!} || document.write('<script src="{{ $script['fallbackURL'] }}"><\/script>')</script>
            @endif
        @else
            {!! HTML::script($script) !!}
        @endif
        @endforeach
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{ route('admin.index') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b><img src="{{ url('/uploads/images/logo.png') }}" width="40"></b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b><img src="{{ url('/uploads/images/logo.png') }}" width="70"></b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ url(Auth::user()->avatar) }}" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs">{{ Auth::user()->getFullName() }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{ url(Auth::user()->avatar) }}" class="img-circle" alt="User Image" />
                                        <p>
                                            {{ Auth::user()->getFullName() }}
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-primary btn-flat"><i class="fa fa-user"></i> View profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('auth.logout') }}" class="btn btn-danger btn-flat"><i class="fa fa-power-off"></i> Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ url(Auth::user()->avatar) }}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->getFullName() }}</p>
                            <p><a target="_blank" href="{{ route('home.index') }}"><i class="fa fa-home text-success"></i><small> View Website</small></a></p>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header"><strong>Content Management</strong></li>
                        <li><a href="/sadmin"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Users</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('users.create') }}"><i class="fa fa-plus-circle"></i> Create New User</a>
                                <a href="{{ route('users.list') }}"><i class="fa fa-list-alt"></i> All Users</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: auto">
            <!-- Main content -->
            <section class="content">
                @yield('content')
                </section><!-- /.content -->
                </div><!-- /.content-wrapper -->
                <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                        Version 1.0.
                    </div>
                    <strong>Copyright &copy; 2016 Court Connect.</strong> All rights reserved.
                </footer>
                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Home tab content -->
                        <div class="tab-pane" id="control-sidebar-home-tab">
                        </div><!-- /.tab-pane -->
                    </div>
                </aside><!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class='control-sidebar-bg'></div>
        </div><!-- ./wrapper -->

        <div data-base-url="{{ url('/') }}"></div>
        
        @include('admin.elements.notice')

        @foreach ($bodyScripts as $script)
            {!! HTML::script($script) !!}
        @endforeach
        @yield('javascript')
    </body>
</html>
