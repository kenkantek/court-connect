@extends('home.layouts.master')
@include('home.layouts.header')
@section('banner')
<div class="row">
  <div id="find-your-court">
            <h3 class="text-center">Find Your Court</h3>     
            <div class="container">
                <div class="col-md-12">
                    <form action="" method="post" role="form">
                        {!! csrf_field() !!}
                      <div class="row">
                        <div class="form-group col-md-4 form-icon">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" class="form-control" name="s_name" id="q" value="{{$request->s_name}}"
                                   placeholder="Seach by Zip/Address or Club Name" autocomplete="off" data-country="us">
                        </div>
                        <div class="form-group col-md-2 form-icon">
                            <i class="fa fa-calendar"></i>
                            <input type="text" class="form-control" name="date" value="{{$request->date}}" id="datepicker" placeholder="Date">
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
                            <input type="text" class="form-control" name="s_time" value="{{ $request->s_time }}" id="search-timepicker" placeholder="Time">
                            <div class="search-tooltip hidden">
                                <div class="tooltiptext">
                                    <div >
                                        <label for="opentime">Start Time</label>
                                        <input class="form-control search-time" name="search-time" value="{{ $request->s_time }}" type="time">
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
                            {!! Form::select('court',[1,2,3,4],$request->court,['id'=>'inputID','class' => 'form-control','style'=>'text-align-last:center; ']) !!}
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-search">SEARCH</button>
                        </div>
                      </div>
                      <div class="row" style="color:#fff; margin-top: 40px;">
                          <div class="form-group col-md-5">
                            <span>Court Type</span>                            
                            <label class="checkbox-inline"><input type="checkbox" value="">Hard</label>
                            <label class="checkbox-inline"><input type="checkbox" value="">Grass</label>
                            <label class="checkbox-inline"><input type="checkbox" value="">Clay</label>
                            <label class="checkbox-inline"><input type="checkbox" value="">Carpet</label>                            
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
@stop
@section('content')
    <div class="row">
      <div class="container content"> 
        <div class="row" id="featured-courts">         
            <div class="col-md-6 featured-blocks">
              <div class="col-md-4 club-image">
                <img src="{{ asset('resources/home/images/featured-club-image-1.jpg') }}" alt="" class="img-responsive">
              </div>
              <div class="col-md-8 information">
                <div class="row">
                  <div class="col-md-10">
                    <h4 class="club-name">UBC Indoor Tennis Club</h4>
                    <small class="club-address">123 Junction Road, City, ST, 123456</small>
                  </div>
                  <div class="col-md-2 price">
                    <span>$45</span>
                  </div>
                </div>   
                 <div class="row">
                  <div class="col-md-7">
                    <p>Distance: <b>1 mile</b></p>
                    <p>Court Type: <b>Hard</b></p>
                    <p>Indoor/Outdoor: <b>Indoor</b></p> 
                  </div>  
                  <div class="col-md-5 text-right" style="padding:0">
                    <p>&nbsp;</p>
                    <div class="dropdown">                    
                      <button class="btn-sub dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                        6-7pm
                        <span class="glyphicon glyphicon-menu-down" style="left:30px"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="">
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">4-5pm</span>                           
                            <span class="col-md-6 price">$45</span>
                          </a>
                        </li>
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">5-6pm</span>                           
                            <span class="col-md-6 price">$45</span>
                          </a>
                        </li>
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">6-7pm</span>                           
                            <span class="col-md-6 price">$45</span>
                          </a>
                        </li>
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">7-8pm</span>                           
                            <span class="col-md-6 price">$50</span>
                          </a>
                        </li>
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">8-9pm</span>                           
                            <span class="col-md-6 price">$54</span>
                          </a>
                        </li>                                                                                           
                      </ul>
                    </div>
                  </div>    
                 </div>  
              </div>            
            </div>
            <div class="col-md-6 featured-blocks">
              <div class="col-md-4 club-image">
                <img src="{{ asset('resources/home/images/featured-club-image-1.jpg') }}" alt="" class="img-responsive">
              </div>
              <div class="col-md-8 information">
                <div class="row">
                  <div class="col-md-10">
                    <h4 class="club-name">UBC Indoor Tennis Club</h4>
                    <small class="club-address">123 Junction Road, City, ST, 123456</small>
                  </div>
                  <div class="col-md-2 price">
                    <span>$45</span>
                  </div>
                </div>   
                 <div class="row">
                  <div class="col-md-7">
                    <p>Distance: <b>1 mile</b></p>
                    <p>Court Type: <b>Hard</b></p>
                    <p>Indoor/Outdoor: <b>Indoor</b></p> 
                  </div>  
                  <div class="col-md-5 text-right" style="padding:0">
                    <p>&nbsp;</p>
                    <div class="dropdown">                    
                      <button class="btn-sub dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                        View Times
                        <span class="glyphicon glyphicon-menu-down" style="left:10px"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="">
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">16:00</span>                           
                            <span class="col-md-6 price">$45</span>
                          </a>
                        </li>
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">17:00</span>                           
                            <span class="col-md-6 price">$45</span>
                          </a>
                        </li>
                        <li class="row unvailable">
                          <a href="#">
                            <span class="col-md-6">18:00</span>                           
                            <span class="col-md-6 price">Not <br/>Available</span></span>
                          </a>
                        </li>
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">19:00</span>                           
                            <span class="col-md-6 price">$50</span>
                          </a>
                        </li>
                        <li class="row">
                          <a href="#">
                            <span class="col-md-6">20:00</span>                           
                            <span class="col-md-6 price">$54</span>
                          </a>
                        </li>                                                                                          
                      </ul>
                    </div>
                  </div>    
                 </div>  
              </div>            
            </div>
        </div> 
        {{-- #show-results --}}
        <div class="row text-left" id="show-results">
          Showing Results <span>1-5</span> of <span>15</span>
        </div>
        {{-- End #show-results --}}

        {{-- #search-results --}}
        <div class="row text-left" id="search-results">
          <div class="col-md-8"> 

            {{-- Club block     --}}
            <div class="club-block row">
              <div class="col-md-4">
                  <div class="row thumbnail text-center">                 
                      <img src="{{ asset('resources/home/images/club-image-1.jpg') }}" alt="" class="img-responsive col-md-12">
                       <div class="caption">
                        <div class="col-md-6">
                          Indoor/Outdoor<br/>
                          <b>Indoor</b>
                        </div>
                        <div class="col-md-6">
                          Court Type<br/>
                          <b>Hard</b>
                        </div>                      
                      </div>
                  </div>              
              </div>                  
              <div class="col-md-8">
                <div class="row information">
                  <div class="col-md-10">
                      <h4 class="club-name">Junction Indoor Tennis Club</h4>
                      <small class="club-address">123 Junction Road, City, ST, 123456</small>
                    </div>
                    <div class="col-md-2 text-center distance">
                      <p>
                        Distance <br>
                        <b>1 mile</b>
                      </p>
                    </div>
                </div>              
                <div class="row">
                  <div class="col-md-12">
                    <span>Select a Time</span>
                    <div class="club-time col-md-12 text-center">
                      <div class="col-md-2">
                        <span>4-5pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>5-6pm</span>
                        <div class="price">
                          $35
                        </div>
                      </div class="price">
                      <div class="col-md-2 active">
                        <span>6-7pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>7-8pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>8-9pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
            {{-- End Club block --}}

             {{-- Club block     --}}
            <div class="club-block row">
              <div class="col-md-4">
                  <div class="row thumbnail text-center">                 
                      <img src="{{ asset('resources/home/images/club-image-2.jpg') }}" alt="" class="img-responsive col-md-12">
                       <div class="caption">
                        <div class="col-md-6">
                          Indoor/Outdoor<br/>
                          <b>Outdoor</b>
                        </div>
                        <div class="col-md-6">
                          Court Type<br/>
                          <b>Grass</b>
                        </div>                      
                      </div>
                  </div>              
              </div>                  
              <div class="col-md-8">
                <div class="row information">
                  <div class="col-md-10">
                      <h4 class="club-name">En Tout Cas</h4>
                      <small class="club-address">456 Tout Road, City, ST, 123456</small>
                    </div>
                    <div class="col-md-2 text-center distance">
                      <p>
                        Distance <br>
                        <b>5 miles</b>
                      </p>
                    </div>
                </div>              
                <div class="row">
                  <div class="col-md-12">
                    <span>Select a Time</span>
                    <div class="club-time col-md-12 text-center">
                      <div class="col-md-2">
                        <span>4-5pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2 unvailable">
                        <span>5-6pm</span>
                        <div class="price">
                          Not Available
                        </div>
                      </div class="price">
                      <div class="col-md-2 active">
                        <span>6-7pm</span>
                        <div class="price">
                          $50
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>7-8pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>8-9pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
            {{-- End Club block --}}

            {{-- Club block     --}}
            <div class="club-block row">
              <div class="col-md-4">
                  <div class="row thumbnail text-center">                 
                      <img src="{{ asset('resources/home/images/club-image-3.jpg') }}" alt="" class="img-responsive col-md-12">
                       <div class="caption">
                        <div class="col-md-6">
                          Indoor/Outdoor<br/>
                          <b>Indoor</b>
                        </div>
                        <div class="col-md-6">
                          Court Type<br/>
                          <b>Hard</b>
                        </div>                      
                      </div>
                  </div>              
              </div>                  
              <div class="col-md-8">
                <div class="row information">
                  <div class="col-md-10">
                      <h4 class="club-name">University of Bath</h4>
                      <small class="club-address">999 Bath Road, City, ST, 123456</small>
                    </div>
                    <div class="col-md-2 text-center distance">
                      <p>
                        Distance <br>
                        <b>5 miles</b>
                      </p>
                    </div>
                </div>              
                <div class="row">
                  <div class="col-md-12">
                    <span>Select a Time</span>
                    <div class="club-time col-md-12 text-center">
                      <div class="col-md-2">
                        <span>4-5pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2 unvailable">
                        <span>5-6pm</span>
                        <div class="price">
                          Not Available
                        </div>
                      </div class="price">
                      <div class="col-md-2 unvailable">
                        <span>6-7pm</span>
                        <div class="price">
                          Not Available
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>7-8pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>8-9pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
            {{-- End Club block --}}

            {{-- Club block     --}}
            <div class="club-block row">
              <div class="col-md-4">
                  <div class="row thumbnail text-center">                 
                      <img src="{{ asset('resources/home/images/club-image-4.jpg') }}" alt="" class="img-responsive col-md-12">
                       <div class="caption">
                        <div class="col-md-6">
                          Indoor/Outdoor<br/>
                          <b>Indoor</b>
                        </div>
                        <div class="col-md-6">
                          Court Type<br/>
                          <b>Hard</b>
                        </div>                      
                      </div>
                  </div>              
              </div>                  
              <div class="col-md-8">
                <div class="row information">
                  <div class="col-md-10">
                      <h4 class="club-name">Junction Indoor Tennis Club</h4>
                      <small class="club-address">123 Junction Road, City, ST, 123456</small>
                    </div>
                    <div class="col-md-2 text-center distance">
                      <p>
                        Distance <br>
                        <b>5 miles</b>
                      </p>
                    </div>
                </div>              
                <div class="row">
                  <div class="col-md-12">
                    <span>Select a Time</span>
                    <div class="club-time col-md-12 text-center">
                      <div class="col-md-2">
                        <span>4-5pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>5-6pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div class="price">
                      <div class="col-md-2 unvailable">
                        <span>6-7pm</span>
                        <div class="price">
                          Not Available
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>7-8pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>8-9pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
            {{-- End Club block --}}

            {{-- Club block     --}}
            <div class="club-block row">
              <div class="col-md-4">
                  <div class="row thumbnail text-center">                 
                      <img src="{{ asset('resources/home/images/club-image-5.jpg') }}" alt="" class="img-responsive col-md-12">
                       <div class="caption">
                        <div class="col-md-6">
                          Indoor/Outdoor<br/>
                          <b>Indoor</b>
                        </div>
                        <div class="col-md-6">
                          Court Type<br/>
                          <b>Hard</b>
                        </div>                      
                      </div>
                  </div>              
              </div>                  
              <div class="col-md-8">
                <div class="row information">
                  <div class="col-md-10">
                      <h4 class="club-name">Wickwood Tennis Center</h4>
                      <small class="club-address">123 Junction Road, City, ST, 123456</small>
                    </div>
                    <div class="col-md-2 text-center distance">
                      <p>
                        Distance <br>
                        <b>15 miles</b>
                      </p>
                    </div>
                </div>              
                <div class="row">
                  <div class="col-md-12">
                    <span>Select a Time</span>
                    <div class="club-time col-md-12 text-center">
                      <div class="col-md-2">
                        <span>4-5pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2 unvailable">
                        <span>5-6pm</span>
                        <div class="price">
                          Not Available
                        </div>
                      </div class="price">
                      <div class="col-md-2 unvailable">
                        <span>6-7pm</span>
                        <div class="price">
                          Not Available
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>7-8pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                      <div class="col-md-2">
                        <span>8-9pm</span>
                        <div class="price">
                          $45
                        </div>
                      </div>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
            {{-- End Club block --}}
           

          </div>
            
          <div class="col-md-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28680.846982591822!2d-74.31112890937982!3d40.9222646086784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDU1JzUzLjciTiA3NMKwMTQnMTkuMSJX!5e0!3m2!1svi!2s!4v1458551717545" width="365" height="670" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
        {{-- End #search-results --}}

        {{-- #deals-near-you --}}
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
        {{-- End #deals-near-you --}}
                
      </div>
    </div>
@stop