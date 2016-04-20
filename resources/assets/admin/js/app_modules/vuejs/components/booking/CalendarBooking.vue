<template>
    <section class="col-xs-12 col-md-12" id="calendar_bookings">
        <div class="days-in-month-wrap">
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
                    <div v-for="(index,hour) in hours" class="grid court-name">{{hour}}</div>
                </div>
                <div class="grid-content-box">
                    <div class="grid-wrap">
                        <div class="court-name-wrap">
                            <div v-for="(index,court) in dataOfClub" class="grid court-name">{{court['name']}}</div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="grid-content-wap">
                            <template v-for="(index,court) in dataOfClub">
                                <div class="grid-row court{{court['id']}}">
                                    <template v-for="(index,grid) in court['hours']">
                                        <div v-if="grid.g_start || grid.g_end" class="day-grid grid {{grid.status}} {{grid.g_start ? 'gstart' : grid.g_end ? 'gend' : ''}} {{index%2 == 0 && court['hours'][index+1] && grid.status == 'available' && grid.status != court['hours'][index+1].status ? 'gn' : ''}} {{index%2 == 1 && court['hours'][index-1] && grid.status == 'available' && grid.status != court['hours'][index-1].status ? 'gn' : ''}}"
                                             @click="openModalGridExpand(court['id'], grid.status, grid.booking_id, grid.hour)">
                                            <div v-if=" !grid.g_end">
                                        <span class="title-grid">{{grid.status == "open" ? "Open Time Booking" : grid.status == "contract"
                                            ? "Contract Time" :  grid.status == "lesson" ? "Lesson" : grid.status}}
                                        </span>
                                                <template v-if="grid.status != 'available'">{{grid.content}}</template>
                                            </div>
                                        </div>
                                        <div v-else @click="openModalGridExpand(court['id'], grid.status, grid.booking_id, grid.hour)" class="test day-grid grid {{grid.status}} g{{index%2 ==0 ? 2 : 0}} {{index%2 == 0 && court['hours'][index+1] && grid.status == 'available' && grid.status != court['hours'][index+1].status ? 'gn' : ''}} {{index%2 == 1 && court['hours'][index-1] && grid.status == 'available' && grid.status != court['hours'][index-1].status ? 'gn' : ''}}">
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
                        <div class="col-xs-3">
                            <h3 class="title-part">Customer Details</h3>
                            <table v-if="player_info">
                                <tr>
                                    <td align="right">Name</td>
                                    <td>
                                        <div class="editable_">{{player_info['first_name']}}</div>
                                        <div class="editable_" >{{player_info['last_name']}}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Email</td>
                                    <td><div class="editable_" >{{player_info['email']}}</div></td>
                                </tr>
                                <tr>
                                    <td align="right">Phone</td>
                                    <td><div class="editable_" >{{player_info['phone']}}</div></td>
                                </tr>
                                <tr>
                                    <td align="right">Address</td>
                                    <td><div class="editable_">{{player_info['address1']}}</div></td>
                                </tr>
                            </table>
                        </div>
                        <template v-if="booking_detail">
                        <div class="col-xs-3">
                            <h3 class="title-part">Booking Details</h3>

                            <table>
                                <tr>
                                    <td align="right">Booking Type</td>
                                    <td>{{booking_detail['type']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Court:</td>
                                    <td>{{booking_detail['court']['name']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Start Time</td>
                                    <td>{{booking_detail['hour'] + " - " + (booking_detail['hour'] + booking_detail['hour_length'])}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Length</td>
                                    <td>{{booking_detail['hour_length']}} Hour</td>
                                </tr>
                                <tr>
                                    <td align="right">Players</td>
                                    <td>{{booking_detail['num_player']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Create Time</td>
                                    <td>{{booking_detail['created_at']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Booking By</td>
                                    <td>Court-Connect.com</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-3">
                            <h3 class="title-part">Payment Details</h3>
                            <table v-if="payment_info">
                                <tr>
                                    <td align="right">Status</td>
                                    <td v-if="booking_detail['status'] == 'required'" style="text-transform: capitalize"><span style="color:red">Payment Required</span></td>
                                    <td v-else style="text-transform: capitalize">{{booking_detail['status']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Tender</td>
                                    <td style="text-transform: capitalize">{{payment_info['type']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Total Due</td>
                                    <td>{{booking_detail['total_price']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-3">
                            <div id="mb-print-receipt" class="btn btn-primary btn-mb-ex icon-fa-print">Print Receipt</div>
                            <div v-if="booking_detail['status'] == 'required'" @click="acceptPayment(booking_detail['id'])" id="mb-accept-payment" class="btn btn-primary btn-mb-ex icon-fa-accept">Accept Payment</div>
                            <div v-else id="mb-check-players-in" class="btn btn-primary btn-mb-ex icon-fa-check">Check Players In</div>
                            <div id="mb-edit-booking" @click="editBooking(booking_detail['id'])" class="btn btn-primary btn-mb-ex icon-fa-edit">Edit Booking</div>
                            <div id="mb-cancel-booking" @click="cancelBooking(booking_detail['id'])"class="btn btn-primary btn-mb-ex btn-custom icon-fa-cancel">Cancel Booking</div>
                        </div>
                        </template>
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
                                    <th v-for="item in info_grid_available.lb_hour">{{ item }}</th>
                                </thead>
                                </tr>
                                <tbody>
                                <tr>
                                    <td>Member: </td>
                                    <td v-for="itemmember in info_grid_available.price_member">${{itemmember}}</td>
                                </tr>
                                <tr>
                                    <td>Non Member: </td>
                                    <td v-for="itemnonmember in info_grid_available.price_nonmember">${{itemnonmember}}</td>
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

    <div id="confirm-booking-delete" class="modal fade" style="z-index: 3000; display: none; height: 150px;top: 50%;background: rgb(255, 255, 255);">
        <div class="modal-body">
            Are you sure delete?
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" id="booking-delete">Delete</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
        </div>
    </div>

    <div id="md-new-deal" class="modal fade mb-modal" style="display: none; z-index: 3000; top: 50%" role="dialog" aria-labelledby="myModalLabel">
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
                                <td> ${{deal.price_member}}</td>
                            </tr>
                            <tr>
                                <td>Orginal Price (Non ember): </td>
                                <td> ${{deal.price_nonmember}}</td>
                            </tr>
                            <tr>
                                <td>New Price for Member</td>
                                <td><input type="text" v-model="deal.new_price_member"></td>
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

</template>
<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: {
            clubSettingId: {default: false},
            dateChooise: {default: false},
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
                hours: ['5am','5:30am','6am','6:30am','7am','7:30am','8am','8:30am','9am','9:30am','10am','10:30am','11am',
                    '11:30am','12pm','12:30pm','1pm','1:30pm','2pm','2:30pm','3pm','3:30pm','4pm','4:30pm',
                    '5pm','5:30pm','6pm','6:30pm','7pm','7:30pm','8pm','8:30pm','9pm','9:30pm','10pm','10:30pm'],
                dates: [],
                now: new Date(),
                courts: [],
                dataOfClub: [],
                booking_detail: null,
                player_info: {
                    first_name: null,
                    last_name: null,
                    email: null,
                    phone: null,
                    address1: null
                },
                payment_info: null,
                info_grid_available: null,
                make_time_unavailable: {
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
        flagChangeDataOfDate: 'reloadAsyncData'
    },
    asyncData(resolve, reject) {
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
            var status = 'date-notcurrent';
            var daysInMonth = this.getDaysInMonth(time.getMonth(), time.getFullYear());
            var index_date_current = 0;
            daysInMonth.forEach(function(date, index){
                //tmpTime = new Date(time.getFullYear(), time.getMonth(), i + 1);
                if(date.getDate() == day_now.getDate() ) {
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
                    if(res.data.success)
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
            if(cls_status == 'available'){
                this.fetchDataOfGridAvailable(court_id, hour);
            }else if(cls_status == 'open' || cls_status == 'contract' || cls_status == 'lesson'){
                this.fetchDataOfBooking(booking_id);
            }
        },
        fetchDataOfBooking(booking_id){
            this.booking_detail = null;
            this.player_info = null;
            this.payment_info = null;
            $("#md-booking-content-expand").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.get(laroute.route('booking.view', {one:booking_id})).then(res => {
                $("#md-booking-content-expand .loading").remove();
                if(res.data.success){
                    this.booking_detail = res.data.booking;
                    this.player_info = JSON.parse(this.booking_detail['player_info']);
                    this.payment_info = JSON.parse(this.booking_detail['payment_info']);
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
                if(res.data.success){
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
                if(data.success){
                    this.booking_detail.status = "paid";
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
                        parent.$http.put(laroute.route('booking.delete', {one: booking_id}),(data) => {
                            if(data.success){
                                parent.flagChangeDataOfDate = Math.random();
                                showNotice('success', "Delete success!", 'Delete Success!');
                            }
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
                if(res.data.success){
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
                if(res.data.success){
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
                if(res.data.success){
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
        }
    },
    ready () {
        this.now = this.dateChooise === null ? new Date(): this.parse(this.dateChooise);
        $(".gn" ).prop( "disabled", true );
    },
    beforeDestroy () {

    }
};
