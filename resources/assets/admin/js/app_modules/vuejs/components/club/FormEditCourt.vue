<template>
	<div class="court_new courtbox"
		 v-if="courts_choice !=null && courts_choice.length == 1"
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

			<div class="form-group" :class=" {'has-error' : (court.rate == null && submit == true)}">
				<label for="name" class="col-sm-4 control-label">Default rate</label>
				<div class="col-sm-8">
					<input class="form-control" placeholder="Default rate" name="default_rate" type="text" id="default_rate"
						   v-model='defaultPrice'>
				</div>
			</div>

			<div>
				<slot name="temp"></slot>
				<button type="button" id="btnEditCourt"  class="btn btn-primary pull-right" @click.prevent="editCourt()">Save Court</button>
				<button type="button" class="btn btn-flat btn-danger pull-left" @click="deleteCourt">Delete court</button>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
</template>
<script>
	export default {
		props:['courts_choice','surface','courts','clubSettingId','reloadCourts','dataRates','delete_court','defaultPrice'],
		data() {
		return {
			submit : false,
		}
	},
	computed: {
		court: function () {
			if(this.courts_choice.length > 0) {
				this.defaultPrice = this.courts_choice[0].default_rate;
				return this.courts_choice[0];
			}
			else return null;
		}
	},
	methods: {
		editCourt(){
			if(this.dataRates.length > 0 && this.court != null ){
				this.$set('court.default_rate', this.defaultPrice);
				const court = this.court;
				court.dataRates = _.cloneDeep(this.dataRates);
				console.log(court);
				$("#clubSetting-wrapper").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
				this.$http.post(laroute.route('courts.update'), court).then(res => {
					this.dataRates = [];
					this.reloadCourts =  Math.floor(Math.random() * 10000);
					this.$set('courts_choice', null);
					showNotice('success', res.data.success_msg, 'Update Success!');
					this.submit = false;
					$('.unSelected').click();
					$("#clubSetting-wrapper .loading").remove();
				}, (res) => {
					showNotice('error', 'Error', 'Error!');
					$("#clubSetting-wrapper .loading").remove();
				});
			}else if(this.dataRates == null || this.dataRates.length < 1) {
				showNotice('error', 'Please add new rate for court', 'Error!');
				$('.new_date_preiod').removeClass('hidden');
				$('html, body').animate({ scrollTop: $('.new_date_preiod').position().top }, 500);
				$('#date-picker-rate').focus();

			 }
	  	},
		deleteCourt(){
			var _this = this;
			$('#cc-confirm-delete').modal({ backdrop: 'static', keyboard: false })
					.one('click', '#cc-submit-delete', function (e) {
						$("body").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
						const court = _this.court;
						_this.$http.delete(laroute.route('courts.delete'), court).then(res => {
							showNotice('success', res.data.success_msg, 'Success!');
						_this.delete_court = _this.reloadCourts =  Math.floor(Math.random() * 10000);
						_this.reloadCourts =  Math.floor(Math.random() * 10000);
						_this.$set('courts_choice', null);
					},(res) => {
							showNotice('error', 'Error', 'Error!');
						});
						$("body .loading").remove();
					});

		},
	 }
	}
</script>