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
                    <div class="text-left clearfix" id="show-results">
                        @if (isset($clubs) && count($clubs) > 0)
                            <div class="pull-left show-result">
                                Showing Results <span>{!! $clubs->currentPage()!!}-{!! $clubs->count() !!}</span> of <span>{!! $clubs->total() !!}</span>

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
                    @else
                        <h4 class="text-center">No result</h4>
                    @endif
                </div>

                <div class="col-md-4 content-right-map">
                    <div id="map" style="min-height: 600px; margin-top: 30px"></div>
                </div>
            </div>
            {{-- End #search-results --}}

            <!-- deal -->
            @include('home.partials.deal')
                    <!-- end deal -->
        </div>
    </div>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    {!! HTML::script("resources/home/js/infobox.js") !!}
    <script>
        $( ".viewmore" ).click(function() {
            var viewTogle = $(this).data('view');
            $( "."+viewTogle ).toggle( "slow" );

        });
        function initialize() {
            var map;
            var markers = new Array();
            var infos = new Array();
            var polylines = new Array();
            var polygons = new Array();
            var geoMarker = null;
            var geoInfo = null;

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
                position: google.maps.ControlPosition.LEFT_TOP,
                style: google.maps.ZoomControlStyle.DEFAULT
            };
            var myMapOptions = {
                draggable : false,
                scrollwheel : false,
                mapTypeControlOptions: mapTypeControlOptions,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                overviewMapControlOptions: overviewMapControlOptions,
                panControlOptions: panControlOptions,
                rotateControlOptions: rotateControlOptions,
                scaleControlOptions: scaleControlOptions,
                zoom: 0,
                zoomControlOptions: zoomControlOptions,
                center: latlng
            };
            var map = new google.maps.Map(document.getElementById("map"), myMapOptions);
            @foreach($clubs as $k=>$club)
                markers[{{$k}}] = new google.maps.Marker({
                //icon: "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld={{$k+1}}|FF7B6F",
                title: "{{$club['name']}}",
                label: "{{$club['name']}}",
                position: new google.maps.LatLng({{$club['latitude']}},{{$club['longitude']}}),
                map: map
            });
            infos[{{$k}}] = new google.maps.InfoWindow({
                content: "{{$club['name']}}"
            });

            google.maps.event.addListener(map, "click", function(event){
                this.setOptions({scrollwheel:true,draggable:true})
            })

            @endforeach


            var latlngbounds = new google.maps.LatLngBounds();
            @for($i=0; $i< count($clubs); $i++)
                latlngbounds.extend(markers[{{$i}}].position);
            @endfor
            map.fitBounds(latlngbounds);
            if (typeof mbOnAfterInit == "function") mbOnAfterInit(map);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

@stop