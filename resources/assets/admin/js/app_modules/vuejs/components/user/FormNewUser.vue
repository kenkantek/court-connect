<template>
    <div class="court_new courtbox">
        <h3 class="title-box">Add New Employee</h3>
        <form class="form-horizontal">
            <div class="form-group" :class=" {'has-error' : (user.first_name == null && submit == true)}">
                <label for="first_name" class="col-sm-4 control-label">First Name *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Enter first name" name="first_name" type="text" id="first_name" v-model='user.first_name'>
                </div>
            </div>
            <div class="form-group" :class=" {'has-error' : (user.last_name == null && submit == true)}">
                <label for="last_name" class="col-sm-4 control-label">Last Name *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Enter last name" name="last_name" type="text" id="last_name" v-model='user.last_name'>
                </div>
            </div>

            <div class="form-group" :class=" {'has-error' : (user.password == null && submit == true)}">
                <label for="password" class="col-sm-4 control-label">Password *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Password" name="password" type="password" id="password" v-model='user.password'>
                </div>
            </div>

            <div class="form-group" :class=" {'has-error' : (user.email == null && submit == true)}">
                <label for="email" class="col-sm-4 control-label">Email *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Email" name="email" type="text" id="email" v-model='user.email'>
                </div>
            </div>

            <div class="form-group">
                <label for="is_admin" class="col-sm-4 control-label">Admin rights? *</label>
                <div class="col-sm-8">
                    <input id="is_admin" class="styled" name="is_admin" type="checkbox" value="0" @click="changeIsAdmin">
                </div>
            </div>

            <div class="form-group" v-show="user.is_admin == 1">
                <label for="is_admin" class="col-sm-4 control-label">Select Clubs</label>
                <div class="col-sm-8">
                    <select id="cc-ms" multiple="multiple" name="clubs" v-model="user.clubs">
                        <template v-for="club in clubs">
                            <option v-if="club.id == clubSettingId" selected="selected" disabled="disabled" value="{{club.id}}">{{club.name}}</option>
                            <option v-else value="{{club.id}}">{{club.name}}</option>
                        </template>
                    </select>
                </div>
            </div>

            <div>
                <slot name="temp"></slot>
                <button type="button" id="btnAddnewUser"  class="btn btn-primary pull-right" @click.prevent="addUser()">Add Employee</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</template>
<script>
    export default {
        props:['surface','users','clubSettingId','clubs','reloadUsers','dataRates'],
        data() {
            return {
                user : {
                    first_name:null,
                    last_name: null,
                    password:null,
                    email:null,
                    is_admin:0,
                    club_id:null,
                    clubs: []
                },
                submit:false,
            }
        },
        watch: {
            clubs: function(){
                $('#cc-ms').change(function() {
                }).multipleSelect({
                    width: '100%',
                });
            },
            clubSettingId: function(){
                $('#cc-ms').change(function() {
                }).multipleSelect({
                    width: '100%',
                });
            }
        },
        methods: {
            changeIsAdmin(){
                if(this.user.is_admin == 0)
                    this.user.is_admin = 1;
                else this.user.is_admin = 0;
            },
            addUser(){
                this.$set('user.club_id',this.clubSettingId);
                this.user.clubs = $("#cc-ms").val();
                this.user.clubs.unshift(this.clubSettingId);
                const user = this.user;
                this.submit = true;
                this.$http.post(laroute.route('users.create.post'), user).then(res => {
                    if(res.data.error)
                    {
                        var msg = "";
                        $.each(res.data.messages,function(k,v){
                            msg += "<div>"+v+"</div>";
                        });
                        showNotice('error', msg, 'Error!');
                    }else
                    {
                        this.reloadUsers = Math.floor(Math.random() * 10000);
                        this.$set('user.first_name', null);
                        this.$set('user.last_name', null);
                        this.$set('user.password', null);
                        this.$set('user.email', null);
                        this.$set('user.is_admin', 0);
                        showNotice('success', res.data.success_msg, 'Success!');
                    }
                    this.submit = false;
                }, (res) => {
                    console.log(res);
                    showNotice('error', "Error. Try again!", 'Error!');
                });
            }
        },
        ready() {
            $('#cc-ms').change(function() {
            }).multipleSelect({
                width: '100%',
            });
        }
    }
</script>