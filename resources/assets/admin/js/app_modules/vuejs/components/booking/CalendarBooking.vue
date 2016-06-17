<template>
    <section class="col-xs-12 col-md-12" id="calendar_bookings">

        <div id="manageMultiTimes" class="hide text-center">
            <button type="button" class="close-md close" @click.prevent="closeMultiTimes()" aria-label="Close"><span aria-hidden="true">X</span></button>
            <h2>Multi-Day Management</h2>
            <p>Select the day from the grid below you want to manage and choose and option below to update all
            the selected times.</p>
            <div class="col-xs-12">
                <div id="mb-multi-make-time-unavailable" class="col-md-6">
                    <form method="POST" action="" accept-charset="UTF-8" class="form-center">
                        <div class="btn btn-primary btn-mb-ex btn-in-expand fright icon-fa-angle-down icon-fa-make-unavailable">Make Time Unavailable</div>
                        <div class="show-expand">
                            <label for="input-reason" class="text-center">Enter Reason</label>
                            <input placeholder="eg.Court Maintainance" class="form-control" v-model="multi_make_time_unavailable.reason" name="input-reason" type="text" value="">
                            <input class="btn btn-primary" type="submit" value="Submit" @click.prevent="multiMakeTimeUnavailable()">
                        </div>
                    </form>
                </div>

                <div id="mb-multi-create-deal"  style="float: left" class="col-md-6">
                    <div class="btn btn-primary btn-mb-ex icon-fa-star btn-in-expand icon-fa-angle-down">Create Deal</div>
                    <div class="show-expand">
                        <h4 >Create A New Deal</h4>

                            <div class="form-group">
                                <label>New Price for Member</label>
                                <input type="text" v-model="multi_deal.new_price_member">
                            </div>
                            <div class="form-group">
                                <label>New Price for Non member</label>
                                <input type="text" v-model="multi_deal.new_price_nonmember">
                            </div>
                        <div class="form-group text-center">
                            <input type="button" @click.prevent="createMultiDeal()" class="btn btn-primary" value="Publish Deal">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="days-in-month-wrap" class="clearfix">
            <div class="days">
                <div v-for="(index,date) in dates" @click="changeDay('cal_day'+index,date.dayFullFormat)" id="cal_day{{index}}" class="day-item {{date.status}}"  data-value="{{ date.dayFullFormat}}">
                    {{ days[date.day_of_week] }} <br>
                    <span>{{ date.day + " " + months[date.month] + " " + date.year % 100 }} </span>
                </div>
            </div>
            <div class="days-in-month-control">
                <div id="next-day-in-month"> > </div>
                <div id="prev-day-in-month"> < </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="day-view-content" class="day-view-content">
            <div class="cld-wrapper">
                <div class="grid-row col-hour">
                    <div class="grid grid-null"></div>
                    <div v-for="item in hours" class="grid court-name row-hour-name" @click.prevent="rowHourClick(item.key)">{{item.value}}</div>
                </div>
                <div class="grid-content-box">
                    <div class="grid-wrap">
                        <div class="court-name-wrap">
                            <div v-for="(index,court) in dataOfClub" class="grid court-name col-court-name" @click.prevent="colCourtClick(court['id'])">{{court['name']}}</div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="grid-content-wap">
                            <template v-for="(index,court) in dataOfClub">
                                <div class="grid-row court{{court['id']}}" data-court="{{court['id']}}">
                                    <template v-for="(index,grid) in court['hours']">
                                        <div v-if="grid.g_start || grid.g_end" data-court="{{court['id']}}" data-hour="{{grid.hour}}" class="day-grid grid {{grid.status}} {{grid.g_start ? 'gstart' : grid.g_end ? 'gend' : ''}} {{index%2 == 0 && court['hours'][index+1] && grid.status == 'available' && grid.status != court['hours'][index+1].status ? 'gn' : ''}} {{index%2 == 1 && court['hours'][index-1] && grid.status == 'available' && grid.status != court['hours'][index-1].status ? 'gn' : ''}}"
                                             @click="openModalGridExpand(court['id'], grid.status, grid.booking_id, grid.hour)">
                                            <div v-if=" !grid.g_end">
                                                <span class="title-grid">{{grid.status == "open" ? "Open Time Booking" : grid.status == "contract"
                                                    ? "Contract Time" :  grid.status == "lesson" ? "Lesson" : grid.status}}
                                                </span>
                                                <template v-if="grid.status != 'available'">{{grid.content}}
                                                    <div v-if="grid.is_cash" class="pay-cash">$</div>
                                                </template>
                                            </div>
                                        </div>
                                        <div v-else data-court="{{court['id']}}" data-hour="{{grid.hour}}" @click="openModalGridExpand(court['id'], grid.status, grid.booking_id, grid.hour)" class="day-grid grid {{grid.status}} g{{index%2 ==0 ? 2 : 0}} {{index%2 == 0 && court['hours'][index+1] && grid.status == 'available' && grid.status != court['hours'][index+1].status ? 'gn' : ''}} {{index%2 == 1 && court['hours'][index-1] && grid.status == 'available' && grid.status != court['hours'][index-1].status ? 'gn' : ''}}">
                                            <span class="title-grid">{{grid.status == "open" ? "Open Time Booking" : grid.status == "contract"
                                                 ? "Contract Time" :  grid.status == "lesson" ? "Lesson" : grid.status}}
                                            </span>
                                            <template v-if="grid.status != 'available'">{{grid.content}}</template>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-expand">
                <div id="md-booking-content-expand" style="display: none">
                    <!-- court booking-expanded -->
                    <div class="court-booking-expanded">
                        <button type="button" class="close-md close" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <div v-if="booking">
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
                            <div v-if="booking['court']" class="col-xs-3">
                                <h3 class="title-part">Booking Details</h3>
                                <table>
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
                                        <td>{{booking['hour'] + " - " + (booking['hour'] + booking['hour_length'])}} | {{booking['date']}}</td>
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
                                        <td>{{booking['source'] == 1 ? "Player Booking" : "Court-Connect.com" }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-xs-3">
                                <h3 class="title-part">Payment Details</h3>
                                <table>
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
                                        <td>${{booking['total_price']}}</td>
                                    </tr>
                                    <tr>
                                        <td align="right">Notes</td>
                                        <td>{{booking['notes']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-xs-3">
                                <div id="mb-print-receipt" class="btn btn-primary btn-mb-ex icon-fa-print" @click="printReceipt(booking['id'])">Print Receipt</div>
                                <div v-if="booking['status'] == 'required'" @click="acceptPayment(booking['id'])" id="mb-accept-payment" class="btn btn-primary btn-mb-ex icon-fa-accept">Accept Payment</div>
                                <div v-if="booking['is_checkIn']" id="mb-check-players-in" class="btn btn-primary btn-mb-ex icon-fa-accept">Check Players In</div>
                                <div v-else @click="checkInBooking(booking['id'])" id="mb-check-players-in" class="btn btn-primary btn-mb-ex icon-fa-cancel">Check Players In</div>
                                <div id="mb-edit-booking" @click="editBooking(booking['id'])" class="btn btn-primary btn-mb-ex icon-fa-edit">Edit Booking</div>
                                <div id="mb-cancel-booking" @click="cancelBooking(booking['id'])"class="btn btn-primary btn-mb-ex btn-custom icon-fa-cancel">Cancel Booking</div>
                            </div>
                        </div>
                    </div>
                    <!-- end court booking-expanded -->
                </div>
                <div id="md-available-content-expand" style="display: none">
                    <!-- available-slot-expanded -->
                    <div v-if="info_grid_available" class="available-slot-expanded">
                        <button type="button" class="close-md close" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <div class="col-xs-8">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Quick Quotes</th>
                                        <td v-for="item in info_grid_available.lb_hour"><strong>{{ item.text }}</strong> <br> ({{ item.value }}) hours</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Member: </td>
                                    <td v-for="itemmember in info_grid_available.price_member">{{itemmember}}</td>
                                </tr>
                                <tr>
                                    <td>Non Member: </td>
                                    <td v-for="itemnonmember in info_grid_available.price_nonmember">{{itemnonmember}}</td>
                                </tr>
                                <tr>
                                    <td>Lesson: </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-4">
                            <div id="mb-make-time-unavailable">
                                <form method="POST" action="" accept-charset="UTF-8" class="form-center" id="form_make_unavailable" enctype="multipart/form-data">
                                    <div class="btn btn-primary btn-mb-ex btn-in-expand icon-fa-angle-down icon-fa-make-unavailable">Make Time Unavailable</div>
                                    <div class="show-expand">
                                        <label for="input-reason" class="text-center">Enter Reason</label>
                                        <input placeholder="eg.Court Maintainance" class="form-control" id="input-reason" v-model="make_time_unavailable.reason" name="input-reason" type="text" value="">
                                        <input class="btn btn-primary" type="submit" value="Submit" @click.prevent="makeTimeUnavailable()">
                                    </div>
                                </form>
                            </div>

                            <div id="mb-create-deal" @click.prevent="openModalDeal()" style="margin-left: 20px" class="btn btn-primary btn-mb-ex icon-fa-star">Create Deal</div>
                        </div>
                    </div>
                    <!-- end available-slot-expanded -->
                </div>
            </div>
        </div>
    </section>

    <div id="confirm-booking-delete" class="modal fade">
        <div class="modal-body">
            Are you sure delete?
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" id="booking-delete">Delete</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
        </div>
    </div>

    <div id="md-new-deal" class="modal fade mb-modal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create A New Deal</h4>
                </div>
                <div class="modal-body">
                    <div >
                        <table>
                            <tr>
                                <td>Date Selected: </td>
                                <td> {{deal.date_text}}</td>
                            </tr>
                            <tr>
                                <td>Time Selected: </td>
                                <td>{{deal.time}}</td>
                            </tr>
                            <tr>
                                <td>Court Selected: </td>
                                <td> {{deal.court_name}}</td>
                            </tr>
                            <tr>
                                <td>Orginal Price (Member): </td>
                                <td>{{deal.price_member}}</td>
                            </tr>
                            <tr>
                                <td>Orginal Price (Non member): </td>
                                <td>{{deal.price_nonmember}}</td>
                            </tr>
                            <tr>
                                <td>New Price for Member</td>
                                <td><input type="text" v-model="deal.new_price_member"><br></td>
                            </tr>
                            <tr>
                                <td>New Price for Non member</td>
                                <td><input type="text" v-model="deal.new_price_nonmember"></td>
                            </tr>
                        </table>
                        <div class="form-group text-center">
                            <input type="button" @click.prevent="createDeal()" class="btn btn-primary" value="Publish Deal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .pay-cash{
            background: red;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            position: absolute;
            width: 20px;
            height: 25px;
            bottom: 0px;
        }
    </style>
</template>
<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: {
            clubSettingId: {default: false},
            dateChooise: {default: false},
            multiTimes: {default: false},
            flagChangeDataOfDate: {default: false},
            readonly: {type: Boolean, default: false},
            value: {type: String, default: ''},
            format: {type: String, default: 'YYYY-MM-DD'}
        },
        data ()
        {
            return {
                show: true,
                days: ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
                months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
                dates: [],
                now: new Date(),
                courts: [],
                dataOfClub: [],
                booking:[],
                info_grid_available: null,
                make_time_unavailable: {
                    hour: null,
                    hour_length: null,
                    reason: null
                },
                multi_make_time_unavailable:{
                    hour: null,
                    hour_length: null,
                    reason: null
                },
                deal: {
                    hour: null,
                    court_id: null,
                    date_text: null,
                    time: null,
                    price_member: null,
                    price_nonmember: null,
                    court_name: null
                },
                multi_deal: {},
                grids_selected: [],
            }
        },
    watch: {
        now()
        {
            this.updateCalendar();
        },
        show()
        {
            this.updateCalendar();
        },
        clubSettingId: 'reloadAsyncData',
        dateChooise: 'reloadAsyncData',
        flagChangeDataOfDate: 'reloadAsyncData',
        multiTimes: 'enableSelectGrid'
    },
    asyncData(resolve, reject) {
        this.updateCalendar();
        this.fetchCourts().done((courts) => {
            resolve({courts});

        }, (error) => {
            console.log(error);
        });
        this.fetchDataOfClub().done((dataOfClub) => {
            resolve({dataOfClub});
            $('.day-view-content .grid-wrap').css('width', 150 * this.dataOfClub.length);
        }, (error) => {
            console.log(error);
        });
    },
    methods: {
        getDaysInMonth(month, year) {
            // Since no month has fewer than 28 days
            var date = new Date(year, month, 1)
            var days = [];
            while (date.getMonth() === month) {
                days.push(new Date(date));
                date.setDate(date.getDate() + 1);
            }
            return days;
        },
        updateCalendar () {
            var arr = [];
            var time = this.now;
            var day_now = new Date();
            var date_current = this.dateChooise;
            var status = 'date-notcurrent';
            var daysInMonth = this.getDaysInMonth(time.getMonth(), time.getFullYear());
            var index_date_current = 0;
            daysInMonth.forEach(function(date, index){
                //tmpTime = new Date(time.getFullYear(), time.getMonth(), i + 1);
                if(date.getDate() == date_current.split('/')[1] ) {
                    status = 'date-current';
                    index_date_current = index;
                }
                arr.push({dayFullFormat: (date.getMonth() + 1) + '/'+ date.getDate() + '/' + date.getFullYear(), day: date.getDate(),day_of_week: date.getDay(), month: date.getMonth(), year: date.getFullYear(), status: status})
                status = 'date-notcurrent';
            });
            this.dates = arr;
            //set margin left
            var w_grid = ($('#calendar_bookings .days-in-month-wrap').width())/7;
            if(index_date_current >= 3) {
                $('#calendar_bookings .days-in-month-wrap .days').css('margin-left', -(index_date_current - 3) * w_grid);
                //console.log(index_date_current);
            }
        },
        parse (str) {
            var time = new Date(str);
            return isNaN(time.getTime()) ? null : time;
        },
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
        fetchDataOfClub(){
            let def = deferred();
            $("#day-view-content").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.get(laroute.route('booking.dataOfClub'), {date: this.dateChooise, club_id: this.clubSettingId,}).then(
                res => {
                    if(res.data.error == false)
                    {
                        def.resolve(res.data.data);
                    }
                    this.submit = false;
                    $("#day-view-content .loading").remove();
                }, (res) => {
                    def.reject(res);
                    $("#day-view-content .loading").remove();
                });
                return def.promise;
            },
        openModalGridExpand(court_id, cls_status, booking_id, hour){
            if($("#day-view-content").hasClass('multi-time'))
                return;
            if(cls_status == 'available'){
                this.fetchDataOfGridAvailable(court_id, hour);
            }else if(cls_status == 'open' || cls_status == 'contract' || cls_status == 'lesson'){
                this.fetchDataOfBooking(booking_id);
            }
        },
        fetchDataOfBooking(booking_id){
            this.booking = [];
            $("#md-booking-content-expand").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.get(laroute.route('booking.view', {one:booking_id})).then(res => {
                $("#md-booking-content-expand .loading").remove();
                if(res.data.error == false){
                    this.booking = res.data.booking;
                }
            }, res => {
                $("#md-booking-content-expand .loading").remove();
            });
        },
        fetchDataOfGridAvailable(court_id, hour){
            this.info_grid_available = null;
            //this.deal = null;
            //this.make_time_unavailable = null;
            $("#md-available-content-expand").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.get(laroute.route('booking.infoGridAvailable', {court_id:court_id, hour: hour, date: this.dateChooise})).then(res => {
                $("#md-available-content-expand .loading").remove();
                if(res.data.error == false){
                    this.info_grid_available = res.data.data;
                    this.make_time_unavailable.court_id = this.deal.court_id = court_id;
                    this.make_time_unavailable.hour = this.deal.hour = hour;
                }
            }, res => {
                $("#md-available-content-expand .loading").remove();
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
        printReceipt(booking_id){
            $('<form>', {
                "id": "getInvoiceImage",
                "html": '<input type="hidden" name="id" value="' + booking_id + '" /><input name="_token" type="hidden" value="'+$('meta[name="csrf-token"]').attr('content')+'">',
                "action": laroute.route('booking.printReceipt'),
                'target': '_blank',
                'method': 'post',
            }).appendTo(document.body).submit();

        },
        editBooking(booking_id){
            //$("#md-booking-content-expand .editable_").removeClass('editable_').addClass('editable');
        },
        checkInBooking(booking_id){
            this.$http.get(laroute.route('booking.check-in', {one: booking_id})).then(res => {
                if(res.data.error == false){
                showNotice('success', "Update accept payment success!", 'Update Success!');

            }else showNotice('error', res.data.message, 'Error!');
        }, res => {

            });
        },
        cancelBooking(booking_id){
            var parent = this;
            $('#confirm-booking-delete').modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#booking-delete', function (e) {
                        $("body").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                        parent.$http.get(laroute.route('booking.cancel', {one: booking_id}),(data) => {
                            console.log(data);
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
        changeDay(element,day){
            $(".days-in-month-wrap .days .date-current ").removeClass('date-current').addClass('date-notcurrent');
            $("#"+element).addClass('date-current').removeClass('date-notcurrent');
            this.$dispatch('child-change-dateChooise', day);
        },
        makeTimeUnavailable(){
            this.$set('make_time_unavailable.hour_length', 1);
            this.$set('make_time_unavailable.date', this.dateChooise);
            const make_time_unavailable = this.make_time_unavailable;
            this.$http.post(laroute.route('booking.makeTimeUnavailable',make_time_unavailable)).then(res => {
                if(res.data.error == false){
                    $("#mb-make-time-unavailable .btn-in-expand").click();
                    this.flagChangeDataOfDate = Math.random();
                    showNotice('success', "Make Time Unavailable success", 'Update Success!');
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
        openModalDeal(){
            this.$set('deal.hour_length', 1);
            this.$set('deal.date', this.dateChooise);
            const deal = this.deal;
            $('#md-new-deal').modal('show');
            $("#md-new-deal .modal-content").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.get(laroute.route('booking.getInfoGridForDeal',deal)).then(res => {
                if(res.data.error == false){
                    var data = res.data.data;
                    this.deal.date_text = data['date_text'];
                    this.deal.time = data['time'];
                    this.deal.court_name = data['court_name'];
                    this.deal.price_member = data['price_member'];
                    this.deal.price_nonmember = data['price_nonmember'];

                }else{
                }
                $("#md-new-deal .modal-content .loading").remove();
            }, res => {
                $("#md-new-deal .modal-content .loading").remove();
            });
        },
        createDeal(){
            const deal = this.deal;
            this.$http.post(laroute.route('booking.newDeal',deal)).then(res => {
                if(res.data.error == false){
                    this.flagChangeDataOfDate = Math.random();
                    $('#md-new-deal').modal('hide');
                    showNotice('success', "New deal success", 'Update Success!');
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
        multiMakeTimeUnavailable(){ //multi
            $("#day-view-content").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$set('multi_make_time_unavailable.hour_length', 1);
            this.$set('multi_make_time_unavailable.date', this.dateChooise);
            var _this = this;
            var data = new FormData();
            data.append('multi_make_time_unavailable',JSON.stringify(this.multi_make_time_unavailable));
            data.append('grids_selected',JSON.stringify(this.grids_selected));
            this.$http.post(laroute.route('booking.makeTimeUnavailable'),data).then(res => {
                if(res.data.error == false){
                    $("#multi_make_time_unavailable .btn-in-expand").click();
                    this.flagChangeDataOfDate = Math.random();
                    _this.grids_selected = [];
                    showNotice('success', "Make Time Unavailable success", 'Update Success!');
                }else{
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }
            }, res => {

            });
            $("#day-view-content .loading").remove();
        },
        createMultiDeal(){
            this.$set('multi_deal.hour_length', 1);
            this.$set('multi_deal.date', this.dateChooise);
            const multi_deal = this.multi_deal;
            var data = new FormData();
            data.append('multi_deal',JSON.stringify(this.multi_deal));
            data.append('grids_selected',JSON.stringify(this.grids_selected));
            var _this = this;
            this.$http.post(laroute.route('booking.newDeal'),data).then(res => {
                if(res.data.error == false){
                    this.flagChangeDataOfDate = Math.random();
                    $('#md-multi-new-deal').modal('hide');
                    showNotice('success', "New multi deal success", 'Update Success!');
                    _this.grids_selected = [];
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
        closeMultiTimes(){
            this.multiTimes = Math.random();
        },
        enableSelectGrid(reload = 0){
            var p = this;
            if(!$("#day-view-content").hasClass('multi-time')){
                $("#day-view-content .grid-content-wap").selectable({
                    filter: ".day-grid.available:not(.gn)",
                    selected: ( event, ui ) => {
                    const c = $(ui.selected).data('court'),
                            h = $(ui.selected).data('hour');

                    this.grids_selected.push({c , h});
                },
                unselected:( event, ui ) => {
                    const c = $(ui.unselected).data('court'),
                            h = $(ui.unselected).data('hour');
                    this.grids_selected = _.reject(this.grids_selected, {c, h});
                }
                });
            }else{
                if(!reload) {
                    $("#day-view-content").selectable("destroy");
                }
                $("#day-view-content .grid-content-wap").selectable("destroy");
                $("#day-view-content .grid-row .day-grid").removeClass('ui-selectee').removeClass('ui-selected');

            }

            $("#day-view-content").toggleClass('multi-time');
            $("#light-overlay-full, #manager-book-top, #manageMultiTimes").toggleClass('hide');
        },
        colCourtClick(court_id){
            if($("#day-view-content").hasClass("multi-time")) {
                var parent = this;
                $(".day-grid.available.g2[data-court='" + court_id + "']").each(function (index) {
                    if (!$(this).hasClass("ui-selected")) {
                        $(this).addClass("ui-selected");
                        const c = $(this).data('court'),
                                h = $(this).data('hour');
                        parent.grids_selected.push({c, h});
                    }
                });
            }
        },
        rowHourClick(hour){
            if($("#day-view-content").hasClass("multi-time")) {
                var parent = this;
                var parent = this;
                $(".day-grid.g2.available[data-hour='" + hour + "']").each(function(index){
                    if (!$(this).hasClass("ui-selected") && !$(this).hasClass("gn")) {
                        $(this).addClass("ui-selected");
                        const c = $(this).data('court'),
                                h = $(this).data('hour');
                        parent.grids_selected.push({c, h});
                    }
                });
            }
        }
    },
    ready () {
        this.now = this.dateChooise === null ? new Date(): this.parse(this.dateChooise);
        $(".gn" ).prop( "disabled", true );
    },
    beforeDestroy () {

    }
};
