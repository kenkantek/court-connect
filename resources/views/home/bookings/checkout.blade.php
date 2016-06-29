@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="instruction">
                <h2><span>Checkout</span></h2>
                @if($msg_errors || $court->price['error'])
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @if($msg_errors)
                            <ul>
                                @foreach($msg_errors as $message)
                                    <li>{{$message}}</li>
                                @endforeach
                            </ul>
                        @else
                            @if(isset($court->price['messages']))
                                <ul>
                                    @if(!is_array($court->price['messages']))
                                        <li>{{$court->price['messages']}}</li>
                                    @elseif(is_array($court->price['messages']))
                                        @foreach($court->price['messages'] as $message)
                                            <li>{{$message}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            @elseif(isset($court->price['status']))
                                <ul>
                                    <li>{{$court->price['status'] == "booking" ? "This was booked" : $court->price['status']}}</li>
                                </ul>
                            @endif
                        @endif
                    </div>
                @else
                <?php
                    $date_booking = date_create($request->input('date'));
                    $intpart = floor($request->input('hour_start'));
                    $fraction = $request->input('hour_start') - $intpart;
                    date_time_set($date_booking, $intpart, $fraction);
                ?>
                <div class="container" id="form-checkout-wrapper">
                    @if( strtotime('now') > strtotime(date_format($date_booking, 'Y-m-d H:i:s')))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div>Warning. Date booking less than today!</div>
                        </div>
                    @endif

                    <div class="alert-message-box alert alert-danger alert-dismissible hide" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="alert-content"></div>
                    </div>

                    @if(!isset($court))
                        <h3 class="text-center">Can't found data</h3>
                    @else
                        @if(isset($court['price']['messages']))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div>This is {{$court['price']['messages']}}</div>
                            </div>

                        @else
                        {{-- left content --}}
                        <div class="col-lg-8 col-md-8 left-sidebar">
                            <form action="{{route("home.checkout")}}" class="form-horizontal" role="form" id="checkout-form" method="post">
                                {{-- Check exist user --}}
                                {!! csrf_field() !!}
                                <input type="hidden" name="date" value="{{$request->input('date')}}">
                                <input type="hidden" name="court" value="{{$request->input('court')}}">
                                <input type="hidden" name="hour_start" value="{{$request->input('hour_start')}}">
                                <input type="hidden" name="hour_length" value="{{$request->input('hour_length')}}">
                                @if($request->dayOfWeek)
                                    <input type="hidden" name="dayOfWeek" value="{{$request->input('dayOfWeek')}}">
                                    <input type="hidden" name="type" value="contract">
                                @endif
                                @if($request->contract_id)
                                    <input type="hidden" name="contract_id" value="{{$request->input('contract_id')}}">
                                @endif

                                @if(!Auth::check())
                                    <div class="nav nav-tabs text-left">
                                        <div class="active col-lg-6 col-md-6">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="is_customer" checked="checked" value="0">I'm A New Customer
                                                    <a data-toggle="tab" href="#new-customer" id="a-new-customer"></a>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="is_customer" value="1">
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
                                                        <input class="form-control" name="customer[email]"  type="email" id="email" placeholder="Enter Email Address"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="customer[password]" class="control-label col-lg-3 col-md-4">Password *</label>
                                                    <div class="col-lg-9 col-md-8">
                                                        <input class="form-control" name="customer[password]"  type="password" placeholder="*********"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="customer[password_confirmation]" class="control-label col-lg-3 col-md-4">Confirm Password *</label>
                                                    <div class="col-lg-9 col-md-8">
                                                        <input class="form-control" name="customer[password_confirmation]"  type="password" placeholder="*********"/>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div id="exist-customer" class="tab-pane fade">
                                            <fieldset class="text-left">
                                                <legend>Sign In</legend>
                                                <div class="col-lg-5 col-md-5">
                                                    <label for="email-login">Email Address</label>
                                                    <input type="email" class="form-control" name="email-login" id="email" placeholder="Enter Email Address">
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <label for="password-login">Password</label>
                                                    <input type="password" class="form-control" name="password-login" id="password-login" placeholder="*********">
                                                </div>
                                                <div class="col-lg-3 col-md-3 text-right">
                                                    <label style="display:block">&nbsp;</label>
                                                    <button type="button" class="btn-sub" id="btn-login-booking">Sign In</button>
                                                </div>
                                                <div class="col-md-12">
                                                    <a href="{{route('auth.password.reset')}}" style="color: red; padding-top: 10px; font-style: italic; display: block; text-align: center;">Forgot Password?</a>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                @endif
                                {{-- end check exist user --}}
                                <div id="cc-form-booking-info">
                                    <fieldset>
                                        <legend class="text-left">Customer Details</legend>
                                        <div class="form-group">
                                            <label for="title" class="control-label col-lg-2 col-md-3">Title</label>
                                            <div class="col-lg-3 col-md-3">
                                                <input class="form-control" name="customer[title]" type="text" id="title" placeholder="Enter Title"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstname" class="control-label col-lg-2 col-md-3">First Name *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->first_name: ""}}" required name="customer[first_name]" type="text" id="firstname" placeholder="Enter First Name"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname" class="control-label col-lg-2 col-md-3">Last Name *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->last_name: ""}}" required name="customer[last_name]" type="text" id="lastname" placeholder="Enter Last Name"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="control-label col-lg-2 col-md-3">Phone *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->phone: ""}}" required name="customer[phone]" type="phone" id="phone" placeholder="Enter Phone"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend class="text-left">Billing Address</legend>
                                        <div class="form-group">
                                            <label for="zip_code" class="control-label col-lg-2 col-md-3">Zipcode *</label>
                                            <div class="col-lg-3 col-md-3">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->zip_code: ""}}" name="customer[zip_code]" type="text" id="input-zip_code" placeholder="Enter Zipcode" value="" />
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <button class="btn-sub btn-get-address-lookup" type="button" style="padding: 9px;"> Address Lookup</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-address1" class="control-label col-lg-2 col-md-3">Address 1 *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->address1: ""}}" name="customer[address1]" type="text" id="input-address1" placeholder="Enter Address 1" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-address2" class="control-label col-lg-2 col-md-3">Address 2 *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->address2: ""}}" name="customer[address2]" type="text" id="input-address2" placeholder="Enter Address 2"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-city" class="control-label col-lg-2 col-md-3">City *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->city: ""}}" name="customer[city]" type="text" id="input-city" placeholder="Enter City"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-state" class="control-label col-lg-2 col-md-3">State *</label>
                                            <div class="col-lg-10 col-md-9">
                                                <input class="form-control" value="{{Auth::user() ? Auth::user()->state: ""}}" name="customer[state]" type="text" id="input-state" placeholder="Enter State"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend class="text-left">Player Details</legend>
                                        <div class="form-group text-left">
                                            <label for="state" class="col-lg-3 col-md-3">Number of Players</label>
                                            <div class="col-lg-2 col-md-2">
                                                <div class="dropdown">
                                                    <select name="player_num" id="numplayer" required class="form-control select2">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="alone-form-player-info" class="hidden">
                                            <div class="form-group">
                                                <div class="col-lg-5 col-md-5 text-left">
                                                    <label for="player-1-name">Player Name</label>
                                                    <input class="form-control player_name" value="{{Auth::user() ? Auth::user()->first_name ." ". Auth::user()->last_name: ""}}" type="text" placeholder="Player Name"/>
                                                </div>
                                                <div class="col-lg-7 col-md-7 text-left">
                                                    <label for="player-1-email">Player Email</label>
                                                    <input class="form-control player_email" value="{{Auth::user() ? Auth::user()->email: ""}}" type="email" placeholder="Player Email"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="group-player">
                                        </div>
                                    </fieldset>
                                    <fieldset class="payment-details">
                                        <legend class="text-left">Payment Details</legend>
                                        <div class="form-group">
                                            <div class="col-lg-2 col-md-2">
                                                <div class="payment-logo">
                                                    <img src="resources/home/images/mastercard-logo.jpg" class="img-responsive" alt="Mastercard">
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment[type]" value="mastercard" checked="checked">Mastercard
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2">
                                                <div class="payment-logo">
                                                    <img src="resources/home/images/visa-logo.jpg" class="img-responsive" alt="Visa">
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment[type]" value="visa">Visa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="payment-logo">
                                                    <img src="resources/home/images/amex-logo.jpg" class="img-responsive" alt="American Express">
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment[type]" value="ax">American Express
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2">
                                                <div class="payment-logo">
                                                    <img src="resources/home/images/discover-logo.jpg" class="img-responsive" alt="Discover">
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment[type]" value="discover" >Discover
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-left">
                                                <section class="col-lg-11 col-md-11">
                                                    <div class="bt-drop-in-wrapper">
                                                        <div id="bt-dropin"></div>
                                                    </div>
                                                </section>
                                                <div class="col-lg-1 col-md-1">
                                                    <label style="display:block;">&nbsp;</label>
                                                    <img src="resources/home/images/rear-of-card.jpg" class="img-responsive" alt="Rear Of Card">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group text-right">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn-sub">Confirm Booking</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </form>

                        </div>
                        {{-- end left content --}}

                        {{-- right content --}}
                        <div class="col-lg-3 col-lg-offset-1 col-md-4 right-sidebar">
                            <div class="detail-header">
                                <h4>Booking Details</h4>
                                <button onclick="window.history.back()" type="button" class="btn-sub">Edit</button>
                            </div>
                            <div class="detail-image">
                                <img src="{{url("/").$court->club->image}}" class="img-responsive" alt="club-image" style="width: 100%">
                            </div>
                            <div class="detail-top text-left">
                                <span class="club-name">{{$court->club->name}}</span>
                                <span class="address" style="color: #a0a0a0">{{$court->club->address}}</span>
                            </div>
                            <div class="detail-information">
                                <div class="form-group">
                                    <span class="col-lg-6 col-md-6 text-right">Indoor/Outdoor:</span>
                                    <label class="col-lg-6 col-md-6 text-left">{{$court->indoor_outdoor == 1 ? "Indoor" : "Outdoor"}}</label>
                                </div>
                                <div class="form-group">
                                    <span class="col-lg-6 col-md-6 text-right">Court Type:</span>
                                    <label class="col-lg-6 col-md-6 text-left" >{{$court->surface->label}}</label>
                                </div>
                                <div class="form-group">
                                    <span class="col-lg-6 col-md-6 text-right">Booking Type:</span>
                                    <label class="col-lg-6 col-md-6 text-left" style="text-transform: capitalize">{{$court->booking_type." court"}}</label>
                                </div>
                                <div class="form-group">
                                    <span class="col-lg-6 col-md-6 text-right">Date:</span>
                                    <label class="col-lg-6 col-md-6 text-left">{{$request->input('date')}}</label>
                                </div>
                                <div class="form-group">
                                    <span class="col-lg-6 col-md-6 text-right">Time:</span>
                                    <label class="col-lg-6 col-md-6 text-left">{{$request->input('hour_start') <=12 ? str_replace(".5",":30",$request->input('hour_start'))."am" : str_replace(".5",":30",($request->input('hour_start') - 12))."pm"}}</label>
                                </div>
                                <div class="form-group">
                                    <span class="col-lg-6 col-md-6 text-right">Length:</span>
                                    <label class="col-lg-6 col-md-6 text-left">{{$request->input('hour_length')}} Hour</label>
                                </div>
                            </div>

                            <div class="detail-price">
                                <div class="form-group">
                                    <span class="col-lg-5 text-right"><b>Total</b></span>
                                    <span class="col-lg-7 text-left price">${{$court->price['total_price']}}</span>
                                </div>
                            </div>
                        </div>
                        {{-- end right content --}}
                        @endif
                    @endif
                </div>

                @endif
            </div>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script>
        var client_token = "<?php echo(Braintree\ClientToken::generate()); ?>";
        var checkout;
        braintree.setup(client_token, "dropin", {
            container: "bt-dropin",
            paypal: {
                button: {
                    type: 'checkout'
                }
            },
            onError: function(data) {
                $(".alert-message-box").removeClass('hide').find('.alert-content').html(data.message);
                $(".loader").addClass('hidden');
            },
            paymentMethodNonceReceived: function (event,nonce) {
                $('#checkout-form').append("<input type='hidden' name='payment_method_nonce' value='"+ nonce +"'></input>");
                if($("input[name=is_customer]").val() == 1)
                    return;

                $.ajax({
                    url: base_url + "/checkout",
                    type: "post",
                    data: $("#checkout-form").serialize(),
                    dataType: "json",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){
                        $(".loader").removeClass('hidden');
                    },
                    success: function(result){
                        //console.log(result);
                        if(result.error){
                            $('html, body').animate({scrollTop : 0},800);
                            var msg ="<ul>";
                            $.each(result.messages,function(k,v){
                                msg += "<li>"+v+"</li>";
                            });
                            msg += "</ul>";
                            $(".alert-message-box").removeClass('hide').find('.alert-content').html(msg);
                            $("#form-checkout-wrapper .loading").remove();
                            $(".loader").addClass('hidden');
                        }else if(!result.error){
                            location.href = base_url + "/view-profile"
                        }
                    },
                    error: function(){
                        $(".alert-message-box").removeClass('hide').find('.alert-content').html("Error, Try again");
                        $(".loader").addClass('hidden');
                    }
                })
            },
            onReady: function(integration){
                checkout = integration;
            }
        });
    </script>

    <script>
        $(document).ready(function(){
            $('input[name="is_customer"]').on("change", function(){
                if($(this).val()==0){
                    $("#a-new-customer").click();
                    $('#cc-form-booking-info').removeClass('disabled');

                }else{
                    $("#a-exist-customer").click();
                    $('#cc-form-booking-info').addClass('disabled');
                }
            });

            $("#group-player").html('');
            for(var i=0; i < parseInt($("#numplayer").val()); i++){
                $("#group-player").append($("#alone-form-player-info").html())
            }
            $("#group-player input[type=text]").attr('required',"required");
            $("#group-player .player_name").attr({'name':'player_name[]','required':'required'});
            $("#group-player .player_email").attr({'name':'player_email[]','required':'required'});


            $("#numplayer").change(function(){
                $("#group-player").html('');
                for(var i=0; i < parseInt($(this).val()); i++){
                    $("#group-player").append($("#alone-form-player-info").html());
                    $("#group-player .player_name").attr({'name':'player_name[]','required':'required'});
                    $("#group-player .player_email").attr({'name':'player_email[]','required':'required'});
                }
            });

            //login
            $("#btn-login-booking").click(function(event){
                event.preventDefault();
                $.ajax({
                    url: base_url + "/login",
                    type: "post",
                    data: {_token: $("input[name=_token]").val(), email: $("input[name=email-login]").val(),password: $("input[name=password-login]").val()},
                    dataType: "json",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){
                        $("#exist-customer").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                    },
                    success: function(result){
                        console.log(result);
                        if(!result.error){
                            location.reload();
                        }else{
                            $('html, body').animate({scrollTop : 0},800);
                            $(".alert-message-box").removeClass('hide').find('.alert-content').html('Your email or password does not match!');
                            $("#exist-customer .loading").remove();
                        }
                    }
                })
            })
            //checkout form
            $("#checkout-form").on('submit',function(event){
                //event.preventDefault();

            })
        })

    </script>
    <style>
        .ui-datepicker-month, .ui-datepicker-year{
            padding: 0px;
        }
        .bootstrap-datetimepicker-widget span{
            text-align: center !important;
        }
    </style>
@stop
@section('javascript')
    {!! HTML::script("resources/vendor/moment/min/moment.min.js") !!}
    {!! HTML::script("resources/vendor/datetimepicker/build/js/bootstrap-datetimepicker.min.js") !!}
@stop