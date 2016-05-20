@extends('home.layouts.master')
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <div class="login-box">
                    <div class="login-box-body">
                        <h3><span>Reset Password</span></h3>
                        <div>
                            <form role="form" method="POST" action="{{ route('auth.password.reset') }}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                                    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="E-Mail Address">
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
        </div>

    </div>
@stop