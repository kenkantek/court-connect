@extends('home.layouts.master')

@section('content')
  @include('home.partials._searchform')
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
          @if (isset($clubs))
            Showing Results <span>1-5</span> of <span>{!! $clubs->count() !!}</span>
          @endif
        </div>
        {{-- End #show-results --}}

        {{-- #search-results --}}
        <div class="row text-left" id="search-results">
          <div class="col-md-8"> 
            @if (isset($clubs))
              @foreach ($clubs as $club)
                {{-- Club block     --}}
                  <div class="club-block row">
                    <div class="col-md-4">
                        <div class="row thumbnail text-center">                 
                            <img src="{{ asset('resources/home/images/club-image-1.jpg') }}" alt="" class="img-responsive col-md-12 img-clubs">
                             <div class="caption">
                              <div class="col-md-6 col-xs-6">
                                Indoor/Outdoor<br/>
                                <b>Indoor</b>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                Court Type<br/>
                                <b>Hard</b>
                              </div>                      
                            </div>
                        </div>              
                    </div>                  
                    <div class="col-md-8">
                      <div class="row information">
                        <div class="col-md-10 col-xs-9">
                            <h4 class="club-name">{!! $club->name !!}</h4>
                            <small class="club-address">{!! $club->address !!}</small>
                          </div>
                          <div class="col-md-2 col-xs-3 text-center distance">
                            <p>
                              Distance <br>
                              <b>1 mile</b>
                            </p>
                          </div>
                      </div>              
                      <div class="row">
                        <div class="col-md-12">
                          <span>Select a Time</span>
                          <div class="club-time text-center">
                            <div class="col-price">
                              <span>4-5pm</span>
                              <div class="price">
                                $45
                              </div>
                            </div>
                            <div class="col-price">
                              <span>5-6pm</span>
                              <div class="price">
                                $35
                              </div>
                            </div class="price">
                            <div class="col-price active">
                              <span>6-7pm</span>
                              <div class="price">
                                $45
                              </div>
                            </div>
                            <div class="col-price">
                              <span>7-8pm</span>
                              <div class="price">
                                $45
                              </div>
                            </div>
                            <div class="col-price">
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
              @endforeach
            @endif
          </div>
          
          <div class="col-md-4">
            <div id="map" style="height: 400px"></div>
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
  
    
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 11
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAY38RQJoR42kbulqrivcRaeYPNGLB3gWc&callback=initMap">
    </script>
  
@stop