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
            <table class="grid-wrap table table-bordered table-th clearfix" style="margin-top: 20px;">
                <thead>
                <tr class="court-name-wrap">
                    <th class="grid-header"></th>
                    <th v-for="i in courts.length" rowspan="2" class="grid-header">{{courts[i]['name']}}</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="i in hours.length" data-row-hour="{{hours[i]}}">
                        <th width="100" class="td_field_label">{{hours[i]}}</th>
                        <td v-for="j in courts.length" class="day-grid available" data-hours="5am" data-court="1">Available {{j}}</td>
                    </tr>
                </tbody>
            </table>

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
                    '5pm','5:30pm','6pm','6:30pm','7pm','7:30pm','8pm','8:30pm','9pm','9:30pm','10pm'],
                date: [],
                now: new Date(),
                courts: []
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
        fetchDataOfDateOfClub(){
            let def = deferred();
            this.$http.get(laroute.route('booking.dataOfDateOfClub'), {date: this.dateChooise, club_id: this.clubSettingId,}).then(
                res => {
                    console.log(res)
                    if(res.data.error)
                    {
                        var msg = "";
                        $.each(res.data.messages,function(k,v){
                            msg += "<div>"+v+"</div>";
                        });
                        showNotice('error', msg, 'Error!');
                    }else
                    {
                        def.resolve(res.data.data);
                        //showNotice('success', res.data.success, 'Success!');
                    }
                    this.submit = false;
                }, (res) => {
                    console.log(res);
                    def.reject(res);
                    //showNotice('error', "Error. Try again!", 'Error!');
                });
                return def.promise;
            }
    },
    ready () {
        this.now = this.dateChooise === null ? new Date(): this.parse(this.dateChooise);
    },
    beforeDestroy () {

    }
};
