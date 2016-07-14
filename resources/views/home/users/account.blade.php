@extends('home.layouts.master')
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
                        <div class="alert alert-{!! Session::get('flash_level') !!}" style="text-align: center">
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
                                <th class="col-md-2">Reservation/Price</th>
                                <th class="col-md-3">Date/Time/# of Weeks</th>
                                <th class="col-md-2">Players</th>
                                <th class="col-md-2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                <tr class="booking-row booking-row-{{$booking->id}}" style="height: 170px">
                                    <td>
                                        <div class="col-md-4">
                                            <img src="{{ asset($booking->club_image) }}" class="img-circle" alt="{!! $booking->name !!}" width="58" height="58">
                                        </div>
                                        <div class="col-md-8">
                                            <p>
                                                <b>{!! $booking->club_name !!}</b>
                                                <br/>
                                                <span>{!! $booking->club_address !!}</span>
                                            </p>
                                            <span>Court #{!! $booking->court_name !!}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            Reservation: #<span>{!! $booking->id !!}</span>
                                        </div>
                                        <div class="booking-type">
                                            Booking type: <strong>{{$booking->type}}</strong>
                                        </div>
                                        <div class="booking-price">
                                            Price: ${{$booking->total_price}}
                                        </div>
                                    </td>
                                    <td>
                                        @if($booking->type == "contract")
                                            <div style="font-weight: bold">Date: {{$booking->date_range_of_contract['from']." - ".$booking->date_range_of_contract['to']}}</div>
                                            <div>Day of Week: {{dayOfWeek($booking->day_of_week)}}</div>
                                            <div>Number of Weeks: {{daysOfWeekBetween($booking->date_range_of_contract['from'],$booking->date_range_of_contract['to'],$booking->day_of_week)}}</div>
                                        @else
                                        <div>{{date('l jS F Y', strtotime($booking->date))}}</div>
                                        @endif
                                        <div>Time: {{format_hour($booking->hour) }}</div>
                                        <div>Length: {{str_replace('am','',str_replace('pm','',format_hour($booking->hour_length)))}} hour</div>

                                    </td>
                                    <td>
                                        <div>
                                            Number of players: {{count(json_decode($booking->players_info))}}
                                            <ul>
                                                @foreach(json_decode($booking->players_info)->name as $item)
                                                    @if(!is_null($item) && $item != '')
                                                        <li>{!! $item !!}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $date_booking = date_create($booking->date);
                                        $intpart = floor($booking->hour);
                                        $fraction = $booking->hour - $intpart;
                                        date_time_set($date_booking, $intpart, $fraction);
                                        ?>
                                        <div class="dropdown yr-booking">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action
                                                <span class="glyphicon glyphicon-menu-down"></span>
                                            </button>
                                            <ul class="cc-action-booking dropdown-menu" aria-labelledby="">
                                                @if($booking->type == 'contract')
                                                    @if($booking->status_booking != 'cancel' || (strtotime(date_format(date_create($booking->date_range_of_contract['from']), 'Y-m-d H:i:s')) < strtotime("now") &&
                                                    strtotime(date_format(date_create($booking->date_range_of_contract['to']), 'Y-m-d H:i:s')) > strtotime("now")))
                                                        <li><a href="#" class="action-booking change-booking" data-booking="{{$booking->id}}">Change Booking</a></li>
                                                        <li><a href="#" class="action-booking cancel-booking" data-booking="{{$booking->id}}">Cancel Booking</a></li>
                                                    @else
                                                    @endif
                                                @else
                                                    @if($booking->status_booking == 'cancel' || strtotime(date_format($date_booking, 'Y-m-d H:i:s')) < strtotime("now"))
                                                    @else
                                                        <li><a href="#" class="action-booking change-booking" data-booking="{{$booking->id}}">Change Booking</a></li>
                                                        <li><a href="#" class="action-booking cancel-booking" data-booking="{{$booking->id}}">Cancel Booking</a></li>
                                                    @endif
                                                @endif

                                                <li><a href="#" class="action-booking print-confirmation" data-booking="{{$booking->id}}">Print Confirmation</a></li>
                                                <li><a href="#" class="action-booking export-outlook" data-type="outlook" data-booking="{{$booking->id}}">Export to Outlook</a></li>
                                                <li><a href="#" class="action-booking export-outlook" data-type="google" data-booking="{{$booking->id}}">Export to Google</a></li>
                                            </ul>
                                        </div>

                                        @if($booking->type == 'contract')
                                                @if($booking->status_booking == 'cancel')
                                                    <div class='status-booking'>Status:<span>Cancelled</span></div>
                                                @elseif(strtotime(date_format(date_create($booking->date_range_of_contract['from']), 'Y-m-d H:i:s')) > strtotime("now") ||
                                                (strtotime(date_format(date_create($booking->date_range_of_contract['from']), 'Y-m-d H:i:s')) < strtotime("now") &&
                                                    strtotime(date_format(date_create($booking->date_range_of_contract['to']), 'Y-m-d H:i:s')) > strtotime("now")))
                                                    <div class='status-booking'>Status:<span>Booked</span></div>
                                                @else
                                                    <div class='status-booking'>Status:<span>Expired</span></div>
                                                @endif
                                        @else
                                                @if($booking->status_booking == 'cancel')
                                                    <div class='status-booking'>Status:<span>Cancelled</span></div>
                                                @elseif(strtotime(date_format($date_booking, 'Y-m-d H:i:s')) < strtotime("now"))
                                                    <div class='status-booking'>Status:<span>Expired</span></div>
                                                @else
                                                    <div class='status-booking'>Status:<span>Booked</span></div>
                                                @endif
                                        @endif
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
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('home.account.setting.password')}}">
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
                                    <input class="form-control" type="password" id="cfrpassword" name="cfrpassword" placeholder="******" value="" />
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
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('home.account.setting.contact')}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="email" class="control-label col-sm-3">Email Address</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="email" disabled id="email" name="email" placeholder="Enter Email Address" value="{!! old('email', Auth::user()->email)!!}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="control-label col-sm-3">Phone</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="phone" name="phone" placeholder="Enter Phone Number" value="{!! old('phone', Auth::user()->phone) !!}"/>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <button type="submit" class="btn-sub">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (Auth::user() != null)
                        <div class="form-blocks">
                            <h4 class="text-left">Address</h4>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('home.account.setting.address')}}">

                                <div class="form-group">
                                    <label for="input-zip_code" class="control-label col-sm-3">Zipcode</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" id="input-zip_code" name="zip_code" placeholder="Enter Zipcode" value="{!! old('zipcode', Auth::user()->zip_code)!!}" />
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn-sub btn-get-address-lookup" type="button" style="padding: 9px;"> Address Lookup</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-address1" class="control-label col-sm-3">Address 1</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" id="input-address1" name="address1" placeholder="Enter Address 1" value="{!! old('address1', Auth::user()->address1)!!}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-address2" class="control-label col-sm-3">Address 2</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" id="input-address2" name="address2" placeholder="Enter Address 2" value="{!! old('address2', Auth::user()->address2)!!}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-city" class="control-label col-sm-3">City</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" id="input-city" name="city" placeholder="Enter City" value="{!! old('city', Auth::user()->city)!!}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-state" class="control-label col-sm-3">State</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" id="input-state" name="state" placeholder="Enter State" value="{!! old('state', Auth::user()->state)!!}"/>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-2">
                                        <button type="submit" class="btn-sub">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="form-blocks">
                        <h4 class="text-left">Others</h4>
                        <form class="form-horizontal" role="form" method="post" action="{{ route('home.account.setting.other')}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="zipcode" class="control-label col-sm-3">Tennis Skill Level</label>
                                <div class="col-sm-2">
                                    <?php
                                        $skill  = Auth::user()->getPlayer() ? Auth::user()->getPlayer()->tenis_level : null;
                                        $cb_offers  = Auth::user()->getPlayer() ? Auth::user()->getPlayer()->receive_discount_offers : 0;
                                    ?>
                                    {!! Form::select("skill",
                                        ['0'=>'Beginner','1'=>'Professional','2'=>'Advanced','3'=>'3.0','4'=>'3.5', '5'=> '4.0', '6'=> '4.5', '7'=>'5.0', '8'=>'5.0+'],$skill,
                                    ['class'=>"form-control select2"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cb_offers" class="control-label col-sm-3">Receive Special Offers?</label>
                                <div class="col-sm-5">
                                    <div class="checkbox text-left">
                                        <label>
                                            <input type="checkbox" name="cb_offers" {{$cb_offers == 1 ? "checked" : ""}} value="1" id="cb_offers">
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

    <!-- modal update/change -->
    <div class="modal fade" tabindex="-1" role="dialog" id="cc-modal-booking-change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change booking</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p>You cannot change the booking. Please cancel and book again.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- modal cancel -->
    <div class="modal fade" tabindex="-1" role="dialog" id="cc-modal-booking-cancel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm cancel booking</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger hide"></div>
                    <table style="text-align: center">
                        <thead>
                            <tr>
                                <th style="padding: 10px 0px;" class="col-md-2 align-left">Reservation#</th>
                                <th style="padding: 10px 0px;" class="col-md-3 align-left">Date/Day/Time/Length</th>
                            </tr>
                        </thead>
                        <tbody align="left">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit">Accept Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <style>
        @media print {
            .print-hide{
                display: none;
                opacity: 0;
            }
            .print-book-confirm{
                display: block;
            }
        }
    </style>

    <script>

        $(document).ready(function(){
            //change booking
            $("body").on('click','.cc-action-booking .change-booking',function(e){
                e.preventDefault();
                $("#cc-modal-booking-change").modal('show');
            });

            //cancel booking
            $("body").on('click','.cc-action-booking .cancel-booking',function(e){
                e.preventDefault();
                var id_booking = $(this).data('booking');
                $.ajax({
                    url: base_url +"/check-update-booking",
                    type: 'post',
                    data: {id: id_booking},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    beforeSend: function(){
                        $(".loader").removeClass('hidden');
                        $("#cc-modal-booking-cancel .modal-body .alert-danger").html('').addClass('hide');
                    },
                    success: function(res){
                        content = $(".booking-row-"+id_booking).clone();
                        content.find('td:first-child').remove();
                        content.find('td:last-child').remove();
                        content.find('td:last-child').remove();
                        $("#cc-modal-booking-cancel .btn-submit").data('booking',id_booking);
                        $("#cc-modal-booking-cancel .modal-body tbody").html(content.html());
                        $("#cc-modal-booking-cancel").modal('show');
                        $(".loader").addClass('hidden');

                        $("#cc-modal-booking-cancel .modal-body .alert-danger").html(res.message).removeClass('hide');

                        if(res.error){
                            $("#cc-modal-booking-cancel .btn-submit").attr('disabled','disabled');
                        }else{
                            $("#cc-modal-booking-cancel .btn-submit").removeAttr('disabled');
                        }
                    },
                    error: function(request, status, error){
                        console.log(request.responseText);
                    }
                })
            });

            $("body").on('click','#cc-modal-booking-cancel .btn-submit',function(e){
                e.preventDefault();
                var id_booking = $(this).data('booking');
                $.ajax({
                    url: base_url +"/cancel-booking",
                    type: 'post',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {id: id_booking},
                    dataType: "json",
                    beforeSend: function(){
                        $(".loader").removeClass('hidden');
                    },
                    success: function(res){
                        if(res.error){
                            $("#cc-modal-booking-cancel .btn-submit").attr('disabled','disabled');
                            $("#cc-modal-booking-cancel .modal-body .alert-danger").html(res.message).removeClass('hide');
                            $(".loader").addClass('hidden');
                        }else{
                            alert("Cancel success!");
                            location.reload();
                        }
                    },
                    error: function(res){
                        console.log(res);
                    }
                })
            });

            //print
            $("body").on('click','.cc-action-booking .print-confirmation',function(e){
                e.preventDefault();
                var id_booking = $(this).data('booking');
                $.ajax({
                    url: base_url +"/print-confirmation",
                    type: 'post',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {id: id_booking},
//                    dataType: 'json',
                    beforeSend: function(){
                        $(".loader").removeClass('hidden');
                    },
                    success: function(res){
                        $(".loader").addClass('hidden');
                        $("body * ").addClass('print-hide');
                        $("body .print-book-confirm").remove();
                        $("body").append('<div class="print-book-confirm">'+res+'</div>');
                        window.print();
                    },
                    error: function(request, status, error){
                        console.log(request.responseText);
                    }
                })
            });

            //send mail
            $("body").on('click','.cc-action-booking .send-mail',function(e){
                e.preventDefault();
                var id_booking = $(this).data('booking');
                $.ajax({
                    url: base_url +"/send-mail",
                    type: 'post',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {id: id_booking},
                    beforeSend: function(){
                        $(".loader").removeClass('hidden');
                    },
                    success: function(res){
                        alert(res.message);
                        $(".loader").addClass('hidden');
                    },
                    error: function(request, status, error){
                        console.log(request.responseText);
                    }
                })
            });

            //export-outlook
            $("body").on('click','.cc-action-booking .export-outlook',function(e){
                location.href = base_url+'/export-calendar/'+$(this).data('booking')+"/"+$(this).data('type');
            });
        });
    </script>
@stop