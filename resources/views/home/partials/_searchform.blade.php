<div class="row">
    <div id="find-your-court">
        <h3 class="text-center">Find Your Court</h3>
        <div class="container">
            {!!  Form::open(array('route' => 'home.search','method' => 'post','id'=>'cc-search-form')) !!}
            <div class="row">
                <div class="form-group col-md-3 col-xs-6 form-icon">
                    <i class="fa fa-map-marker"></i>
                    {!! Form::text('s_name', $request->input('s_name'), ['id' => 'q', 'class' => 'form-control', 'autocomplete' => 'off',
                     'data-country' => 'us', 'placeholder' => 'Search by City or Club Name', 'required' => 'required',
                     'oninvalid' => "this.setCustomValidity('A location is required')", 'oninput' =>"setCustomValidity('')"
                     ] ) !!}
                </div>
                <div class="form-group col-md-2 col-xs-6 form-icon">
                    <i class="fa fa-calendar"></i>
                    <input type="text" class="form-control" name="date" value="{!! $request->input('date') !!}" id="datepicker" placeholder="Date">
                    <p align="center"
                       style="color: white; font-family: RobotoLight, 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 13px; margin-top: 5px">
                    </p>
                    <div id="calendar-switch">
                        <span id="calendar-switch-header">Select the days of the week<br/>you'd like to book</span>
                        <div id="day-of-week">
                            <div class="checkbox">
                                <?php $dayOfWeek = $request->input('dayOfWeek') ? $request->input('dayOfWeek') : []; ?>
                                <div class="col-md-6">
                                    <label class="checkbox-inline">{!! Form::checkbox('dayOfWeek[]', '1', in_array(1,$dayOfWeek) ? true : false) !!}Mondays</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="checkbox-inline">{!! Form::checkbox('dayOfWeek[]', '6', in_array(6,$dayOfWeek) ? true : false) !!}Saturdays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label class="checkbox-inline">{!! Form::checkbox('dayOfWeek[]', '2', in_array(2,$dayOfWeek) ? true : false) !!}Tuesdays</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="checkbox-inline">{!! Form::checkbox('dayOfWeek[]', '7', in_array(7,$dayOfWeek) ? true : false) !!}Sundays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label class="checkbox-inline">{!! Form::checkbox('dayOfWeek[]', '3', in_array(3,$dayOfWeek) ? true : false) !!}Wednesdays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label class="checkbox-inline">{!! Form::checkbox('dayOfWeek[]', '4', in_array(4,$dayOfWeek) ? true : false) !!}Thursdays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="checkbox">
                                <div class="col-md-6">
                                    <label class="checkbox-inline">{!! Form::checkbox('dayOfWeek[]', '5', in_array(5,$dayOfWeek) ? true : false) !!}Fridays</label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div style="padding: 20px 15px 10px 15px;">
                                <button class="btn btn-search" id="calendar-switch-button" type="button">Switch To Open Time Bookings</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2 col-xs-6 form-icon  form-icon group-search-home-timepicker">
                    <?php
                    $arr_time = [
                            '5:00' => '5:00 AM','5:30' => '5:30 AM','6:00' => '6:00 AM','6:30' => '6:30 AM','7:00' => '7:00 AM','7:30' => '7:30 AM',
                            '8:00' => '8:00 AM','8:30' => '8:30 AM','9:00' => '9:00 AM','9:30' => '9:30 AM','10:00' => '10:00 AM','10:30' => '10:30 AM',
                            '11:00' => '11:00 AM','11:30' => '11:30 AM','12:00' => '12:00 PM','12:30' => '12:30 PM','13:00' => '1:00 PM','13:30' => '1:30 PM',
                            '14:00' => '2:00 PM','14:30' => '2:30 PM','15:00' => '3:00 PM','15:30' => '3:30 PM','16:00' => '4:00 PM','16:30' => '4:30 PM',
                            '17:00' => '5:00 PM','17:30' => '5:30 PM','18:00' => '6:00 PM','18:30' => '6:30 PM','19:00' => '7:00 PM','19:30' => '7:30 PM',
                            '20:00' => '8:00 PM','20:30' => '8:30 PM','21:00' => '9:00 PM','21:30' => '9:30 PM','22:00' => '10:00 PM'
                    ] ;
                    ?>

                        <i class="fa fa-clock-o"></i>
                        <input type="text" class="form-control glyphicon glyphicon-time" id="search-timepicker-text" placeholder="Time" readonly="readonly">
                        <input type="hidden" name="s_time" id="search-timepicker">

                    <div class="search-tooltip hidden">
                        <div class="tooltiptext">
                            <div >
                                <label for="opentime">Start Time</label>
                                {!! Form::select('cc-input-search-time', $arr_time, $request->input('s_time'), ['id'=>'cc-input-search-time', 'class' => 'form-control search-time select2']) !!}
                            </div>

                            <script>
                                $(document).ready(function(){
                                    // set time current
                                    var timeNow = new Date();
                                    var hours   = timeNow.getHours();
                                    var minutes = timeNow.getMinutes();
                                    if(minutes <= 30) minutes = 30;
                                    else{
                                        hours +=1;
                                        minutes = "00";
                                    }
                                    $("#cc-input-search-time").val((hours < 10 ? "0" + hours : hours) + ":" + minutes);
                                    $("#search-timepicker-text").val($("#cc-input-search-time option[selected=selected]").text());
                                    $("#search-timepicker").val($("#cc-input-search-time option[selected=selected]").val());
                                })
                            </script>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2 col-xs-6 form-icon time-kicker">
                    <input id="mb-book-in-hour" class="ionslider" type="text" name="mb-book-in-hour" data-from="{!! $request->input('mb-book-in-hour') !!}">
                </div>
                <div class="form-group col-md-2 col-xs-6 form-icon">
                    <i style="background-image: url('resources/home/images/racket_05.png');width: 28px; height: 18px;"></i>
                    {!! Form::selectRange('court',1,4,$request->input('court'),['id'=>'inputID','class' => 'form-control placeholder-single','placeholder'=>'# Courts']) !!}
                </div>
                <div class="form-group col-md-1 col-xs-6">
                    <button type="submit" class="btn btn-search">SEARCH</button>
                </div>
            </div>
            <div class="row frm-g-distance-search">
                <div class="form-group col-md-5">
                    <span style="padding-right: 20px">Court Type: </span>
                    <?php $surface_arr = $request->input('surface_id') ? $request->input('surface_id') : []; ?>
                    <label class="checkbox-inline">{!! Form::checkbox('surface_id[]', '1', in_array(1,$surface_arr) ? true : false) !!}Hard</label>
                    <label class="checkbox-inline">{!! Form::checkbox('surface_id[]', '2', in_array(2,$surface_arr) ? true : false) !!}Har-Tru</label>
                    <label class="checkbox-inline">{!! Form::checkbox('surface_id[]', '3', in_array(3,$surface_arr) ? true : false) !!}Red Clay</label>
                    <label class="checkbox-inline">{!! Form::checkbox('surface_id[]', '4', in_array(4,$surface_arr) ? true : false) !!}Grass</label>
                    <label class="checkbox-inline">{!! Form::checkbox('surface_id[]', '5', in_array(5,$surface_arr) ? true : false) !!}Carpet</label>
                </div>
                <div class="form-group col-md-7">
                    <span style="float: left; padding-right: 20px">Distance</span>
                    <div class="form-icon time-kicker" style="float: left; width: 200px; margin-top: -17px">
                        <input id="mb-book-distance" class="ionslider" type="text" name="mb-book-distance" data-from="{!! $request->input('mb-book-distance') !!}">
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>