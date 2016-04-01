<template>
    <div class="court_new courtbox">
        <h3 class="title-box">Add New Clubs</h3>
        <form class="form-horizontal" @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter name club" v-model="club.name">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" placeholder="Enter phone club" v-model="club.phone">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" placeholder="Enter address club" v-model="club.address">
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="city" placeholder="Enter city club" v-model="club.city">
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" maxlength="2" id="state" placeholder="Enter state club" v-model="club.state">
                </div>
            </div>
            <div class="form-group">
                <label for="zipcode" class="col-sm-2 control-label">Zipcode</label>

                <div class="col-sm-10">

                    <input type="text" class="form-control" id="zipcode" placeholder="Enter zipcode club" v-model="club.zipcode">
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Photo</label>

                <div class="col-sm-10">
                    <img :src="club.image" width="400" @click="getFilePathFromDialog($event)">
                    <input type="file" @change="onChangeImage($event)" accept="image/*" v-el:input-image class="hidden" />
                </div>
            </div>
            <button type="submit" class="btn btn-info pull-right" :disabled="submiting">Add club</button>

        </form>
    </div>
</template>
<script>
    export default {
        props: ['clubs'],
        data() {
        return {
            club : {
                name:null,
                address:null,
                phone:null,
                image:"/uploads/images/clubs/no-image.jpg",
                city:null,
                state:null,
                zipcode:null,
            },
            submiting:false,
            formErrors: {},

        }
    },
    methods: {
        getFilePathFromDialog(event){
            this.$els.inputImage.click();
        },
        onChangeImage(event) {
            const images = event.target.files[0];
            if (images != 'undefined') {

                var reader = new FileReader();
                reader.onload =  (event) => {
                    this.$set('club.image', event.target.result);
                };
                reader.readAsDataURL(images);
            }
        },
        onSubmit(){
            const club = this.club;
            this.submiting = true;
            this.$http.post(laroute.route('super.clubs.create'), club).then(res => {
                this.submiting = false;
            this.clubs.unshift(res.data.club);
            this.$set('club.name', null);
            this.$set('club.address', null);
            this.$set('club.phone', null);
            this.$set('club.image', '/uploads/images/clubs/no-image.jpg');
            this.$set('club.city', null);
            this.$set('club.state', null);
            this.$set('club.zipcode', null);

            showNotice('success', res.data.success_msg, 'Success!');

        }, (res) => {
            var msg = "";
            $.each(res.data,function(k,v){
                msg += "<div>"+v+"</div>";
            });
            showNotice('error', msg, 'Error!');
            this.formErrors = res.data;
            this.submiting = false;
        });
    }
    }
    }
</script>