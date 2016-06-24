<template>
    <div class="modal fade mb-modal" style="display: none;" id="myModal" role="dialog" aria-labelledby="myModalLabel">
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
                                            <input type="radio" name="book-type" value="open" id="book-type-open" v-model="inputBookingDetail.type" v-on:change="changeBookingType">
                                            <label for="book-type-open">Open Time</label>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <input type="radio" name="book-type" value="contract" id="book-type-contract" v-model="inputBookingDetail.type" v-on:change="changeBookingType">
                                            <label for="book-type-contract">Contract Time</label>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <input type="radio" name="book-type" value="lesson" id="book-type-lesson" v-model="inputBookingDetail.type" v-on:change="changeBookingType">
                                            <label for="book-type-lesson">Lesson</label>
                                        </div>
                                    </div>
                                    <div class="slc-member mb-group-sl">
                                        <h4 class="mb-title-h4-modal text-center">Member?</h4>
                                        <div class="col-sm-6">
                                            <input type="radio" value="1" name="book-member" id="book-member-yes" v-model="inputBookingDetail.member" v-on:change="changeBookingType">
                                            <label for="book-member-yes">Yes</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="radio" value="0" checked="checked" name="book-member" id="book-member-no" v-model="inputBookingDetail.member" v-on:change="changeBookingType">
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
                                                <select name="mb-book-day-contract" class="form-control" v-model="inputBookingDetail.contract_id" v-on:change="changeContract">
                                                    <option value="">--Select--</option>
                                                    <option v-for="item in contracts" value="{{item.id}}">{{item.start_date + " - " + item.end_date}}</option>
                                                </select>
                                                <h4 class="mb-title-h4-modal text-center">Start Day</h4>
                                                <select name="mb-book-start-day-contract" class="form-control" v-model="inputBookingDetail.dayOfWeek">
                                                    <option value="1">Monday</option>
                                                    <option value="2">Tuesday</option>
                                                    <option value="3">Wednesday</option>
                                                    <option value="4">Thursday</option>
                                                    <option value="5">Friday</option>
                                                    <option value="6">Saturday</option>
                                                    <option value="7">Sunday</option>
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
                                            <span>Total day: {{info_contract.total_week}}</span>
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
                                                <div v-for="item in info_contract.extras">
                                                    <input type="checkbox" class="styled" value="{{item.name}}" v-model="inputBookingDetail.extra_id">
                                                    <label for="">{{item.name + "("+item.value+")"}}</label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="mb-group-sl slc-type-lesson slc-type-group">
                                        <div class="col-xs-12 col-md-12">
                                            <h4 class="mb-title-h4-modal text-center">Choose a Teacher</h4>
                                            <select name="mb-book-teacher" class="form-control" v-model="inputBookingDetail.teacher_id">
                                                <option value="">--Select--</option>
                                                <option v-for="item in teachers" value="{{item.id}}">{{item.first_name + " "+ item.last_name+ " - Price: $" + item.teacher.rate}}</option>
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
                                            <div v-if="inputBookingDetail.type != 'contract'">
                                                Date: <b>{{inputBookingDetail.date}}</b>
                                            </div>
                                            <div v-else>
                                                Date Period: <br><b>{{info_contract.start_date + " - " + info_contract.end_date}}</b>
                                            </div>
                                            <div>Time: <b>{{inputBookingDetail.hour_start <= 12 ? (inputBookingDetail.hour_start + "").replace(".5",":30") + " am" : ((inputBookingDetail.hour_start - 12)+"").replace(".5",":30") + " pm"}}</b></div>
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

                                        <div style="width: 300px; margin: 0px auto" class="{{inputBookingDetail.member == 1 ? 'block' :'hidden'}}">
                                            <label>Select a player member for booking</label>
                                            <select class="js-data-user-ajax" name="player_id" id="player_id" v-model="customerDetail.player_id">
                                                <option value="">Select user member</option>
                                            </select>
                                        </div>
                                        <div class="{{inputBookingDetail.member == 1 ? 'hidden' :'block'}}">
                                            <div class="form-group">
                                                <label for="surname" class="col-sm-4 btn btn-primary" @click="customer_lookup()">Customer Lookup</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" placeholder="Surname" name="surname" type="text" value="" id="surname" v-model="surname">
                                                </div>
                                            </div>
                                            <div class="clearfix" style="padding-bottom: 20px;"></div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <label for="title">Title</label>
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
                                                <label for="input-zip_code" class="col-sm-2 control-label">Zipcode *</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" placeholder="Enter Zip Code" style="width: 50%; margin-right: 10px;" name="zipcode" type="text" value="" id="input-zip_code" v-model="customerDetail.zip_code">
                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-primary" type="button" @click="address_lookup()">Address Lookup</button>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="address1" class="col-sm-2 control-label">Address 1 *</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="Address Line 1" name="address1" type="text" value="" id="input-address1" v-model="customerDetail.address1">
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
                                                    <input class="form-control" placeholder="City" name="city" type="text" value="" id="input-city" v-model="customerDetail.city">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label for="state" class="col-sm-2 control-label">State *</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" placeholder="State" name="state" type="text" value="" id="input-state" v-model="customerDetail.state">
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
                                            <div v-if="inputBookingDetail.type != 'contract'">
                                                Date: <b>{{inputBookingDetail.date}}</b>
                                            </div>
                                            <div v-else>
                                                Date Period: <br><b>{{info_contract.start_date + " - " + info_contract.end_date}}</b>
                                            </div>
                                            <div>Time: <b>{{inputBookingDetail.hour_start <= 12 ? (inputBookingDetail.hour_start  + "").replace(".5",":30") + " am" : ((inputBookingDetail.hour_start - 12)+"").replace(".5",":30") + " pm"}}</b></div>
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
                                    <form method="POST" id="checkout-form" action="/sadmin/booking" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="DbSaxkk2WraIAh6Jav0pV8o8wIgYs4NIANN5oPpv">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-3">
                                                <label for="cost-adjustment">Cost Adjustment</label>
                                                <input class="form-control" placeholder="-$10" name="cost-adjustment" type="number" value="" id="cost-adjustment" v-model="paymentDetail.cost_adj">
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
                                                <input name="payment" type="radio" value="mastercard" id="mastercard" v-model="paymentDetail.type" v-on:change="changePaymentType">
                                                <label for="mastercard">Mastercard</label>
                                            </div>
                                            <div class="pull-left payment-item">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_visa.png" alt="visa">
                                                </div>
                                                <input name="payment" type="radio" value="visa" id="visa" v-model="paymentDetail.type" v-on:change="changePaymentType">
                                                <label for="visa">Visa</label>
                                            </div>
                                            <div class="pull-left payment-item" style="width: 32%">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_emerican_express.png" alt="american-express">
                                                </div>
                                                <input name="payment" type="radio" value="american-express" id="american-express" v-model="paymentDetail.type" v-on:change="changePaymentType">
                                                <label for="mastercard">American Express</label>
                                            </div>
                                            <div class="pull-left payment-item">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_discover.png" alt="discover">
                                                </div>
                                                <input name="payment" type="radio" value="discover" id="discover" v-model="paymentDetail.type" v-on:change="changePaymentType">
                                                <label for="discover">Discover</label>
                                            </div>
                                            <div class="pull-left payment-item">
                                                <div class="img-wrap">
                                                    <img src="/resources/admin/img/icon_payment_cash.png" alt="cash">
                                                </div>
                                                <input name="cash" type="radio" value="cash" id="cash" v-model="paymentDetail.type" v-on:change="changePaymentType">
                                                <label for="mastercard">Cash</label>
                                            </div>
                                        </div>
                                        <section class="">
                                            <div v-show="!payment_is_cash" class="bt-drop-in-wrapper">
                                                <div id="bt-dropin"></div>
                                            </div>
                                        </section>

                                        <div class="form-group clearfix">
                                            <input v-show="!payment_is_cash" type="submit" value="Next" class="btn btn-primary pull-right">
                                            <input v-show="payment_is_cash" type="submit" value="Next" class="btn btn-primary pull-right" @click.prevent="nextConfirmation()">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane " id="mb-confirmation-content">
                                <h3 class="text-center">Complete!</h3>
                                <div id="print-receipt" class="btn btn-primary btn-md-cpl" onclick="partPrint('#InfoOrderComplete');">
                                    <i class="fa fa-print" aria-hidden="true"></i>Print Receipt
                                </div>
                                <div id="email-receipt" class="btn btn-primary btn-md-cpl" @click.prevent="emailReceipt()">
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
                                                <div v-if="inputBookingDetail.type != 'contract'">
                                                    Date: <b>{{inputBookingDetail.date}}</b>
                                                </div>
                                                <div v-else>
                                                    Date Period: <br><b>{{info_contract.start_date + " - " + info_contract.end_date}}</b>
                                                </div>
                                                <div>Time: <b>{{inputBookingDetail.hour_start <= 12 ? (inputBookingDetail.hour_start  + "").replace(".5",":30") + " am" : ((inputBookingDetail.hour_start - 12)+"").replace(".5",":30") + " pm"}}</b></div>
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
                                                <td v-if="paymentDetail.card_number != null">{{paymentDetail.card_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Reference: </td>
                                                <td>#{{booking_reference}}</td>
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
        props: ['clubSettingId','clickNewBooking','flagChangeDataOfDate','client_token'],
        data (){
        return {
            courts: [],
            surname: null,
            inputBookingDetail:{
                type: null,
                member: 0,
                date: null,
                contract_id: null,
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
            nonce: null,
            pre_nonce: null,
            court_detail:{
                name: null,
            },
            booking_reference: null,
            total_price: null,
            contracts: [],
            teachers: [],
            info_contract: {
                total_week: null,
                extras: []
            },
            payment_is_cash: false,
            is_process_booking: false,
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
                    url = laroute.route('courts.list', {one:this.clubSettingId});
            this.$http.get(url).then(res => {
                def.resolve(res.data.data);
            }, res => {
                def.reject(res);
            });
            return def.promise;
        },
        changeBookingType(){
            if(this.inputBookingDetail.type == 'contract'){
                var url = laroute.route('contracts.listContract', {club_id: this.clubSettingId, member: this.inputBookingDetail.member});
                this.$http.get(url).then(res => {
                    this.contracts = res.data.data;
                }, res => {

                });
            }else if(this.inputBookingDetail.type == 'lesson'){
                this.$http.get(laroute.route('teacher.list',{one:this.clubSettingId})).then(res => {
                    this.teachers = res.data.data;
                }, res => {

                });
            }

        },
        changePaymentType(){
            if(this.paymentDetail.type == 'cash'){
                this.payment_is_cash = true;
            }else{
                this.payment_is_cash = false;
            }
        },
        changeContract(){
            if(this.inputBookingDetail.contract_id == '' || this.inputBookingDetail.contract_id == null){
                showNotice('error', "Please, select a date period", 'Error!');
                return;
            }
            this.$http.get(laroute.route('contracts.getView',{one:this.inputBookingDetail.contract_id})).then(res => {
                if(res.data.error == false)
                {
                    this.info_contract = res.data.data;
                }else{
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }
            }, res => {

            });
        },
        viewPriceOrder(){
            this.$set('inputBookingDetail.hour_length',$("#mb-book-in-hour").val());
            this.$set('inputBookingDetail.date',$("#mb-book-day-open").val());
            this.$set('inputBookingDetail.club_id',this.clubSettingId);

                const input = this.inputBookingDetail;

            let def = deferred(),
                    url = laroute.route('booking.viewPriceOrder');
            $("#mb-create-new-booking").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.post(url,input).then(res => {
                $("#mb-create-new-booking .loading").remove();
                if(res.data.error) {
                    var msg = "";
                    if(res.data.status){
                        switch(res.data.status){
                            case 'booking': msg = "This was book. Please select another time or date"; break;
                            case 'unavailable': msg = "Unavailable. Please select another time or date"; break;
                            case 'close': msg = "Day Close. Please select another time or date"; break;
                            default: msg = res.data.status
                        }
                    }
                    else
                        $.each(res.data.messages,function(k,v){
                            msg += "<div>"+v+"</div>";
                        });
                    this.total_price = "NaN";
                    showNotice('error', msg, 'Error!');
                }else
                {
                    this.total_price = res.data.total_price;
                    if(res.data.price_teacher)
                        showNotice('success', res.data.price_teacher);
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
                    url = laroute.route('booking.postCheckCourtBooking');

            $("#mb-create-new-booking").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.post(url, input).then(res => {
                $("#mb-create-new-booking .loading").remove();
                if(res.data.error)
                {
                    var msg = "";
                    if(res.data.status){
                        switch(res.data.status){
                            case 'booking': msg = "This was book. Please select another time or date"; break;
                            case 'unavailable': msg = "Unavailable. Please select another time or date"; break;
                            case 'close': msg = "Close. Please select another time or date"; break;
                            default: msg = res.data.status
                        }
                    }
                    else $.each(res.data.messages,function(k,v){
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
            this.changePaymentType();
            this.createFormBrainTree();
            this.$set('customerDetail.address1',$("#input-address1").val());
            this.$set('customerDetail.state',$("#input-state").val());
            this.$set('customerDetail.city',$("#input-city").val());
            this.$set('customerDetail.zip_code',$("#input-zip_code").val());
            if(this.inputBookingDetail.member == 1){
                this.customerDetail.player_id = $("#player_id").val();
                $("#mb-create-new-booking").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                this.$http.post(laroute.route('booking.checkPlayerforBooking', {one: this.customerDetail.player_id})).then(res => {
                    $("#mb-create-new-booking .loading").remove();
                if(!res.data.error)
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
                    if(res.data.status){
                        switch(res.data.status){
                            case 'booking': msg = "This was book. Please select another time or date"; break;
                            case 'unavailable': msg = "Unavailable. Please select another time or date"; break;
                            case 'close': msg = "Close. Please select another time or date"; break;
                            default: msg = res.data.status
                        }
                    }
                    else $.each(res.data.messages,function(k,v){
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
                        url = laroute.route('booking.checkInputCustomer');
                $("#mb-create-new-booking").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                this.$http.post(url,customer).then(res => {
                    $("#mb-create-new-booking .loading").remove();
                if(res.data.error)
                {
                    var msg = "";
                    if(res.data.status){
                        switch(res.data.status){
                            case 'booking': msg = "This was book. Please select another time or date"; break;
                            case 'unavailable': msg = "Unavailable. Please select another time or date"; break;
                            case 'close': msg = "Close. Please select another time or date"; break;
                            default: msg = res.data.status
                        }
                    }
                    else $.each(res.data.messages,function(k,v){
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
            if(this.is_process_booking)
                return;
            this.is_process_booking = true;

            var data =  new FormData();
            data.append('infoBooking',JSON.stringify(this.inputBookingDetail));
            data.append('customer',JSON.stringify(this.customerDetail));
            data.append('payment',JSON.stringify(this.paymentDetail));
            data.append('total_price', this.total_price);
            data.append('nonce', this.nonce);

            // check validate customer
            $("#mb-create-new-booking").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.post('/sadmin/booking/payment', data).then(res => {
                if(res.data.error){
                    var msg = "";
                    if(res.data.status){
                        switch(res.data.status){
                            case 'booking': msg = "This was book. Please select another time or date"; break;
                            case 'unavailable': msg = "Unavailable. Please select another time or date"; break;
                            case 'close': msg = "Close. Please select another time or date"; break;
                            default: msg = res.data.status
                        }
                    }
                    else $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else{
                    this.booking_reference = res.data.booking_reference;
                    this.paymentDetail.type = res.data.payment_type;
                    this.paymentDetail.card_number = res.data.last4;
                    this.total_price = res.data.total_price
                    this.flagChangeDataOfDate = Math.random();
                    this.$dispatch('child-change-flagChangeDataOfDate', this.flagChangeDataOfDate);
                    this.tabClick("mb-confirmation-content")
                }
                $("#mb-create-new-booking .loading").remove();
                this.is_process_booking = false;
            }, res => {

            });
        },
        preBookingDetail(){
            this.tabClick("mb-booking-detail-content")
        },
        preCustomerDetail(){
            this.tabClick("mb-customer-details-content")
        },
        emailReceipt(){
            var id_booking = this.booking_reference;
            $.ajax({
                url: base_url +"/send-mail",
                type: 'post',
                data: {id: id_booking},
                beforeSend: function(){
                    $("#mb-create-new-booking").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                },
                success: function(res){
                    $("#mb-create-new-booking .loading").remove();
                    alert(res.message);
                    $(".loader").addClass('hidden');
                },
                error: function(request, status, error){
                    console.log(request.responseText);
                }
            })
        },
        tabClick(element){
            $("#mb-create-new-booking .mb-tabs li").removeClass('active').addClass('tab-disabled');
            $("a[href="+"#"+element+"]").parent().addClass('active');
            $(".tab-pane").removeClass('active');
            $("#"+element).addClass('active');
        },
        address_lookup(){
            var _this = this;
            this.$http.get(laroute.route('booking.address_lookup', {one: this.customerDetail.zip_code})).then(res => {
                if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else{
                    _this.customerDetail.state = res.data.address.state;
                    _this.customerDetail.city = res.data.address.city;
                }
            }, res => {

            });
        },
        customer_lookup(){
            var _this = this;
            this.$http.get(laroute.route('booking.customer_lookup', {one: this.surname})).then(res => {
                if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else{
                    _this.customerDetail.first_name = res.data.user.first_name;
                    _this.customerDetail.last_name = res.data.user.last_name;
                    _this.customerDetail.zip_code = res.data.user.zip_code;
                    _this.customerDetail.city = res.data.user.city;
                    _this.customerDetail.state = res.data.user.state;
                    _this.customerDetail.address1 = res.data.user.address1;
                    _this.customerDetail.email = res.data.user.email;
                    _this.customerDetail.phone = res.data.user.phone;
                }
            }, res => {

            });
        },
        resetData(){
            this.fetchCourts();
            this.preBookingDetail();
            this.inputBookingDetail = {
                type: null,
                        member: 0,
                        date: null,
                        contract_id: null,
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
            this.is_process_booking = false;
            this.booking_reference = null;
            this.total_price = '';
            this.contracts = [];
            this.info_contract = {
                total_week: null,
                extras: []
            };
            this.pre_nonce = this.nonce;
            this.nonce = null;
        },
        createFormBrainTree(){
            if (checkout != null) {
                checkout.teardown(function () {
                    checkout = null;
                    // braintree.setup can safely be run again!
                });
            }

            var _this = this;
            //$("#bt-dropin").html('');
            braintree.setup(this.client_token, "dropin", {
                container: "bt-dropin",
                onReady: function (integration) {
                    checkout = integration;
                },
                onError: function(data) {
                    $(".alert-message-box").removeClass('hide').find('.alert-content').html(data.message);
                    $(".loader").addClass('hidden');
                },
                paymentMethodNonceReceived: function (event,nonce) {
                    _this.nonce = nonce;
                    _this.nextConfirmation();
                }
            });
        }
    },ready () {
        $("#mb-create-new-booking .loading").remove();

        $('.daterange').daterangepicker(
                {
                    showDropdowns: true,
                    startDate: moment().startOf('month'),
                    endDate: moment().add(3, 'months').endOf('month'),
                });

        $("li.tab-disabled").click(function (e) {
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

        //lookup address
        $("body").on('click','.btn-get-address-lookup',function(){
            var zipcode;
            if($("#input-zip_code").length)
                zipcode = $("#input-zip_code").val();
            else zipcode = $("input[name=zipcode]").val();
            console.log(zipcode);
            $.ajax({
                url : "http://maps.googleapis.com/maps/api/geocode/json?components=postal_code:"+zipcode+"&sensor=false",
                method: "post",
                success:function(data){
                    $("input[name=state], #input-state").val(data.results[0].address_components[2].long_name);
                    $("input[name=city], #input-city").val(data.results[0].address_components[3].long_name);
                }
            });
        });

        $("#input-address1").geocomplete()
                .bind("geocode:result", function(event, result){
                    $.each(result.address_components, function(index, val) {
                        if (typeof val.types[0] != "undefined" ) {
                            if(val.types[0] == "locality"){
                                $("#input-city").val(val.long_name);
                            }
                            if(val.types[0] == 'administrative_area_level_1'){
                                $("#input-state").val(val.long_name);
                            }
                            if(val.types[0] == "postal_code"){
                                $("#input-zip_code").val(val.long_name);
                            }
                        }
                    });
                });
    },
    beforeDestroy () {

    }
    }

</script>