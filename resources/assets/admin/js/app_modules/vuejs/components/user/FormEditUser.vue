<template>
    <div class="court_new courtbox"  v-if="users_choice.length == 1">
        <h3 class="title-box">Edit User</h3>
        <form class="form-horizontal fm-user">

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
                    <input v-if="user.is_admin == true" id="is_admin" checked="checked" class="styled is_admin" name="is_admin" type="checkbox" @click="is_admin()">
                    <input v-else id="is_admin" class="styled" name="is_admin" type="checkbox" @click="is_admin()">
                </div>
            </div>

            <div>
                <slot name="temp"></slot>
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