<template>
    <div class="modal fade mb-modal" style="display: none; top: 50px" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create A New Booking</h4>
                </div>
                <div class="modal-body">
                    <div id="mb-create-new-booking">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs mb-tabs" role="tablist">
                            <li role="presentation" class="li-first active">
                                <a class="a-first" href="#mb-booking-detail-content" aria-controls="mb-booking-detail-content" role="tab" data-toggle="tab">Booking detail</a>
                            </li>
                            <li role="presentation" class="tab-disabled" >
                                <a href="#mb-customer-details-content" aria-controls="mb-customer-details-content" role="tab" data-toggle="tab">Customer Detail</a>
                            </li>
                            <li role="presentation" class="tab-disabled" >
                                <a href="#mb-payment-details-content" aria-controls="mb-payment-details-content" role="tab" data-toggle="tab">Payment Detail</a>
                            </li>
                            <li role="presentation" class="tab-disabled" >
                                <a href="#mb-confirmation-content" aria-controls="mb-confirmation-content" role="tab" data-toggle="tab">Confirmation</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="mb-tab-content tab-content">
                            <div role="tabpanel" class="tab-pane active" id="mb-booking-detail-content">
                                <form action="">
                                    <div class="slc-type mb-group-sl">
                                        <h4 class="mb-title-h4-modal text-center">Select a Booking Type</h4>
                                        <div class="col-xs-12 col-md-4">
                                            <input type="radio" name="book-type" value="open" id="book-type-open" v-model="inputBookingDetail.type">
                                            <label for="book-type-opentime">Open Time</label>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <input type="radio" name="book-type" value="contract" id="book-type-contract" v-model="inputBookingDetail.type">
                                            <label for="book-type-contract">Contract Time</label>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <input type="radio" name="book-type" value="lesson" id="book-type-lesson" v-model="inputBookingDetail.type">
                                            <label for="book-type-lesson">Lesson</label>
                                        </div>
                                    </div>
                                    <div class="slc-member mb-group-sl">
                                        <h4 class="mb-title-h4-modal text-center">Member?</h4>
                                        <div class="col-sm-6">
                                            <input type="radio" value="1" checked="checked" name="book-member" id="book-member-yes" v-model="inputBookingDetail.member">
                                            <label for="book-member-yes">Yes</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="radio" value="0" name="book-member" id="book-member-no" v-model="inputBookingDetail.member">
                                            <label for="book-member-no">No</label>
                                        </div>
                                    </div>
                                    <div class="slc-day-hour">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="slc-type-open slc-type-lesson slc-type-group">
                                                <h4 class="mb-title-h4-modal text-center">Select a Date</h4>
                                                <input type="text" class="form-control" name="mb-book-day-open" id="mb-book-day-open" v-model="inputBookingDetail.date">
                                            </div>
                                            <div class="slc-type-contract slc-type-group">
                                                <h4 class="mb-title-h4-modal text-center">Select a Date Period</h4>
                                                <input type="text" class="form-control" name="mb-book-day-contract" id="mb-book-day-contract" v-model="inputBookingDetail.date_range">
                                                <h4 class="mb-title-h4-modal text-center">Start Day</h4>
                                                <select name="mb-book-start-day-contract" class="form-control" v-model="inputBookingDetail.dayOfWeek">
                                                    <option value="mon">Monday</option>
                                                    <option value="tue">Tuesday</option>
                                                    <option value="web">Wednesday</option>
                                                    <option value="thu">Thursday</option>
                                                    <option value="fri">Friday</option>
                                                    <option value="sat">Saturday</option>
                                                    <option value="sun">Sunday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <h4 class="mb-title-h4-modal text-center">Select a Time</h4>
                                            <select name="mb-book-hour" class="form-control" v-model="inputBookingDetail.hour_start">
                                                <option v-for="item in hours" value="{{item.key}}">{{item.value}}</option>
                                            </select>
                                            <h4 class="mb-title-h4-modal text-center">length</h4>
                                            <input id="mb-book-in-hour" class="ionslider" type="text" name="mb-book-in-hour" >
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="mb-group-sl slc-type-contract slc-type-group">
                                        <div class="col-xs-12 col-md-12">
                                            <span>Total day: 35</span>
                                        </div>
                                    </div>

                                    <div class="mb-group-sl">
                                        <div class="col-xs-12 col-md-12" style="margin: 20px 0px">
                                            <h4 class="mb-title-h4-modal text-center">Select a Court</h4>
                                            <select name="mb-book-court" class="form-control" v-model="inputBookingDetail.court_id">
                                                <option v-for="(index,court) in courts" value="{{ court.id }}" >{{ court.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-group-sl slc-type-contract slc-type-group">
                                        <div class="col-xs-12 col-md-12">
                                            <h4 class="mb-title-h4-modal text-center">Extras</h4>
                                            <input type="checkbox" class="styled" value="1" v-model="inputBookingDetail.extras" v-model="inputBookingDetail.extra_id">
                                            <label for="">Balls($10)</label>
                                        </div>
                                    </div>
                                    <div class="mb-group-sl slc-type-lesson slc-type-group">
                                        <div class="col-xs-12 col-md-12">
                                            <h4 class="mb-title-h4-modal text-center">Choose a Teacher</h4>
                                            <select name="mb-book-teacher" class="form-control" v-model="inputBookingDetail.teacher_id">
                                                @for($i=1; $i<110; $i++)
                                                <option value="{{$i}}">Teacher #{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="mb-group-sl">
                                        <div class="col-xs-12 col-md-12">
                                            <h4 class="mb-title-h4-modal text-center">Order Total: <strong class="price" style="">${{total_price}} </strong></h4>
                                            <div id="viewPriceOrder" class="btn" @click.prevent="viewPriceOrder()">View price</div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="mb-group-sl">
                                        <div class="col-xs-12 col-md-12">
                                            <div class="pull-right">
                                                <input type="button" value="Next" class="btn btn-primary" @click.prevent="nextCustomerDetail()">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane " id="mb-customer-details-content">
                                <div class="info-booking-details">
                                    <h4 class="bold pull-left">Booking Details</h4>
                                    <a href="" id="mb-edit-booking-details" class="btn btn-primary pull-right" @click.prevent="preBookingDetail()">Edit</a>
                                    <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                </div>
                                <div class="clearfix"></div>
                                <table class="tbl-info-booking-details" style="width: 100%">
                                    <tr>
                                        <td>
                                            <div>Booking Type: <b style="text-transform: capitalize">{{inputBookingDetail.type}}</b></div>
                                            <div>Member: <b>{{inputBookingDetail.member == 1 ? "Yes" : "No"}}</b></div>
                                        </td>

                                        <td>
                                            <div>Date: <b>{{inputBookingDetail.date}}</b></div>
                                            <div>Time: <b>{{inputBookingDetail.hour_start <= 12 ? inputBookingDetail.hour_start + " am" : (inputBookingDetail.hour_start - 12) + " pm"}}</b></div>
                                            <div>Length: <b>{{inputBookingDetail.hour_length}} Hour</b></div>
                                        </td>

                                        <td>
                                            <div>Court: <b>{{court_detail.name}}</b></div>
                                        </td>
                                        <td>
                                            <div>Cost: <b>${{total_price}}</b></div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="info-customers-details">
                                    <h4 class="pull-left bold">Customer Details</h4>
                                    <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                    <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data">

                                        <div style="width: 300px; margin: 0px auto" v-if="inputBookingDetail.member == 1">
                                            <label>Select a player for booking</label>
                                            <select class="js-data-user-ajax" name="player_id" id="player_id" v-model="customerDetail.player_id">
                                                <option value="">Select user member</option>
                                            </select>
                                        </div>
                                        <div v-else>
                                            <div class="form-group">
                                                <label for="surname" class="col-sm-4 control-label">Customer Lookup</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" placeholder="Surname" name="surname" type="text" value="" id="surname" v-model="customerDetail.surname">
                                                </div>
                                            </div>
                                            <div class="clearfix" style="padding-bottom: 20px;"></div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <label for="title">Title *</label>
                                                    <input class="form-control" placeholder="Title" name="title" type="text" value="" id="title" v-model="customerDetail.title">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="firstname">Fist Name *</label>
                                                    <input class="form-control" placeholder="First name" name="first_name" type="text" value="" id="firstname" v-model="customerDetail.first_name">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="lastname">Last Name *</label>
                                                    <input class="form-control" placeholder="Lastname" name="lastname" type="text" value="" id="lastname" v-model="customerDetail.last_name">
                                                </div>
                                            </div>
                                            <div class="clearfix" style="padding-bottom: 20px;"></div>
                                            <div class="form-group clearfix">
                                                <label for="zipcode" class="col-sm-2 control-label">Zipcode *</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" placeholder="Enter Zip Code" style="width: 50%; margin-right: 10px;" name="Zipcode" type="text" value="" id="zipcode" v-model="customerDetail.zip_code">
                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-primary" type="button" @click="address_lookup()">Address Lookup</button>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="address1" class="col-sm-2 control-label">Address 1 *</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="Address Line 1" name="address1" type="text" value="" id="address1" v-model="customerDetail.address1">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="address2" class="col-sm-2 control-label">Address 2</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="Address Line 2" name="address2" type="text" value="" id="address2" v-model="customerDetail.address2">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="city" class="col-sm-2 control-label">City *</label>
                                                <div class=" col-sm-10">
                                                    <input class="form-control" placeholder="City" name="city" type="text" value="" id="city" v-model="customerDetail.city">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="state" class="col-sm-2 control-label">State *</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="State" name="state" type="text" value="" id="state" v-model="customerDetail.state">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="email" class="col-sm-2 control-label">Email *</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="Email" name="email" type="text" value="" id="email" v-model="customerDetail.email">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="phone" class="col-sm-2 control-label">Phone *</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="Phone" name="phone" type="text" value="" id="phone" v-model="customerDetail.phone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <input type="button" class="btn btn-primary pull-right" type="submit" value="Next" @click.prevent="nextPayment()">
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane " id="mb-payment-details-content">
                                <div class="info-booking-details">
                                    <h4 class="bold pull-left">Booking Details</h4>
                                    <a href="" id="mb-edit-booking-details" class="btn btn-primary pull-right" @click.prevent="preBookingDetail()">Edit</a>
                                    <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                </div>

                                <div class="clearfix"></div>
                                <table class="tbl-info-booking-details" style="width: 100%">
                                    <tr>
                                        <td>
                                            <div>Booking Type: <b style="text-transform: capitalize">{{inputBookingDetail.type}}</b></div>
                                            <div>Member: <b>{{inputBookingDetail.member == 1 ? "Yes" : "No"}}</b></div>
                                        </td>

                                        <td>
                                            <div>Date: <b>{{inputBookingDetail.date}}</b></div>
                                            <div>Time: <b>{{inputBookingDetail.hour_start <= 12 ? inputBookingDetail.hour_start + " am" : (inputBookingDetail.hour_start - 12) + " pm"}}</b></div>
                                            <div>Length: <b>{{inputBookingDetail.hour_length}} Hour</b></div>
                                        </td>

                                        <td>
                                            <div>Court: <b>{{court_detail.name}}</b></div>
                                        </td>
                                        <td>
                                            <div>Cost: <b>${{total_price}}</b></div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="info-customers-details">
                                    <div class="info-booking-details">
                                        <h4 class="bold pull-left">Customer Details</h4>
                                        <a href="" id="mb-edit-booking-details" class="btn btn-primary pull-right" @click.prevent="preCustomerDetail()">Edit</a>
                                        <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                    </div>
                                    <div class="clearfix"></div>
                                    <table style="width: 100%">
                                        <tr>
                                            <td>Name: </td>
                                            <td>{{customerDetail.first_name + " " + customerDetail.last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address: </td>
                                            <td>{{customerDetail.address1 + ", " + customerDetail.city + ", "+ customerDetail.state}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td>{{customerDetail.email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tel: </td>
                                            <td>{{customerDetail.phone}}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="info-payment-details">
                                    <h4 class="bold pull-left">Payment Details</h4>
                                    <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                    <div class="clearfix"></div>
                                    <form method="POST" action="/sadmin/booking/abc" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="DbSaxkk2WraIAh6Jav0pV8o8wIgYs4NIANN5oPpv">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-3">
                                                <label for="cost-adjustment">Cost Adjustment</label>
                                                <input class="form-control" placeholder="-$10" name="cost-adjustment" type="text" value="" id="cost-adjustment" v-model="paymentDetail.cost_adj">
                                            </div>
                                            <div class="col-xs-12 col-md-9">
                                                <label for="adjustment-reason">Adjustment Reason</label>
                                                <input class="form-control" placeholder="eg. Manager Discount" name="adjustment-reason" type="text" value="" id="adjustment-reason" v-model="paymentDetail.adj_reason">
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="pull-left payment-item">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_mastercard.png" alt="mastercard">
                                                </div>
                                                <input name="payment" type="radio" value="mastercard" id="mastercard" v-model="paymentDetail.type">
                                                <label for="mastercard">Mastercard</label>
                                            </div>
                                            <div class="pull-left payment-item">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_visa.png" alt="visa">
                                                </div>
                                                <input name="payment" type="radio" value="visa" id="visa" v-model="paymentDetail.type">
                                                <label for="visa">Visa</label>
                                            </div>
                                            <div class="pull-left payment-item" style="width: 32%">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_emerican_express.png" alt="american-express">
                                                </div>
                                                <input name="payment" type="radio" value="american-express" id="american-express" v-model="paymentDetail.type">
                                                <label for="mastercard">American Express</label>
                                            </div>
                                            <div class="pull-left payment-item">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_discover.png" alt="discover">
                                                </div>
                                                <input name="payment" type="radio" value="discover" id="discover" v-model="paymentDetail.type">
                                                <label for="discover">Discover</label>
                                            </div>
                                            <div class="pull-left payment-item">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_cash.png" alt="cash">
                                                </div>
                                                <input name="cash" type="radio" value="cash" id="cash" v-model="paymentDetail.type">
                                                <label for="mastercard">Cash</label>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="pull-left">
                                                <label for="card-number">Card Number</label>
                                                <input type="text" name="card-number" class="form-control" id="card-number" placeholder="12345672234566" v-model="paymentDetail.card_number" style="width: 240px;">
                                            </div>
                                            <div class="pull-left" style="position: relative">
                                                <label for="card-expiry">Expiry</label>
                                                <input type="text" name="card-expiry" class="form-control" id="card-expiry" placeholder="06/17" v-model="paymentDetail.expiry" style="width: 120px; margin: 0px 10px;">
                                            </div>
                                            <div class="pull-left">
                                                <label for="card-cvv">CVV*</label>
                                                <input type="text" name="card-cvv" class="form-control" id="card-cvv" placeholder="123" v-model="paymentDetail.cvv" style="width: 100px; margin-right: 10px;">
                                            </div>
                                            <div class="pull-right">
                                                <img src="/resources/admin/img/icon_payment-cart.png" alt="card" style="margin-top: 25px;" >
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <input type="submit" value="Next" class="btn btn-primary pull-right" @click.prevent="nextConfirmation()">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane " id="mb-confirmation-content">
                                <h3 class="text-center">Complete!</h3>
                                <div id="print-receipt" class="btn btn-primary btn-md-cpl" onclick="partPrint('#InfoOrderComplete');">
                                    <i class="fa fa-print" aria-hidden="true"></i>Print Receipt
                                </div>
                                <div id="email-receipt" class="btn btn-primary btn-md-cpl">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>Email Receipt
                                </div>

                                <div id="InfoOrderComplete">
                                    <div class="info-booking-details">
                                        <h4 class="bold pull-left">Booking Details</h4>
                                        <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                    </div>
                                    <table class="tbl-info-booking-details" style="width: 100%">
                                        <tr>
                                            <td>
                                                <div>Booking Type: <b style="text-transform: capitalize">{{inputBookingDetail.type}}</b></div>
                                                <div>Member: <b>{{inputBookingDetail.member == 1 ? "Yes" : "No"}}</b></div>
                                            </td>

                                            <td>
                                                <div>Date: <b>{{inputBookingDetail.date}}</b></div>
                                                <div>Time: <b>{{inputBookingDetail.hour_start <= 12 ? inputBookingDetail.hour_start + " am" : (inputBookingDetail.hour_start - 12) + " pm"}}</b></div>
                                                <div>Length: <b>{{inputBookingDetail.hour_length}} Hour</b></div>
                                            </td>

                                            <td>
                                                <div>Court: <b>{{court_detail.name}}</b></div>
                                            </td>
                                            <td>
                                                <div>Cost: <b>${{total_price}}</b></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="info-customers-details">
                                        <div class="info-booking-details">
                                            <h4 class="bold pull-left">Customer Details</h4>
                                            <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="clearfix"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <td>Name: </td>
                                                <td>{{customerDetail.first_name + " " + customerDetail.last_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Address: </td>
                                                <td>{{customerDetail.address1 + ", " + customerDetail.city + ", "+ customerDetail.state}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email: </td>
                                                <td>{{customerDetail.email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tel: </td>
                                                <td>{{customerDetail.phone}}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="info-payment-details">
                                        <div class="info-booking-details">
                                            <h4 class="bold pull-left">Payment Details</h4>
                                            <hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="clearfix"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <td>Type: </td>
                                                <td>{{paymentDetail.type}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card Number: </td>
                                                <td>{{paymentDetail.card_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Reference: </td>
                                                <td>{{booking_reference}}</td>
                                            </tr>
                                            <tr>
                                                <td>Amount: </td>
                                                <td>${{total_price}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
    var _ = require('lodash'),
            deferred = require('deferred');
    export default {
        props: ['clubSettingId','clickNewBooking','flagChangeDataOfDate'],
        data (){
        return {
            courts: [],
            inputBookingDetail:{
                type: null,
                member: 1,
                date: null,
                date_range: null,
                hour_start: 5,
                hour_length: 1,
                dayOfWeek: null,
                court_id: null,
                extra_id: [],
                teacher_id: null,
                club_id: null,
                num_player: 0,
            },
            customerDetail:{
                player_id: null,
                surname: null,
                title: null,
                firstname: null,
                lastname: null,
                zipcode: null,
                address1: null,
                address2: null,
                state: null,
                city: null,
                email: null,
                phone: null,
            },
            paymentDetail:{
                cost_adj: null,
                adj_reason: null,
                type: "mastercard",
                card_number: null,
                expiry: null,
                cvv: null,
            },
            court_detail:{
                name: null,
            },
            booking_reference: null,
            total_price: '',
            hours:[
                {key: 5, value: "5am"}, {key: 5.50, value: "5:30am"}, {key: 6, value: "6am"}, {key: 6.50, value: "6:30am"},
                {key: 7, value: "7am"}, {key: 7.50, value: "7:30am"}, {key: 8, value: "8am"}, {key: 8.50, value: "8:30am"},
                {key: 9, value: "9am"}, {key: 9.50, value: "9:30am"}, {key: 10, value: "10am"}, {key: 10.50, value: "10:30am"},
                {key: 11, value: "11am"}, {key: 11.50, value: "11:30am"}, {key: 12, value: "12am"}, {key: 12.50, value: "12:30pm"},
                {key: 13, value: "1pm"}, {key: 13.50, value: "1:30pm"}, {key: 14, value: "2pm"}, {key: 14.50, value: "2:30pm"},
                {key: 15, value: "3pm"}, {key: 15.50, value: "3:30pm"}, {key: 16, value: "4pm"}, {key: 16.50, value: "4:30pm"},
                {key: 17, value: "5pm"}, {key: 17.50, value: "5:30pm"}, {key: 18, value: "6pm"}, {key: 18.50, value: "6:30pm"},
                {key: 19, value: "7pm"}, {key: 19.50, value: "7:30pm"}, {key: 20, value: "8pm"}, {key: 20.50, value: "8:30pm"},
                {key: 21, value: "9pm"}, {key: 21.50, value: "9:30pm"}, {key: 22, value: "10pm"}
            ],
            inputBookingDetail_bk: null,
            customerDetail_bk: null,
            paymentDetail_bk: null,
        }
    },
    watch: {
        clubSettingId: 'reloadAsyncData',
        total_price: 'reloadAsyncData',
        clickNewBooking: 'resetData'
    },
    asyncData(resolve, reject) {
        this.fetchCourts().done((courts) => {
            resolve({courts});
    }, (error) => {
        console.log(error);
    });

    },
    methods: {
        fetchCourts() {
            let def = deferred(),
                    url = laroute.route('clubs.courts.list', {one:this.clubSettingId});
            this.$http.get(url).then(res => {
                def.resolve(res.data.data);
        }, res => {
            def.reject(res);
        });
        return def.promise;
    },
    viewPriceOrder(){
        this.$set('inputBookingDetail.hour_length',$("#mb-book-in-hour").val());
        this.$set('inputBookingDetail.date',$("#mb-book-day-open").val());
        this.$set('inputBookingDetail.club_id',this.clubSettingId);
        const input = this.inputBookingDetail;

        let def = deferred(),
                url = laroute.route('booking.viewPriceOrder', input);
        this.$http.get(url).then(res => {
            if(res.data.error) {
            var msg = "";
            $.each(res.data.messages,function(k,v){
                msg += "<div>"+v+"</div>";
            });
            this.total_price = "NaN";
            showNotice('error', msg, 'Error!');
        }else
        {
            this.total_price = res.data.total_price;
        }
    }, res => {

    });
    },
    nextCustomerDetail(){
        this.$set('inputBookingDetail.hour_length',$("#mb-book-in-hour").val());
        this.$set('inputBookingDetail.date',$("#mb-book-day-open").val());
        this.$set('inputBookingDetail.club_id',this.clubSettingId);
        const input = this.inputBookingDetail;

        // check validate data
        let def = deferred(),
                url = laroute.route('booking.checkInputBooking', input);
        this.$http.get(url).then(res => {
            if(res.data.error)
            {
                var msg = "";
                $.each(res.data.messages,function(k,v){
                    msg += "<div>"+v+"</div>";
                });
                this.total_price = "NaN";
                showNotice('error', msg, 'Error!');
            }else{
                this.total_price = res.data.total_price;
                this.court_detail = res.data.court_detail;
                this.tabClick("mb-customer-details-content")
            }
        }, res => {

        });
    },
    nextPayment(){
            if(this.inputBookingDetail.member == 1){
                this.customerDetail.player_id = $("#player_id").val();
                this.$http.get(laroute.route('booking.checkPlayerforBooking', {one: this.customerDetail.player_id})).then(res => {
                    if(res.data.success)
                    {
                        var player = res.data.player; console.log(player);
                        this.customerDetail.first_name = player.first_name;
                        this.customerDetail.last_name = player.last_name;
                        this.customerDetail.address1 = player.address1;
                        this.customerDetail.state = player.state;
                        this.customerDetail.city = player.city;
                        this.customerDetail.email = player.email;
                        this.customerDetail.phone = player.phone;
                        this.tabClick("mb-payment-details-content");
                    }else{
                        var msg = "";
                        $.each(res.data.messages,function(k,v){
                            msg += "<div>"+v+"</div>";
                        });
                        showNotice('error', msg, 'Error!');
                    }
                }, res => {

                });
            }
            else{
                const customer = this.customerDetail;
                // check validate customer
                let def = deferred(),
                url = laroute.route('booking.checkInputCustomer', customer);
                this.$http.get(url).then(res => {
                    if(res.data.error)
                    {
                        var msg = "";
                        $.each(res.data.messages,function(k,v){
                            msg += "<div>"+v+"</div>";
                        });
                        showNotice('error', msg, 'Error!');
                    }else{
                        this.tabClick("mb-payment-details-content");
                    }
                }, res => {

                });
            }


        },
        nextConfirmation(){
            var data = new FormData();
            data.append('infoBooking',JSON.stringify(this.inputBookingDetail));
            data.append('customer',JSON.stringify(this.customerDetail));
            data.append('payment',JSON.stringify(this.paymentDetail));
            data.append('total_price', this.total_price);
            // check validate customer
            this.$http.post('/sadmin/booking/check-input-payment', data).then(res => {
                if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else{
                    this.booking_reference = res.data.booking_id;
                    this.flagChangeDataOfDate = Math.random();
                    this.$dispatch('child-change-flagChangeDataOfDate', this.flagChangeDataOfDate);
                    this.tabClick("mb-confirmation-content")
                }
            }, res => {

            });
        },
        preBookingDetail(){
            this.tabClick("mb-booking-detail-content")
        },
        preCustomerDetail(){
            this.tabClick("mb-customer-details-content")
        },
        tabClick(element){
            $("#mb-create-new-booking .mb-tabs li").removeClass('active').addClass('tab-disabled');
            $("a[href="+"#"+element+"]").parent().addClass('active');
            $(".tab-pane").removeClass('active');
            $("#"+element).addClass('active');
        },
        resetData(){
            this.fetchCourts();
            this.preBookingDetail();
            this.inputBookingDetail = {
                type: null,
                        member: 1,
                        date: null,
                        date_range: null,
                        hour_start: 5,
                        hour_length: 1,
                        dayOfWeek: null,
                        court_id: null,
                        extra_id: [],
                        teacher_id: null,
                        club_id: null,
                        num_player: null
            };
            this.customerDetail = {
                        player_id: null,
                        surname: null,
                        title: null,
                        first_name: null,
                        last_name: null,
                        zip_code: null,
                        address1: null,
                        address2: null,
                        state: null,
                        city: null,
                        email: null,
                        phone: null,
            };
            this.paymentDetail = {
                cost_adj: null,
                        adj_reason: null,
                        type: "mastercard",
                        card_number: null,
                        expiry: null,
                        cvv: null,
            },
            this.court_detail = {
                name: null,
            };
            this.booking_reference = null;
            this.total_price = '';
        },
        address_lookup(){
            this.$http.get(laroute.route('booking.address_lookup', {one: this.customerDetail.zipcode})).then(res => {
                if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else{
                    console.log(res.data);
                    this.customerDetail.state = res.data.state;
                    this.customerDetail.city = res.data.city;
                }
            }, res => {

            });
        }
    },ready () {
        //test model open
        //$(".create_new_book").click();

        $("li.tab-disabled").click(function (e) {
            console.log("abc");
            e.preventDefault();
            return false;
        });

        $(".li-first, .a-first").click(function (e) {
            e.preventDefault();
            return false;
        });

        $("#mb-book-in-hour").ionRangeSlider({
            min: 1,
            max:7,
            type: 'single',
            step: 1,
            postfix: " Hour",
            prettify: false,
            hasGrid: true,
            hideMinMax: true,
        });

    },
    beforeDestroy () {

    }
    }

</script>