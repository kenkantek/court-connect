<div class="row">
  <div id="find-your-court">
            <h3 class="text-center">Find Your Court</h3>     
            <div class="container">
                <div class="row">
                    <form action="{{ route('home.search') }}" method="get" role="form">
                        {{ csrf_field() }}
                        <div class="form-group col-md-3 form-icon">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" class="form-control" name="s_name" id="q"
                                   placeholder="Seach by Zip/Address or Club Name" autocomplete="off" data-country="us">
                        </div>
                        <div class="form-group col-md-2 form-icon">
                            <i class="fa fa-calendar"></i>
                            <input type="text" class="form-control" name="date" id="datepicker" placeholder="Date">
                            <p align="center"
                               style="color: white; font-family: RobotoLight, 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 13px; margin-top: 5px">
                                </p>
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
                        </div>
                        <div class="form-group col-md-2 form-icon">
                            <i class="glyphicon glyphicon-time"></i>
                            <input type="time" class="form-control" name="s_time" id="search-timepicker" placeholder="Time">
                            <div class="search-tooltip hidden">
                                <div class="tooltiptext">
                                    <div >
                                        <label for="opentime">Start Time</label>
                                        <input class="form-control search-time" name="search-time" value="08:00" type="time">
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-2 form-icon">
                            <input id="mb-book-in-hour" class="ionslider" type="text" name="mb-book-in-hour" value="">
                                    
                        </div>
                        <div class="form-group col-md-2 form-icon">
                            <i style="background-image: url('resources/home/images/racket_05.png');width: 28px; height: 18px;"></i>
                            {!! Form::select('court',[1,2,3,4],old('court'),['id'=>'inputID','class' => 'form-control','style'=>'text-align-last:center; ']) !!}
                        </div>
                        <div class="form-group col-md-1">
                            <button type="submit" class="btn btn-search">SEARCH</button>
                        </div>
                      </div>
                      <div class="row" style="color:#fff; margin-top: 40px;">
                          <div class="form-group col-md-5">
                            <span>Court Type</span>                            
                            <label class="checkbox-inline"><input name="surface_id" type="checkbox" value="1">Hard</label>
                            <label class="checkbox-inline"><input name="surface_id" type="checkbox" value="2">Har-Tru</label>
                            <label class="checkbox-inline"><input name="surface_id" type="checkbox" value="3">Red Clay</label>
                            <label class="checkbox-inline"><input name="surface_id" type="checkbox" value="4">Grass</label>                            
                            <label class="checkbox-inline"><input name="surface_id" type="checkbox" value="5">Carpet</label>                            
                          </div>
                          <div class="form-group col-md-7">
                            <span>Distance</span>
                          </div>
                      </div>
                    </form>
                </div>
            </div>          
        </div>  

</div>