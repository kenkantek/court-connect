<template>
    <div id="confirm-action-delete" class="modal fade">
        <div class="modal-body">
            Are you sure you want to delete this user?
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" id="booking-delete">Delete</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="pull-left">
        <input type="text" v-model="search_text" placeholder="search anything..." style="text-indent: 5px; outline: none; height: 32px;">
        <button style="" class="btn btn-primary" @click.prevent="submitSearch()">Search</button>
    </div>
    <a style="margin-top: 0px; margin-bottom: 10px;" class="btn btn-primary pull-right btn-new-court" href="" @click.prevent="scrollAddnewUser()"><i class="fa fa-plus-circle"></i> Add New Player</a>
    <table id="tbl-listuser" class="table table-bordered table-hover table-th" id="datatables">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(index,user) in data.data"  >
            <td><input type="checkbox" class="court-item-check" name="court-item-check" value="{{index}}" @click="addUsers(index)"></td>
            <td>{{ user.fullname }}</td>
            <td>{{ user.email }} </td>
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
     tr.selected {
         background-color: #0f494d;
         color: #fff;
     }
    tr.selected:hover {
        background-color: #0f494d;
        color: #fff;
    }
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
                api:laroute.route('customer.listdata'),
                search_text: ''
            }
        },
        watch: {
            clubSettingId: 'reloadAsyncData',
            reloadUsers: 'reloadAsyncData',
            users_choice: function () {
                if(this.users_choice.length <=0){
                    $('table tbody tr').removeClass('selected');
                    $('.court-item-check').prop('checked',false);
                }
            }
        },
        asyncData(resolve, reject) {
            this.fetchUsers(this.api).done((data) => {
                resolve({data});
            this.users_choice = [];
            tmp_choice = null;
        }, (error) => {
                console.log(error);
            });

        },
        methods: {
            submitSearch(){
                this.reloadAsyncData();
            },
            fetchUsers(api, clubid = this.clubSettingId, take = this.data.per_pagem, search_text = this.search_text) {
                let def = deferred();
                this.$http.get(api ,{ clubid, take, search_text}).then(res => {
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
                var indexTable = index + 1 ;
                if(tmp_choice != index) {
                    $('tr').removeClass('selected');
                    if($('.court-item-check:eq('+index+')').prop('checked')){
                        $('.court-item-check:eq('+index+')').prop('checked',false);
                    }else{
                        $('tr:nth-child('+indexTable+')').addClass('selected');
                        $('.court-item-check:eq('+index+')').prop('checked',true);
                    }
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
                this.api = api + "&search_text=" + this.search_text;
                this.reloadAsyncData();
            }
        },

        components: { Filter }
    }
</script>