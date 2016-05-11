<template>
    <a class="btn btn-primary pull-right btn-new-court" href="" @click.prevent="scrollAddnewTeacher()"><i class="fa fa-plus-circle"></i> Add New User</a>
    <table id="tbl-listteacher" class="table table-bordered table-hover table-th">
        <thead>
        <tr>
            <th></th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Rate</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(index,teacher) in teachers"  >
            <td><input type="checkbox" class="court-item-check" name="court-item-check" value="{{index}}" @click="addTeacher(index)"></td>
            <td>{{ teacher.fullname }}</td>
            <td>{{ teacher.email }} </td>
            <td>${{ teacher.teacher.rate }} </td>
        </tr>
        </tbody>
    </table>
</template>
<script>
    var _ = require('lodash'),
    deferred = require('deferred');
    var tmp_choice = null;
    export default {
        props:['clubSettingId','teachers_choice','teachers','reloadTeacher'],
        watch: {
            clubSettingId: 'reloadAsyncData',
            reloadTeachers:'reloadAsyncData',
        },
        asyncData(resolve, reject) {
            this.fetchTeachers().done((teachers) => {
                resolve({teachers});
            }, (error) => {
                console.log(error);
            });

        },
        methods: {
            fetchTeachers() {
                //if (this.clubSettingId != null) {
                    let def = deferred(),
                    url = laroute.route('teacher.listdata', {one:this.clubSettingId});
                    this.$http.get(url).then(res => {
                        def.resolve(res.data.data);
                    }, res => {
                        def.reject(res);
                    });
                    return def.promise;
               // }
            },
            addTeacher(index){
                this.teachers_choice = [];
                $("#tbl-listteacher .court-item-check:checked").prop("checked",false);
                if(tmp_choice != index) {
                    $("#tbl-listteacher .court-item-check[value='"+index+"']").prop("checked",true);
                    this.teachers_choice[0] = this.teachers[$("#tbl-listteacher .court-item-check[value='" + index + "']").val()];
                    tmp_choice = index;
                }
                else {
                    tmp_choice = null;
                }
            },
            scrollAddnewTeacher(){
                $("#tbl-listteacher .court-item-check:checked").prop("checked",false);
                this.teachers_choice = [];
            },
        }
    }
</script>