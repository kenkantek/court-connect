<template>
    <section id="manager-book-top" class="col-xs-12 col-md-12">
        <div class="menu-action">
            <div class="pull-left" style="margin-bottom: 10px">
                <input type="text" v-model="dateChooise" class="datetimepicker" name="datebook">
            </div>
            <div class="pull-right" style="margin-bottom: 10px">
                <div class="btn btn-primary manage_multi_times" @click="clickMultiTimes()">Manage Multiple Times</div>
                <div class="btn btn-primary create_new_book" @click="openModalNewBooking()">Create New Booking</div>
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
        :date-chooise="dateChooise",
        :flag-change-data-of-date="flagChangeDataOfDate",
        :multi-times="multiTimes"
        ></calendar-booking>

    <div class="clearfix"></div>


    <new-booking
            :club-setting-id.sync="clubSettingId",
            :click-new-booking.sync="clickNewBooking"
            :flag-change-data-of-date="flagChangeDataOfDate",
            :client_token.sync="client_token"
            ></new-booking>
    <!-- Modal -->
</template>
<script>
    import SearchBooking from './SearchBooking.vue';
    import CalendarBooking from './CalendarBooking.vue';
    import NewBooking from './NewBooking.vue';
    let _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: ['clubSettingId'],
        data(){
            return {
                dateChooise: (new Date()).getMonth()+1+"/"+(new Date()).getDate()+"/"+(new Date()).getFullYear(),
                clickNewBooking: null,
                flagChangeDataOfDate: Math.random(),
                multiTimes: null,
                client_token: null
            }
        },
        watch: {
            dateChooise: 'reloadAsyncData',
            flagChangeDataOfDate: 'reloadAsyncData'
        },
        computed: {

        },
        asyncData(resolve, reject) {
            this.getClientTokenBrainTree();
        },
        computed: {

        },
        methods:{
            getClientTokenBrainTree(){
                var _this = this;
                this.$http.get(laroute.route('booking.getClientToken')).then(res => {
                    this.client_token = res.data.client_token;
                }, res => {

                });
            },
            openModalNewBooking(){
                $("#myModal").modal('show');
                $("#mb-create-new-booking .loading").remove();
                this.getClientTokenBrainTree();
                this.clickNewBooking = Math.random();
            },
            clickMultiTimes(){
                this.multiTimes = Math.random();
            }
        },
        components: {
            SearchBooking , CalendarBooking, NewBooking
        },
        events: {
            'child-change-dateChooise': function (day) {
                this.dateChooise = day;
            },
            'child-change-flagChangeDataOfDate': function (flagChangeDataOfDate) {
                this.flagChangeDataOfDate = flagChangeDataOfDate;
            }
        }
    }
</script>