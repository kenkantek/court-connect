@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="row">
                <h2 style="color: #63ac1e; margin-top: 50px; margin-bottom: 30px;">FAQS</h2>
                <div class="content col-md-12 text-left">
                    @foreach($data as $item)
                        <div class="panel-group col-md-12" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapse-checkout-option-{{$item->id}}" data-toggle="collapse" class="accordion-toggle" aria-expanded="true">
                                            {{$item->question}}
                                            <i class="fa fa-caret-down"></i>
                                        </a></h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapse-checkout-option-{{$item->id}}">
                                    <div class="panel-body">
                                        {!! $item->answer !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <br>
            </div>
        </div>
    </div>
@stop