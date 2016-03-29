<template>
    <div class="court_new courtbox">
        <h3 class="title-box">Add New User</h3>
        <form class="form-horizontal">
            <div class="form-group" :class=" {'has-error' : (user.fullname == null && submit == true)}">
                <label for="name" class="col-sm-4 control-label">Name *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Enter full name" name="fullname" type="text" id="fullname" v-model='user.fullname'>
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
                <label for="is_admin" class="col-sm-4 control-label">Is Admin? *</label>
                <div class="col-sm-8">
                    <input id="is_admin" class="styled" name="is_admin" type="checkbox" value="0">
                </div>
            </div>

            <div>
                <slot name="temp"></slot>
                <button type="button" id="btnAddnewUser"  class="btn btn-primary pull-right" @click.prevent="addUser()">Add User</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</template>
<script>
    export default {
        props:['surface','users','clubSettingId','reloadUsers','dataRates'],
        data() {
            return {
                user : {
                    name:null,
                    password:null,
                    email:null,
                    is_admin:0,
                    club_id:null,
                },
                submit:false,
            }
        },
        methods: {
            addUser(){
                this.$set('user.club_id', this.clubSettingId);
                const user = this.user;
                this.submit = true;
                this.$http.post(laroute.route('users.create.post'), user).then(res => {
                    console.log(res)
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
                        this.$set('user.fullname', null);
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
        }
    }
</script>