<template>
    <div class="court_new courtbox"  v-if="teachers_choice.length == 1">
        <h3 class="title-box">Edit Teacher</h3>
        <form class="form-horizontal fm-user">

            <div class="form-group" :class=" {'has-error' : (teacher.first_name == null && submit == true)}">
                <label for="first_name" class="col-sm-4 control-label">First Name *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Enter first name" name="first_name" type="text" id="first_name" v-model='teacher.first_name'>
                </div>
            </div>

            <div class="form-group" :class=" {'has-error' : (teacher.last_name == null && submit == true)}">
                <label for="last_name" class="col-sm-4 control-label">Last Name *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Enter last name" name="last_name" type="text" id="last_name" v-model='teacher.last_name'>
                </div>
            </div>

            <div class="form-group" :class=" {'has-error' : (teacher.email == null && submit == true)}">
                <label for="email" class="col-sm-4 control-label">Email *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Email" name="email" type="text" id="email" v-model='teacher.email'>
                </div>
            </div>

            <div class="form-group" :class=" {'has-error' : (teacher.password == null && submit == true)}">
                <label for="password" class="col-sm-4 control-label">Password *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="Password" name="password" type="password" id="password" v-model='teacher.password'>
                </div>
            </div>

            <div class="form-group" :class=" {'has-error' : (teacher.rate == null && submit == true)}">
                <label for="rate" class="col-sm-4 control-label">Rate *</label>
                <div class="col-sm-8">
                    <input class="form-control" placeholder="rate" name="rate" type="number" id="rate" v-model='teacher.teacher.rate'>
                </div>
            </div>

            <div>
                <slot name="temp"></slot>
                <button type="button" id="btnDeleteUser"  class="btn btn-danger pull-left" @click.prevent="deleteTeacher()">Delete teacher
                </button>
                <button type="button" id="btnEditUser"  class="btn btn-primary pull-right" @click.prevent="editTeacher()">Edit teacher
                </button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</template>
<script>
    export default {
        props:['teachers_choice','clubSettingId','reloadTeachers'],
        data() {
        return {
            submit : false,
        }
    },
    computed: {
        teacher: function () {
            return this.teachers_choice[0];
        }
    },
    methods: {
        editTeacher(){
                this.$set('teacher.rate',this.teacher.teacher.rate);
                const teacher = this.teacher;
                this.$http.post(laroute.route('teacher.edit.post'), teacher).then(res => {
                    if(res.data.error){
                        var msg = "<div>"+res.data.message+"</div>";
                        showNotice('error', msg, 'Error!');
                    }else
                    {
                        this.reloadTeachers =  Math.floor(Math.random() * 10000);
                        showNotice('success', res.data.success, 'Deleted user successfully!');
                    }
                    this.submit = false;
                }, (res) => {
                    showNotice('error', 'Error', 'Error!');
                });

            },
            deleteTeacher(){
                const teacher = this.teacher;
                this.$http.get(laroute.route('teacher.delete'), {id:teacher.id}).then(res => {
                    if(res.data.error)
                {
                    var msg = "";
                    $.each(res.data.messages,function(k,v){
                        msg += "<div>"+v+"</div>";
                    });
                    showNotice('error', msg, 'Error!');
                }else
                {
                    this.reloadTeachers =  Math.floor(Math.random() * 10000);
                    showNotice('success', res.data.success, 'Deleted user successfully!');
                }
                this.submit = false;
                }, (res) => {
                    showNotice('error', 'Error', 'Error!');
                });

            },
        }
    }
</script>