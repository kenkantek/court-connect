@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <h2><span>Sign Up To Court Connect</span></h2>
                <span style="font-weight: bold;">Create a Court Connect account to book, edit and review your court reservations.</span>
                <br><br>
                <small><span class="red"> *</span> Mandatory Field</small>
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
                    <label class="control-label col-sm-4" for="firstname">First Name<span class="red"> *</span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" value="{!! old('firstname') !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="lastname">Last Name<span class="red"> *</span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="{!! old('lastname') !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Email Address<span class="red"> *</span></label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="{!! old('email') !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">Password<span class="red"> *</span></label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="password" name="password" placeholder="***********">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="cfrpassword">Confirm Password<span class="red"> *</span></label>
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
                            <span>By clicking sign up, you agree to <a href="{{url('page/terms-of-use')}}" target="_blank">Terms of Service</a></span>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop