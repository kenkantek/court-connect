<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="shortcut icon" href="/resources/admin/img/favicon.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
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
    <body class="skin-blue sidebar-mini  pace-done sidebar-collapse">
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
                    <div class="navbar-header-menu">
                        <div class="header-block col-md-3">
                            <div class="info-box-img">
                            <img src="{{ asset('uploads/images/tiger-raquest.jpeg') }}" class="club-thump-image" alt="Club Image"/>
                            </div>

                            <div class="info-box-content text-center">
                              <span class="info-box-text">Managing</span>
                              <select name="club" id="club">
                                  <option>Tiger Raquest Club</option>
                              </select>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <div class="col-md-6 text-center">
                              <h1>
                                    @yield('title_heading')
                              </h1>
                          </div>
                          <div class="col-md-3">
                              <ul class="nav navbar-nav pull-right">
                                <li class="pull-right">
                                    <a href="{{ route('auth.logout') }}" style="font-size: 35px"><i class="fa fa-sign-out"></i></a>
                                </li>
                                <li class="user user-menu pull-right">
                                    <a href="#">
                                        <label class="hidden-xs">Login</label>
                                        <img src="{{ url(Auth::user()->avatar) }}" class="user-image" alt="User Image"/>
                                        <span class="hidden-xs">{{ Auth::user()->getFullName() }}</span>
                                    </a>
                                </li>

                            </ul>
                          </div>

                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header"><strong>Content Management</strong></li>
                        <li><a href="/sadmin"><i class="fa fa-home"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-area-chart"></i></a>

                    </li>
                    <li>
                        <a href="{{ route('users.list') }}"><i class="fa fa-users"></i></a>
                    </li>
                    <li>
                        <a href="{{ route('clubs.setting') }}">
                            <i class="fa fa-cogs"></i>
                        </a>
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
