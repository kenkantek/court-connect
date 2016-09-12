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
                        <div class="col-md-6 col-xs-6">
                            Indoor/Outdoor<br/>
                            @if($request->court == 1)
                            <b>{{$club->contracts[0]['court']->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</b>
                            @endif
                        </div>
                        <div class="col-md-6 col-xs-6">
                            Court Type<br/>
                            @if($request->court == 1)
                            <b>{{$club->contracts[0]['court']->surface->label}}</b>
                            @endif
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
                            <b>{{isset($club->distance_in_miles) ? number_format($club->distance_in_miles, 2) : ''}} miles</b>
                        </p>
                    </div>
                </div>
                @foreach($club->contracts as $contract)
                    @foreach($contract['price_main'] as $item_price_main)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="club-time text-center club-time-wrap">
                                    <div class="first-court">
                                        <hr style="width: 100%">
                                        <div class="club-time text-center club-time-wrap clearfix">
                                            @foreach ($item_price_main as $k=>$price)
                                                <div class="row-day clearfix">
                                                    <div class="title-day">{{$dayOfWeek[$request->input('dayOfWeek')[$k]]}} | Contract</div>
                                                    <div class="title-day" style="font-weight: bold; font-size: 1.2em; display: inline-block">{{$contract['start_date']." - ".$contract['end_date']}} | </div>
                                                    <div class="title-day" style="display: inline-block">Number of Weeks: {{ $contract['daysOfWeek'][substr($dayOfWeek[$request->input('dayOfWeek')[$k]],0,3)]['count']}}</div>
                                                    <hr>
                                                    @foreach ($price as $item)
                                                        @if(isset($item['status']) || $item['error'] == true)

                                                        @else
                                                            <div class="col-price {!! $item['hour_start'] == $keyword_hour ? "active" : ""!!}">
                                                                     <span>{{str_replace(":00","",str_replace("pm","",str_replace("am","",format_hour($item['hour_start']))))}} -
                                                                         {{str_replace(":00","",format_hour($item['hour_start'] + $item['hour_length']))}}
                                                                     </span>
                                                                <a href="{{route('home.checkout',['date'=>$request->input('date'),'dayOfWeek'=>$request->input('dayOfWeek')[$k], 'contract_id' => $contract['contract_id'], http_build_query(['courts' => $contract['arr_count']]), 'hour_start'=>$item['hour_start'],'hour_length'=>$item['hour_length']])}}" class="price btn-booking-tennis {{  isset($item['status']) ? "disabled": "" }}"  data-court="" data-hour_start="{{$item['hour_start']}}" data-hour_length="{{$item['hour_length']}}">
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
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br style="background: #fff">
                    @endforeach
                @endforeach
            </div>

        </div>

    </div>
    {{-- End Club block --}}
@endforeach