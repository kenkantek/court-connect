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
    }
    .monthly-indicator-wrap .action {
        display: inline-block;
    }
    .datetime-picker td:not(.date-pass, .date-future):hover .monthly-indicator-wrap .overflow{
        display: block;
    }
</style>

<template>
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
                <tbody>
                <tr v-for="i in 5">
                    <td v-for="j in 7"
                        :class="date[i * 7 + j] && date[i * 7 + j].status"
                        :date="date[i * 7 + j] && date[i * 7 + j].date"
                        ">
                        <div class="monthly-day-number">{{date[i * 7 + j] && date[i * 7 + j].text}}</div>
                        <div class="monthly-indicator-wrap">
                            <div class="overflow">
                                <div class="btn-close action">
                                    <img src="/uploads/images/config/close_icon.png" alt="">
                                </div>
                                <div class="btn-plane action">
                                    <img src="/uploads/images/config/plane_icon.png" alt=""></div>
                                <div class="btn-clock action">
                                    <img src="/uploads/images/config/clock_icon.png" alt="">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            readonly: { type: Boolean, default: false },
            value: { type: String, default: '' },
            format: { type: String, default: 'YYYY-MM-DD' }
        },
        data () {
        return {
            show: true,
            days: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            date: [],
            now: new Date()
        };
    },
    watch: {
        now () {
            this.update();
        },
        show () {
            this.update();
        }
    },
    methods: {
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
                    status: 'date-pass'
                });
            }

            time.setMonth(time.getMonth() + 2, 0);       // the last day of this month
            var curDayCount = time.getDate();
            time.setDate(1);                             // fix bug when month change
            var value = this.value || this.stringify(new Date());
            for (let i = 0; i < curDayCount; i++) {
                let tmpTime = new Date(time.getFullYear(), time.getMonth(), i + 1);
                let status = '';
                this.stringify(tmpTime) === value && (status = 'date-active');
                arr.push({
                    text: i + 1,
                    time: tmpTime,
                    status: status
                });
            }

            var j = 1;
            while (arr.length < 42) {
                arr.push({
                    text: j,
                    time: new Date(time.getFullYear(), time.getMonth() + 1, j),
                    status: 'date-future'
                });
                j++;
            }
            this.date = arr;
        },
        monthClick (flag) {
            this.now.setMonth(this.now.getMonth() + flag);
            this.now = new Date(this.now);
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
</script>