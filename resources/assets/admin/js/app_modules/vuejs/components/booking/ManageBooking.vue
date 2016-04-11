<template>
    <section class="col-xs-12 col-md-12">

        <div class="menu-action">
            <div class="pull-left" style="margin-bottom: 10px">
                <input type="text" v-model="dateChooise" class="datetimepicker" name="datebook">
            </div>
            <div class="pull-right" style="margin-bottom: 10px">
                <div class="btn btn-primary manage_multi_times">Manage Multiple Times</div>
                <div class="btn btn-primary create_new_book" data-toggle="modal" data-target="#myModal">Create New Booking</div>
            </div>
        </div>
        <div class="clearfix"></div>

        <search-booking
            :club-setting-id="clubSettingId",
            :date-chooise="dateChooise"
        ></search-booking>
    </section>

    <calendar-booking
        :club-setting-id="clubSettingId",
        :date-chooise="dateChooise"
        ></calendar-booking>

    <div class="clearfix"></div>

    <!-- available-slot-expanded -->
    <div class="available-slot-expanded" style="display: none">
        <div class="col-xs-8">
            <table class="table">
                <thead>
                <tr>
                    <th>Quick Quotes</th>
                    <th>8am-9pm <br> (1hour)</th>
                    <th>8am-9pm <br> (1hour)</th>
                    <th>8am-9pm <br> (1hour)</th>
                    <th>8am-9pm <br> (1hour)</th>
                    <th>8am-9pm <br> (1hour)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Member: </td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                </tr>
                <tr>
                    <td>Member: </td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                </tr>
                <tr>
                    <td>Member: </td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                    <td>$35</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-4">
            <div id="mb-make-time-unavailable">
                {!! Form::open(['method' => 'POST','files' => true,'class'=>'form-center', 'id'=>"form_make_unavailable"]) !!}
                <div class="btn btn-primary btn-mb-ex btn-in-expand icon-fa-angle-down icon-fa-make-unavailable">Make Time Unavailable</div>
                <div class="show-expand">
                    {!! Form::label('input-reason','Enter Reason',['class'=>'text-center']) !!}
                    {!! Form::text('input-reason','',['placeholder'=>'eg.Court Maintainance','class'=>'form-control','id'=>'input-reason']) !!}
                    {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div id="mb-create-deal" style="margin-left: 20px" class="btn btn-primary btn-mb-ex icon-fa-star">Create Deal</div>
        </div>
    </div>
    <!-- end available-slot-expanded -->

    <!-- court booking-expanded -->
    <div class="court-booking-expanded">
        <div class="col-xs-3">
            <h3 class="title-part">Customer Details</h3>
            <table>
                <tr>
                    <td align="right">Name:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Email:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Phone:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Address:</td>
                    <td>Brian ABC</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-3">
            <h3 class="title-part">Customer Details</h3>
            <table>
                <tr>
                    <td align="right">Name:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Email:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Phone:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Address:</td>
                    <td>Brian ABC</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-3">
            <h3 class="title-part">Customer Details</h3>
            <table>
                <tr>
                    <td align="right">Name:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Email:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Phone:</td>
                    <td>Brian ABC</td>
                </tr>
                <tr>
                    <td align="right">Address:</td>
                    <td>Brian ABC</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-3">
            <div id="mb-print-receipt" class="btn btn-primary btn-mb-ex icon-fa-print">Print Receipt</div>
            <div id="mb-accept-payment" class="btn btn-primary btn-mb-ex icon-fa-accept">Accept Payment</div>
            <div id="mb-check-players-in" class="btn btn-primary btn-mb-ex icon-fa-check">Check Players In</div>
            <div id="mb-edit-booking" class="btn btn-primary btn-mb-ex icon-fa-edit">Edit Booking</div>
            <div id="mb-cancel-booking" class="btn btn-primary btn-mb-ex btn-custom icon-fa-cancel">Cancel Booking</div>
        </div>
    </div>
    <!-- end court booking-expanded -->
</template>
<script>
    import SearchBooking from './SearchBooking.vue';
    import CalendarBooking from './CalendarBooking.vue';
    let _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: ['clubSettingId'],
        data(){
            return {
                dateChooise: (new Date()).getMonth()+1+"/"+(new Date()).getDate()+"/"+(new Date()).getFullYear()
            }
        },
        watch: {
            dateChooise: 'reloadAsyncData'
        },
        computed: {

        },
        asyncData(resolve, reject) {

        },
    computed: {

    },
        methods:{

        },
        components: {
            SearchBooking , CalendarBooking
        }
    }
</script>