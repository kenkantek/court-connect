<template>
	<table class="table table-bordered table-hover table-th" id="list_contract" style="margin-top: 10px">
		<thead>
		<tr>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Total Weeks</th>
			<th>Notes</th>
		</tr>
		</thead>
		<tbody>
		<tr class="item_contract" v-for="(index,contract) in contracts" @click="selectContract(index,contract)">
			<td>{{ contract.start_date }}</td>
			<td>{{ contract.end_date }}</td>
			<td>{{ contract.total_week }}</td>
			<td>{{ contract.note }}</td>
		</tr>
		</tbody>
	</table>
</template>
<script>
	let _ = require('lodash'),
			deferred = require('deferred');
	export default {
		props:['clubSettingId','contracts','reloadContracts','contractSelect'],
		data() {
			return {
				contractSelectId:0,
			}
		},
		watch: {
			clubSettingId: 'reloadAsyncData',
			reloadContracts:'reloadAsyncData',
		},
		asyncData(resolve, reject) {
			this.fetchContracts().done((contracts) => {
				resolve({contracts});
		}, (error) => {
				console.log(error);
			});
		},
		methods: {
			selectContract(index,contract){
				var index = index + 1;
				if(this.contractSelect == null){
					$('#list_contract').find('tr:eq('+index+')').addClass('bg-primary');
					this.contractSelect = contract;
					this.contractSelectId = this.contractSelect.id
				}else{
					this.contractSelect = contract;
					if (this.contractSelectId == this.contractSelect.id) {
						this.contractSelectId = 0;
						this.contractSelect = null;
						$('#list_contract').find('tr:eq('+index+')').removeClass('bg-primary');
					}else{
						$('#list_contract').find('tr').removeClass('bg-primary');
						$('#list_contract').find('tr:eq('+index+')').addClass('bg-primary');
						this.contractSelectId = this.contractSelect.id
					}
				}
			},
			fetchContracts() {
				let def = deferred(),
						url = laroute.route('contracts.list', {one:this.clubSettingId});
				this.$http.get(url).then(res => {
					def.resolve(res.data.data);
			}, res => {
					def.reject(res);
				});
				return def.promise;
			},
		}
	}
</script>
