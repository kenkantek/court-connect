<template>
    <section class="col-xs-12 col-md-12">

        <div class="menu-action">
            <div class="pull-left" style="margin-bottom: 10px">
                <input type="text" v-model="dateChooise" class="datetimepicker" name="datebook">
            </div>
            <div class="pull-right" style="margin-bottom: 10px">
                <div class="btn btn-primary manage_multi_times">Manage Multiple Times</div>
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
        :date-chooise="dateChooise"
        ></calendar-booking>

    <div class="clearfix"></div>


    <new-booking
            :club-setting-id.sync="clubSettingId",
            :click-new-booking.sync="clickNewBooking"
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
                clickNewBooking: null
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
            openModalNewBooking(){
                $("#myModal").modal('show');
                this.clickNewBooking = Math.random();
            }
        },
        components: {
            SearchBooking , CalendarBooking, NewBooking
        }
    }
</script>