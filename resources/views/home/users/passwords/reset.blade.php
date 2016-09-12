@extends('home.layouts.master')
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <h2 style="margin-top: 50px; margin-bottom: 0px;"><span>Forgot Password</span></h2>
            </div>

            <div class="login-box" style="margin-top: 20px">
                <div>
                    <form role="form" method="POST" action="{{ route('auth.password.reset') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                            <input type="email" class="form-control hidden" name="email" value="{{ $email or old('email') }}" placeholder="E-Mail Address">
                            <span class="fa fa-envelope-o form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                            <input type="password" class="form-control" name="password" placeholder="New password">
                            <span class="fa fa-user form-control-feedback"></span>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation">
                            <span class="fa fa-user form-control-feedback"></span>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info"><i class="fa fa-edit"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@stop