@extends('home.layouts.master')
@section('header')
<div class="row header-1">
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="logo"><img src="resources/home/images/logo_02.png" class="img-responsive logo" alt="logo"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Club Owners <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <span class="arrow-up"></span>

                            <form action="#" class="dropdown-wg" method="post" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" id=""
                                           placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id=""
                                           placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-login">Login</button>
                                <div class="form-group">
                                    <a href=""><label class="form-label">Forgot Password?</label></a>
                                </div>
                                <div class="form-group">
                                    <label style="font-family: RobotoBlackItalic, 'Helvetica Neue', Helvetica, Arial, sans-serif;color: #0f0f0f;font-size: 20px; font-weight: normal">Manage
                                        a Tennis Club?</label>
                                    <a data-toggle="modal" data-target="#myModal"><label class="form-label">Request
                                        an
                                        account</label></a>
                                </div>
                            </form>

                        </ul>
                    </li>
                    <li><a href="#">New Player</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Player Login <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <span class="arrow-up"></span>

                            <form action="#" class="dropdown-wg" method="post" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" id=""
                                           placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id=""
                                           placeholder="Password">
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
        </nav>        
    </div>
</div>
<div class="row header-1-bg"></div> 

@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <h2><span>Sign Up To Court Connect</span></h2>
                <span style="font-weight: bold;">Siging up with Court Connect will allow you to view and edit all your bookings and make reserveing your perfect court even quicker</span>
                <br/>
                <small>* Manditory Field</small>
            </div>
                
                <form class="form-horizontal" role="form">     
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="firstname">First Name*</label>
                      <div class="col-sm-5">          
                        <input type="text" class="form-control" id="firstname" placeholder="Enter First Name">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="lastname">Last Name*</label>
                      <div class="col-sm-5">          
                        <input type="text" class="form-control" id="lastname" placeholder="Enter Last Name">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Email Address*</label>
                      <div class="col-sm-5">          
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="pwd">Password*</label>
                      <div class="col-sm-5">          
                        <input type="password" class="form-control" id="pwd" placeholder="***********">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="cpwd">Confirm Password*</label>
                      <div class="col-sm-5">          
                        <input type="password" class="form-control" id="cpwd" placeholder="***********">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="cb_offers">Receive Special Offers?</label>
                      <div class="col-sm-5 text-left">          
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="cb_offers">
                            </label>
                          </div>
                      </div>
                    </div>

                    <div class="form-group submit">        
                      <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-default">Sign Up</button>  
                        <div class="submit-text">                                          
                            <span>By Clicking Sign Up, You Agree to <a href="#">Teams of Service</a></span>
                        </div>  
                      </div>
                    </div>      

            </form>
        </div>
    </div>
@stop