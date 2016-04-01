<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Court Connect</title>

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


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
                <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&language=en"></script>
                <link rel="stylesheet" type="text/css" href="http://www.jqueryscript.net/demo/City-Autocomplete-Plugin-with-jQuery-Google-Places-API/city-autocomplete.css"/>
                <script src="http://www.jqueryscript.net/demo/City-Autocomplete-Plugin-with-jQuery-Google-Places-API/jquery.city-autocomplete.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">    
    @yield('header')  
    @yield('banner')
    @yield('content')        
    <div class="row footer">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-4" style="border-right: 2px solid rgba(101, 117, 86, 0.5)">
                            <span>COMPANY</span>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Press</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4" style="border-right: 2px solid rgba(101, 117, 86, 0.5);min-height: 140px">
                            <span>LEGAL</span>
                            <ul>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4" style="border-right: 2px solid rgba(101, 117, 86, 0.5);min-height: 140px">
                            <span>HELP</span>
                            <ul>
                                <li><a href="#">Support Center</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <span>CONNECT WITH US</span>

                    <div class="social"><i class="fa fa-facebook"></i> <i class="fa fa-twitter"></i> <i
                            class="fa fa-linkedin"></i></div>
                </div>
            </div>
            <div class="row copyright">
                Copyright © 2016 Open Sports, LLC New Jersey - All Rights Reserved
            </div>
        </div>
    </div>
    <!--End footer-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <img style="margin: 0 auto" src="{{ asset('resources/home/images/logo-color_05.png') }}" class="img-responsive" alt="Image">

                    <p style="margin-bottom:20px;margin-top: 34px;color: #082e31;font-family: RobotoBlackItalic, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 24px">
                        Club Owners - Request an Account</p>

                    <p style="padding:0 45px 0 45px; text-align:left ;color: #a0a0a0; font-family: RobotoRegular, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px">
                        Court Connect is a complete schedualing solution to connect your club with tennis fans. Call us
                        now
                        to discuss how managing and taking bookings can be made easy using Court-Connect.com</p>

                    <p style="margin-top:55px;margin-bottom:35px;color: #082e31; font-size: 31px"><span
                            style="font-family: RobotoThin, 'Helvetica Neue', Helvetica, Arial, sans-serif;">Call</span>
                        <span style="font-family: RobotoRegular, 'Helvetica Neue', Helvetica, Arial, sans-serif;">123-456-789</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="calendar-switch">

    </div>

    @foreach ($bodyScripts as $script)
        {!! HTML::script($script) !!}
    @endforeach

    @yield('javascript')

</div>
</body>
</html>
