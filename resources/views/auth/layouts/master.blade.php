<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="shortcut icon" href="/resources/admin/img/favicon.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
    <body class="login-page">
        <div class="login-box">
          <div class="login-box-body">
            @yield('content')
          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        @foreach ($bodyScripts as $script)
            {!! HTML::script($script) !!}
        @endforeach
        @yield('javascript')
    </body>
</html>
