<template>
    <form action="" method="post" id="form_search_booking">
        <div class="pull-left col-xs-12 col-md-3">
            <h2 class="title-search">Find a Booking</h2>
        </div>
        <div class="pull-left col-xs-12 col-md-3">
            <div class="col-xs-12 col-md-10">
                <label for="reference_number">Reference Number</label>
                <input class="form-control" name="reference_number" v-model="search_reference" type="text" id="reference_number">
            </div>
            <div class="col-xs-12 col-md-2"><br><br> Or</div>
        </div>
        <div class="pull-left col-xs-12 col-md-3">
            <label for="customer_name">Name</label>
            <input class="form-control" name="customer_name" v-model="search_name" type="text" id="customer_name">
        </div>
        <div class="pull-left col-xs-12 col-md-3">
            <label for=" " style="color: #fff">.</label>
            <input class="btn btn-primary" style="display: block" type="submit" value="Search" @click.prevent="searchFindBooking()">
        </div>
        <div class="clearfix"></div>
        <div id="result_search" class="hidden">
            <h3 class="text-center">Search Results</h3>
            <table>
                <tr>
                    <th>Booking Reference</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Booking Details</th>
                </tr>
                <tr v-for="(index,item) in search_result">
                    <td>{{item['id']}}</td>
                    <td>{{item['billing_info']['first_name'] + " " + item['billing_info']['last_name']}}</td>
                    <td>{{item['billing_info']['phone']}}</td>
                    <td>
                        Court {{item['court_name']}} - {{item['date']}} @ {{item['hour']}}
                        <a href="#" @click="fetchDataOfBooking(item['id'])" class="viewbooking btn btn-primary">View</a>
                        <a href="#" class="editbooking btn btn-primary">Edit</a>
                        <a href="#" class="checkIn btn btn-primary">Check In</a>
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <div class="hide" id="cc-modal-view-booking-search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="court-booking-expanded">
            <button type="button" class="close-md close" aria-label="Close"><span aria-hidden="true">X</span></button>
            <div class="col-xs-3">
                <h3 class="title-part">Customer Details</h3>
                <table v-if="booking['billing_info']">
                    <tr>
                        <td align="right">Name</td>
                        <td>
                            <div class="editable_">{{booking['billing_info']['first_name']}}</div>
                            <div class="editable_" >{{booking['billing_info']['last_name']}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Email</td>
                        <td><div class="editable_" >{{booking['billing_info']['email']}}</div></td>
                    </tr>
                    <tr>
                        <td align="right">Phone</td>
                        <td><div class="editable_" >{{booking['billing_info']['phone']}}</div></td>
                    </tr>
                    <tr>
                        <td align="right">Address</td>
                        <td><div class="editable_">{{booking['billing_info']['address1']}}</div></td>
                    </tr>
                </table>
            </div>
            <template v-if="booking">
                <div class="col-xs-3">
                    <h3 class="title-part">Booking Details</h3>

                    <table v-if="booking['billing_info']">
                        <tr>
                            <td align="right">Booking Type</td>
                            <td>{{booking['type']}}</td>
                        </tr>
                        <tr>
                            <td align="right">Court:</td>
                            <td>{{booking['court']['name']}}</td>
                        </tr>
                        <tr>
                            <td align="right">Start Time</td>
                            <td>{{booking['hour'] + " - " + (booking['hour'] + booking['hour_length'])}}</td>
                        </tr>
                        <tr>
                            <td align="right">Length</td>
                            <td>{{booking['hour_length']}} Hour</td>
                        </tr>
                        <tr>
                            <td align="right">Players</td>
                            <td>{{booking['num_player']}}</td>
                        </tr>
                        <tr>
                            <td align="right">Create Time</td>
                            <td>{{booking['created_at']}}</td>
                        </tr>
                        <tr>
                            <td align="right">Booking By</td>
                            <td>Court-Connect.com</td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-3">
                    <h3 class="title-part">Payment Details</h3>
                    <table v-if="booking['billing_info']">
                        <tr>
                            <td align="right">Status</td>
                            <td v-if="booking['status'] == 'required'" style="text-transform: capitalize"><span style="color:red">Payment Required</span></td>
                            <td v-else style="text-transform: capitalize">{{booking['status']}}</td>
                        </tr>
                        <tr>
                            <td align="right">Tender</td>
                            <td style="text-transform: capitalize">{{booking['type']}}</td>
                        </tr>
                        <tr>
                            <td align="right">Total Due</td>
                            <td>{{booking['total_price']}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-3">
                    <div id="mb-print-receipt" class="btn btn-primary btn-mb-ex icon-fa-print">Print Receipt</div>
                    <div v-if="booking['status'] == 'required'" @click="acceptPayment(booking['id'])" id="mb-accept-payment" class="btn btn-primary btn-mb-ex icon-fa-accept">Accept Payment</div>
                    <div v-else id="mb-check-players-in" class="btn btn-primary btn-mb-ex icon-fa-check">Check Players In</div>
                    <div id="mb-edit-booking" @click="editBooking(booking['id'])" class="btn btn-primary btn-mb-ex icon-fa-edit">Edit Booking</div>
                    <div id="mb-cancel-booking" @click="cancelBooking(booking['id'])"class="btn btn-primary btn-mb-ex btn-custom icon-fa-cancel">Cancel Booking</div>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: ['clubSettingId','dateChooise'],
        data (){
            return {
                search_reference: null,
                search_name: null,
                search_result: [],
                booking: []
            }
        },
        methods: {
            searchFindBooking(){
                $("#result_search").addClass('hidden');
                $("#cc-modal-view-booking-search").addClass('hide')
                $("#form_search_booking").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                this.$http.get(laroute.route('booking.search',{reference:this.search_reference,name: this.search_name})).then(res => {
                    if(!res.data.error)
                    {
                        this.search_result = res.data.bookings;
                        $("#result_search").removeClass('hidden');
                    }else{
                        var msg = "";
                        $.each(res.data.messages,function(k,v){
                            msg += "<div>"+v+"</div>";
                        });
                        showNotice('error', msg, 'Error!');
                    }
                $("#form_search_booking .loading").remove();
                }, res => {

                });
            },
            fetchDataOfBooking(booking_id){
                this.booking = [];
                $("#cc-modal-view-booking-search").removeClass('hide').append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                this.$http.get(laroute.route('booking.view', {one:booking_id})).then(res => {
                    $("#cc-modal-view-booking-search .loading").remove();
                    if(res.data.error == false){
                        this.booking = res.data.booking;
                    }
                    }, res => {
                        $("#cc-modal-view-booking-search .loading").remove();
                    });
            },
            acceptPayment(booking_id){
                this.$http.get(laroute.route('booking.acceptPayment', {one: booking_id}),(data) => {
                    if(data.error == false){
                    this.booking.status = "paid";
                    showNotice('success', "Update accept payment success!", 'Update Success!');
                }
            }).error((data) => {

            });

            },
            editBooking(booking_id){
                //$("#md-booking-content-expand .editable_").removeClass('editable_').addClass('editable');
            },
            cancelBooking(booking_id){
                var parent = this;
                $('#confirm-booking-delete').modal({ backdrop: 'static', keyboard: false })
                        .one('click', '#booking-delete', function (e) {
                            $("body").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                            parent.$http.get(laroute.route('booking.cancel', {one: booking_id}),(data) => {
                                if(data.error == false){
                                parent.flagChangeDataOfDate = Math.random();
                                showNotice('success', "Cancel booking success!", 'Cancel Success!');
                            }else{
                                showNotice('error', data.message, 'Error!');
                            }
                            $("body .loading").remove();
                        }).error((data) => {

                });
            });
            },
        }
    }
</script>