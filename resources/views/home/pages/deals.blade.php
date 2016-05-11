@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="row">
                <h2 style="color: #63ac1e; margin-top: 77px">Deals</h2>
                <div class="deal-list-wrapper col-md-12">
                    @foreach($deals as $k=>$deal)
                        <div class="item ">
                            <div class="col-md-4">
                                <a class="deal-link" href="{{route('home.checkout',['date'=>$deal->date,'court'=>$deal->court_id,'hour_start'=>$deal->hour,'hour_length'=>$deal->hour_length])}}">
                                <div class="img-carousel">
                                    <img src="{!! url("/").$deal->image !!}" width="205" height="205" alt="Chania">
                                </div>
                                <div class="caption title-carousel">
                                    {!! $deal->club_name !!}
                                </div>
                                <div class="caption location-carousel">
                                    {!! $deal->address !!}
                                </div>
                                <hr>
                                <div class="caption datetime-carousel">
                                    <i class="glyphicon glyphicon-calendar"></i> {{date('jS F Y', strtotime($deal->date))}} &nbsp;
                                    <i class="glyphicon glyphicon-time"></i>
                                    {{$deal->hour <=12 ? str_replace(".5",":30",$deal->hour)."am" : str_replace(".5",":30",($deal->hour - 12))."pm"}} -
                                    {{$deal->hour + $deal->hour_length <=12 ? str_replace(".5",":30",$deal->hour + $deal->hour_length)."am" : str_replace(".5",":30",($deal->hour + $deal->hour_length- 12))."pm"}}
                                </div>
                                <div class="caoption price-carousel">
                                    ${{$deal->price_nonmember}}
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