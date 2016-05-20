@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="row">
                <br>
                @if ( session()->has('caffeinated.flash.message') )
                    <div class="alert alert-{{session()->get('caffeinated.flash.level')}}">
                        {!! session()->get('caffeinated.flash.message') !!}
                    </div>

                @else
                    <hr>
                    <a href="/" class="btn-blue">Back to Home</a>
                @endif
            </div>
        </div>
    </div>
    </div>
@stop