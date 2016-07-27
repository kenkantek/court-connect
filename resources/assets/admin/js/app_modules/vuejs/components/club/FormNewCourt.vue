<template>
	<div class="court_new courtbox">
		<h3 class="title-box">Add New Court</h3>
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
					<select class="form-control" id="surface_type" name="surface" v-model='court.surface_id'>
						<option
							v-for="val in surface"
							:value="val.id">
							{{ val.label }}
						</option>
					</select>
				</div>
			</div>
			<div class="form-group" >
				<label for="basic_price" class="col-sm-4 control-label">Basic Price *</label>
				<div class="col-sm-8">
					<select class="form-control" id="basic_price" name="price" v-model='court.base_price' @change="updateDataRates">
						<option value="0">-------</option>
						<option  v-for="court in courts" value="{{court.id}}">Same price as {{court.name}}</option>
					</select>
				</div>
			</div>

			<div class="form-group" :class=" {'has-error' : (court.rate == null && submit == true)}">
				<label for="name" class="col-sm-4 control-label">Default rate</label>
				<div class="col-sm-8">
					<input class="form-control" placeholder="Default rate" name="default_rate" type="text" id="default_rate"
						   v-model='defaultPrice' value="20">
				</div>
			</div>

			<div>
				<slot name="temp"></slot>
				<button type="button" id="btnAddnewCourt"  class="btn btn-primary pull-right" @click.prevent="addCourt()">Add Court
				</button>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>
</template>
<script>
	export default {
		props:['surface','courts','clubSettingId','reloadCourts','dataRates','btnAddCourt','indexDataRates','defaultPrice'],
		data() {
		return {
			court : {
				name:null,
				indoor_outdoor:1,
				surface_id:1,
				base_price:0,
				club_id:null,
			},
			submit:false,
		}
	},
	methods: {
		updateDataRates(){
			for (var index in this.courts) {
				if (this.court.base_price == this.courts[index].id) {
					for (var i in this.courts[index].rates) {
						const datarate = _.cloneDeep(this.courts[index].rates[i]);
						const nameCourt = _.cloneDeep(this.courts[index].name);
//						this.dataRates.push({datarate,nameCourt});
						this.dataRates=[{datarate,nameCourt}];
					}
					break;
				}
			}
		},
		addCourt(){
			if (this.dataRates.length == 0) {
				showNotice('error', 'Please add new rate for court', 'Error!');
				$('.new_date_preiod').removeClass('hidden');
				$('html, body').animate({ scrollTop: $('.new_date_preiod').position().top }, 500);
				$('#date-picker-rate').focus();

			}else{
				this.$set('court.club_id', this.clubSettingId);
				this.$set('court.default_rate', this.defaultPrice);
				const court = this.court;
				court.dataRates = _.cloneDeep(this.dataRates);
				this.submit = true;
				$("#clubSetting-wrapper").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
				this.$http.post(laroute.route('courts.create'), court).then(res => {
					this.reloadCourts =  Math.floor(Math.random() * 10000);

					this.$set('court.name', null);
					this.$set('court.indoor_outdoor', 1);
					this.$set('court.surface_id', 1);
					this.$set('court.base_price', 0);
					this.$set('btnAddCourt', false);
					this.$set('indexDataRates',null);
					showNotice('success', res.data.success_msg, 'Success!');
					this.submit = false;
					$('.unSelected').click();
					$("#clubSetting-wrapper .loading").remove();
				}, (res) => {
					showNotice('error', 'Data invalid!', 'Error!');
					$("#clubSetting-wrapper .loading").remove();
				});
			}

		}
	}
	}
</script>