<!--HEADER-->
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>
        <div class="row">
            <h1>Find Your Court</h1>
            <div class="col-md-12">
                {!!  Form::open(array('route' => 'home.search','method' => 'post','id'=>'cc-search-form')) !!}
                <div class="form-group col-md-4 form-icon">
                    <i class="fa fa-map-marker"></i>
                    <input type="text" class="form-control" name="s_name" id="q" oninvalid="this.setCustomValidity('A location is required')" oninput="setCustomValidity('')" required title="A location is required"
                           placeholder="Search by City or Club Name" autocomplete="off" data-country="us">
                </div>
                <div class="form-group col-md-2 form-icon">
                    <i class="fa fa-calendar"></i>
                    <input type="text" class="form-control" name="date" id="datepicker" placeholder="Date">

                    <div id="calendar-switch">
                        <span id="calendar-switch-header">Select the days of the week<br/>you'd like to book</span>
                        <div id="day-of-week">
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label class="checkbox-inline"><input type="checkbox" name="dayOfWeek[]" value="1" id="mondays">Mondays</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="checkbox-inline"><input type="checkbox" name="dayOfWeek[]" value="6" id="saturdays">Saturdays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label class="checkbox-inline"><input type="checkbox" name="dayOfWeek[]" value="2" id="tuesdays">Tuesdays</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="checkbox-inline"><input type="checkbox" name="dayOfWeek[]" value="7" id="sundays">Sundays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label><input type="checkbox" name="dayOfWeek[]" value="3" id="wednesdays">Wednesdays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label><input type="checkbox" name="dayOfWeek[]" value="4" id="thursdays">Thursdays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label><input type="checkbox" name="dayOfWeek[]" value="5" id="fridays">Fridays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div style="padding: 20px 15px 10px 15px;">
                                <button class="btn btn-search" id="calendar-switch-button" type="button">Switch To Open Time Bookings</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2 form-icon group-search-home-timepicker">
                    <i class="glyphicon glyphicon-time"></i>
                    <input type="time" class="form-control" name="s_time" id="search-timepicker" step="1800" placeholder="Time">
                    <div class="search-tooltip hidden">
                        <div class="tooltiptext time-kicker">
                            <div >
                                <label for="opentime">Start Time</label>
                                <input class="form-control search-time" id="cc-input-search-time" value="08:00" type="time" step="1800">
                            </div>
                            <div>
                                <label for="opentime">Length</label>
                                <input id="mb-book-in-hour" class="ionslider" type="text" name="mb-book-in-hour" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2 form-icon">
                    <i style="background-image: url('resources/home/images/racket_05.png');width: 28px; height: 18px;"></i>
                    {!! Form::selectRange('court',1,4,null,['id'=>'inputID','class' => 'form-control placeholder-single','placeholder'=>'# Courts']) !!}
                            <!-- <input type="text" class="form-control" name="" id="" placeholder="# Courts"> -->
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-search">SEARCH</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!--END HEADER-->
<!--App bar-->
<div class="app-bar" style="padding: 11px 0 11px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-4 divine-appbar-r">
                <a href="{!! route("home.deals") !!}" style="text-decoration: none; color: #fff"><span>Click here to find the best deals</span></a>
            </div>
            <div class="col-md-8 divine-appbar-l">
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
</div>
<!--END App bar-->