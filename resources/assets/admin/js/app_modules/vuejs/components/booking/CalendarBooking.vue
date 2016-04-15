<template>
    <section class="col-xs-12 col-md-12" id="calendar_bookings">
        <div class="days-in-month-wrap">
            <div class="days">
                <div v-for="i in date.length" class="day-item {{date[i].status}}"  data-value="{{ date[i].day + '-' + date[i].month + 1 + '-' + date[i].year }}">
                    {{ days[date[i].day_of_week] }} <br>
                    <span>{{ date[i].day + " " + months[date[i].month] + " " + date[i].year % 100 }} </span>
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
                <div class="grid-wrap">
                    <div class="court-name-wrap">
                        <div v-for="(index,court) in dataOfClub" class="grid court-name">{{court['name']}}</div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="grid-content-wap">
                        <template v-for="(index,court) in dataOfClub">
                            <div class="grid-row">
                                <template v-for="(index,grid) in court['hours']">
                                    <div v-if="grid.g_start || grid.g_end" class="day-grid grid {{grid.status}} {{grid.g_start ? 'gstart' : grid.g_end ? 'gend' : ''}} {{index%2 == 0 && court['hours'][index+1] && grid.status == 'available' && grid.status != court['hours'][index+1].status ? 'gn' : ''}} {{index%2 == 1 && court['hours'][index-1] && grid.status == 'available' && grid.status != court['hours'][index-1].status ? 'gn' : ''}}"
                                         @click="openModalViewExpand(grid.status, grid.booking_id)">
                                        <div v-if=" !grid.g_end">
                                        <span class="title-grid">{{grid.status == "open" ? "Open Time Booking" : grid.status == "contract"
                                            ? "Contract Time" :  grid.status == "lesson" ? "Lesson" : grid.status}}
                                        </span>
                                            <template v-if="grid.status != 'available'">{{grid.content}}</template>
                                        </div>
                                    </div>
                                    <div v-else @click="openModalViewExpand(grid.status)" class="test day-grid grid {{grid.status}} g{{index%2 ==0 ? 2 : 0}} {{index%2 == 0 && court['hours'][index+1] && grid.status == 'available' && grid.status != court['hours'][index+1].status ? 'gn' : ''}} {{index%2 == 1 && court['hours'][index-1] && grid.status == 'available' && grid.status != court['hours'][index-1].status ? 'gn' : ''}}">
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

            <div class="md-expand">

                <div id="md-available-content-expand" style="display: none">
                    <!-- available-slot-expanded -->
                    <div class="available-slot-expanded">
                        <button type="button" class="close-md close" aria-label="Close"><span aria-hidden="true">X</span></button>
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
                                <form method="POST" action="" accept-charset="UTF-8" class="form-center" id="form_make_unavailable" enctype="multipart/form-data">
                                    <div class="btn btn-primary btn-mb-ex btn-in-expand icon-fa-angle-down icon-fa-make-unavailable">Make Time Unavailable</div>
                                    <div class="show-expand">
                                        <label for="input-reason" class="text-center">Enter Reason</label>
                                        <input placeholder="eg.Court Maintainance" class="form-control" id="input-reason" name="input-reason" type="text" value="">
                                        <input class="btn btn-primary" type="submit" value="Submit">
                                    </div>
                                </form>
                            </div>

                            <div id="mb-create-deal" style="margin-left: 20px" class="btn btn-primary btn-mb-ex icon-fa-star">Create Deal</div>
                        </div>
                    </div>
                    <!-- end available-slot-expanded -->
                </div>

                <div id="md-booking-content-expand" style="display: none">
                    <!-- court booking-expanded -->
                    <div class="court-booking-expanded">
                        <button type="button" class="close-md close" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <div class="col-xs-3">
                            <h3 class="title-part">Customer Details</h3>
                            <table>
                                <tr>
                                    <td align="right">Name {{(JSON.parse(this.booking_detail['user_info']))['firstname']}}</td>
                                    <td>
                                        <span class="editable_" v-model="user_info.firstname">{{user_info['firstname']}}</span>
                                        <span class="editable_" v-model="user_info.lastname">{{user_info['lastname']}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Email</td>
                                    <td class="editable_" v-model="user_info.email">{{user_info['email']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Phone</td>
                                    <td class="editable_" v-model="user_info.phone">{{user_info['phone']}}</td>
                                </tr>
                                <tr>
                                    <td align="right">Address</td>
                                    <td class="editable_" v-model="user_info.address1">{{user_info['address1']}}</td>
                                </tr>
                            </table>
                        </div>
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
                            <table>
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
                            <div id="mb-cancel-booking" class="btn btn-primary btn-mb-ex btn-custom icon-fa-cancel">Cancel Booking</div>
                        </div>
                    </div>
                    <!-- end court booking-expanded -->
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: {
            clubSettingId: {default: false},
            dateChooise: {default: false},
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
                date: [],
                now: new Date(),
                courts: [],
                dataOfClub: [],
                booking_detail: null,
                user_info: {
                    firstname: null,
                    lastname: null,
                    email: null,
                    phone: null,
                    address1: null
                },
                payment_info: null
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
                arr.push({day: date.getDate(),day_of_week: date.getDay(), month: date.getMonth(), year: date.getFullYear(), status: status})
                status = 'date-notcurrent';
            });
            this.date = arr;
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
            this.$http.get(laroute.route('booking.dataOfClub'), {date: this.dateChooise, club_id: this.clubSettingId,}).then(
                res => {
                    console.log(res)
                    if(res.data.success)
                    {
                        def.resolve(res.data.data);
                    }
                    this.submit = false;
                }, (res) => {
                    console.log(res);
                    def.reject(res);
                });
                return def.promise;
            },
        openModalViewExpand(cls_status, booking_id){
            console.log(cls_status);
            if(cls_status == 'available'){

            }else if(cls_status == 'open' || cls_status == 'contract' || cls_status == 'lesson'){
                this.fetchDataOfBooking(booking_id);
            }
        },
        fetchDataOfBooking(booking_id){
            console.log(booking_id);
            this.booking_detail = null;
            this.user_info = null;
            this.payment_info = null;
            this.$http.get(laroute.route('booking.view', {one:booking_id}),(data) => {
                if(data.success){
                    this.booking_detail = data.booking;
                    this.user_info = JSON.parse(this.booking_detail['user_info']);
                    this.payment_info = JSON.parse(this.booking_detail['payment_info']);
                }
            }).error((data) => {

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
            $("#md-booking-content-expand .editable_").removeClass('editable_').addClass('editable');
        }
    },
    ready () {
        this.now = this.dateChooise === null ? new Date(): this.parse(this.dateChooise);
    },
    beforeDestroy () {

    }
};
