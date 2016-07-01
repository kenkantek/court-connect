@extends('auth.layouts.master')
@section('content')
    <h3>Forgot Password</h3>
    <div>
        <form role="form" method="POST" action="{{ route('auth.password.email') }}">
            {!! csrf_field() !!}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @else
                <div class="form-group">
                    <p>Enter your email address and we'll send you link to reset your password.</p>
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
        <a href="{{ route('auth.login') }}">Back to login</a>
    </div>
@endsection