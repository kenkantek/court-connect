<template>
    <div class="court_new courtbox"  v-if="users_choice.length == 1">
        <h3 class="title-box">Edit Player</h3>
        <form class="form-horizontal fm-user">

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
                    <input disabled class="form-control" placeholder="Email" name="email" type="text" id="email" v-model='user.email'>
                </div>
            </div>

            <div>
                <slot name="temp"></slot>
                <button type="button" id="btnDeleteUser"  class="btn btn-danger pull-left" @click.prevent="deleteUser()">Delete Customer
                </button>
                <button type="button" id="btnEditUser"  class="btn btn-primary pull-right" @click.prevent="editUser()">Edit Customer
                </button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</template>
<script>
    export default {
        props:['users_choice','surface','users','clubs','clubSettingId','reloadUsers','dataRates'],
        data() {
            return {
                submit : false,
            }
        },
        computed: {
            user: function () {
                return this.users_choice[0];
            }
        },
        watch: {
            clubs: function(){
                $('#cc-ms').multipleSelect({
                    width: '100%',
                });
            },
            clubSettingId: function(){
                $('#cc-ms').multipleSelect({
                    width: '100%',
                });
            }
        },
        methods: {
            editUser(){
                const user = this.user;
                this.$http.post(laroute.route('users.edit.post'), user).then(res => {
                    if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else
                {
                    this.user = null;
                    this.users_choice = null;
                    this.reloadUsers =  Math.floor(Math.random() * 10000);
                    showNotice('success', res.data.success, 'Update Success!');
                }
                this.submit = false;
            }, (res) => {
                    showNotice('error', 'Error', 'Error!');
                });

            },
            deleteUser(){
                var _this = this;
                $('#confirm-action-delete').modal({ backdrop: 'static', keyboard: false }).one('click', '#booking-delete', function (e) {
                    _this.$set('user.create_player',1);
                    const user = _this.user;
                    _this.$http.get(laroute.route('users.delete'), {id:user.id}).then(res => {
                        if(res.data.error)
                    {
                        var msg = "<div>"+res.data.message+"</div>";
                        showNotice('error', msg, 'Error!');
                    }else{
                        _this.users_choice = [];
                        _this.reloadUsers =  Math.floor(Math.random() * 10000);
                        showNotice('success', res.data.success, 'Deleted successfully!');
                    }
                    _this.submit = false;
                }, (res) => {
                        showNotice('error', 'Error', 'Error!');
                    });
                 });
            }
        },
        ready() {
            $('#cc-ms').multipleSelect({
                width: '100%',
            });
        }
    }
</script>