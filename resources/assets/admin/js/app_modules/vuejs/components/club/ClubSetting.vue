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

		<section class="col-xs-12 col-md-7">
			<div class="courtbox contacttime">
				<h3 class="title-box pull-left">Contract Time</h3>
				<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Create Contract Time Period</a>
				<div class="clearfix"></div>
				<div class="clearfix">
					Creating a contract time period will allow a user to book a regular time slot each week.
					When creating a contract time period, each day of the week can be set to a  different price.
				</div>
				<table class="table table-bordered table-hover table-th" id="datatables" style="margin-top: 10px">
					<thead>
					<tr>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Total Weeks</th>
						<th>Notes</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Monday 1st Sep 2016</td>
						<td>Sunday 31st May 2017</td>
						<td>36</td>
						<td>Use for booking courts 1-5 indoors</td>
					</tr>
					<tr>
						<td>Monday 1st Sep 2016</td>
						<td>Sunday 31st May 2017</td>
						<td>36</td>
						<td>Use for booking courts 1-5 indoors</td>
					</tr>
					<tr>
						<td>Monday 1st Sep 2016</td>
						<td>Sunday 31st May 2017</td>
						<td>36</td>
						<td>Use for booking courts 1-5 indoors</td>
					</tr>
					<tr>
						<td>Monday 1st Sep 2016</td>
						<td>Sunday 31st May 2017</td>
						<td>36</td>
						<td>Use for booking courts 1-5 indoors</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="courtbox contacttimerate">
				<h3 class="title-box">Contract Time Rates</h3>
				<div class="clearfix">
					Note: Before setting rates, ensure that all holiday and closed days are entered into the calendar to ensure that the total days figure is calculated correctly
				</div>

				<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" class="form-court" id="form_search_contract_rate" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
					<div class="pull-left">
						<strong>Enter Price</strong>
						<input class="price_contract_rate form-control" placeholder="Enter Price" name="price_contract_rate" type="text">
						<span>Select hours from grid and press apply to adjust hours</span>
					</div>
					<div class="pull-right">
						<input class="btn btn-primary" type="submit" value="Apply">
					</div>
				</form>

				<div class="clearfix"></div>
				<table class="table table-bordered table-hover table-th clearfix" style="margin-top: 20px">
					<thead>
					<tr>
						<th style="text-align: right">
							Starting Date <br>
							Day of the Week <br>
							Total Days w/ Holidays
						</th>
						<th>Mon</th>
						<th>Tue</th>
						<th>Web</th>
						<th>Thur</th>
						<th>Fri</th>
						<th>Sat</th>
						<th>Sun</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td class="td_field_label">5am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">6am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">7am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">8am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">9am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">10am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">11am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">12am</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">1pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">2pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">3pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">4pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">5pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">6pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">7pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">8pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">9pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					<tr>
						<td class="td_field_label">10pm</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
						<td>$20</td>
					</tr>
					</tbody>
				</table>
			</div>

			<div class="courtbox extras">
				<div class="col-xs-12 col-md-6">
					<h3 class="title-box pull-left">Extras</h3>
					<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Add Extra</a>
					<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" id="form_add_extra" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
						<table class="table table-bordered table-hover table-th" id="datatables">
							<thead>
							<tr>
								<th>Extra Name</th>
								<th>Cost</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Balls</td>
								<td>$10</td>
							</tr>
							<tr>
								<td><input class="extra_name form-control" name="extra_name" type="text"></td>
								<td><input class="extra_cost form-control" name="extra_cost" type="text"></td>
							</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="col-xs-12 col-md-6">
					<h3 class="title-box">Allow Members Prices ? </h3>
					<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" id="form_allow_member_price" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">

						<input name="allow_member_price" type="radio" value="1">
						<label for=" ">Yes</label>

						<input name="allow_member_price" type="radio" value="0">
						<label for=" ">No</label>
					</form>
				</div>
			</div>
		</section>

		<section class="col-xs-12 col-md-5">
			<div class="courtbox contacttimeperiod">
				<h3 class="title-box">Create Contract Time Period</h3>
				<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
					<table>
						<tbody><tr>
							<td width="30%"><label for="start_date">Start Date *</label></td>
							<td><input class="form-control" placeholder="First Day of the Contract Period" name="start_date" type="text" id="start_date"></td>
						</tr>
						<tr>
							<td width="30%"><label for="end_date">End Date *</label></td>
							<td><input class="form-control" placeholder="Last Day of the Contract Period" name="end_date" type="text" id="end_date"></td>
						</tr>
						<tr>
							<td width="30%"><label for="total_week">Total Weeks *</label></td>
							<td>34</td>
						</tr>
						<tr>
							<td width="30%"><label for="notes">Notes *</label></td>
							<td><input class="form-control" placeholder="Some test notes can go here" name="notes" type="text" id="notes"></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input class="btn btn-primary pull-right" type="submit" value="Create Contract Time">
							</td>
						</tr>
						</tbody></table>
				</form>
			</div>
		</section>
	</div>
</template>
<script>
	import ListCourt from './ListCourt.vue';
	import FormEditCourt from './FormEditCourt.vue';
	import FormNewCourt from './FormNewCourt.vue';
	import CourtRate from './CourtRate.vue';
	import DateTime from './DateTime.vue';
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
	}
	}
</script>