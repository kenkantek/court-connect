<template>
    <a class="btn btn-primary pull-right btn-new-court" href="" @click.prevent="scrollAddnewUser()"><i class="fa fa-plus-circle"></i> Add New User</a>
    <table id="tbl-listuser" class="table table-bordered table-hover table-th" id="datatables">
        <thead>
        <tr>
            <th></th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Is Admin ?</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(index,user) in users"  >
            <td><input type="checkbox" class="court-item-check" name="court-item-check" value="{{index}}" @click="addUsers(index)"></td>
            <td>{{ user.fullname }}</td>
            <td>{{ user.email }} </td>
            <td v-if="user.is_admin == true">Yes</td>
            <td v-else>No</td>
        </tr>
        </tbody>
    </table>
</template>
<script>
    var _ = require('lodash'),
    deferred = require('deferred');
    var tmp_choice = null;
    export default {
        props:['clubSettingId','users_choice','users','reloadUsers','dataRates'],
        watch: {
            clubSettingId: 'reloadAsyncData',
            reloadUsers:'reloadAsyncData',
        },
        asyncData(resolve, reject) {
        this.fetchUsers().done((users) => {
            resolve({users});
    }, (error) => {
        console.log(error);
    });

    },
        methods: {
            fetchUsers() {
                let def = deferred(),
                    url = laroute.route('users.listdata', {one:this.clubSettingId});
                this.$http.get(url).then(res => {
                    def.resolve(res.data.data);
            }, res => {
                def.reject(res);
            });
            return def.promise;
            },
            addUsers(index){
                this.users_choice = [];
                $("#tbl-listuser .court-item-check:checked").prop("checked",false);
                if(tmp_choice != index) {
                    $("#tbl-listuser .court-item-check[value='"+index+"']").prop("checked",true);
                    this.users_choice[0] = this.users[$("#tbl-listuser .court-item-check[value='" + index + "']").val()];
                    tmp_choice = index;
                }
                else {
                    tmp_choice = null;
                }
            },
            scrollAddnewUser(){
                $("#tbl-listuser .court-item-check:checked").prop("checked",false);
                this.users_choice = [];
            },
        }
    }
</script>