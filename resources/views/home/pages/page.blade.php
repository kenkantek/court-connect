@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="row">
                <h2 style="color: #63ac1e; margin-top: 50px; margin-bottom: 30px;">{{$page->title}}</h2>
                <div class="content col-md-12 text-left">
                    {!! $page->description !!}
                </div>
                <div class="clearfix"></div>
                <br>
            </div>
        </div>
    </div>
@stop