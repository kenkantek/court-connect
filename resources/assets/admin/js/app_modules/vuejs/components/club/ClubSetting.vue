<template>
	<div class="box-body">
		<div id="clubSetting-wrapper" style="position: relative; overflow: hidden">
			<section class="col-xs-12 col-md-5">
				<div class="court_list courtbox clearfix">
					<h3 class="title-box pull-left">Courts</h3>
				</div>

				<list-court
					:club-setting-id="clubSettingId"
					:courts_choice.sync="courts_choice"
					:courts.sync="courts"
					:reload-courts.sync="reloadCourts"
					:index-data-rates.sync = "indexDataRates"
				></list-court>
			<div>
				<a class="btn btn-primary btn-new-court" href="" @click.prevent="scrollAddnewCourt()"><i class="fa fa-plus-circle"></i> Add New Court</a>
				<form-edit-court
					v-if="courts_choice.length < 2"
					:courts_choice="courts_choice"
					:surface="surface"
					:courts.sync="courts"
					:club-setting-id="clubSettingId"
					:reload-courts.sync="reloadCourts"
					:data-rates.sync="dataRates",
					:delete_court.sync = "delete_court",
					:default-price.sync = "defaultPrice"
					></form-edit-court>
				<form-new-court
					v-if="!courts_choice.length && btnAddCourt"
					:surface="surface"
					:courts.sync="courts"
					:club-setting-id="clubSettingId"
					:reload-courts.sync="reloadCourts"
					:data-rates.sync="dataRates"
					:btn-add-court.sync = "btnAddCourt"
					:index-data-rates.sync = "indexDataRates"
					:default-price.sync = "defaultPrice"
					>
						<span slot="temp">When creating a new court you can set the initial prices to match a previously created court. Select the court you'd like to copy the prices from.
						</span>
				</form-new-court>
				</div>
			</section>
			<section class="col-xs-12 col-md-7">
				<court-rate 
				:club-setting-id.sync="clubSettingId" 
				:data-rates.sync="dataRates" 
				:courts_choice.sync="courts_choice"
				:btn-add-court.sync = "btnAddCourt"
				:index-data-rates.sync = "indexDataRates"
				:reload-courts.sync = "reloadCourts"
				:default-price.sync = "defaultPrice"
				></court-rate>
				
			</section>
		</div>


		<section class="col-xs-12 col-md-12" id="box-set-open-days">
			<h3 class="title-box">Set Club Hours/Holidays</h3>
			<p>This allows you to change multiple dates at the same time.
				Start by entering a date range and the days of the week you want to apply the opening times.
				The opening times you enter will then be charged for all dates in the date range where the day matches what you have selected.
				Holidays and days when the club is closed do not count toward contract times.
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
					<span>: Holiday but club open</span>
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
			<!--<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Create Contract Time Period</a>-->
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
		props:['clubSettingId','delete_court'],
		data(){
		return {
			dataRates:[],
			courts_choice:[],
			surface:null,
			courts:[],
			reloadCourts:1,
			btnAddCourt:false,
			indexDataRates: null,
			defaultPrice: 20
		}
	},
	watch: {
		courts_choice : function () {
			if(this.courts_choice.length > 0) {
				//this.dataRates = _.cloneDeep(this.courts_choice[0].rates);
				this.dataRates = [];
				for (var index in this.courts_choice) {    // don't actually do this
					for (var i in this.courts_choice[index].rates) {
						const datarate = _.cloneDeep(this.courts_choice[index].rates[i]);
						const nameCourt = _.cloneDeep(this.courts_choice[index].name);
						this.dataRates.push({datarate,nameCourt});
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
			this.btnAddCourt = !this.btnAddCourt;
			this.courts_choice = [];
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