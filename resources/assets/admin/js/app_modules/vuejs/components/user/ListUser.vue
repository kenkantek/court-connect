<template>
    <a class="btn btn-primary pull-right btn-new-court" href="" @click.prevent="scrollAddnewUser()"><i class="fa fa-plus-circle"></i> Add New User</a>
    <table id="tbl-listuser" class="table table-bordered table-hover table-th" id="datatables">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Is Admin ?</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(index,user) in data.data"  >
            <td><input type="checkbox" class="court-item-check" name="court-item-check" value="{{index}}" @click="addUsers(index)"></td>
            <td>{{ user.fullname }}</td>
            <td>{{ user.email }} </td>
            <td v-if="user.is_admin == true">Yes</td>
            <td v-else>No</td>
        </tr>
        </tbody>
    </table>
    <filter
            :data.sync="data"
    ></filter>
</template>
<style scoped>
    tr td{
        text-align: left;
    }
</style>
<script>
    import Filter from '../globals/Filter.vue';
    var _ = require('lodash'),
            deferred = require('deferred');
    var tmp_choice = null;
    export default {
        props:['clubSettingId','users_choice','users','reloadUsers','dataRates'],
        data(){
            return {
                data: {
                    per_page: "10",
                },
                api:laroute.route('users.listdata'),
            }
        },
        watch: {
            clubSettingId: 'reloadAsyncData',
            reloadUsers: 'reloadAsyncData',
        },
        asyncData(resolve, reject) {
        this.fetchUsers(this.api).done((data) => {
            resolve({data});
        }, (error) => {
            console.log(error);
        });

        },
        methods: {
            fetchUsers(api, clubid = this.clubSettingId, take = this.data.per_page) {
                let def = deferred();
                this.$http.get(api ,{ clubid, take}).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return def.promise;
            },
            addUsers(index){
                this.users_choice = [];
                $("#tbl-listuser .court-item-check:checked").prop("checked",false);
                console.log(index);
                if(tmp_choice != index) {
                    $("#tbl-listuser .court-item-check[value='"+index+"']").prop("checked",true);
                    this.users_choice[0] = this.data.data[$("#tbl-listuser .court-item-check[value='" + index + "']").val()];
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
        },
        events: {
            'go-to-page'(api) {
                console.log(api);
                this.api = api;
                this.reloadAsyncData();
            }
        },

        components: { Filter }
    }
</script>