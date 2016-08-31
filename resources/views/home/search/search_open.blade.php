@foreach ($clubs as $club)
    {{-- Club block     --}}
    <div class="club-block">
        <div class="club-intro clearfix">
            <div class="col-md-4">
                <div class="row thumbnail text-center">
                    <img src="{{ asset($club['image']) }}" alt="" class="img-responsive col-md-12 img-clubs">
                    <div class="caption">
                        @if(isset($club->court) > 0)
                            <div class="col-md-6 col-xs-6">
                                @if($request->court == 1)
                                Indoor/Outdoor<br/>
                                <b>{{$club->court->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-6">
                                @if($request->court == 1)
                                Court Type<br/>
                                <b>{{$club->court->surface->label}}</b>
                                @endif
                            </div>
                        @endif
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
                            <b>{{isset($club->distance) ? $club->distance : ''}} miles</b>
                        </p>
                    </div>
                    @if(isset($club->data_date_open->is_close) && $club->data_date_open->is_close == 1)
                        <div class="text-center" style="clear: both; font-weight: bold; padding: 10px 0px; font-size: 1.2em; color: #63ac1e;">Date closed</div>
                    @elseif(isset($club->alert_error))
                        <div class="text-center" style="clear: both; font-weight: bold; padding: 10px 0px; font-size: 1.2em; color: #63ac1e;">{{$club->alert_error}}</div>
                    @endif
                </div>
                @if(count($club->courts) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="club-time text-center club-time-wrap">
                                <div class="first-court">
                                    <div class="club-time text-center club-time-wrap clearfix">
                                        @if(isset($club->price_main))
                                            @foreach ($club->price_main as $item)
                                                @if(isset($item['status']) || $item['error'] == true)

                                                @else
                                                    <div class="col-price {!! $item['hour_start'] == $keyword_hour ? "active" : ""!!}">
                                                                            <span>{{$item['hour_start'] <=12 ? str_replace(".5",":30",$item['hour_start']): str_replace(".5",":30",($item['hour_start'] - 12))}} -
                                                                                {{$item['hour_start'] + $item['hour_length'] <=12 ? str_replace(".5",":30",$item['hour_start'] + $item['hour_length'])."am" : str_replace(".5",":30",($item['hour_start'] + $item['hour_length']- 12))."pm"}}
                                                                            </span>

                                                        <a href="{{route('home.checkout',['date'=>$request->input('date'), http_build_query(['courts' => $club->arr_count]),'hour_start'=>$item['hour_start'],'hour_length'=>$item['hour_length']])}}" class="price btn-booking-tennis {{  isset($item['status']) ? "disabled": "" }}"  data-court="{{$club->court->id}}" data-hour_start="{{$item['hour_start']}}" data-hour_length="{{$item['hour_length']}}">
                                                            @if(isset($item['total_price']) && $item['total_price'] == 'N/A' )
                                                                <span>N/A</span>
                                                            @else
                                                                @if(isset($item['total_price']))
                                                                    <span>${!! $item['total_price'] !!}</span>
                                                                @else
                                                                    <span>{!! isset($item['status']) ? ($item['status'] == 'unavailable' ? 'unavailable' : ($item['status'] == 'nosetprice' ? 'unavai' : $item['status'])) : "unavai" !!}</span>
                                                                @endif
                                                            @endif
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
    {{-- End Club block --}}
@endforeach