@extends('home.layouts.master')
@section('header-home')
    @include('home.layouts.header-home')
@stop

@section('content')
    <!--Content-->
    <article class="row">
        <div class="container content">
            {{-- @yield('content') --}}
            <h2>How <span>Court Connect</span> Works</h2>

            <div class="row line-content">
                <div class="col-md-4 col-sm-4">
                    <div class="thumbnail">
                        <img src="resources/home/images/search_07.png" alt="">
                    </div>

                    <div class="caption title">Search</div>
                    <div class="caption">Find nearby clubs with available court time</div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="thumbnail">
                        <img src="resources/home/images/book_09.png" alt="">
                    </div>

                    <div class="caption title">Book</div>
                    <div class="caption">
                        Click to reserve your court
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="thumbnail">
                        <img src="resources/home/images/play_13.png" alt="">
                    </div>

                    <div class="caption title">Play</div>
                    <div class="caption">
                        Arrive at your club and play
                    </div>
                </div>
            </div>
            <div class="row line-ball">
                <div class="ball">
                    <img src="resources/home/images/ball_05.png">
                </div>
            </div>

            <!-- deal -->
        @include('home.partials.deal')
        <!-- end deal -->
        </div>
    </article>
    <!--End Content-->
@stop

@section('content-footer')
    <!--Footer-->
    <article class="club">
        <div class="container">
            <div class="col-md-8">
                <p style="color: #eaffd6; font-family: RobotoThin, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 22px">
                    Club Owners!</p>

                <p style="color: #eaffd6; font-family: RobotoThin, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px">
                    Court Connect can help you fill your court time and help with your books. Click here to learn how to get started with Court Connect today!
                </p>
            </div>
            <div class="col-md-4 text-center">
                <a href="#" class="btn btn-club cc-request-acount">Find Out More</a>
            </div>
        </div>
    </article>

@stop

@section('javascript')
    <script type="application/javascript">
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(function(position)
            {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                var capa = document.getElementById("capa");

                capa.innerHTML = "<input type='hidden' name='lat' value='" + Math.round(latitude*10000)/10000 + "'/><input type='hidden' name='lon' value='" + Math.round(longitude*10000)/10000 + "'/>";

            },function error(msg){alert('Please enable your GPS position future.');
            }, {maximumAge:600000, timeout:5000, enableHighAccuracy: true});
        }else
        {
            alert("Geolocation API is not supported in your browser.");
        }
    </script>
@stop