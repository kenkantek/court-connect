<style scoped>
    .datetime-picker {
        position: relative;
        display: inline-block;
        font-family: "Segoe UI","Lucida Grande",Helvetica,Arial,"Microsoft YaHei";
        -webkit-font-smoothing: antialiased;
        color: #333;
        width: 100%;
    }

    .datetime-picker * {
        box-sizing: border-box;
    }

    .datetime-picker input {
        width: 100%;
        padding: 5px 10px;
        height: 30px;
        outline: 0 none;
        border: 1px solid #ccc;
        font-size: 13px;
    }

    .datetime-picker .picker-wrap {
        z-index: 1000;
        width: 100%;
        min-height: 280px;
        margin-top: 2px;
        background-color: #fff;
    }
    .datetime-picker th{
        border: 0px !important;
    }
    .datetime-picker table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        text-align: center;
        font-size: 13px;
    }

    .datetime-picker tr {
        height: 34px;
        border: 0 none;
    }

    .datetime-picker th, .datetime-picker td {
        user-select: none;
        width: 34px;
        height: 34px;
        padding: 0;
        border: 0 none;
        line-height: 34px;
        text-align: center;
        border: 1px solid #EBEBEB;
    }

    .datetime-picker td {
        cursor: pointer;
        height: 70px;
        position: relative;
    }

    .datetime-picker td.date-pass, .datetime-picker td.date-future {
        color: #aaa;
    }

    .datetime-picker .date-head {
        background-color: none;
        text-align: left;
        color: #000;
        font-size: 14px;
    }
    .datetime-picker td.date-pass, .datetime-picker td.date-future{
        background: #F3F3F5;
    }
    .datetime-picker .date-days {
        color: #000;
        font-size: 14px;
    }

    .datetime-picker .show-year {
        display: inline-block;
        min-width: 40px;
        vertical-align: middle;
    }

    .datetime-picker .show-month {
        display: inline-block;
        min-width: 28px;
        vertical-align: middle;
    }

    .datetime-picker .btn-prev,
    .datetime-picker .btn-next {
        cursor: pointer;
        display: inline-block;
        padding: 0 10px;
        vertical-align: middle;
    }

    .datetime-picker .btn-prev:hover,
    .datetime-picker .btn-next:hover {
        background: rgba(16, 160, 234, 0.5);
    }
    .monthly-day-number {
        position: absolute;
        line-height: 1em;
        top: 2px;
        left: 2px;
        font-size: 11px;
    }
    .monthly-indicator-wrap {
        width: 100%;
        max-width: none;
        position: relative;
        text-align: center;
        height: 100%;
    }
    .monthly-indicator-wrap .overflow {
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        line-height: 70px;
        display: none;
        transition: all 0.1s linear;
        position: absolute;
        top: 0;
    }
    .overflow .action {
        display: inline;
    }
    .datetime-picker td:not(.date-future):hover .monthly-indicator-wrap .overflow{
        display: block;
    }
    .date-pass .monthly-indicator-wrap .time{
        line-height: 70px;
    }
    .datetime-picker td.date-pass:hover .monthly-indicator-wrap .overflow{
        display: none;
    }
    .date-pass .monthly-indicator-wrap, .date-future .monthly-indicator-wrap{
        display: none;
    }
    .txt-holiday{
        text-transform: uppercase;
        font-weight: bold;
    }
    .dlg-setopenday{
        position: absolute;
        left: 0px;
        z-index: 999;
        top: 70px;
        background: #e2e2e2;
        border: 1px solid #ccc;
        width: 100%;
    }
    .block{
        display: block !important;
    }
    .monthly-indicator-wrap .time{
        position: absolute;
        text-align: center;
        width: 100%;
    }
</style>

<template>
    <div >
        <form method="POST" action="" accept-charset="UTF-8" id="form_set_openday" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
            <div class="pull-left form-box">
                <label for="date">Select day(s) of the week</label>
                <br>
                <select class="form-control" name="date_open" id="date_open" v-model="dataOpenHour.daysOfWeek" multiple="multiple" style="display: none;">
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                    <option value="7">Sunday</option>
                </select>
            </div>
            <div class="pull-left form-box">
                <label for="daterange_open">Date range</label>
                <input class="daterange form-control" name="daterange_open" type="text" id="daterange_open">
            </div>
            <div class="pull-left form-box">
                <label for="opentime">Open Time</label>
                <input id="opentime" class="timepicker opentime form-control" placeholder=""  name="opentime" type="text">
            </div>
            <div class="pull-left form-box">
                <label for="closetime">Closing Time</label>
                <input class="timepicker closetime form-control" placeholder="" name="closetime" type="text" id="closetime">
            </div>
            <div class="pull-left">
                <br>
                <input class="btn btn-primary" style="margin-top: 6px;" type="submit" value="Apply" @click.prevent="addOpenHours()">
            </div>
        </form>
    </div>
    <div class="datetime-picker">
        <div class="picker-wrap" v-show="show">
            <table class="date-picker">
                <thead>
                <tr class="date-head">
                    <th colspan="4" style="text-align: left">
                        <span class="btn-prev" @click="monthClick(-1)">&lt;</span>
                        <span class="show-month">{{months[now.getMonth()]}}</span>
                        <span class="show-year">{{now.getFullYear()}}</span>
                        <span class="btn-next" @click="monthClick(1)">&gt;</span>
                    </th>
                    <th colspan="3">
                    </th>
                </tr>
                <tr class="date-days">
                    <th v-for="day in days">{{day}}</th>
                </tr>
                </thead>
                <tbody id="tbody-wrapper-main">

                <tr v-for="i in 6">
                    <td v-for="j in 7"
                        :class="date[i * 7 + j] && date[i * 7 + j].status"
                        :date="date[i * 7 + j] && date[i * 7 + j].date"
                        data-x = "{{i}}" data-y = "{{j}}"
                        data-id= "{{date[i * 7 + j] && date[i * 7 + j].status == 'date-current' && date[i * 7 + j].text }}">
                        <div class="monthly-day-number" A11>{{date[i * 7 + j] && date[i * 7 + j].text}}</div>
                        <div class="monthly-indicator-wrap" v-if="date[i * 7 + j] && date[i * 7 + j].status == 'date-current'">
                            <div class="time"></div>
                            <div class="overflow">
                                <div class="btn-close action" @click="setCloseClick(date[i * 7 + j].text)"><img src="/uploads/images/config/close_icon.png" alt=""></div>
                                <div class="btn-plane action" @click="setHolidayClick(date[i * 7 + j].text)"><img src="/uploads/images/config/plane_icon.png" alt=""></div>
                                <div class="btn-clock action"><img src="/uploads/images/config/clock_icon.png" alt=""> </div>
                                <div class="dlg-setopenday hidden">
                                    <div style="width: 50%; float: left">
                                        <label for="opentime" >Open Time</label>
                                        <input class="form-control timepicker" name="opentime" value="" v-model="date[i*7+j].hours_open">
                                    </div>
                                    <div style="width: 50%; float: left">
                                        <label for="closetime" >Closing Time</label>
                                        <input class="form-control timepicker" name="closetime" value="" v-model="date[i*7+j].hours_close" >
                                    </div>
                                    <div >
                                        <input class="btn btn-primary" style="margin-top: 6px; width: auto;" type="button" @click="setTimeClick(i * 7 + j)" value="Apply" >
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .overflow .action {
            display: inline;
            padding-right: 5px;
        }
        .monthly-indicator-wrap.day_close{
            background: #1b1b1b;
            text-transform: uppercase;
            color: #fff;
            line-height: 70px;
            font-weight: bold;
        }
        .monthly-indicator-wrap.day_holiday{
            background: #930101;
            color: #fff;
        }
    </style>
</template>

<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: {
            clubSettingId: { default: false },
            readonly: { type: Boolean, default: false },
            value: { type: String, default: '' },
            format: { type: String, default: 'YYYY-MM-DD' }
        },
        data () {
        return {
            show: true,
            days: ['Sun', 'Mon', 'Tues', 'Weds', 'Thurs', 'Fri', 'Sat'],
            months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            date: [],
            now: new Date(),
            list_infoday:[],
            dataOpenHour: [],
            day_chooice: null
        };
    },
    watch: {
        now () {
            this.update();
        },
        show () {
            this.update();
        },
        clubSettingId: 'reloadAsyncData',
    },
    asyncData(resolve, reject) {
        this.fetchDataDates().done((list_infoday) => {
            resolve({list_infoday});
        this.processData();
        }, (error) => {
            console.log(error);
        });
    },
    methods: {
        setCloseClick(index){
            d_s = this.now.getFullYear() + "-" + (this.now.getMonth()+1) + "-" + index;
            this.$http.post(laroute.route('clubs.courts.setEventDay'), {date: d_s, club_id: this.clubSettingId, is_event: 'close'}).then(res => {
                if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else
                {
                    showNotice('success', res.data.success, 'Success!');
                    this.fetchDataDates();
                }
                this.submit = false;
            }, (res) => {
                showNotice('error', "Error. Try again!", 'Error!');
            });
        },
        setHolidayClick(index){
            d_s = this.now.getFullYear() + "-" + (this.now.getMonth()+1) + "-" + index;
            this.$http.post(laroute.route('clubs.courts.setEventDay'), {date: d_s, club_id: this.clubSettingId, is_event: 'holiday'}).then(res => {
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
                showNotice('success', res.data.success, 'Success!');
                this.fetchDataDates();
            }
            this.submit = false;
        }, (res) => {
            console.log(res);
            showNotice('error', "Error. Try again!", 'Error!');
        });
        },
        setTimeClick(index){
            d_s = this.now.getFullYear() + "-" + (this.now.getMonth()+1) + "-" + this.date[index].text;
            this.$http.post(laroute.route('clubs.courts.setEventDay'), {date: d_s, open_time: this.covertHour24to12(this.date[index].hours_open), close_time: this.covertHour24to12(this.date[index].hours_close), club_id: this.clubSettingId, is_event: 'sethours'}).then(res => {

                if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else
                {
                    showNotice('success', res.data.success, 'Success!');
                    this.fetchDataDates();
                }
                this.submit = false;
                }, (res) => {
                    console.log(res);
                    showNotice('error', "Error. Try again!", 'Error!');
                });
        },
        addOpenHours(){
            const d = {};
            d.days = $("#form_set_openday select[name=date_open]").val();
            d.open_time = $("#form_set_openday input[name=opentime]").val();
            d.close_time = $("#form_set_openday input[name=closetime]").val();

            d.end_date =  $("#daterange_open").data('daterangepicker').endDate.format('YYYY/MM/DD');
            d.start_date =  $("#daterange_open").data('daterangepicker').startDate.format('YYYY/MM/DD');
            d.club_id = this.clubSettingId;
            $("#box-set-open-days").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.post(laroute.route('clubs.courts.setOpenDay'), d).then(res => {
                if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else
                {
                    showNotice('success', res.data.success, 'Success!');
                    this.fetchDataDates();
                }
                this.submit = false;
                $("#box-set-open-days .loading").remove();
             }, (res) => {
                    console.log(res);
                    showNotice('error', "Error. Try again!", 'Error!');
                    $("#box-set-open-days .loading").remove();
                }
            );
        },
        covertHour24to12($hour){
            var hourEnd = $hour.indexOf(":");
            var H = +$hour.substr(0, hourEnd);
            var h = H % 12 || 12;
            var ampm = H < 12 ? "AM" : "PM";
            $data = h + $hour.substr(hourEnd, 3) + " "+ ampm;
            return $data;
        },
        fetchDataDates() {
            let def = deferred(),
            url = laroute.route('clubs.courts.listdays', {club_id: this.clubSettingId, month: this.now.getMonth() + 1, year: this.now.getFullYear()});
            this.$http.get(url).then(res => {
                def.resolve(res.data.data);
                this.list_infoday = res.data.data;
                $("#tbody-wrapper-main td .monthly-indicator-wrap").attr('class','monthly-indicator-wrap')
                $("#tbody-wrapper-main td .monthly-indicator-wrap .time").html('');
                this.processData();
            }, res => {
                def.reject(res);
            });
            return def.promise;
        },
        processData(){
            $.each(this.list_infoday,function(k,item){
                var  d = item.date.split("-");
                if(item.is_close == 0 && item.is_holiday == 0 ) {
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .monthly-indicator-wrap .time").html(item.open_time != '' ?item.open_time + " - " + item.close_time: '' );
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .dlg-setopenday input[name=opentime]").val(item.open_time);
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .dlg-setopenday input[name=closetime]").val(item.close_time);
                }
                else if(item.is_close == 1) {
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .monthly-indicator-wrap").attr('class','monthly-indicator-wrap day_close');
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .monthly-indicator-wrap .time").html('closed');
                }else if(item.is_holiday == 1) {
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .monthly-indicator-wrap").attr('class','monthly-indicator-wrap day_holiday');
                    text_holiday = '<div class="txt-holiday" style="text-transform: uppercase; padding-top: 5px;margin-bottom: -15px;font-weight: bold;">Holiday</div>';
                    text_holiday += item.open_time != '' ? item.open_time + " - " + item.close_time: '';
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .monthly-indicator-wrap .time").html(text_holiday);

                }else{
                    $("#tbody-wrapper-main td[data-id=" + parseInt(d[2]) + "] .monthly-indicator-wrap").attr('class','monthly-indicator-wrap');
                }
                $(".timepicker").timepicker('setTime', '6:00 AM');
                $(".timepicker.closetime").timepicker('setTime', '22:00 PM');
            });
        },
        close () {
            this.show = false;
        },
        update () {
            var arr = [];
            var time = new Date(this.now);
            time.setMonth(time.getMonth(), 1);           // the first day
            var curFirstDay = time.getDay();
            curFirstDay === 0 && (curFirstDay = 7);
            time.setDate(0);                             // the last day
            var lastDayCount = time.getDate();
            for (let i = curFirstDay; i > 0; i--) {
                arr.push({
                    text: lastDayCount - i + 1,
                    time: new Date(time.getFullYear(), time.getMonth(), lastDayCount - i + 1),
                    status: 'date-pass',
                    hours_open: '',
                    hours_close: '',
                });
            }

            time.setMonth(time.getMonth() + 2, 0);       // the last day of this month
            var curDayCount = time.getDate();
            time.setDate(1);                             // fix bug when month change
            var value = this.value || this.stringify(new Date());
            for (let i = 0; i < curDayCount; i++) {
                let tmpTime = new Date(time.getFullYear(), time.getMonth(), i + 1);
                let status = 'date-current';
                //this.stringify(tmpTime) === value && (status = 'date-active');
                arr.push({
                    text: i + 1,
                    time: tmpTime,
                    status: status,
                    hours_open: '',
                    hours_close: '',
                });
            }

            var j = 1;
            while (arr.length < 42) {
                arr.push({
                    text: j,
                    time: new Date(time.getFullYear(), time.getMonth() + 1, j),
                    status: 'date-future',
                    hours_open: '',
                    hours_close: '',
                });
                j++;
            }
            this.date = arr;
        },
        monthClick (flag) {
            this.now.setMonth(this.now.getMonth() + flag);
            this.now = new Date(this.now);
            this.fetchDataDates();
        },
        parse (str) {
            var time = new Date(str);
            return isNaN(time.getTime()) ? null : time;
        },
        stringify (time = this.now, format = this.format) {
            var year = time.getFullYear();
            var month = time.getMonth() + 1;
            var date = time.getDate();
            var monthName = this.months[time.getMonth()];

            var map = {
                YYYY: year,
                MMM: monthName,
                MM: ('0' + month).slice(-2),
                M: month,
                DD: ('0' + date).slice(-2),
                D: date
            };
            return format.replace(/Y+|M+|D+/g, function (str) {
                return map[str];
            });
        }
        },
        ready () {
            this.now = this.parse(this.value) || new Date();
        },
        beforeDestroy () {
            document.removeEventListener('click', this.close, false);
        }
    };

        $(function() {
            $("body").on('click','.btn-clock',function(){
                $(".monthly-indicator-wrap .overflow").removeClass('block');
                $(this).parent().toggleClass('block');
                $(this).parent().find('.dlg-setopenday').toggleClass('hidden');
            })
        });
</script>