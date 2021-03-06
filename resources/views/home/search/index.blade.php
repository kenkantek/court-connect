@extends('home.layouts.master')

@section('content')
    @include('home.partials._searchform')
    <div class="row">
        <div class="container content">
            <div class="clearfix"></div>
            {{-- #search-results --}}
            <div class="row text-left clearfix" id="search-results">
                <div class="col-md-8 content-left-info">
                    {{-- #show-results --}}

                    @if($msg_errors !=null)

                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <ul>
                                @foreach($msg_errors as $message)
                                    <li>{{$message}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="text-left clearfix" id="show-results">
                            <div style="margin: 20px 0px" class="visible-lg"></div>
                            @if (isset($clubs) && count($clubs) > 0)
                                <div class="pull-left show-result">
                                    Showing Results <span>{!! $clubs->perPage() * ($clubs->currentPage() - 1) + 1!!}-{!! $clubs->perPage() * ($clubs->currentPage() - 1) + $clubs->count() !!}</span> of <span>{!! $clubs->total() !!}</span>
                                </div>
                                <div class="pull-right">
                                    {!! $clubs->appends($request->input())->render() !!}
                                </div>

                            @endif
                        </div>
                        {{-- End #show-results --}}
                        @if (isset($clubs) && count($clubs) > 0)
                            @if(isset($request->dayOfWeek) && is_array($request->dayOfWeek) && count($request->dayOfWeek) > 0)
                                @include("home.search.search_contract")
                            @else
                                @include("home.search.search_open")
                            @endif
                                <div class="pull-right">
                                    {!! $clubs->appends($request->input())->render() !!}
                                </div>
                        @else
                            <h4 class="text-center">No result found. Please modify your search above.</h4>
                        @endif
                    @endif
                </div>

                <div class="col-md-4 content-right-map">
                    <div id="map" class="clearfix"></div>
                </div>
            </div>
        {{-- End #search-results --}}

        <!-- deal -->
        @include('home.partials.deal')
        <!-- end deal -->
        </div>
    </div>

@stop

@section('javascript')
    <script type="application/javascript">
        $(document).ready(function(){
            var count_max_get_geo = 3;
            function getGeolocation(){
                if(count_max_get_geo <= 0 ) {
                    alert("Geolocation API is not supported in your browser.");
                    return ;
                }
                count_max_get_geo --;
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;
                                var capa = document.getElementById("capa");
                                capa.innerHTML = "<input type='hidden' name='lat' value='" + Math.round(latitude*10000)/10000 + "'/><input type='hidden' name='lon' value='" + Math.round(longitude*10000)/10000 + "'/>";

                            },function error(msg){
                                switch(error.code) {
                                    case error.PERMISSION_DENIED:
                                        alert("User denied the request for Geolocation.");
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        alert("Location information is unavailable.");
                                        break;
                                    case error.TIMEOUT:
                                        alert("The request to get user location timed out.");
                                        break;
                                    case error.UNKNOWN_ERROR:
                                        alert("An unknown error occurred.");
                                        break;
                                }
                            },{
                                maximumAge:600000,
                                timeout:5000,
                                enableHighAccuracy: true
                            }
                    );
                }else {
                    count_max_get_geo --;
                    setTimeout(getGeolocation, 1000);
                }
            }
            //getGeolocation();
        })
    </script>

    <script src="https://maps.googleapis.com/maps/api/js"></script>
    {!! HTML::script("resources/home/js/infobox.js") !!}
    <script>
        $( ".viewmore" ).click(function() {
            var viewTogle = $(this).data('view');
            $( "."+viewTogle ).toggle( "slow" );

        });
        var map;
        var markers = new Array();
        var infos = new Array();
        var polylines = new Array();
        var polygons = new Array();
        var geoMarker = null;
        var geoInfo = null;
        var gmarkers;
        function initialize() {

            var latlng = new google.maps.LatLng(0, 0);
            var mapTypeControlOptions = {
                mapTypeIds: [google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.TERRAIN],
                position: google.maps.ControlPosition.RIGHT_TOP,
                style: google.maps.MapTypeControlStyle.DEFAULT
            };
            var overviewMapControlOptions = {
                opened: false
            };
            var panControlOptions = {
                position: google.maps.ControlPosition.LEFT_TOP
            };
            var rotateControlOptions = {
                position: google.maps.ControlPosition.LEFT_TOP
            };
            var scaleControlOptions = {
                position: google.maps.ControlPosition.LEFT_BOTTOM,
                style: google.maps.ScaleControlStyle.DEFAULT
            };
            var zoomControlOptions = {
                position: google.maps.ControlPosition.LEFT_CENTER,
                style: google.maps.ZoomControlStyle.SMALL
            };
            var myMapOptions = {
                draggable : true,
                scrollwheel : true,
                mapTypeControlOptions: mapTypeControlOptions,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                overviewMapControlOptions: overviewMapControlOptions,
                panControlOptions: panControlOptions,
                rotateControlOptions: rotateControlOptions,
                scaleControlOptions: scaleControlOptions,
                zoom: 5,
                zoomControlOptions: zoomControlOptions,
                center: latlng,
                scaleControl: true,
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                fullscreenControl: true
            };
            map = new google.maps.Map(document.getElementById("map"), myMapOptions);
            @if( is_null($msg_errors) && $clubs)
                    @foreach($clubs as $k=>$club)
                    markers[{{$k}}] = new google.maps.Marker({
                //icon: "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld={{$k+1}}|FF7B6F",
                title: "{{$club['name']}}",
                label: "{{$club['name']}}",
                position: new google.maps.LatLng({{$club['latitude']}},{{$club['longitude']}}),
                map: map
            });
            var infowindow = new google.maps.InfoWindow({
                id: markers[{{$k}}],
                content:markers[{{$k}}].title,
                position:markers[{{$k}}].getPosition()
            });
            google.maps.event.addListenerOnce(infowindow, 'closeclick', function(){
                markers[{{$k}}].setVisible(true);
            });
            markers[{{$k}}].setVisible(false);
            infowindow.open(map);

            google.maps.event.addListener(map, "click", function(event){
                this.setOptions({scrollwheel:true,draggable:true})
            })

            @endforeach
                    gmarkers = markers;
                    @endif

            var latlngbounds = new google.maps.LatLngBounds();
            @for($i=0; $i< count($clubs); $i++)
                latlngbounds.extend(markers[{{$i}}].position);
            @endfor
            map.fitBounds(latlngbounds);

            if (typeof mbOnAfterInit == "function") mbOnAfterInit(map);

            @if(empty($clubs) || count($clubs) < 1)
                    geocoder = new google.maps.Geocoder();
            if (geocoder) {
                var address = "{{$request->input('s_name')}}";
                geocoder.geocode({
                    'address': address
                }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                            map.setCenter(results[0].geometry.location);

                            var infowindow = new google.maps.InfoWindow({
                                content: '<b>' + address + '</b>',
                                size: new google.maps.Size(150, 50)
                            });

                            var marker = new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: map,
                                title: address
                            });
                            google.maps.event.addListener(marker, 'click', function () {
                                infowindow.open(map, marker);
                            });

                        } else {
                            alert("No results found");
                        }
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            }
            @endif
        }
        @if(count($clubs) == 1)
            $(document).ready(function(){
            setTimeout(function(){
                var z = map.getZoom();
                console.log(z);
                map.setZoom(17);
                var z = map.getZoom();
                console.log(z);
            },1000);
        });
        @endif
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@stop