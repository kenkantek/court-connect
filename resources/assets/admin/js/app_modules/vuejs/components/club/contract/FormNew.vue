<template>
<div class="courtbox contacttimeperiod">
	<h3 class="title-box">Create Contract Time Period</h3>
		<form class="form-horizontal">
		<div class="form-group" :class=" {'has-error' : (startDate == '' && error == true)}">
			<label for="name" class="col-sm-4 control-label">Start Date *</label>
			<div class="col-sm-8">
				<input v-model="startDate" class="datepicker-contract form-control" placeholder="First Day of the Contract Period" name="startDate" type="text" id="start_date">
			</div>
		</div>
		<div class="form-group" :class=" {'has-error' : (endDate == '' && error == true)}">
			<label for="name" class="col-sm-4 control-label">End Date *</label>
			<div class="col-sm-8">
				<input v-model="endDate" class="datepicker-contract form-control" placeholder="Last Day of the Contract Period" name="endDate" type="text" id="end_date">
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-4 control-label">Total Weeks </label>
			<div class="col-sm-8">
				<span v-text="totalWeek"></span>
			</div>
		</div>
		<div class="form-group" :class=" {'has-error' : (note == '' && error == true)}">
			<label for="name" class="col-sm-4 control-label">Notes *</label>
			<div class="col-sm-8">
				<input v-model="note" class="form-control" placeholder="Some test notes can go here" name="notes" type="text" id="notes">	
			</div>
		</div>
		<div>
			<button class="btn btn-primary pull-right" @click.prevent="addContract()" :disabled="submit">Create Contract Time</button>
		</div>
		</form>
</div>
</template>
<script>
	export default { 
		props: ['clubSettingId','reloadContracts'],
		data() {
			return {
							startDate:"",
							endDate:"",
							totalWeek:"",
							note:"",
							error:false,
							rates :[
												 { _5_1: 1200 , _5_2: 1200, _5_3: 1200, _5_4: 1200, _5_5: 1200, _5_6: 1500, _5_7: 1500 },
												 { _6_1: 1200 , _6_2: 1200, _6_3: 1200, _6_4: 1200, _6_5: 1200, _6_6: 1500, _6_7: 1500 },
												 { _7_1: 1200 , _7_2: 1200, _7_3: 1200, _7_4: 1200, _7_5: 1200, _7_6: 1500, _7_7: 1500 },
												 { _8_1: 1200 , _8_2: 1200, _8_3: 1200, _8_4: 1200, _8_5: 1200, _8_6: 1500, _8_7: 1500 },
												 { _9_1: 1200 , _9_2: 1200, _9_3: 1200, _9_4: 1200, _9_5: 1200, _9_6: 1500, _9_7: 1500 },
												 { _10_1: 1200 , _10_2: 1200, _10_3: 1200, _10_4: 1200, _10_5: 1200, _10_6: 1500, _10_7: 1500 },
												 { _12_1: 1200 , _12_2: 1200, _12_3: 1200, _12_4: 1200, _12_5: 1200, _12_6: 1500, _12_7: 1500 },
												 { _13_1: 1200 , _13_2: 1200, _13_3: 1200, _13_4: 1200, _13_5: 1200, _13_6: 1500, _13_7: 1500 },
												 { _14_1: 1200 , _14_2: 1200, _14_3: 1200, _14_4: 1200, _14_5: 1200, _14_6: 1500, _14_7: 1500 },
												 { _15_1: 1200 , _15_2: 1200, _15_3: 1200, _15_4: 1200, _15_5: 1200, _15_6: 1500, _15_7: 1500 },
												 { _16_1: 1200 , _16_2: 1200, _16_3: 1200, _16_4: 1200, _16_5: 1200, _16_6: 1500, _16_7: 1500 },
												 { _17_1: 1200 , _17_2: 1200, _17_3: 1200, _17_4: 1200, _17_5: 1200, _17_6: 1500, _17_7: 1500 },
												 { _18_1: 1200 , _18_2: 1200, _18_3: 1200, _18_4: 1200, _18_5: 1200, _18_6: 1500, _18_7: 1500 },
												 { _20_1: 1200 , _20_2: 1200, _20_3: 1200, _20_4: 1200, _20_5: 1200, _20_6: 1500, _20_7: 1500 },
												 { _21_1: 1200 , _21_2: 1200, _21_3: 1200, _21_4: 1200, _21_5: 1200, _21_6: 1500, _21_7: 1500 },
												 { _22_1: 1200 , _22_2: 1200, _22_3: 1200, _22_4: 1200, _22_5: 1200, _22_6: 1500, _22_7: 1500 },

											],
							extras:[{'Balls':10}],
							submit:false
						}
			},
			watch: {
				endDate: function () {
						var a = moment(this.startDate, 'MM/DD/YYYY');
						var b = moment(this.endDate, 'MM/DD/YYYY');
					 	var days = b.diff(a, 'days');
					 	this.totalWeek = b.diff(a,'weeks');
					 	if(days < 30) {
					 		this.error = true;
					 		showNotice('error', 'Error', 'End date must be greater than start date 30 days!');
					 	}else{
					 		this.error = false;
					 	}
					}
			},
			ready() {
				 $('.datepicker-contract').daterangepicker({
			        singleDatePicker: true,
			        showDropdowns: true
			    });
				 $('#start_date').daterangepicker({
				 		singleDatePicker: true,
			      showDropdowns: true,
			      startDate: moment({month: '8'}).endOf('month').format('MM/DD/YYYY'),
				 });
				 $('#end_date').daterangepicker({
				 		singleDatePicker: true,
			      showDropdowns: true,
			      startDate: moment({month: '4'}).add(1, 'year').endOf('month').format('MM/DD/YYYY'),
			      minDate: moment(this.startDate, 'MM/DD/YYYY').add(1, 'months'),
				 });
			},
			methods: {
				addContract(){
					this.submit = true;
					var valid = this.validform();
					if (valid) {
						var contract = {};
						contract.start_date = this.startDate ;
						contract.end_date = this.endDate ;
						contract.total_week = this.totalWeek ;
						contract.note = this.note ;
						contract.club_id = this.clubSettingId ;
						contract.rates = this.rates ;
						contract.extras = this.extras ;
						this.$http.post(laroute.route('contracts.create'),contract).then(res => {
							this.note = '';
							showNotice('success','Create contract success! ','Success!');
							this.reloadContracts =  Math.floor(Math.random() * 10000);
						},(res)=> {
							showNotice('error','Please Enter Note ','Error!');
						})
					}
					this.submit = false;
				},
				validform(){
					if (this.startDate == "" ||	this.endDate == "" ||	this.totalWeek == "" ||	this.note == "" ||	this.endDate == "") {
						this.error = true;
						return false;
					}else{
						this.error = false;
						return true;
					}
				}
				
			},
	}
</script>