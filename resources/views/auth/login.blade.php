@extends('auth.layouts.master')
@section('content')
    <h3>System Login</h3>
    <div>
        <form role="form" method="POST" action="{{ route('auth.login') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Please enter your email!">
                <span class="fa fa-user form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="fa fa-key form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox" class="styled" name="remember" value="1" id="remember"> Remember me?
                  </label>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-info"><i class="fa fa-unlock"></i> Login</button>
              </div>
            </form>
            <a href="{{ route('auth.password.reset') }}">Forgot password?</a>
        </form>
    </div>
</div>
@include('admin.elements.notice')
@endsection
