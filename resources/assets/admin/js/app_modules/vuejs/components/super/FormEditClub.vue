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
          <label for="image" class="col-sm-2 control-label">Image</label>

          <div class="col-sm-10">
            <img :src="club.image" width="400" @click="getFilePathFromDialog($event)">
            <input type="file" @change="onChangeImage($event)" accept="image/*" v-el:input-image class="hidden" />
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
            <input type="text" class="form-control" id="state" placeholder="Enter state club" v-model="club.state">
          </div>
        </div>
        <div class="form-group">
          <label for="zipcode" class="col-sm-2 control-label">Zipcode</label>

          <div class="col-sm-10">
          	
            <input type="text" class="form-control" id="zipcode" placeholder="Enter zipcode club" v-model="club.zipcode">
          </div>
        </div>
        <button type="submit" class="btn btn-flat btn-info pull-right" :disabled="submiting" style="margin-right: 85px;">Update club</button>
        <button type="button" class="btn btn-flat btn-danger pull-right" @click="deleteClub">Delete club</button>
        

    </form>
	</div>
</template>
<script>
	export default {
		props: ['clubs','clubs_choice','delete_club'],
		data() {
			return {
								submiting:false,
								formErrors: {},
								
							}
		},
    computed: {
       club: function () {
          return this.clubs_choice;
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
					const club = this.club;
          this.submiting = true;
          this.$http.put(laroute.route('super.clubs.edit'), club).then(res => {
              this.submiting = false;
              showNotice('success', res.data.success_msg, 'Success!');
		        }, (res) => {
		                this.formErrors = res.data;
		                this.submiting = false;
		                showNotice('error', 'Error', 'Error!');
		            });
			}
		}
	}
</script>