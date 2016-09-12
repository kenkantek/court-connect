<template>
    <div class="box-body">
        <div class="user-clubs">
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <div class="court_list courtbox">
                        <h3 class="title-box pull-left">Player list</h3>
                        <list-customer
                                :club-setting-id="clubSettingId"
                                :users_choice.sync="users_choice"
                                :users.sync="users"
                                :reload-users.sync="reloadUsers"
                        >
                        </list-customer>
                    </div>
                </div>

                <div class="col-xs-12 col-md-5">
                    <form-edit-customer
                            v-if="users_choice.length < 2"
                            :users_choice="users_choice"
                            :surface="surface"
                            :users.sync="users"
                            :club-setting-id="clubSettingId"
                            :clubs="clubs"
                            :reload-users.sync="reloadUsers"
                            :data-rates.sync="dataRates"
                    >

                    </form-edit-customer>
                    <form-new-customer
                            v-if="!users_choice.length"
                            :surface="surface"
                            :users.sync="users"
                            :club-setting-id="clubSettingId"
                            :clubs="clubs"
                            :reload-users.sync="reloadUsers"
                            :data-rates.sync="dataRates"
                    >
                    </form-new-customer>
                </div>
            </div>
        </div>
        <!-- end user club -->
    </div>
</template>
<script>
    import ListCustomer from './ListCustomer.vue';
    import FormEditCustomer from './FormEditCustomer.vue';
    import FormNewCustomer from './FormNewCustomer.vue';
    let _ = require('lodash'),
            deferred = require('deferred');
    export default {
        props:['clubSettingId','clubs'],
        data(){
            return {
                dataRates:[],
                users_choice:[],
                surface:null,
                users:[],
                reloadUsers:1,
            }
        },
        watch: {
            users_choice : function () {
                if(this.users_choice.length > 0) {
                    this.dataRates = [];
                    for (var index in this.users_choice) {    // don't actually do this

                        for (var i in this.users_choice[index].rates) {
                            const temp = _.cloneDeep(this.users_choice[index].rates[i]);
                            this.dataRates.push(temp);
                        }
                    }
                }else{
                    this.dataRates = [];
                }
            }
        },
        methods:{
        },
        ready() {},
        components: {
            ListCustomer,
            FormEditCustomer,
            FormNewCustomer,
        }
    }
</script>
