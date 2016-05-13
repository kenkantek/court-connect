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

            {{-- #search-results --}}
            <div class="row text-left" id="search-results">
                <div class="col-md-8">
                    {{-- #show-results --}}
                    <div class="text-left clearfix" id="show-results">
                        @if (isset($clubs))
                            <div class="pull-left show-result">
                                Showing Results <span>1-5</span> of <span>{!! $clubs->total() !!}</span>

                            </div>
                            <div class="pull-right">
                                {!! $clubs->appends($request->input())->render() !!}
                            </div>

                        @endif
                    </div>
                    {{-- End #show-results --}}
                    @if (isset($clubs))
                        @foreach ($clubs as $club)
                            {{-- Club block     --}}
                            <div class="club-block">
                                <div class="club-intro clearfix">
                                    <div class="col-md-4">
                                        <div class="row thumbnail text-center">
                                            <img src="{{ asset('resources/home/images/club-image-1.jpg') }}" alt="" class="img-responsive col-md-12 img-clubs">
                                            <div class="caption">
                                                <div class="col-md-6 col-xs-6">
                                                    Indoor/Outdoor<br/>
                                                    <b>{{$club->courts[0]->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                                                </div>
                                                <div class="col-md-6 col-xs-6">
                                                    Court Type<br/>
                                                    <b>{{$club->courts[0]->surface->label}}</b>
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
                                                <div class="club-time text-center club-time-wrap">
                                                    <div class="first-court">
                                                        <div class="court-name">Court: {!! $club->courts[0]->name !!}</div>
                                                        <hr style="width: 100%">
                                                        <div class="intro-court clearfix">
                                                            <div class="court-io-door pull-right">
                                                                Indoor/Outdoor:
                                                                <b>{{$club->courts[0]->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                                                            </div>
                                                            <div class="court-type pull-left">
                                                                Court Type:
                                                                <b>{{$club->courts[0]->surface->label}}</b>
                                                            </div>
                                                        </div>
                                                        <div class="club-time text-center club-time-wrap clearfix">
                                                            @foreach ($club->courts[0]->prices as $item)
                                                                <div class="col-price {!! $item['hour_start'] == $keyword_hour ? "active" : ""!!}">
                                                                    <span>{{$item['hour_start'] <=12 ? str_replace(".5",":30",$item['hour_start'])."am" : str_replace(".5",":30",($item['hour_start'] - 12))."pm"}} -
                                                                        {{$item['hour_start'] + $item['hour_length'] <=12 ? str_replace(".5",":30",$item['hour_start'] + $item['hour_length'])."am" : str_replace(".5",":30",($item['hour_start'] + $item['hour_length']- 12))."pm"}}
                                                                    </span>

                                                                    <a href="{{route('home.checkout',['date'=>$request->input('date'),'court'=>$club->courts[0]->id,'hour_start'=>$item['hour_start'],'hour_length'=>$item['hour_length']])}}" class="price btn-booking-tennis {{  isset($item['status']) ? "disabled": "" }}"  data-court="{{$club->courts[0]->id}}" data-hour_start="{{$item['hour_start']}}" data-hour_length="{{$item['hour_length']}}">
                                                                        @if(isset($item['total_price']) && $item['total_price'] == 'N/A' )
                                                                            <span>N/A</span>
                                                                        @else
                                                                            @if(isset($item['total_price']))
                                                                                <span>${!! $item['total_price'] !!}</span>
                                                                            @else
                                                                                <span>{!! isset($item['status']) ? $item['status'] : "unavai" !!}</span>
                                                                            @endif
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <span class="btn btn-primary viewmore" data-view="content-view-more-club-{!! $club->id !!}">View more >></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-view-more-court content-view-more-club-{!! $club->id !!}" style="display: none;">
                                    @foreach($club->courts as $k=>$court )
                                        <?php if($k==0) continue; ?>
                                        <div class="row item-court">
                                            <div class="court-name">Court: {!! $court->name !!}</div>
                                            <hr style="width: 100%" />
                                            <div class="intro-court clearfix">
                                                <div class="court-io-door pull-right">
                                                    Indoor/Outdoor:
                                                    <b>{{$court->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                                                </div>
                                                <div class="court-type pull-left">
                                                    Court Type:
                                                    <b>{{$court->surface->label}}</b>
                                                </div>
                                            </div>

                                            <div class="club-time text-center club-time-wrap clearfix ">
                                                @foreach ($court->prices as $item)
                                                    <div class="col-price {!! $item['hour_start'] == $keyword_hour ? "active" : ""!!}">
                                                        <span>{{$item['hour_start'] <=12 ? str_replace(".5",":30",$item['hour_start'])."am" : str_replace(".5",":30",($item['hour_start'] - 12))."pm"}} -
                                                            {{$item['hour_start'] + $item['hour_length'] <=12 ? str_replace(".5",":30",$item['hour_start'] + $item['hour_length'])."am" : str_replace(".5",":30",($item['hour_start'] + $item['hour_length']- 12))."pm"}}
                                                        </span>
                                                        <a href="{{route('home.checkout',['date'=>$request->input('date'),'court'=>$court->id,'hour_start'=>$item['hour_start'],'hour_length'=>$item['hour_length']])}}" class="price btn-booking-tennis {{isset($item['status']) ? "disabled": "" }}"  data-court="{{$court->id}}" data-hour_start="{{$item['hour_start']}}" data-hour_length="{{$item['hour_length']}}">
                                                            @if(isset($item['total_price']) && $item['total_price'] == 'N/A' )
                                                                <span>N/A</span>
                                                            @else
                                                                @if(isset($item['total_price']))
                                                                    <span>${!! $item['total_price'] !!}</span>
                                                                @else
                                                                    <span>{!! isset($item['status']) ? $item['status'] : "unavai" !!}</span>
                                                                @endif
                                                            @endif
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach



                                </div>
                            </div>

                            {{-- End Club block --}}
                        @endforeach
                    @else
                        <div class="text-center">No result</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div id="map" style="height: 400px"></div>
                </div>
            </div>
            {{-- End #search-results --}}

            <!-- deal -->
            @include('home.partials.deal')
                    <!-- end deal -->
        </div>
    </div>
    <script>
        $( ".viewmore" ).click(function() {
            var viewTogle = $(this).data('view');
            $( "."+viewTogle ).toggle( "slow" );

        });
    </script>
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