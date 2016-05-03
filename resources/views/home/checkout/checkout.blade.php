@extends('home.layouts.master')
@include('home.layouts.header')
@section('banner')
    <div class="row header-1-bg"></div> 
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <h2><span>Checkout</span></h2>     
                    <div class="container">

                        {{-- left content --}}
                        <div class="col-lg-8 col-md-8 left-sidebar">                            
                            <form class="form-horizontal" role="form" id="checkout-form">
                                    {{-- Check exist user --}}
                                    @if(!Auth::check())
                                    <div class="nav nav-tabs text-left">
                                        <div class="active col-lg-6 col-md-6">
                                            <div class="radio">
                                                <label>          
                                                    <input type="radio" name="rdCustomer" checked="checked" value="0">I'm A New Customer
                                                    <a data-toggle="tab" href="#new-customer" id="a-new-customer"></a> 
                                                </label>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="radio">
                                                <label>          
                                                    <input type="radio" name="rdCustomer" value="1">
                                                    I'm A Exist Customer. Sign In<a data-toggle="tab" href="#exist-customer" id="a-exist-customer"></a>
                                                </label>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="tab-content">                             
                                      <div id="new-customer" class="tab-pane fade in active">                                       
                                        <fieldset>
                                            <legend class="text-left">Create Account</legend>                                                         
                                            <div class="form-group">
                                                <label for="email" class="control-label col-lg-3 col-md-4">Email Address *</label>
                                                <div class="col-lg-9 col-md-8">
                                                    <input class="form-control" type="email" id="email" placeholder="Enter Email Address"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd" class="control-label col-lg-3 col-md-4">Password *</label>
                                                <div class="col-lg-9 col-md-8">
                                                    <input class="form-control" type="password" id="pwd" placeholder="*********"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cf-pwd" class="control-label col-lg-3 col-md-4">Confirm Password *</label>
                                                <div class="col-lg-9 col-md-8">
                                                    <input class="form-control" type="password" id="cf-pwd" placeholder="*********"/>
                                                </div>                                       
                                            </div>                                
                                        </fieldset>                                      
                                      </div>
                                      <div id="exist-customer" class="tab-pane fade">
                                        <fieldset class="text-left">
                                            <legend>Sign In</legend>                                                         
                                            <div class="col-lg-5 col-md-5">  
                                                <label for="email">Email Address</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address">
                                            </div>
                                            <div class="col-lg-4 col-md-4">  
                                                <label for="pwd">Password</label>
                                                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="*********">
                                            </div>    
                                            <div class="col-lg-3 col-md-3 text-right">  
                                                <label style="display:block">&nbsp;</label>
                                                <button type="button" class="btn-sub">Sign In</button>
                                            </div>                        
                                        </fieldset>  
                                      </div>
                                    </div>
                                    <script>
                                    $(document).ready(function(){
                                        $('input[name="rdCustomer"]').on("change", function(){
                                            if($(this).val()==0){                                        
                                                $("#a-new-customer").click();
                                            }else{                                        
                                                $("#a-exist-customer").click();
                                            }
                                        })
                                    })
                                    </script>
                                    @endif
                                    {{-- end check exist user --}}
                                    <fieldset>
                                        <legend class="text-left">Customer Details</legend>                                                            
                                        <div class="form-group">
                                            <label for="title" class="control-label col-lg-2 col-md-3">Title *</label>
                                            <div class="col-lg-3 col-md-3">
                                                <input class="form-control" type="text" id="title" placeholder="Enter Title"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstname" class="control-label col-lg-2 col-md-3">First Name *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" type="text" id="firstname" placeholder="Enter First Name"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname" class="control-label col-lg-2 col-md-3">Last Name *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" type="text" id="lastname" placeholder="Enter Last Name"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="control-label col-lg-2 col-md-3">Phone *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" type="phone" id="phone" placeholder="Enter Phone"/>
                                            </div>
                                        </div>                                                       
                                    </fieldset>
                                    <fieldset>
                                        <legend class="text-left">Billing Address</legend>                                                             
                                        <div class="form-group">
                                            <label for="zipcode" class="control-label col-lg-2 col-md-3">Zipcode *</label>
                                            <div class="col-lg-3 col-md-3">
                                                <input class="form-control" type="text" id="zipcode" placeholder="Enter Zipcode" value="123456" />
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <button class="btn-sub" type="button" style="padding: 9px;"> Address Lookup</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address1" class="control-label col-lg-2 col-md-3">Address 1 *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" type="text" id="address1" placeholder="Enter Address 1" value="Flat 1"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address2" class="control-label col-lg-2 col-md-3">Address 2 *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" type="text" id="address2" placeholder="Enter Address 2" value="49 Craven Avanue"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="city" class="control-label col-lg-2 col-md-3">City *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" type="text" id="city" placeholder="Enter City" value="London"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state" class="control-label col-lg-2 col-md-3">State *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" type="text" id="state" placeholder="Enter State" value="GREATER LONDON"/>
                                            </div>                                        
                                        </div>       
                                    </fieldset>
                                    <fieldset>
                                        <legend class="text-left">Player Details</legend>                                                      
                                        <div class="form-group text-left">
                                            <label for="state" class="col-lg-3 col-md-3">Number of Players</label>
                                            <div class="col-lg-2 col-md-2">
                                                <div class="dropdown">
                                                  <button class="btn btn-default dropdown-toggle" type="button" id="tennis-level" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    2
                                                    <span class="glyphicon glyphicon-menu-down"></span>
                                                  </button>
                                                  <ul class="dropdown-menu" aria-labelledby="tennis-level">
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>                                                                          
                                                    <li><a href="#">3</a></li>                                                                          
                                                  </ul>
                                                </div>
                                            </div>                                        
                                        </div>      
                                        
                                        
                                        <div class="form-group">                                        
                                            <div class="col-lg-5 col-md-5 text-left">
                                                <label for="player-1-name">Player Name</label>
                                                <input class="form-control" type="text" id="player-1-name" placeholder="Player 1 Name"/>
                                            </div>
                                            <div class="col-lg-7 col-md-7 text-left">
                                                <label for="player-1-email">Player Email</label>
                                                <input class="form-control" type="text" id="player-1-email" placeholder="Player 1 Email"/>
                                            </div>                                                
                                        </div>
                                        <div class="form-group">                                        
                                            <div class="col-lg-5 col-md-5">
                                                <input class="form-control" type="text" id="player-2-name" placeholder="Player 2 Name"/>
                                            </div>
                                            <div class="col-lg-7 col-md-7">
                                                <input class="form-control" type="text" id="player-2-email" placeholder="Player 2 Email"/>
                                            </div>                                                
                                        </div>         
                                    </fieldset>
                                    <fieldset class="payment-details">
                                        <legend class="text-left">Payment Details</legend>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2">      
                                                    <div class="payment-logo">
                                                        <img src="resources/home/images/mastercard-logo.jpg" class="img-responsive" alt="Mastercard">
                                                    </div>                                        
                                                    <div class="radio">                                                    
                                                        <label>                                                    
                                                            <input type="radio" name="rdPayment" checked="checked">Mastercard
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2">     
                                                    <div class="payment-logo">
                                                        <img src="resources/home/images/visa-logo.jpg" class="img-responsive" alt="Visa">    
                                                    </div>                                          
                                                    <div class="radio">                        
                                                      <label>                                                                                        
                                                        <input type="radio" name="rdPayment">Visa
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">   
                                                    <div class="payment-logo">
                                                        <img src="resources/home/images/amex-logo.jpg" class="img-responsive" alt="American Express">
                                                    </div>                                           
                                                    <div class="radio">
                                                      <label>
                                                        <input type="radio" name="rdPayment">American Express
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2">    
                                                    <div class="payment-logo">
                                                        <img src="resources/home/images/discover-logo.jpg" class="img-responsive" alt="Discover">
                                                    </div>                                           
                                                    <div class="radio">
                                                      <label>                                                    
                                                        <input type="radio" name="rdPayment">Discover
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2">                                            
                                                    <div class="payment-logo">
                                                        <img src="resources/home/images/paypal-logo.jpg" class="img-responsive" alt="Paypal">
                                                    </div>   
                                                    <div class="radio">
                                                      <label>                                                    
                                                        <input type="radio" name="rdPayment">Paypal
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>                                                     
                                        </div>        
                                        <div class="form-group">
                                            <div class="row text-left">
                                                <div class="col-lg-6 col-md-6">  
                                                    <label for="card-number">Card Number</label>
                                                    <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Enter Card Number">
                                                </div>
                                                <div class="col-lg-2 col-md-2">  
                                                    <label for="expiry">Expiry</label>
                                                     <div class="dropdown">
                                                      <button class="btn btn-default dropdown-toggle" type="button" id="expiry" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        -
                                                        <span class="glyphicon glyphicon-menu-down"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="expiry">
                                                        <li><a href="#">12/16</a></li>
                                                        <li><a href="#">01/17</a></li>                                                                         
                                                        <li><a href="#">02/18</a></li>                                                                         
                                                      </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3">  
                                                    <label for="ccv">CCV*</label>
                                                    <input type="text" class="form-control" name="ccv" id="ccv" placeholder="On Back Of Card">
                                                </div>
                                                <div class="col-lg-1 col-md-1"> 
                                                    <label style="display:block;">&nbsp;</label>
                                                    <img src="resources/home/images/rear-of-card.jpg" class="img-responsive" alt="Rear Of Card">
                                                </div>
                                            </div>
                                        </div>                              
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn-sub">Confirm Booking</button>
                                        </div>   
                                    </fieldset>
                                </form>


                            
                        </div>
                        

                        {{-- end left content --}}

                        {{-- right content --}}
                        <div class="col-lg-3 col-lg-offset-1 col-md-4 right-sidebar">
                            <div class="detail-header">
                                <h4>Booking Details</h4>    
                                <button type="button" class="btn-sub">Edit</button>    
                            </div>                                                                   
                            <div class="detail-image">                         
                                <img src="resources/home/images/club-image.jpg" class="img-responsive" alt="club-image" style="width: 100%">
                            </div>
                            <div class="detail-top text-left">
                                <span class="club-name">En Tout Cas</span>
                                <span class="address" style="color: #a0a0a0">456 Tout Road City, ST, 123456</span>
                            </div>
                            <div class="detail-information">
                                <div class="form-group">
                                  <span class="col-lg-6 col-md-6 text-right">Indoor/Outdoor:</span>
                                  <label class="col-lg-6 col-md-6 text-left">Indoor</label>
                                </div>
                                <div class="form-group">
                                  <span class="col-lg-6 col-md-6 text-right">Court Type:</span>
                                  <label class="col-lg-6 col-md-6 text-left">Hard</label>
                                </div>
                                <div class="form-group">
                                  <span class="col-lg-6 col-md-6 text-right">Booking Type:</span>
                                  <label class="col-lg-6 col-md-6 text-left">Open Court</label>
                                </div>
                                <div class="form-group">
                                  <span class="col-lg-6 col-md-6 text-right">Date:</span>
                                  <label class="col-lg-6 col-md-6 text-left">19/06/16</label>
                                </div>
                                <div class="form-group">
                                  <span class="col-lg-6 col-md-6 text-right">Time:</span>
                                  <label class="col-lg-6 col-md-6 text-left">9:00</label>
                                </div>
                                <div class="form-group">
                                  <span class="col-lg-6 col-md-6 text-right">Length:</span>
                                  <label class="col-lg-6 col-md-6 text-left">1 Hour</label>
                                </div>
                            </div>
                            
                            <div class="detail-price">
                                <div class="form-group">
                                  <span class="col-lg-5 text-right"><b>Total</b></span>
                                  <span class="col-lg-7 text-left price">$38</span>
                                </div>
                            </div>
                        </div>
                        {{-- end right content --}}
                    </div>
            </div>
        </div>
    </div>
@stop