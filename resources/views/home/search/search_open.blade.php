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
                                Indoor/Outdoor<br/>
                                <b>{{$club->court->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                Court Type<br/>
                                <b>{{$club->court->surface->label}}</b>
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
                            <b>1 mile</b>
                        </p>
                    </div>
                </div>
                @if(count($club->courts) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="club-time text-center club-time-wrap">
                                <div class="first-court">
                                    <div class="intro-court clearfix">
                                        <div class="court-io-door pull-right">
                                            Indoor/Outdoor:
                                            <b>{{$club->court->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                                        </div>
                                        <div class="court-type pull-left">
                                            Court Type:
                                            <b>{{$club->court->surface->label}}</b>
                                        </div>
                                    </div>
                                    <div class="club-time text-center club-time-wrap clearfix">
                                        @foreach ($club->court->prices as $item)
                                            <div class="col-price {!! $item['hour_start'] == $keyword_hour ? "active" : ""!!}">
                                                                    <span>{{$item['hour_start'] <=12 ? str_replace(".5",":30",$item['hour_start']): str_replace(".5",":30",($item['hour_start'] - 12))}} -
                                                                        {{$item['hour_start'] + $item['hour_length'] <=12 ? str_replace(".5",":30",$item['hour_start'] + $item['hour_length'])."am" : str_replace(".5",":30",($item['hour_start'] + $item['hour_length']- 12))."pm"}}
                                                                    </span>

                                                <a href="{{route('home.checkout',['date'=>$request->input('date'),'court'=>$club->court->id,'hour_start'=>$item['hour_start'],'hour_length'=>$item['hour_length']])}}" class="price btn-booking-tennis {{  isset($item['status']) ? "disabled": "" }}"  data-court="{{$club->court->id}}" data-hour_start="{{$item['hour_start']}}" data-hour_length="{{$item['hour_length']}}">
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

                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
    {{-- End Club block --}}
@endforeach