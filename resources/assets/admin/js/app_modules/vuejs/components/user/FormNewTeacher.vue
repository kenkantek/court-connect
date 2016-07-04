<template>
    <div class="court_new courtbox">
        <h3 class="title-box">Add New Pro</h3>
        <form class="form-horizontal">
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
                    <input class="form-control" placeholder="rate" name="rate" type="number" id="rate" v-model='teacher.rate'>
                </div>
            </div>

            <div>
                <slot name="temp"></slot>
                <button type="button" id="btnAddnewteacher"  class="btn btn-primary pull-right" @click.prevent="addTeacher()">Add Pro</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</template>
<script>
    export default {
        props:['surface','teacher','clubSettingId','reloadTeachers','dataRates'],
        data() {
            return {
                teacher : {
                    first_name:null,
                    last_name:null,
                    password:null,
                    email:null,
                    rate:0,
                    club_id:null,
                },
                submit:false,
            }
        },
        methods: {
            addTeacher(){
                this.$set('teacher.club_id', this.clubSettingId);
                const teacher = this.teacher;
                this.submit = true;
                this.$http.post(laroute.route('teacher.create.post'), teacher).then(res => {
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
                        this.reloadTeachers = Math.floor(Math.random() * 10000);
                        this.$set('teacher.first_name', null);
                        this.$set('teacher.last_name', null);
                        this.$set('teacher.password', null);
                        this.$set('teacher.email', null);
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