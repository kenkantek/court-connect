<template>
    <div class="box-body">

        <div class="teach-clubs">
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <h3 class="title-box pull-left">Pro list</h3>
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
            surface:null,
            teachers:[],
            teachers_choice:[],
            reloadTeachers:1,
        }
    },
    watch: {
        teachers_choice : function () {
            if(this.teachers_choice.length > 0) {
                this.dataRates = [];
                for (var index in this.teachers_choice) {    // don't actually do this

                    for (var i in this.teachers_choice[index].rates) {
                        const temp = _.cloneDeep(this.teachers_choice[index].rates[i]);
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
                ListTeacher,
                FormEditTeacher,
                FormNewTeacher,
    }
    }
</script>
