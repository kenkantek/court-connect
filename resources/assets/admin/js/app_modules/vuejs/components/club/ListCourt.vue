<template>
	
	<table class="table table-bordered table-hover table-th" id="datatables">
		<thead>
		<tr>
			<th></th>
			<th>Court Name</th>
			<th>Indoor/Outdoor</th>
			<th>Surface</th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="(index,court) in data.data"  @click="addCourts(index)">
			<td><input type="checkbox" class="court-item-check" name="court-item-check" value="{{index}}" @click="addCourts(index)"></td>
			<td>{{ court.name }}</td>
			<td v-if="court.indoor_outdoor == 1">Indoor</td>
			<td v-else>Outdoor</td>
			<td>{{ court.surface.label }}</td>
		</tr>
		</tbody>
	</table>
	<filter
	 :data.sync="data"
	></filter>
</template>
<style scoped>
	tr.selected {
		background-color: #0f494d;
		color: #fff;
	}
	tr.selected:hover {
		background-color: #0f494d;
		color: #fff;
	}
</style>
<script>
	import Filter from '../globals/Filter.vue';
	var _ = require('lodash'),
		deferred = require('deferred');
	export default {
		props:['clubSettingId','courts_choice','courts','reloadCourts'],
		data(){
			return {
        data: {
                per_page: "10",
                },
        api:laroute.route('clubs.courts.list'),
			}
		},
		watch: {
			clubSettingId: 'reloadAsyncData',
			reloadCourts:'reloadAsyncData',
		},
	asyncData(resolve, reject) {
		this.fetchCourts(this.api).done((data) => {
			resolve({data});
		}, (error) => {
			console.log(error);
		});

	},
	methods: {
		fetchCourts(api, clubid = this.clubSettingId, take = this.data.per_page) {
			let def = deferred();
			this.$http.get(api ,{ clubid, take}).then(res => {
				const { data } = res;
        def.resolve(data);
			}, res => {
				def.reject(res);
			});
			return def.promise;
		},
		addCourts(index){
				this.courts_choice = [];
				var indexTable = index + 1 ;
				if($('.court-item-check:eq('+index+')').prop('checked')){
					$('tr:nth-child('+indexTable+')').removeClass('selected');
					$('.court-item-check:eq('+index+')').prop('checked',false);
				}else{
					$('tr:nth-child('+indexTable+')').addClass('selected');
					$('.court-item-check:eq('+index+')').prop('checked',true);
				}
				$('.court-item-check:checked').each(function(index, el) {
					this.courts_choice.push(this.data.data[$(el).val()]);
				}.bind(this));
			}
		}, 
		events: {
            'go-to-page'(api) {
            		console.log(api);
                this.api = api;
                this.reloadAsyncData();
            }
    	},

        components: { Filter }
	}
</script>