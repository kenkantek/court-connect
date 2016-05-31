@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <h2><span>Sign Up To Court Connect</span></h2>
                <span style="font-weight: bold;">Signing up with Court Connect will allow you to view and edit all your bookings and make reserveing your perfect court even quicker</span>
                <br>
                <small>* Manditory Field</small>
                <br>
                <br>
            </div>
            <div class="col-sm-12">
                @include('home.blocks.error')
            </div>

            <form class="form-horizontal" role="form" method="POST" action="">
                {{-- <form class="form-horizontal" role="form" method="POST" action="{!! URL::route('home.signup') !!}">   --}}
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-sm-4" for="firstname">First Name*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" value="{!! old('firstname') !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="lastname">Last Name*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="{!! old('lastname') !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Email Address*</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="{!! old('email') !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">Password*</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="password" name="password" placeholder="***********">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="cfrpassword">Confirm Password*</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="cfrpassword" name="cfrpassword" placeholder="***********">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="cb_offers">Receive Special Offers?</label>
                    <div class="col-sm-5 text-left">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="cb_offers" name="cb_offers" value="1">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group submit">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-default">Sign Up</button>
                        <div class="submit-text">
                            <span>By Clicking Sign Up, You Agree to <a href="{{url('page/term-of-service')}}">Term of Service</a></span>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop