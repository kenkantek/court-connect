@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="row">
                <h2 style="color: #63ac1e; margin-top: 50px; margin-bottom: 30px;">Deals</h2>
                <div class="deal-list-wrapper col-md-12">
                    @foreach($deals as $k=>$deal)
                        <div class="item ">
                            <div class="col-md-4">
                                <a class="deal-link" href="{{route('home.checkout',['date'=>$deal->date,http_build_query(['courts'=>[$deal->court_id]]),'hour_start'=>$deal->hour,'hour_length'=>$deal->hour_length])}}">
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
                                <div class="caption datetime-carousel">
                                    <div class="">
                                        <i class="glyphicon glyphicon-calendar"></i> {{date('F jS Y', strtotime($deal->date))}} &nbsp;
                                    </div>
                                    <div class="">
                                        <i class="glyphicon glyphicon-time"></i>
                                        {{format_hour($deal->hour)}} -
                                        {{format_hour($deal->hour + $deal->hour_length)}}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                <div class="caoption price-carousel">
                                    ${{number_format($deal->price_nonmember,2)}}
                                </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination clearfix">
                    <?php echo $deals->render(); ?>
                </div>
            </div>
        </div>
    </div>
@stop