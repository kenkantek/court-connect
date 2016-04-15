<template>
    <div class="court_new courtbox">
        <h3 class="title-box">Edit Clubs : {{ club.name }}</h3>
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
                <label for="state" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    <select class="form-control" name="state" id="state" v-model="club.state" @change="fetchCitys()">
                        <option v-for="option in states" :value="option.id">
                            {{ option.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <select class="form-control" name="city" id="city" v-model="club.city">
                        <option v-for="option in citys" v-bind:value="option.id">
                            {{ option.name }}
                        </option>
                    </select>
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
            <button type="submit" class="btn btn-flat btn-info pull-right" :disabled="submiting" style="margin-right: 85px;">Update club</button>
            <button type="button" class="btn btn-flat btn-danger pull-right" @click="deleteClub">Delete club</button>


        </form>
    </div>
</template>
<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: ['clubs','clubs_choice','delete_club'],
        data() {
        return {
            submiting:false,
            formErrors: {},
            states: [],
            citys: [],
        }
    },
    asyncData(resolve, reject) {
        this.fetchStates().done((states) => {
            resolve({states});
        }, (error) => {
            console.log(error);
        });
        this.fetchCitys().done((citys) => {
            resolve({citys});
        }, (error) => {
            console.log(error);
        });
    },
    computed: {
        club: function () {
            return this.clubs_choice;
        },
    },
    watch: {
        clubs_choice: function(){
            this.fetchCitys();
        }
    },
    methods: {
        fetchStates() {
            let def = deferred(),
                url = laroute.route('clubs.states');
            this.$http.get(url).then(res => {
                def.resolve(res.data.data);
            }, res => {
                def.reject(res);
            });
            return def.promise;
        },
        fetchCitys(){
            let def = deferred(),
                url = laroute.route('clubs.citys', {state_id: this.club.state});
            this.$http.get(url).then(res => {
                this.citys = res.data.data;
            def.resolve(res.data.data);
        }, res => {
            def.reject(res);
        });

        return def.promise;
        },
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
        deleteClub(){
            const club = this.club;
            this.$http.delete(laroute.route('super.clubs.delete'), club).then(res => {
                showNotice('success', res.data.success_msg, 'Success!');
            this.delete_club =  Math.floor(Math.random() * 10000);
            this.$set('clubs_choice', null);
        },(res) => {
            showNotice('error', 'Error', 'Error!');
        });
    },
    onSubmit(){
        this.$set('club.state',this.club.state);
        this.$set('club.city',this.club.city);
        const club = this.club;
        this.submiting = true;
        this.$http.put(laroute.route('super.clubs.edit'), club).then(res => {
            this.submiting = false;
        showNotice('success', res.data.success_msg, 'Success!');
    }, (res) => {
        this.formErrors = res.data;
        this.submiting = false;
        var msg = "";
        $.each(res.data,function(k,v){
            msg += "<div>"+v+"</div>";
        });
        showNotice('error', msg, 'Error!');
    });
    }
    }
    }
</script>