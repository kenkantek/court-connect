<template>
    <div class="court_new courtbox"  v-if="users_choice.length == 1">
        <h3 class="title-box">Edit User</h3>
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
                    <input class="form-control" placeholder="Email" name="email" type="text" id="email" v-model='user.email'>
                </div>
            </div>

            <div class="form-group">
                <label for="is_admin" class="col-sm-4 control-label">Is Admin? *</label>
                <div class="col-sm-8">
                    <input v-if="user.is_admin == true" id="is_admin" checked="checked" class="styled is_admin" name="is_admin" type="checkbox" @click="is_admin()">
                    <input v-else id="is_admin" class="styled" name="is_admin" type="checkbox" @click="is_admin()">
                </div>
            </div>

            <div>
                <slot name="temp"></slot>
                <button type="button" id="btnDeleteUser"  class="btn btn-danger pull-left" @click.prevent="deleteUser()">Delete User
                </button>
                <button type="button" id="btnEditUser"  class="btn btn-primary pull-right" @click.prevent="editUser()">Edit User
                </button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</template>
<script>
    export default {
        props:['users_choice','surface','users','clubSettingId','reloadUsers','dataRates'],
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
    methods: {
        editUser(){
            const user = this.user;
            console.log(user);
            this.$http.post(laroute.route('users.edit.post'), user).then(res => {
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
                this.reloadUsers =  Math.floor(Math.random() * 10000);
                showNotice('success', res.data.success, 'Update Success!');
            }
            this.submit = false;
            }, (res) => {
                showNotice('error', 'Error', 'Error!');
            });

        },
        deleteUser(){
            const user = this.user;
            this.$http.get(laroute.route('users.delete'), {id:user.id}).then(res => {
            if(res.data.error)
            {
                var msg = "<div>"+res.data.message+"</div>";
                showNotice('error', msg, 'Error!');
            }else
            {
                this.reloadUsers =  Math.floor(Math.random() * 10000);
                showNotice('success', res.data.success, 'Deleted user successfully!');
            }
            this.submit = false;
            }, (res) => {
                showNotice('error', 'Error', 'Error!');
            });

        },
        is_admin(){
            if($(".fm-user input[name=is_admin]").hasClass('is_admin')) {
                $(this).removeClass('is_admin')
                this.$set('user.is_admin',0);
            }
            else {
                $(".fm-user input[name=is_admin]").addClass("is_admin");
                this.$set('user.is_admin',1);
            }
        }
    }
    }
</script>