@extends('home.layouts.master')
@extends('home.layouts.header-home')
@section('content')
        <!--Content-->
<div class="row">
    <div class="container content">
        {{-- @yield('content') --}}
        <h2>How <span>Court Connect</span> Works</h2>

        <div class="row line-content">
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="resources/home/images/search_07.png" alt="">
                </div>

                <div class="caption title">Search</div>
                <div class="caption">Explore over 1,000’s courts to find the one perfect for you</div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="resources/home/images/book_09.png" alt="">
                </div>

                <div class="caption title">Book</div>
                <div class="caption">
                    A couple of clicks and you’re booked! Manage your bookings in your account
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="resources/home/images/play_13.png" alt="">
                </div>

                <div class="caption title">Play</div>
                <div class="caption">
                    Arrive at your selected venue with you booking refrence and get playing
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
</div>
<!--End Content-->

<!--Footer-->
<div class="row club">
    <div class="container">
        <div class="col-md-8">
            <p style="color: #eaffd6; font-family: RobotoThin, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 22px">
                Club Owners!</p>

            <p style="color: #eaffd6; font-family: RobotoThin, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px">
                This is Photoshop's version of auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. </p>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-club">Find Out More</a>
        </div>
    </div>
</div>
@stop