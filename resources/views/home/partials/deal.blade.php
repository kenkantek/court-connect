{{-- begin ddeals-near-you --}}
<div class="deals">
    <h2 style="color: #63ac1e; margin-top: 77px">Deals Near You</h2>
    @if(count($deals) > 0)
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($deals as $k=>$deal)
                @if($k!=0 && $k % 3 == 0)
                </div>
                @endif
                @if($k==0 || $k % 3 == 0)
                    @if($k==0)
                    <div class="item active">
                    @else
                        <div class="item">
                    @endif
                @endif
                <div class="col-md-4">
                    <a class="deal-link" href="{{route('home.checkout',['date'=>$deal->date,'court'=>$deal->court_id,'hour_start'=>$deal->hour,'hour_length'=>$deal->hour_length])}}">

                        <div class="img-carousel">
                            <img src="{!! url("/").$deal->image !!}" width="205" height="205" alt="Chania">
                        </div>
                        <div class="caption title-carousel">
                            {!! $deal->club_name !!}
                        </div>
                        <div class="caption location-carousel">
                            {!! $deal->city.", ".$deal->state !!}
                        </div>
                        <hr>
                        <div class="datetime-carousel">
                            <i class="glyphicon glyphicon-calendar"></i> {{date('F jS Y', strtotime($deal->date))}} &nbsp;
                            <i class="glyphicon glyphicon-time"></i>
                            {{format_hour($deal->hour)}} -
                            {{format_hour($deal->hour + $deal->hour_length)}}
                        </div>
                        <div class="caoption price-carousel">
                            ${{number_format($deal->price_nonmember,2)}}
                        </div>
                    </a>
                </div>
            @endforeach
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
    @endif
{{-- end deals-near-you --}}