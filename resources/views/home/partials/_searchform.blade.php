<div class="row">
    <div id="find-your-court">
        <h3 class="text-center">Find Your Court</h3>
        <div class="container">
            {!!  Form::open(array('route' => 'home.search','method' => 'post','id'=>'cc-search-form')) !!}
            <div class="row">
                <div class="form-group col-md-3 form-icon">
                    <i class="fa fa-map-marker"></i>
                    {!! Form::text('s_name', $request->input('s_name'), ['id' => 'q', 'class' => 'form-control', 'autocomplete' => 'off',
                     'data-country' => 'us', 'placeholder' => 'Search by City or Club Name', 'required' => 'required',
                     'oninvalid' => "this.setCustomValidity('A location is required')", 'oninput' =>"setCustomValidity('')"
                     ] ) !!}
                </div>
                <div class="form-group col-md-2 form-icon">
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
                <div class="form-group col-md-2 form-icon">
                    <i class="glyphicon glyphicon-time"></i>
                    {!! Form::time('s_time', $request->input('s_time'), ['id'=>'search-timepicker','class' => 'form-control'] ) !!}
                    <div class="search-tooltip hidden">
                        <div class="tooltiptext">
                            <div >
                                <label for="opentime">Start Time</label>
                                {!! Form::time('search-time', $request->input('s_time'), ['class' => 'form-control search-time','id'=>'cc-input-search-time'] ) !!}
                            </div>
                            @if(!$request->input('s_time'))
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
                                })
                            </script>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2 form-icon time-kicker">
                    <input id="mb-book-in-hour" class="ionslider" type="text" name="mb-book-in-hour" data-from="{!! $request->input('mb-book-in-hour') !!}">
                </div>
                <div class="form-group col-md-2 form-icon">
                    <i style="background-image: url('resources/home/images/racket_05.png');width: 28px; height: 18px;"></i>
                    {!! Form::selectRange('court',1,4,$request->input('court'),['id'=>'inputID','class' => 'form-control placeholder-single','placeholder'=>'# Courts']) !!}
                </div>
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-search">SEARCH</button>
                </div>
            </div>
            <div class="row" style="color:#fff; margin: 20px 0 10px 0;">
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