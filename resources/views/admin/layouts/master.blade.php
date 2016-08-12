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
    <script>
        var base_url = "{{url('/')}}";
    </script>
</head>
<?php if (!isset($title)) {
    $title = "Booking Manager";
}
?>
<body class="skin-blue sidebar-mini  pace-done sidebar-collapse">
<div class="wrapper">
    <header class="main-header">
        <header-main
                :club-setting-id.sync="clubSettingId"
                :clubs.sync="clubs"
                :delete_club.sync = "delete_club"
                :title="'{!! $title !!}'"
                :user="user"
        ></header-main>

    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"><strong>Content Management {{Request::url()}}</strong></li>
                <li {{ Request::is("sadmin") ? 'class="active"': '' }}>
                    <a href="/sadmin" data-toggle="tooltip" data-placement="right" title="Home"><i class="fa fa-home"></i></a>
                </li>

                <li {{ Request::is("/sadmin/booking/*") ? 'class="active"': '' }}>
                    <a href="{{ route('booking.index') }}" data-toggle="tooltip" data-placement="right" title="Booking"><i class="fa fa-book"></i></a>
                </li>

                @if (Auth::user()->is_super || Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('reports.index') }}" data-toggle="tooltip" data-placement="right" title="Reports"><i class="fa fa-area-chart"></i></a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('users.list') }}" data-toggle="tooltip" data-placement="right" title="Employees"><i class="fa fa-users"></i></a>
                </li>
                <li>
                    <a href="{{ route('teacher.listAll') }}" data-toggle="tooltip" data-placement="right" title="Pros"><i class="fa fa-user-plus"></i></a>
                </li>

                @if (Auth::user()->is_super || Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('clubs.setting') }}" data-toggle="tooltip" data-placement="right" title="Club Setting">
                            <i class="fa fa-cogs"></i>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->is_super)
                    <li>
                        <a href="{{ route('super.index') }}" data-toggle="tooltip" data-placement="right" title="Super Admin">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->is_super || Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('admin.setting') }}" data-toggle="tooltip" data-placement="right" title="Website Setting">
                            <i class="fa fa-th"></i>
                        </a>
                    </li>
                @endif

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

    <div id="cc-confirm-delete" class="modal hide fade">
        <div class="modal-body">
            Are you sure delete?
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" id="cc-submit-delete">Delete</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
        </div>
    </div>

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
<div id="light-overlay-full" class="hide"></div>
<div data-base-url="{{ url('/') }}"></div>

@include('admin.elements.notice')

<script type="text/javascript">
    var userLogin = {
        fullname: '{!! $userLogin->fullname !!}',
        email: '{!! $userLogin->email !!}',
        avatar: '{!! $userLogin->avatar !!}',
        id: {!! $userLogin->id !!},
    };
    jQuery(document).ready(function($) {
        $('#club').change(function(event) {
            var club_id = $(this).val();
            var csrf_token = $('meta[name=csrf-token]').attr('content');
            url = laroute.route('dashboard.context');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {csrf_token: csrf_token,club_id:club_id},
            }).done(function(data) {
                console.log(data);
            }).fail(function(data) {
                console.log("error");
            })
        });
    });
</script>
@foreach ($bodyScripts as $script)
    {!! HTML::script($script) !!}
@endforeach
@yield('javascript')
</body>
</html>
