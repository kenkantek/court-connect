<template>
    <div class="court_new courtbox">
        <h3 class="title-box">Add New Clubs</h3>
        <form class="form-horizontal" @submit.prevent="onSubmit" id="form-newClub">
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
                    <input id="geocomplete" name="address" class="form-control" type="text" placeholder="Enter address club" value="" v-model="club.address" />
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    <input class="form-control" name="administrative_area_level_1" type="text" value="" v-model="club.state" >
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input class="form-control" name="locality" type="text" value="" v-model="club.city">
                </div>
            </div>
            <div class="form-group">
                <label for="zipcode" class="col-sm-2 control-label">Zipcode</label>
                <div class="col-sm-10">
                    <input class="form-control" name="postal_code" type="text" value="" v-model="club.zipcode">
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Photo</label>

                <div class="col-sm-10">
                    <img :src="club.image" width="400" @click="getFilePathFromDialog($event)">
                    <input type="file" @change="onChangeImage($event)" accept="image/*" v-el:input-image class="hidden" />
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right" :disabled="submiting">Add club</button>
            </div>

        </form>
        <div class="map_canvas" style="border:red; height:400px"></div>
<!--         <form>
            <input id="geocomplete" type="text" placeholder="Type in an address" value="Empire State Bldg" />
            <input id="find" type="button" value="find" />
        </form> -->
    </div>
</template>
<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: ['clubs','reloadClubs'],
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
                country:null,
                longitude:null,
                latitude:null,
            },
            submiting:false,
            formErrors: {},
            states: [],
            citys: [],
            georesult:[],
        }
    },
    watch: {
        club: function () {
             $("#geocomplete").trigger("geocode");
        },
        clubSettingId: 'reloadAsyncData',
        georesult: function () {
            console.log(this.georesult);
            var _this = this;

        _this.club.address = this.georesult.formatted_address;

        _this.club.latitude = this.georesult.geometry.access_points[0].location.lat;
        _this.club.longitude = this.georesult.geometry.access_points[0].location.lng;

             $.each(this.georesult.address_components, function(index, val) {
                if (typeof val.types[0] != "undefined" ) {
                    if(val.types[0] == "locality"){
                        $("#form-newClub input[name=address]").val( val.long_name);
                    }
                    if(val.types[0] == 'administrative_area_level_1'){
                        $("#form-newClub input[name=administrative_area_level_1]").val(val.long_name);
                    }
                    if(val.types[0] == "postal_code"){
                        $("#form-newClub input[name=locality]").val(val.long_name);
                    }
                    if(val.types[0] == "country"){
                        $("#form-newClub input[name=postal_code]").val(val.short_name);
                    }
                }
            });
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
    ready() {
        var _this = this;
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        }).bind("geocode:result", function(event, result){
            _this.georesult = result;
          });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
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
        getFilePathFromDialog(event){
            this.$els.inputImage.click();
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
            this.$set('club.address',$("#form-newClub input[name=address]").val());
            this.$set('club.state',$("#form-newClub input[name=administrative_area_level_1]").val());
            this.$set('club.city',$("#form-newClub input[name=locality]").val());
            this.$set('club.zipcode',$("#form-newClub input[name=postal_code]").val());

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

            this.reloadClubs = Math.floor(Math.random() * 10000);

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