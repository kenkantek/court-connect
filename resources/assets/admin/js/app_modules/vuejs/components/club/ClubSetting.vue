<template>
	<div class="box-body">
		<div id="clubSetting-wrapper" style="position: relative; overflow: hidden">
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
		</div>


		<section class="col-xs-12 col-md-12" id="box-set-open-days">
			<h3 class="title-box">Set Opening Hours/Holiday Days</h3>
			<p>This form allows you to change multiple dates at the same time.
				Start by selecting the day(s) of the week you want to apply the opening times to and then a range of dates for this to be applied.
				The opening times you enter will then be changed for all dates in the date range where the day matches what you've selected. Holiday days and closed days will not count towards contract time bookings</p>

			<div class="clearfix"></div>
			<date-time
				:club-setting-id="clubSettingId"
				>
			</date-time>
			<ul>
				<li>
					<img src="/uploads/images/config/close_icon.png" alt="">
					<span>: Club closed</span>
				</li>
				<li>
					<img src="/uploads/images/config/plane_icon.png" alt="">
					<span>: Vacation but club open</span>
				</li>
				<li>
					<img src="/uploads/images/config/clock_icon.png" alt="">
					<span>: Set operating hours by day</span>
				</li>
			</ul>
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