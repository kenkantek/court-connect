@extends('home.layouts.master')

@section('header')
<!--HEADER-->
    <div class="row header">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="logo"><img src="resources/home/images/logo_02.png" class="img-responsive logo" alt="logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Club Owners <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <span class="arrow-up"></span>

                                <form action="#" class="dropdown-wg" method="post" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" id=""
                                               placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id=""
                                               placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-login">Login</button>
                                    <div class="form-group">
                                        <a href=""><label class="form-label">Forgot Password?</label></a>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-family: RobotoBlackItalic, 'Helvetica Neue', Helvetica, Arial, sans-serif;color: #0f0f0f;font-size: 20px; font-weight: normal">Manage
                                            a Tennis Club?</label>
                                        <a data-toggle="modal" data-target="#myModal"><label class="form-label">Request
                                            an
                                            account</label></a>
                                    </div>
                                </form>

                            </ul>
                        </li>
                        <li><a href="#">New Player</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Player Login <b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <span class="arrow-up"></span>

                                <form action="#" class="dropdown-wg" method="post" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" id=""
                                               placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id=""
                                               placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-login">Login</button>
                                    <div class="form-group">
                                        <a href=""><label class="form-label">Forgot Password?</label></a>
                                    </div>
                                    <div class="form-group" style="text-align: center">
                                        <label class="line-label"><span>OR</span></label>
                                    </div>
                                    <div class="form-group" style="text-align: center; margin-bottom: 0px">
                                        <button type="submit" name="facebook-sigin" class="btn-login-facebook"></button>
                                    </div>

                                </form>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            <div class="row">
                <h1>Find Your Court</h1>

                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post" role="form">
                            <div class="form-group col-md-4 form-icon">
                                <i class="fa fa-map-marker"></i>
                                <input type="text" class="form-control" name="" id=""
                                       placeholder="Seach by Zip/Address or Club Name">
                            </div>
                            <div class="form-group col-md-2 form-icon">
                                <i class="fa fa-calendar"></i>
                                <input type="text" class="form-control" name="" id="datepicker" placeholder="Date">

                                <p align="center"
                                   style="color: white; font-family: RobotoLight, 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 13px; margin-top: 5px">
                                    Contract Time Booking</p>
                            </div>
                            <div class="form-group col-md-2 form-icon">
                                <i class="glyphicon glyphicon-time"></i>
                                <input type="text" class="form-control" name="" id="timepicker" placeholder="Time">
                            </div>
                            <div class="form-group col-md-2 form-icon">
                                <i style="background-image: url('resources/home/images/racket_05.png');width: 28px; height: 18px;"></i>
                                <!--<select name="court" id="inputID" class="form-control">-->
                                <!--<option value=""> # Courts </option>-->
                                <!--</select>-->
                                <input type="text" class="form-control" name="" id="" placeholder="# Courts">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-search">SEARCH</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END HEADER-->
    <!--App bar-->
    <div class="row app-bar" style="padding: 11px 0 11px 0">
        <div class="container">
            <div class="col-md-6 divine-appbar-r">
                <span>Looking For The Best Deals?</span> Click here
            </div>
            <div class="col-md-6 divine-appbar-l">
                <div class="col-md-4" style="font-size: 14px; line-height: 1.2em; margin-top: 10px">
                    Download the<br>
                    <span style="color: #63ac1e">Court Connect</span> App
                </div>
                <div class="col-md-4">
                    <a href=""><img src="resources/home/images/app-store_05.png"></a>
                </div>
                <div class="col-md-4">
                    <a href=""><img src="resources/home/images/play-store_09.png"></a>
                </div>
            </div>
        </div>
    </div>
    <!--END App bar-->
@stop
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