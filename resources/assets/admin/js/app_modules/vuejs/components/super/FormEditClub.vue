<template>
    <div class="form-clubs col-xs-12 col-md-7">
        <h3 class="title-box">Commission</h3>
        <form v-show="club.flat_fee == false" class="form-horizontal" id="form-newClub1">
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Open time booked on the front end</label>
                <div class="col-sm-4 placeholder" data-placeholder="%">
                    <input type="number" min="0" class="form-control" placeholder="percentage" v-model="club.otb_front_per">
                </div>
                <div class="col-sm-4 placeholder" data-placeholder="$">
                    <input type="number" min="0" class="form-control" placeholder="$" v-model="club.otb_front_mon">
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Open time booked on the back end</label>
                <div class="col-sm-4 placeholder" data-placeholder="%">
                    <input type="number" min="0" class="form-control" placeholder="percentage" v-model="club.otb_back_per">
                </div>
                <div class="col-sm-4 placeholder" data-placeholder="$">
                    <input type="number" min="0" class="form-control" placeholder="$" v-model="club.otb_back_mon">
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Contract time booked on the front end</label>
                <div class="col-sm-4 placeholder" data-placeholder="%">
                    <input type="number" min="0" class="form-control" placeholder="percentage" v-model="club.ctb_front_per">
                </div>
                <div class="col-sm-4 placeholder" data-placeholder="$">
                    <input type="number" min="0" class="form-control" placeholder="$" v-model="club.ctb_front_mon">
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Contract time booked on the back end</label>
                <div class="col-sm-4 placeholder" data-placeholder="%">
                    <input type="number" min="0" class="form-control" placeholder="percentage" v-model="club.ctb_back_per">
                </div>
                <div class="col-sm-4 placeholder" data-placeholder="$">
                    <input type="number" min="0" class="form-control" placeholder="$" v-model="club.ctb_back_mon">
                </div>
            </div>
        </form>

        <label>
            <input v-if="club.flat_fee == true" checked="checked" type="checkbox" v-model="club.flat_fee">
            <input v-else type="checkbox" v-model="club.flat_fee" >
            <span><h4 style="display: inline;" class="title-box">Flat fee</h4></span>
        </label>
        <div class="from-group" v-show="club.flat_fee == true">
            <div class="col-md-6">
                <input type="number" v-model="club.price_flat_fee" required min="0" class="form-control left" placeholder="$">
            </div>
            <div class="col-md-6">
                <select name="" class="form-control left" v-model="club.down_box_flat_fee">
                    <option value="monthly">Monthly</option>
                    <option value="quarterly">Quarterly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
        </div>
    </div>

    <div id="lch-form-new-club" class="form-clubs col-xs-12 col-md-5">
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
                    <input id="geocomplete" type="text" class="form-control" id="address" placeholder="Enter address club" v-model="club.address">
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="zipcode" placeholder="Enter zipcode club" v-model="club.city">
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="zipcode" placeholder="Enter zipcode club" v-model="club.state">

                </div>
            </div>
            <div class="form-group">
                <label for="zipcode" class="col-sm-2 control-label">Zip</label>

                <div class="col-sm-10">

                    <input type="text" class="form-control" id="zipcode" placeholder="Enter zipcode club" v-model="club.zipcode">
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Photo</label>

                <div class="col-sm-10">
                    <img :src="club.image" width="200" @click="getFilePathFromDialog($event)">
                    <input type="file" @change="onChangeImage($event)" accept="image/*" v-el:input-image class="hidden" />
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-flat btn-info pull-right" :disabled="submiting" style="margin-right: 65px;">Update club</button>
                <button type="button" class="btn btn-flat btn-danger pull-left" @click="deleteClub">Delete club</button>
            </div>
           


        </form>
                <div class="map_canvas" style="border:red; height:400px"></div>
<!--         <form>
            <input id="geocomplete" type="text" placeholder="Type in an address" value="Empire State Bldg" />
            <input id="find" type="button" value="find" />
        </form> -->
    </div>
    </div>
</template>

<style scoped>
    .placeholder
    {
        position: relative;
        width: 200px;
        padding-right: 0px;
        line-height: 30px;
    }
    .placeholder input{
        position: relative;
        width: 100%;
    }

    .placeholder::before
    {
        position: absolute;
        right: 5px;
        top: 3px;
        content: attr(data-placeholder);
        pointer-events: none;
        opacity: 0.6;
        z-index: 10000;
    }
    #lch-form-new-club{
        position: absolute;
        top: 0px;
        right: 0px;
    }
</style>

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
                georesult:[],
                first_check: true
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
            $("#geocomplete").trigger("geocode");
             // $("#geocomplete").geocomplete({
             //      map: ".map_canvas",
             //      details: "form",
             //      types: ["geocode", "establishment"],
             //    })
            //this.fetchCitys();
        },
        georesult: function () {
            console.log(this.georesult);
            var _this = this;

            _this.club.address = this.georesult.formatted_address;
            _this.club.latitude = this.georesult.geometry.location.lat();
            _this.club.longitude = this.georesult.geometry.location.lng();

            $.each(this.georesult.address_components, function(index, val) {
                if (typeof val.types[0] != "undefined" ) {
                    if(val.types[0] == "locality"){
                        $("#form-newClub input[name=address]").val( val.long_name);
                        _this.$set('club.city',val.long_name);
                    }
                    if(val.types[0] == 'administrative_area_level_1'){
                        $("#form-newClub input[name=administrative_area_level_1]").val(val.long_name);
                        _this.$set('club.state',val.long_name);
                    }
                    if(val.types[0] == "postal_code"){
                        $("#form-newClub input[name=locality]").val(val.long_name);
                        _this.$set('club.zipcode',val.long_name);

                    }
                    if(val.types[0] == "country"){
                        $("#form-newClub input[name=postal_code]").val(val.short_name);
                        _this.$set('club.country',val.long_name);
                    }
                }
            });
        }
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
        $("#geocomplete").trigger("geocode");
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
            var _this = this;
            $('#cc-confirm-delete').modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#cc-submit-delete', function (e) {
                        $("body").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
                        const club = _this.club;
                        _this.$http.delete(laroute.route('super.clubs.delete'), club).then(res => {
                            showNotice('success', res.data.success_msg, 'Success!');
                        _this.delete_club =  Math.floor(Math.random() * 10000);
                        _this.$set('clubs_choice', null);
                        },(res) => {
                            showNotice('error', 'Error', 'Error!');
                        });
                        $("body .loading").remove();
                    });

        },
        onSubmit(){
            this.$set('club.state',this.club.state);
            this.$set('club.city',this.club.city);
            const club = this.club;
            this.submiting = true;
            $("body").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
            this.$http.put(laroute.route('super.clubs.edit'), club).then(res => {
                this.submiting = false;
                showNotice('success', res.data.success_msg, 'Success!');
                $("body .loading").remove();
            }, (res) => {
                this.formErrors = res.data;
                this.submiting = false;
                var msg = "";
                $.each(res.data,function(k,v){
                    msg += "<div>"+v+"</div>";
                });
                showNotice('error', msg, 'Error!');
                $("body .loading").remove();
            });
        }
    }
    }
</script>