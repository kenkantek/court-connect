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
                            @foreach($bookings as $booking)
                                <tr class="booking-row-{{$booking->id}}" style="height: 150px">
                                    <td>
                                        <div class="col-md-4">
                                            <img src="{{ asset('resources/home/images/club-avatar.jpg') }}" class="img-circle" alt="{!! $booking->name !!}" width="58" height="58">
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
                                            Reservation: <span>{!! $booking->id !!}</span>
                                        </div>
                                        <div class="booking-type">
                                            Booking type: {{$booking->type}}
                                        </div>
                                        <div class="booking-price">
                                            Price: ${{$booking->total_price}}
                                        </div>
                                    </td>
                                    <td>
                                        <div><?php echo date('l jS F Y', strtotime($booking->date)) ?></div>
                                        <div>at {{($booking->hour <=12 ? str_replace(".5",":30",$booking->hour)."am" : str_replace(".5",":30",($booking->hour - 12))."pm") }}</div>
                                        <div>for {{$booking->hour_length}} Hour</div>
                                    </td>
                                    <td>
                                        <div>
                                            <ul>
                                                @foreach(json_decode($booking->players_info)->name as $item)
                                                    <li>{!! $item !!}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown yr-booking">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Modify
                                                <span class="glyphicon glyphicon-menu-down"></span>
                                            </button>
                                            <ul class="cc-action-booking dropdown-menu" aria-labelledby="">
                                                <li><a href="#" class="action-booking change-booking" data-booking="{{$booking->id}}">Change Booking</a></li>
                                                <li><a href="#" class="action-booking cancel-booking" data-booking="{{$booking->id}}">Cancel Booking</a></li>
                                                <li><a href="#" class="action-booking print-confirmation" data-booking="{{$booking->id}}">Print Confirmation</a></li>
                                                <li><a href="#" class="action-booking send-mail" data-booking="{{$booking->id}}">Export to Outlook</a></li>
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
                                {!! csrf_field() !!}
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
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="zipcode" class="control-label col-sm-3">Tennis Skill Level</label>
                                <div class="col-sm-2">
                                    <select name="skill" class="form-control select2">
                                        <option value="beginer">Beginner</option>
                                        <option value="professional">Professional</option>
                                    </select>
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

    <!-- modal update/change -->
    <div class="modal fade" tabindex="-1" role="dialog" id="cc-modal-booking-change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm change booking</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p>You can't perform the updates. Please cancel booking and book again !</p>
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
                                <th class="col-md-2">Reservation#</th>
                                <th class="col-md-3">Date/Time</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit">Accept Delete</button>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
                    dataType: "json",
                    beforeSend: function(){
                        $("#cc-modal-booking-cancel .modal-content").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                    },
                    success: function(res){
                        content = $(".booking-row-"+id_booking).clone();
                        content.find('td:first-child').remove();
                        content.find('td:last-child').remove();
                        content.find('td:last-child').remove();
                        $("#cc-modal-booking-cancel .btn-submit").data('booking',id_booking);
                        $("#cc-modal-booking-cancel .modal-body tbody").html(content.html());
                        $("#cc-modal-booking-cancel").modal('show');
                        $("#cc-modal-booking-cancel .loading").remove();

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
                    type: 'get',
                    data: {id: id_booking},
                    dataType: "json",
                    beforeSend: function(){
                        $("#cc-modal-booking-cancel").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                    },
                    success: function(res){
                        if(res.error){
                            $("#cc-modal-booking-cancel .btn-submit").attr('disabled','disabled');
                            $("#cc-modal-booking-cancel .modal-body .alert-danger").html(res.message).removeClass('hide');
                            $("#cc-modal-booking-cancel .loading").remove();
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
                    data: {id: id_booking},
                    dataType: 'json',
                    beforeSend: function(){
                        $("body").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                    },
                    success: function(res){ console.log(res);
                        $("body .loading").remove();
                        $("body * ").addClass('print-hide');
                        $("body .print-book-confirm").remove();
                        $("body").append('<div class="print-book-confirm">'+res.data+'</div>');
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
                    data: {id: id_booking},
                    beforeSend: function(){
                        $("body").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                    },
                    success: function(res){
                        alert(res.message);
                        $("body .loading").remove();
                    },
                    error: function(request, status, error){
                        console.log(request.responseText);
                    }
                })
            });
        });
    </script>
@stop