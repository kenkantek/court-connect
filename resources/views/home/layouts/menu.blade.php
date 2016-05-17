@if(Auth::check())
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">        
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->getFullName() }}<b
                    class="caret"></b></a>
            <ul class="dropdown-menu ">
                <span class="arrow-up"></span>
                <li class="text-center"><a href="{{ route('home.account') }}">Manage Account</a></li>
                <li class="text-center"><a href="{{ route('auth.logout-home') }}">Log out</a></li>
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

                <form action="{{ route('auth.login-home') }}" class="cc-loginFormUser dropdown-wg" method="post" role="form">
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
                    <button type="submit" class="btn btn-login"><i class="fa fa-circle-o-notch fa-spin hidden" style="text-align: left; float: left; line-height: 20px;"></i>Login</button>
                    <div class="form-group" style="margin-top: 10px">
                        <a href="{{ url("/password/reset") }}"><label class="form-label">Forgot Password?</label></a>
                    </div>

                    <div class="msg-login"></div>

                    <div class="form-group">
                        <h3 class="caption title" style="font-size: 21px; width: 100%; margin-top: 20px; margin-bottom: 5px;">Manage a Tennis Club?</h3>
                        <a href="#" id="cc-request-acount"><label class="form-label">Request an account</label></a>
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

                <form action="{{ route('auth.login-home') }}" class="cc-loginFormUser dropdown-wg" method="post" role="form">
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
                    <button type="submit" class="btn btn-login"><i class="fa fa-circle-o-notch fa-spin hidden" style="text-align: left; float: left; line-height: 20px;"></i>Login</button>
                    <div class="form-group" style="margin-top: 10px">
                        <a href="{{ url("/password/reset") }}"><label class="form-label">Forgot Password?</label></a>
                    </div>

                    <div class="msg-login"></div>

                    <div class="form-group" style="text-align: center">
                        <label class="line-label"><span>OR</span></label>
                    </div>
                    <div class="form-group" style="text-align: center; margin-bottom: 0px">
                        <a href="{{ route('auth.facebook') }}" class="btn-login-facebook"></a>
                    </div>
                </form>
            </ul>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->

<div id="cc-modal-request-account" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <img style="margin: auto; width: 180px;" src="{{ asset('resources/home/images/logo-color_05.png') }}" class="img-responsive logo" alt="logo">
                <h4 class="caption title" style="width: 100%; font-size: 22px; margin: 20px 0px;">Clubs Owners - Request an Account</h4>
                <p style="color:#000">Court Connect is a complete schedualing solution to connect your club with tennis fans. Call us now to discuss how managing and taking bookings can be made easy using Court-Connect.com</p>
                <div class="md-phone" style="font-size: 26px; color: #000; padding-top: 25px;">Call <strong>123456789</strong></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif