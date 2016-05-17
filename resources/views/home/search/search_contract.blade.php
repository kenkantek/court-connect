<?php
$dayOfWeek = [
        "1" => "Mondays",
        "2" =>"Tuesdays",
        "3"=>"Wednesdays",
        "4"=>"Thursdays",
        "5"=>"Fridays",
        "6" => "Saturdays",
        "7" => "Sundays"
];
?>
@foreach ($clubs as $club)
    {{-- Club block     --}}
    <div class="club-block">
        <div class="club-intro clearfix">
            <div class="col-md-4">
                <div class="row thumbnail text-center">
                    <img src="{{ asset($club['image']) }}" alt="" class="img-responsive col-md-12 img-clubs">
                    <div class="caption">
                        @if(count($club->courts) > 0)
                            <div class="col-md-6 col-xs-6">
                                Indoor/Outdoor<br/>
                                <b>{{$club->courts[0]->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                Court Type<br/>
                                <b>{{$club->courts[0]->surface->label}}</b>
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
                                        @foreach ($club->courts[0]->prices as $k=>$price)
                                            <div class="row-day clearfix">
                                                <hr>
                                                <div class="title-day">{{$dayOfWeek[$request->input('dayOfWeek')[$k]]}}</div>
                                                @foreach($price as $item)
                                                    <div class="col-price {!! $item['hour_start'] == $keyword_hour ? "active" : ""!!}">
                                                                    <span>{{$item['hour_start'] <=12 ? str_replace(".5",":30",$item['hour_start']): str_replace(".5",":30",($item['hour_start'] - 12))}} -
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
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="btn btn-primary viewmore" data-view="content-view-more-club-{!! $club->id !!}">View more >></span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="content-view-more-court content-view-more-club-{!! $club->id !!}" style="display: none;">
            @foreach($club->courts as $k=>$court )
                <?php if($k==0) continue; ?>
                <div class="item-court">
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

                        @foreach ($court->prices as $k=>$price)
                            <div class="row-day clearfix">
                                <hr>
                                <div class="title-day">{{$dayOfWeek[$request->input('dayOfWeek')[$k]]}}</div>
                                @foreach($price as $item)
                                    <div class="col-price {!! $item['hour_start'] == $keyword_hour ? "active" : ""!!}">
                                                                    <span>{{$item['hour_start'] <=12 ? str_replace(".5",":30",$item['hour_start']): str_replace(".5",":30",($item['hour_start'] - 12))}} -
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
                        @endforeach
                    </div>
                </div>
            @endforeach



        </div>
    </div>
    {{-- End Club block --}}
@endforeach