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
    <div class="row">
        <h2 style="color: #63ac1e; margin-top: 77px">Deals Near You</h2>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="col-md-4">
                        <div class="img-carousel">
                            <img src="resources/home/images/pro1_08.jpg" alt="Chania">
                        </div>
                        <div class="caption title-carousel">
                            Tiger Racquet Club
                        </div>
                        <div class="caption location-carousel">
                            West Caldwell, NJ
                        </div>
                        <hr>
                        <div class="caption datetime-carousel">
                            <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                class="glyphicon glyphicon-time"></i> 8-9AM
                        </div>
                        <div class="caoption price-carousel">
                            $38
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-carousel">
                            <img src="resources/home/images/pro2_14.jpg" alt="Chania">
                        </div>
                        <div class="caption title-carousel">
                            Clifton Racquet Club
                        </div>
                        <div class="caption location-carousel">
                            West Caldwell, NJ
                        </div>
                        <hr>
                        <div class="caption datetime-carousel">
                            <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                class="glyphicon glyphicon-time"></i> 8-9AM
                        </div>
                        <div class="caoption price-carousel">
                            $42
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-carousel">
                            <img src="resources/home/images/pro3_20.jpg" alt="Flower">
                        </div>
                        <div class="caption title-carousel">
                            Tiger Racquet Club
                        </div>
                        <div class="caption location-carousel">
                            West Caldwell, NJ
                        </div>
                        <hr>
                        <div class="caption datetime-carousel">
                            <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                class="glyphicon glyphicon-time"></i> 8-9AM
                        </div>
                        <div class="caoption price-carousel">
                            $38
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="col-md-4">
                        <div class="img-carousel">
                            <img src="resources/home/images/pro2_14.jpg" alt="Chania">
                        </div>
                        <div class="caption title-carousel">
                            Tiger Racquet Club
                        </div>
                        <div class="caption location-carousel">
                            West Caldwell, NJ
                        </div>
                        <hr>
                        <div class="caption datetime-carousel">
                            <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                class="glyphicon glyphicon-time"></i> 8-9AM
                        </div>
                        <div class="caoption price-carousel">
                            $38
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-carousel">
                            <img src="resources/home/images/pro1_08.jpg" alt="Chania">
                        </div>
                        <div class="caption title-carousel">
                            Tiger Racquet Club
                        </div>
                        <div class="caption location-carousel">
                            West Caldwell, NJ
                        </div>
                        <hr>
                        <div class="caption datetime-carousel">
                            <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                class="glyphicon glyphicon-time"></i> 8-9AM
                        </div>
                        <div class="caoption price-carousel">
                            $38
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-carousel">
                            <img src="resources/home/images/pro3_20.jpg" alt="Flower">
                        </div>
                            <div class="caption title-carousel">
                                    Tiger Racquet Club
                                </div>
                                <div class="caption location-carousel">
                                    West Caldwell, NJ
                                </div>
                                <hr>
                                <div class="caption datetime-carousel">
                                    <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                        class="glyphicon glyphicon-time"></i> 8-9AM
                                </div>
                                <div class="caoption price-carousel">
                                    $38
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-md-4">
                                <div class="img-carousel">
                                    <img src="resources/home/images/pro1_08.jpg" alt="Chania">
                                </div>
                                <div class="caption title-carousel">
                                    Tiger Racquet Club
                                </div>
                                <div class="caption location-carousel">
                                    West Caldwell, NJ
                                </div>
                                <hr>
                                <div class="caption datetime-carousel">
                                    <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                        class="glyphicon glyphicon-time"></i> 8-9AM
                                </div>
                                <div class="caoption price-carousel">
                                    $38
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-carousel">
                                    <img src="resources/home/images/pro3_20.jpg" alt="Flower">
                                </div>
                                <div class="caption title-carousel">
                                    Tiger Racquet Club
                                </div>
                                <div class="caption location-carousel">
                                    West Caldwell, NJ
                                </div>
                                <hr>
                                <div class="caption datetime-carousel">
                                    <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                        class="glyphicon glyphicon-time"></i> 8-9AM
                                </div>
                                <div class="caoption price-carousel">
                                    $38
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-carousel">
                                    <img src="resources/home/images/pro2_14.jpg" alt="Chania">
                                </div>
                                <div class="caption title-carousel">
                                    Tiger Racquet Club
                                </div>
                                <div class="caption location-carousel">
                                    West Caldwell, NJ
                                </div>
                                <hr>
                                <div class="caption datetime-carousel">
                                    <i class="glyphicon glyphicon-calendar"></i> Februray 12th &nbsp; <i
                                        class="glyphicon glyphicon-time"></i> 8-9AM
                                </div>
                                <div class="caoption price-carousel">
                                    $38
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
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