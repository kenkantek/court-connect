<template>
	<table class="table table-bordered table-hover table-th" id="datatables">
		<thead>
		<tr>
			<th v-for="column in gridColumns" @click="sortBy(column.key)" :class="{active: sortKey == column.key}">{{column.value}}
				<span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'desc'"></span>
			</th>
		</tr>
		</thead>
		<tbody>
			<tr v-for="booking in data.data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]">
				<td>{{ booking.id }}</td>
				<td>
					{{ booking.date }}
					<div>
						at {{ booking.hour }}
						for {{ booking.hour_length }}Hour
					</div>
				</td>
				<td></td>
				<td>{{ booking.source }}</td>
				<td>{{ booking.billing_info.first_name + " " + booking.billing_info.last_name }}</td>
				<td>{{ booking.type }}</td>
				<td>{{ booking.created_at }}</td>
				<td>${{ booking.total_price }}</td>
			</tr>
		</tbody>
	</table>
</template>


<script>
	 var _ = require('lodash'),
     deferred = require('deferred');
	export default {
		props:['clubSettingId'],
		watch: {
			clubSettingId: 'reloadAsyncData',
		},
		data:function(){
		 	var columns = [
				{key:"id", value:"Txn Id"},
				{key:"date",value:"Txn Date/Time"},
				{key:"debit",value:"Debit/Credit"},
				{key:"source",value:"Source"},
				{key:"book_by",value:"Booke By"},
				{key:"type",value:"Type"},
				{key:"created_at",value:"Date booked"},
				{key:"total_price",value:"Amount"}
			];
			 var sortOrders = [];
			$.each(columns,function(k,v){
				console.log(v);
				console.log(k);
				sortOrders[v.key] = 1
			});
//			columns.forEach(function (k, v) {
//				console.log(v);
//				console.log(k);
//			})

			 return {
				 data: {
					 per_page: "10",
				 },
				 gridColumns: columns ,
				 sortKey: '',
				 sortOrders: sortOrders,
				 api:laroute.route('reports.listdata'),
			 }
	 	},
		 asyncData(resolve, reject) {
			 this.fetchBookings(this.api).done((data) => {
				 resolve({data});
			 }, (error) => {
				 console.log(error);
			 });
		 },
		methods: {
			fetchBookings(api, clubid = this.clubSettingId, take = this.data.per_page) {
				let def = deferred();
				this.$http.get(api ,{ clubid, take}).then(res => {
					const { data } = res;
					def.resolve(data);
				}, res => {
					def.reject(res);
				});
				return def.promise;
			},
			 sortBy(key){
		 		 console.log(key);
				 this.sortKey = key;
				 this.sortOrders[key] = this.sortOrders[key] * -1
			 }
		},
	 	ready(){

			//$('table').bootstrapTable({locale:'en-US'});
		}
	}
</script>