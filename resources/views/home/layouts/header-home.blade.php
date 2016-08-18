<!--HEADER-->
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" style="margin-top: 20px"
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
            <h1 class="h1-mobile">Find Your Court</h1>
            <div class="col-md-12">
                {!!  Form::open(array('route' => 'home.search','method' => 'post','id'=>'cc-search-form')) !!}
                <div class="form-group col-md-4 col-xs-12 form-icon">
                    <i class="fa fa-map-marker"></i>
                    <input type="text" class="form-control" name="s_name" id="q" oninvalid="this.setCustomValidity('A location is required')" oninput="setCustomValidity('')" required title="A location is required"
                           placeholder="Search by City or Club Name" autocomplete="off" data-country="us">
                </div>
                <div class="form-group col-md-2 col-xs-6 md-fright form-icon">
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
                <div class="form-group col-md-2 col-xs-6 md-fright form-icon group-search-home-timepicker">
                    <?php
                    $arr_time = [
                            '6:00' => '6:00 AM','6:30' => '6:30 AM','7:00' => '7:00 AM','7:30' => '7:30 AM',
                            '8:00' => '8:00 AM','8:30' => '8:30 AM','9:00' => '9:00 AM','9:30' => '9:30 AM','10:00' => '10:00 AM','10:30' => '10:30 AM',
                            '11:00' => '11:00 AM','11:30' => '11:30 AM','12:00' => '12:00 PM','12:30' => '12:30 PM','13:00' => '1:00 PM','13:30' => '1:30 PM',
                            '14:00' => '2:00 PM','14:30' => '2:30 PM','15:00' => '3:00 PM','15:30' => '3:30 PM','16:00' => '4:00 PM','16:30' => '4:30 PM',
                            '17:00' => '5:00 PM','17:30' => '5:30 PM','18:00' => '6:00 PM','18:30' => '6:30 PM','19:00' => '7:00 PM','19:30' => '7:30 PM',
                            '20:00' => '8:00 PM','20:30' => '8:30 PM','21:00' => '9:00 PM','21:30' => '9:30 PM','22:00' => '10:00 PM',
                            '22:30' => '10:30 PM','23:00' => '11:00 PM','23:30' => '11:30 PM','24:00' => '12:00 AM', '0:30' => '12:30 AM','1:00' => '1:00 AM','1:30' => '1:30 AM','2:00' => '2:00 AM','2:30' => '2:30 AM',
                            '3:00' => '3:00 AM','3:30' => '3:30 AM','4:00' => '4:00 AM','4:30' => '4:30 AM',
                            '5:00' => '5:00 AM','5:30' => '5:30 AM'
                    ] ;
                    ?>
                    <i class="fa fa-clock-o"></i>
                    <input type="text" class="form-control glyphicon glyphicon-time" id="search-timepicker-text" placeholder="Time" readonly="readonly">
                    <input type="hidden" name="s_time" id="search-timepicker">
                    <div class="search-tooltip hidden">
                        <div class="tooltiptext time-kicker">
                            <div >
                                <label for="opentime">Start Time</label>
                                {!! Form::select('cc-input-search-time', $arr_time,"6:00", ['id'=>'cc-input-search-time', 'class' => 'form-control search-time select2']) !!}
                            </div>
                            <div>
                                <br>
                                <label for="opentime">Length</label>
                                <input id="mb-book-in-hour" class="ionslider" type="text" name="mb-book-in-hour" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2 col-xs-6 form-icon">
                    <i style="background-image: url('resources/home/images/racket_05.png');width: 28px; height: 18px;"></i>
                    {!! Form::selectRange('court',1,4,1,['id'=>'inputID','class' => 'form-control placeholder-single select2','placeholder'=>'# Courts', 'required'=> 'required']) !!}
                            <!-- <input type="text" class="form-control" name="" id="" placeholder="# Courts"> -->
                </div>
                <div class="form-group col-md-2 col-xs-6">
                    <button type="submit" class="btn btn-search">SEARCH</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!--END HEADER-->
<!--App bar-->
<div class="app-bar" style="padding: 11px 0 11px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-12 divine-appbar-r">
                <a href="{!! route("home.deals") !!}" style="text-decoration: none; color: #fff"><span>Click here to find the best deals</span></a>
            </div>
            <div class="col-md-8 col-xs-12 divine-appbar-l" style="display: none !important;">
                <div class="col-md-4 col-xs-12" style="font-size: 14px; line-height: 1.2em; margin-top: 10px">
                    Download the<br>
                    <span style="color: #63ac1e">Court Connect</span> App
                </div>
                <div class="col-md-4 col-xs-6">
                    <a href=""><img src="resources/home/images/app-store_05.png"></a>
                </div>
                <div class="col-md-4 col-xs-6">
                    <a href=""><img src="resources/home/images/play-store_09.png"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--END App bar-->
