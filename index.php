<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Court Connect</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui.css">
    <link href="css/jquery-ui-timepicker-addon.css" rel="stylesheet">
    <link href="css/custome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
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
                    <a href="#" class="logo"><img src="images/logo_02.png" class="img-responsive logo" alt="logo"></a>
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
                                <i style="background-image: url('images/racket_05.png');width: 28px; height: 18px;"></i>
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
                    <a href=""><img src="images/app-store_05.png"></a>
                </div>
                <div class="col-md-4">
                    <a href=""><img src="images/play-store_09.png"></a>
                </div>
            </div>
        </div>
    </div>
    <!--END App bar-->

    <!--Content-->
    <div class="row">
        <div class="container content">
            <h2>How <span>Court Connect</span> Works</h2>

            <div class="row line-content">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="images/search_07.png" alt="">
                    </div>

                    <div class="caption title">Search</div>
                    <div class="caption">Explore over 1,000’s courts to find the one perfect for you</div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="images/book_09.png" alt="">
                    </div>

                    <div class="caption title">Book</div>
                    <div class="caption">
                        A couple of clicks and you’re booked! Manage your bookings in your account
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="images/play_13.png" alt="">
                    </div>

                    <div class="caption title">Play</div>
                    <div class="caption">
                        Arrive at your selected venue with you booking refrence and get playing
                    </div>
                </div>
            </div>
            <div class="row line-ball">
                <div class="ball">
                    <img src="images/ball_05.png">
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
                                    <img src="images/pro1_08.jpg" alt="Chania">
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
                                    <img src="images/pro2_14.jpg" alt="Chania">
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
                                    <img src="images/pro3_20.jpg" alt="Flower">
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
                                    <img src="images/pro2_14.jpg" alt="Chania">
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
                                    <img src="images/pro1_08.jpg" alt="Chania">
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
                                    <img src="images/pro3_20.jpg" alt="Flower">
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
                                    <img src="images/pro1_08.jpg" alt="Chania">
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
                                    <img src="images/pro3_20.jpg" alt="Flower">
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
                                    <img src="images/pro2_14.jpg" alt="Chania">
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
                    <img style="margin: 0 auto" src="images/logo-color_05.png" class="img-responsive" alt="Image">

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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-timepicker-addon.min.js"></script>
    <script src="js/jquery-ui-timepicker-addon-i18n.min.js"></script>
    <script src="js/jquery-ui-sliderAccess.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepicker').datetimepicker({
                showTimepicker: false,
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");

                        var btn = $('<button class="btn btn-search" style="width:100%; font-size:12px;padding:0;" type="button">Switch To Contract Time Bookings</button>');
                        btn.unbind("click")
                        .bind("click", function () {
                            $("#datepicker").datepicker( "hide" );
                           

                        });

                        buttonPane.replaceWith(btn);

                    }, 1);
                }
            });
            $('#timepicker').timepicker({
                timeOnlyTitle: 'Start Time',
                showButtonPanel: false,
                showHour: false,
                showMinute: false,
                hour: 9,
                timeFormat: 'hh:mm TT',
                timeText: '',                
                timeInput: true,
            });
        });
    </script>
</div>
</body>
</html>