@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="col-sm-12">
                @include('home.blocks.error')
            </div>

            <div class="login-box">
                <div class="login-box-body">
                    <h3><span>Forgot Password</span></h3>
                    <form role="form" method="POST" action="{{ route('auth.password.email') }}">
                        {!! csrf_field() !!}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @else
                            <div class="form-group">
                                <br>
                                <p>Have you forgotten your password?</p>
                                <p>Please enter your Email address. System will send a email with active link to reset your password.</p>
                            </div>
                        @endif
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
                            <span class="fa fa-user form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info"><i class="fa fa-envelope-o"></i> Send</button>
                        </div>
                    </form>
                    <a href="{{ route('home.index') }}">Back to Home</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
@stop
