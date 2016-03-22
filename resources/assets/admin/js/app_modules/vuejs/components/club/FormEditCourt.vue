<template>
	<div class="court_new courtbox" 
	v-if="courts_choice.length == 1"
	>
		<h3 class="title-box">Edit Court</h3>
		<form class="form-horizontal">
      <div class="form-group" :class=" {'has-error' : (court.name == null && submit == true)}">
        <label for="name" class="col-sm-4 control-label">Court Name *</label>          
        <div class="col-sm-8">
          <input class="form-control" placeholder="Court name" name="name" type="text" id="name" 
          v-model='court.name'>
        </div>
      </div>
      <div class="form-group" :class=" {'has-error' : (court.indoor_outdoor == null && submit == true)}">
        <label for="last_name" class="col-sm-4 control-label">Indoor/Outdoor? *</label>          
        <div class="col-sm-8">
          <select class="form-control" name="indoor_outdoor" v-model='court.indoor_outdoor'>
					<option value="1">Indoor</option>
					<option value="2">Outdoor</option>
					</select>
				</div>
      </div>      
      
      <div class="form-group" :class=" {'has-error' : (court.surface_id == null && submit == true)}">
        <label for="surface_type" class="col-sm-4 control-label">Surface Type *</label>        
        <div class="col-sm-8">
          <select class="form-control" name="surface" v-model='court.surface_id'>
						<option 
							v-for="val in surface"
						 	:value="val.id">
						 		{{ val.label }}
						</option>
					</select>
				</div>
      </div>      
      <div>
        <slot name="temp"></slot>
					<button type="button" id="btnEditCourt"  class="btn btn-primary pull-right" @click.prevent="editCourt()">Edit Court
					</button>
      </div>
      <!-- /.box-footer -->
    </form>
	</div>
</template>
<script>
	export default {
		props:['courts_choice','surface','courts','clubSettingId','reloadCourts','dataRates'],
		data() {
			return {
				submit : false,
			}
		},
		computed: {
       court: function () {
          return this.courts_choice[0];
        }
    },	
    methods: {
    	editCourt(){
    		if(this.dataRates.length > 0){
					const court = this.court;
					court.dataRates = _.cloneDeep(this.dataRates);
					console.log(court.dataRates);
					this.$http.post(laroute.route('courts.update'), court).then(res => {
						this.dataRates = [];
	          this.reloadCourts =  Math.floor(Math.random() * 10000);
						this.$set('courts_choice', null);
	          showNotice('success', res.data.success_msg, 'Update Success!');
	          this.submit = false;
	        }, (res) => {
	                showNotice('error', 'Error', 'Error!');
	            });
				}else if(this.dataRates == null) {
					showNotice('error', 'Please add new rate for court', 'Error!');
					$('.new_date_preiod').removeClass('hidden');
					$('html, body').animate({ scrollTop: $('.new_date_preiod').position().top }, 500);
					$('#date-picker-rate').focus();
					
				}
    	}
    }	
	}
</script>