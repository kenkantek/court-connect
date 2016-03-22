@if(Auth::check())
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">        
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->getFullName() }}<b
                    class="caret"></b></a>
            <ul class="dropdown-menu ">
                <span class="arrow-up"></span>
                <li class="text-center"><a href="{{ route('home.account', Auth::user()->id) }}">Manage Account</a></li>
                <li class="text-center"><a href="{{ route('auth.logout') }}">Log out</a></li>
            </ul>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->
@else
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Club Owners <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <span class="arrow-up"></span>

                <form action="{{ route('auth.login') }}" class="dropdown-wg" method="post" role="form">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="Email Address">
                        <span class="fa fa-user form-control-feedback"></span>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                        <input type="password" class="form-control" name="password" id=""
                               placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-login">Login</button>
                    <div class="form-group">
                        <a href=""><label class="form-label">Forgot Password?</label></a>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <label class="line-label"><span>OR</span></label>
                    </div>
                    <div class="form-group" style="text-align: center; margin-bottom: 0px">
                        <button type="submit" name="facebook-sigin" class="btn-login-facebook"></button>
                    </div>
                </form>
            </ul>
        </li>
        <li><a href="{{ route('home.signup') }}">New Player</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Player Login<b
                    class="caret"></b></a>
            <ul class="dropdown-menu">
                <span class="arrow-up"></span>

                <form action="{{ route('auth.login') }}" class="dropdown-wg" method="post" role="form">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="Email Address">
                        <span class="fa fa-user form-control-feedback"></span>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                        <input type="password" class="form-control" name="password" id=""
                               placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-login">Login</button>
                    <div class="form-group">
                        <a href=""><label class="form-label">Forgot Password?</label></a>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <label class="line-label"><span>OR</span></label>
                    </div>
                    <div class="form-group" style="text-align: center; margin-bottom: 0px">
                        <button type="submit" name="facebook-sigin" class="btn-login-facebook"></button>
                    </div>
                </form>
            </ul>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->
@endif