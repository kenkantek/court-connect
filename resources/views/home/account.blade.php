@extends('home.layouts.master')
@include('home.layouts.header')
@section('banner')
    <div class="row header-1-bg"></div> 
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <h2><span>Your Account</span></h2>     
                 <div class="container">
                     @if (Session::has('flash_message'))                                  
                        <div class="alert alert-{!! Session::get('flash_level') !!}">
                            {!! Session::get('flash_message') !!}
                        </div>     
                    @endif         
                    @include('home.blocks.error')        
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
                        @foreach($booking as $item)
                        <?php 
                        // var_dump($item);die();
                            $court  = DB::table('courts')->where('id', $item['court_id'])->first();
                            $club   = DB::table('clubs')->where('id', $court->club_id)->first();                            
                            $player = DB::table('players')->where('id', $item['player_id'])->first();  
                            $user   = DB::table('users')->where('id', $player->user_id)->first();                            
                        ?>
                          <tr>                
                            <td>
                                <div class="col-md-4">
                                    <img src="{{ asset('resources/home/images/club-avatar.jpg') }}" class="img-circle" alt="{!! $club->name !!}" width="58" height="58">     
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        <b>{!! $club->name !!}</b>
                                        <br/>
                                        <span>{!! $club->address !!}</span>
                                    </p>                               
                                    <span>Court #{!! $item['court_id'] !!}</span>
                                </div>   
                            </td>
                            <td>
                                <b>{!! $item['id'] !!}</b>
                            </td>
                            <td>
                                <b><?php echo date('l jS F Y', strtotime($item['created_at'])) ?></b>                                
                            </td>
                            <td>
                                <div>
                                    <b>{!! $user->first_name." ".$user->last_name !!}</b>
                                </div>                               
                            </td>
                            <td>
                                <div class="dropdown yr-booking">
                                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Modify
                                    <span class="glyphicon glyphicon-menu-down"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="">
                                    <li><a href="#">Change Booking</a></li>
                                    <li><a href="#">Cancel Booking</a></li>
                                    <li><a href="#">Print Confirmation</a></li>                       
                                    <li><a href="#">Export to Outlook</a></li>                     
                                  </ul>
                                </div>
                            </td>
                          </tr>    
                          @endforeach                      
                        </tbody>
                      </table>
                  </div>
                </div>

                <div class="container">
                    <div class="page-header">
                        <h3 class="text-left">Settings</h3>                        
                    </div>

                    <div class="form-blocks">
                        <h4 class="text-left">Pasword</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('home.account.setting.password', $user->id)}}">
                            {!! csrf_field() !!}                            
                            <div class="form-group">                                
                                <label for="password" class="control-label col-sm-3">New Password</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="password" id="password" name="password" placeholder="******" value="" />
                                </div>
                            </div>
                            <div class="form-group">                                
                                <label for="cfrpassword" class="control-label col-sm-3">New Password Confirmation</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="password" id="cfrpassword" name="password" placeholder="******" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="old-password" class="control-label col-sm-3">Old Password</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="password" id="old_password" name="old_password" placeholder="******" value=""/>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button type="submit" class="btn-sub">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                     
                    <div class="form-blocks">
                        <h4 class="text-left">Contact Details</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('home.account.setting.contact', $user->id)}}">
                            {!! csrf_field() !!}                            
                            <div class="form-group">                                
                                <label for="email" class="control-label col-sm-3">Email Address</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Enter Email Address" value="{!! old('email', isset($user) ? $user->email : null)!!}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="control-label col-sm-3">Phone</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="phone" name="phone" placeholder="Enter Phone Number" value="{!! old('phone', isset($user) ? $user->phone : null)!!}"/>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button type="submit" class="btn-sub">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-blocks">
                        <h4 class="text-left">Address</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('home.account.setting.address', $player->id)}}">
                            {!! csrf_field() !!}     
                            <div class="form-group">
                                <label for="zipcode" class="control-label col-sm-3">Zipcode</label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="zipcode" name="zipcode" placeholder="Enter Zipcode" value="{!! old('zipcode', isset($player) ? $player->zipcode : null)!!}" />
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn-sub" type="button" style="padding: 9px;"> Address Lookup</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address1" class="control-label col-sm-3">Address 1</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="address1" name="address1" placeholder="Enter Address 1" value="{!! old('address1', isset($player) ? $player->address1 : null)!!}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address2" class="control-label col-sm-3">Address 2</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="address2" name="address2" placeholder="Enter Address 2" value="{!! old('address2', isset($player) ? $player->address2 : null)!!}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="control-label col-sm-3">City</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="city" name="city" placeholder="Enter City" value="{!! old('city', isset($player) ? $player->city : null)!!}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="state" class="control-label col-sm-3">State</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="state" name="state" placeholder="Enter State" value="{!! old('state', isset($player) ? $player->state : null)!!}"/>
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