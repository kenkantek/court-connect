<template>
	<div class="cc-wrapper-report">
		<div class="box-body">
			<hr class="clearfix">
			<h5 class="clearfix">To generate financial reports you can download to Excel, please enter the time period below.</h5>

			<br>
			<div class="form-group col-md-3">
				<div class="input-group col-md-10">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" class="form-control pull-right" v-model="filter_data.date_range" id="reservation">
				</div>
				<!-- /.input group -->
			</div>
			<!-- /.form group -->

			<div class="form-group col-md-2">
				<div class="input-group">
					<input type="submit" @click="onSubmit()" value="Search" class="form-control pull-right btn btn-block btn-info btn-flat">
				</div>
				<!-- /.input group -->
			</div>
			<!-- /.form group -->

			<!-- checkbox -->
			<div class="form-group col-md-3">
				<label>
					<input type="checkbox" class="minimal" id="input-only-cc" v-model="filter_data.only_cc" v-on:change="changeOnlyCC">
					Show Court-Connect Bookings Only?
				</label>
			</div>

			<div class="form-group col-md-2 pull-right">
				<button type="button" @click.prevent="downloadData()" id="cc-btn-download-file" class="btn btn-block btn-primary btn-lg">
					<i class="fa fa-circle-o-notch fa-spin hidden" style="text-align: left; float: left; line-height: 25px; margin-right: 20px"></i>
					Download as .csv
				</button>
			</div>

		</div>

		<table class="table table-bordered table-hover table-th" id="datatables">
			<thead>
				<tr>
					<th v-for="column in gridColumns" @click="sortBy(column.key)" :class="{active: sortKey == column.key}">{{column.value}}
						<span class="arrow" :class="sortOrders[column.key] > 0 ? 'asc' : 'desc'"></span>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="booking in data.data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]">
					<td>{{ booking.id }}</td>
					<td>
						{{ booking.type == "contract" ? (dateOfWeek[booking.day_of_week]+ ", " + booking.date_range_of_contract.from + " - " + booking.date_range_of_contract.to): booking.date }}
						<div>
							at {{ booking.hour }}
							for {{ booking.hour_length }}Hour
						</div>
					</td>
					<td>{{ booking.cart_type == null || booking.cart_type == '' ? "Debit / Cash" : "Credit / " + booking.cart_type}}</td>
					<td>{{ booking.source == 1 ? "Court Connect" : (booking.source == 2 ? "Club" : "Other") }}</td>
					<td>{{ booking.booked_by.fullname }}</td>
					<td>{{ booking.billing_info.first_name + " " + booking.billing_info.last_name }}</td>
					<td>{{ booking.type }}</td>
					<td>{{ booking.created_at }}</td>
					<td>${{ booking.total_price_order }}</td>
				</tr>
			<tr>
				<th style="background: #333; color: #fff; padding: 15px 10px;" colspan="8">Total</th>
				<th style="background: #333; color: #fff; padding: 15px 10px;">${{parseFloat(total_balance)}}</th>
			</tr>
			</tbody>
		</table>
		<div class="pull-left col-md-8">
			<filter
					:data.sync="data"
			></filter>
		</div>
	</div>
</template>

<script>
	import Filter from '../globals/Filter.vue';
	var _ = require('lodash'),
			deferred = require('deferred');
	export default {
		props:['clubSettingId'],
		watch: {
			clubSettingId: 'reloadAsyncData',
			filter_data: 'onSubmit'
		},
		data:function(){
			var columns = [
				{key:"id", value:"Txn Id"},
				{key:"date",value:"Txn Date/Time"},
				{key:"debit",value:"Tender"},
				{key:"source",value:"Source"},
				{key:"booked_by",value:"Booked By"},
				{key:"customer",value:"Customer Name"},
				{key:"type",value:"Type"},
				{key:"created_at",value:"Day Trading"},
				{key:"total_price",value:"Gross"}
			];
			var sortOrders = {};
			$.each(columns,function(k,v){
				sortOrders[v.key] = 1
			});
			return {
				data: {
					per_page: "10",
				},
				dateOfWeek: ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
				idown: null,
				filter_data:{
					date_range: null,
					only_cc: 0
				},
				total_balance: 0,
				gridColumns: columns ,
				sortKey: '',
				sortOrders: sortOrders,
				api:laroute.route('reports.listdata'),
			}
		},
		asyncData(resolve, reject) {
		this.fetchBookings().done((data) => {
			resolve({data});
	}, (error) => {
		console.log(error);
	});
	},
	methods: {
		changeOnlyCC(){
			if($('#input-only-cc').is(":checked"))
					this.filter_data.only_cc = 1;
			else this.filter_data.only_cc = 0;
			this.onSubmit();
		},
		fetchBookings(){
			let def = deferred();
			this.$http.get(this.api ,{ clubid: this.clubSettingId, take: this.data.per_page}).then(res => {
				const { data } = res;
				def.resolve(data);
				var _this = this;
				_this.total_balance = 0;
				$.each(this.data.data,function(k,v){
					_this.total_balance += v.total_price;
				});

			}, res => {
				def.reject(res);
			});
			return def.promise;
		},
		sortBy(key){
			this.sortKey = key;
			this.sortOrders[key] = this.sortOrders[key] * -1
		},
		onSubmit(){
			if($('#input-only-cc').is(":checked"))
				this.filter_data.only_cc = 1;
			else this.filter_data.only_cc = 0;

			var end_date =  $("#reservation").data('daterangepicker').endDate.format('YYYY/MM/DD');
			var start_date =  $("#reservation").data('daterangepicker').startDate.format('YYYY/MM/DD');
			let def = deferred();
			this.$http.get(this.api ,{start_date: start_date, end_date: end_date,source: this.filter_data.only_cc, clubid: this.clubSettingId, take: this.data.per_page}).then(res => {
				this.data = res.data;
				var _this = this;
				_this.total_balance = 0;
				$.each(this.data.data,function(k,v){
					_this.total_balance += v.total_price;
				});

			}, res => {

			});
		},
		downloadData(){
			if($('#input-only-cc').is(":checked"))
				this.filter_data.only_cc = 1;
			else this.filter_data.only_cc = 0;

			var end_date =  $("#reservation").data('daterangepicker').endDate.format('YYYY/MM/DD');
			var start_date =  $("#reservation").data('daterangepicker').startDate.format('YYYY/MM/DD');
			let def = deferred();
			$("#cc-btn-download-file i").toggleClass('hidden');
			this.$http.get(laroute.route('reports.download'),{start_date: start_date, end_date: end_date,source: this.filter_data.only_cc, clubid: this.clubSettingId, take: this.data.per_page}).then(res => {
				if(!res.data.error)
					this.downloadURL(res.data.url)
				$("#cc-btn-download-file i").toggleClass('hidden');
			}, res => {

			});
		},
		downloadURL(url){
			if (this.idown) {
				this.idown.attr('src',url);
			} else {
				this.idown = $('<iframe>', { id:'idown', src:url }).hide().appendTo('body');
			}
		}
	},
	events: {
		'go-to-page'(api) {
			console.log(api);
			this.api = api;
			this.reloadAsyncData();
		}
	},

	components: { Filter },
	ready(){
		$('#reservation').daterangepicker({
			startDate: moment().subtract('days', 29),
		});
		//$('table').bootstrapTable({locale:'en-US'});
	}
	}
</script>