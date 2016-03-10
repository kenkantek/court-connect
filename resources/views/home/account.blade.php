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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Anthony Cooper <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Your Account</a></li>
                            <li><a href="#">Your Bookings</a></li>
                            <li><a href="#">Logout</a></li>   
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
                <h2><span>Your Account</span></h2>     
                 <div class="container">
                    <div class="page-header">
                        <h3 class="text-left">Your Bookings</h3> 
                      </div>                                          
                  <div class="table-responsive">          
                      <table class="table">
                        <thead>
                          <tr>               
                            <th class="col-md-3">Club</th>
                            <th class="col-md-2">Reservation#</th>
                            <th class="col-md-3">Date/Time</th>
                            <th class="col-md-2">Players</th>
                            <th class="col-md-2"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>                
                            <td>
                                <div class="col-md-4">
                                    <img src="resources/home/images/club-avatar.jpg" class="img-circle" alt="Club Avatar" width="58" height="58">     
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        <b>Entout Cas</b>
                                        <br/>
                                        <span>135 Tennis Avanue</span>
                                    </p>                               
                                    <span>Court #5</span>
                                </div>   
                            </td>
                            <td>
                                <b>123456798</b>
                            </td>
                            <td>
                                <b>Friday 19th June 2016</b>
                            </td>
                            <td>
                                <div>
                                    <b>Brian Brendell</b>
                                </div>
                                <div>
                                    <b>Ray Kaplan</b>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown yr-booking">
                                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Modify
                                    <span class="glyphicon glyphicon-menu-down"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="">
                                    <li><a href="#">Modify</a></li>
                                    <li><a href="#">Delete</a></li>                                                                          
                                  </ul>
                                </div>
                            </td>
                          </tr>
                          <tr>                
                            <td>
                                <div class="col-md-4">
                                    <img src="resources/home/images/club-avatar.jpg" class="img-circle" alt="Club Avatar" width="58" height="58">     
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        <b>Entout Cas</b>
                                        <br/>
                                        <span>135 Tennis Avanue</span>
                                    </p>                               
                                    <span>Court #5</span>
                                </div>   
                            </td>
                            <td>
                                <b>123456798</b>
                            </td>
                            <td>
                                <b>Friday 19th June 2016</b>
                            </td>
                            <td>
                                <div>
                                    <b>Brian Brendell</b>
                                </div>
                                <div>
                                    <b>Ray Kaplan</b>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown yr-booking">
                                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Modify
                                    <span class="glyphicon glyphicon-menu-down"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="">
                                    <li><a href="#">Modify</a></li>
                                    <li><a href="#">Delete</a></li>                                                                          
                                  </ul>
                                </div>
                            </td>
                          </tr>
                          <tr>                
                            <td>
                                <div class="col-md-4">
                                    <img src="resources/home/images/club-avatar.jpg" class="img-circle" alt="Club Avatar" width="58" height="58">     
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        <b>Entout Cas</b>
                                        <br/>
                                        <span>135 Tennis Avanue</span>
                                    </p>                               
                                    <span>Court #5</span>
                                </div>   
                            </td>
                            <td>
                                <b>123456798</b>
                            </td>
                            <td>
                                <b>Friday 19th June 2016</b>
                            </td>
                            <td>
                                <div>
                                    <b>Brian Brendell</b>
                                </div>
                                <div>
                                    <b>Ray Kaplan</b>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown yr-booking">
                                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Modify
                                    <span class="glyphicon glyphicon-menu-down"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="">
                                    <li><a href="#">Modify</a></li>
                                    <li><a href="#">Delete</a></li>                                                                          
                                  </ul>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>

                <div class="container">
                    <div class="page-header">
                        <h3 class="text-left">Settings</h3>
                    </div>
                     
                    <div class="form-blocks">
                        <h4 class="text-left">Contact Details</h4>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="email" class="control-label col-sm-3">Email Address</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="email" id="email" placeholder="Enter Email Address" value="AntonCooper@gmail.com" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="control-label col-sm-3">Phone</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="phone" placeholder="Enter Phone Number" value="07791105194"/>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button type="submit" class="btn-sub">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-blocks">
                        <h4 class="text-left">Address</h4>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="zipcode" class="control-label col-sm-3">Zipcode</label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="zipcode" placeholder="Enter Zipcode" value="123456" />
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn-sub" type="button" style="padding: 9px;"> Address Lookup</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address1" class="control-label col-sm-3">Address 1</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="address1" placeholder="Enter Address 1" value="Flat 1"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address2" class="control-label col-sm-3">Address 2</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="address2" placeholder="Enter Address 2" value="49 Craven Avanue"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="control-label col-sm-3">City</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="city" placeholder="Enter City" value="London"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="state" class="control-label col-sm-3">State</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="state" placeholder="Enter State" value="GREATER LONDON"/>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button type="submit" class="btn-sub">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-blocks">
                        <h4 class="text-left">Others</h4>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="zipcode" class="control-label col-sm-3">Tennis Skill Level</label>
                                <div class="col-sm-2">
                                    <div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" id="tennis-level" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Beginner
                                        <span class="glyphicon glyphicon-menu-down"></span>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="tennis-level">
                                        <li><a href="#">Beginner</a></li>
                                        <li><a href="#">Professional</a></li>                                                                          
                                      </ul>
                                    </div>
                                </div>                               
                            </div>            
                            <div class="form-group">
                                <label for="cb_offers" class="control-label col-sm-3">Receive Special Offers?</label>
                                <div class="col-sm-5">
                                    <div class="checkbox text-left">
                                        <label>
                                          <input type="checkbox" id="cb_offers">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button type="submit" class="btn-sub">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop