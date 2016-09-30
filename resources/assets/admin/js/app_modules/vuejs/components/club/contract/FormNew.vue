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
				<input v-model="note" class="form-control" placeholder="Notes can go here." name="notes" type="text" id="notes">
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
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
					{ A1: 0 , A2: 0, A3: 0, A4: 0, A5: 0, A6: 0, A7: 0 },
				],
				extras:[{ name:'Balls', value : 10}],
				submit:false
			}
		},
		watch: {
			startDate: function () {
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
			},
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
					contract.rates_member = this.rates ;
					contract.rates_nonmember = this.rates ;
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