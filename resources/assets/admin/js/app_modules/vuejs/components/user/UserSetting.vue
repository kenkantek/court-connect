<template>
    <div class="box-body">
        <div class="user-clubs">
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <div class="court_list courtbox">
                        <h3 class="title-box pull-left">User list</h3>
                        <list-user
                                :club-setting-id="clubSettingId"
                                :users_choice.sync="users_choice"
                                :users.sync="users"
                                :reload-users.sync="reloadUsers"
                                >
                        </list-user>
                    </div>
                </div>

                <div class="col-xs-12 col-md-5">
                    <form-edit-user
                            v-if="users_choice.length < 2"
                            :users_choice="users_choice"
                            :surface="surface"
                            :users.sync="users"
                            :club-setting-id="clubSettingId"
                            :reload-users.sync="reloadUsers"
                            :data-rates.sync="dataRates"
                            >

                    </form-edit-user>
                    <form-new-user
                            v-if="!users_choice.length"
                            :surface="surface"
                            :users.sync="users"
                            :club-setting-id="clubSettingId"
                            :reload-users.sync="reloadUsers"
                            :data-rates.sync="dataRates"
                            >
                    </form-new-user>
                </div>
            </div>
        </div>
        <!-- end user club -->
        <div class="teach-clubs">
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <h3 class="title-box pull-left">Teacher list</h3>
                    <list-teacher
                            :club-setting-id="clubSettingId"
                            :teachers_choice.sync="teachers_choice"
                            :teachers.sync="teachers"
                            :reload-teachers.sync="reloadTeachers",
                            >
                    </list-teacher>
                </div>
                <div class="col-xs-12 col-md-5">
                    <form-edit-teacher
                            v-if="teachers_choice.length < 2"
                            :teachers_choice="teachers_choice"
                            :club-setting-id="clubSettingId"
                            :reload-teachers.sync="reloadTeachers"
                            >

                    </form-edit-teacher>
                    <form-new-teacher
                            v-if="!teachers_choice.length"
                            :surface="surface"
                            :club-setting-id="clubSettingId"
                            :reload-teachers.sync="reloadTeachers"
                            >
                    </form-new-teacher>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ListUser from './ListUser.vue';
    import FormEditUser from './FormEditUser.vue';
    import FormNewUser from './FormNewUser.vue';
    import ListTeacher from './ListTeacher.vue';
    import FormEditTeacher from './FormEditTeacher.vue';
    import FormNewTeacher from './FormNewTeacher.vue';
    let _ = require('lodash'),
            deferred = require('deferred');
    export default {
        props:['clubSettingId'],
        data(){
        return {
            dataRates:[],
            users_choice:[],
            surface:null,
            users:[],
            reloadUsers:1,
            teachers:[],
            teachers_choice:[],
            reloadTeachers:1,
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
    ready() { console.log(this.clubSettingId);},
    components: {
        ListUser,
                FormEditUser,
                FormNewUser,
                ListTeacher,
                FormEditTeacher,
                FormNewTeacher,
    }
    }
</script>
