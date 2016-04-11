<template>
	<div class="box-body">
		<section class="col-xs-12 col-md-5">
			<div class="court_list courtbox">
				<h3 class="title-box pull-left">Courts</h3>
				<a class="btn btn-primary pull-right btn-new-court" href="" @click.prevent="scrollAddnewCourt()"><i class="fa fa-plus-circle"></i> Add New Court</a>
				<list-court
					:club-setting-id="clubSettingId"
					:courts_choice.sync="courts_choice"
					:courts.sync="courts"
					:reload-courts.sync="reloadCourts"
					></list-court>
			</div>
			<form-edit-court
				v-if="courts_choice.length < 2"
				:courts_choice="courts_choice"
				:surface="surface"
				:courts.sync="courts"
				:club-setting-id="clubSettingId"
				:reload-courts.sync="reloadCourts"
				:data-rates.sync="dataRates"
				></form-edit-court>
			<form-new-court
				v-if="!courts_choice.length"
				:surface="surface"
				:courts.sync="courts"
				:club-setting-id="clubSettingId"
				:reload-courts.sync="reloadCourts"
				:data-rates.sync="dataRates"
				>
				<span slot="temp">When creating a new court you can set the initial prices to match a previously created court. Select the court you'd like to copy the prices from.
						</span>			
			</form-new-court>

		</section>

		<section class="col-xs-12 col-md-7">
			<court-rate :club-setting-id.sync="clubSettingId" :data-rates.sync="dataRates" :courts_choice.sync="courts_choice"></court-rate>
			

		</section>

		<section class="col-xs-12 col-md-12">
			<h3 class="title-box">Set Opening Hours/Holiday Days</h3>
			<p>This form allows you to change multiple dates at the same time.
				Start by selecting the day(s) of the week you want to apply the opening times to and then a range of dates for this to be applied.
				The opening times you enter will then be changed for all dates in the date range where the day matches what you've selected. Holiday days and closed days will not count towards contract time bookings</p>

			<div class="clearfix"></div>
			<div class="">
				<form method="POST" action="" accept-charset="UTF-8" id="form_set_openday" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
					<div class="pull-left form-box">
						<label for="date">Select day(s) of the week</label>
						<br>
						<select class="form-control" name="date_open" id="date_open" v-model="dataOpenHour.daysOfWeek" multiple="multiple" style="display: none;">
							<option value="mon">Monday</option>
							<option value="tue">Tuesday</option>
							<option value="wed">Wednesday</option>
							<option value="thur">Thursday</option>
							<option value="fri">Friday</option>
							<option value="sat">Saturday</option>
							<option value="sun">Sunday</option>
						</select>
					</div>
					<div class="pull-left form-box">
						<label for="daterange_open">Date range</label>
						<input class="daterange form-control" name="daterange_open" type="text" id="daterange_open">
					</div>
					<div class="pull-left form-box">
						<label for="opentime">Open Time</label>
						<input id="opentime" class="timepicker opentime form-control" placeholder=""  name="opentime" type="text">
					</div>
					<div class="pull-left form-box">
						<label for="closetime">Closing Time</label>
						<input class="timepicker closetime form-control" placeholder="" name="closetime" type="text" id="closetime">
					</div>
					<div class="pull-left">
						<br>
						<input class="btn btn-primary" style="margin-top: 6px;" type="submit" value="Apply" @click.prevent="addOpenHours()">
					</div>
				</form>
			</div>

			<date-time
				:club-setting-id="clubSettingId"
				:reload-courts.sync="reloadDays"
				:data-rates.sync="dataDays"
				>
			</date-time>
		</section>

		<contract-time
			:club-setting-id="clubSettingId"
		>
		<div class="clearfix" slot="headercontract">
					<h3 class="title-box pull-left">Contract Time</h3>
					<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Create Contract Time Period</a>
				</div>
		</contract-time>
	</div>
</template>
<script>
	import ListCourt from './ListCourt.vue';
	import FormEditCourt from './FormEditCourt.vue';
	import FormNewCourt from './FormNewCourt.vue';
	import CourtRate from './CourtRate.vue';
	import DateTime from './DateTime.vue';
	import ContractTime from './contract/ContractTime.vue';
	let _ = require('lodash'),
		deferred = require('deferred');
	export default {
		props:['clubSettingId'],
		data(){
		return {
			dataRates:[],
			courts_choice:[],
			surface:null,
			courts:[],
			reloadCourts:1,
			dataOpenHour: [],
		}
	},
	watch: {
		courts_choice : function () {
			if(this.courts_choice.length > 0) {
				//this.dataRates = _.cloneDeep(this.courts_choice[0].rates);
				this.dataRates = [];
				for (var index in this.courts_choice) {    // don't actually do this

					for (var i in this.courts_choice[index].rates) {
						const temp = _.cloneDeep(this.courts_choice[index].rates[i]);
						this.dataRates.push(temp);
					}

				}
			}else{
				this.dataRates = [];
			}
		}
	},
	asyncData(resolve, reject) {
		this.fetchSurface(this.surface).done((surface) => {
			resolve({surface});
	}, (error) => {
		console.log(error);
	});

	},
	methods:{
		scrollAddnewCourt(){
			$('html, body').animate({ scrollTop: $('#btnAddnewCourt').position().top }, 500);
		},
		fetchSurface(surface) {
			let def = deferred(),
				url =laroute.route('surface.list');
			this.$http.get(url).then(res => {
				def.resolve(res.data);
			}, res => {
				def.reject(res);
			});
			return def.promise;
		},
		addOpenHours(){
			const d = {};
			d.days = $("#form_set_openday select[name=date_open]").val();
		    d.hours = $("#form_set_openday input[name=opentime]").val() + " - " + $("#form_set_openday input[name=closetime]").val();
			d.end_date =  $("#daterange_open").data('daterangepicker').endDate.format('YYYY/MM/DD');
			d.start_date =  $("#daterange_open").data('daterangepicker').startDate.format('YYYY/MM/DD');
			d.club_id = this.clubSettingId;
			console.log(d);
			this.$http.post(laroute.route('clubs.courts.setOpenDay'), d).then(res => {
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
					showNotice('success', res.data.success_msg, 'Success!');
				}
				this.submit = false;
			}, (res) => {
				console.log(res);
				showNotice('error', "Error. Try again!", 'Error!');
			});
			},
	},
	components: {
		  ListCourt,
			FormEditCourt,
			FormNewCourt,
			CourtRate,
			DateTime,
			ContractTime,
	  }
	}
</script>