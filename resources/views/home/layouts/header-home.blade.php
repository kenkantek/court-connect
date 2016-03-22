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
                <a href="{{ route('home.index') }}" class="logo"><img src="resources/home/images/logo_02.png" class="img-responsive logo" alt="logo"></a>
            </div>
            @include('home.layouts.menu')
        </nav>
        <div class="row">
            <h1>Find Your Court</h1>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('home.search') }}" method="get" role="form">
                        {{ csrf_field() }}
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

<div id="calendar-switch">
    <span id="calendar-switch-header">Select the days of the week<br/>you'd like to book</span>
    <div id="day-of-week">
        <div class="checkbox">
            <div class="col-md-6">
                <label class="checkbox-inline"><input type="checkbox" value="" id="mondays">Mondays</label>
            </div>
            <div class="col-md-6">
                <label class="checkbox-inline"><input type="checkbox" value="" id="saturdays">Saturdays</label>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="checkbox">
            <div class="col-md-6">
                <label class="checkbox-inline"><input type="checkbox" value="" id="tuesdays">Tuesday</label>
            </div>
            <div class="col-md-6">
                <label class="checkbox-inline"><input type="checkbox" value="" id="sundays">Sundays</label>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="checkbox">
            <div class="col-md-6">
                <label><input type="checkbox" value="" id="wednesdays">Wednesdays</label>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="checkbox">
            <div class="col-md-6">
                <label><input type="checkbox" value="" id="thursdays">Thursdays</label>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="checkbox">
            <div class="col-md-6">
                <label><input type="checkbox" value="" id="fridays">Fridays</label>
            </div>
            <div class="clearfix"></div>
        </div>
        <div style="padding: 20px 15px 10px 15px;">
            <button class="btn btn-search" id="calendar-switch-button" type="button">Switch To Open Time Bookings</button>
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