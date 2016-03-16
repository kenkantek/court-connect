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
		<tr v-for="(index,court) in courts"  >
			<td><input type="checkbox" class="court-item-check" name="court-item-check" value="{{index}}" @click="addCourts(index)"></td>
			<td>{{ court.name }}</td>
			<td v-if="court.indoor_outdoor == 1">Indoor</td>
			<td v-else>Outdoor</td>
			<td>{{ court.surface.label }}</td>
		</tr>
		
		</tbody>
	</table>
</template>
<script>
	 var _ = require('lodash'),
     deferred = require('deferred');
	export default {
		props:['clubSettingId','courts_choice','courts','reloadCourts'],
		watch: {
	    clubSettingId: 'reloadAsyncData',
	    reloadCourts:'reloadAsyncData',	    
	  },
		asyncData(resolve, reject) {
         this.fetchCourts().done((courts) => {
             resolve({courts});
         }, (error) => {
             console.log(error);
         });

    },
		methods: {
				 fetchCourts() {
                let def = deferred(),
                url = laroute.route('clubs.courts.list', {one:this.clubSettingId});
                this.$http.get(url).then(res => {
                	def.resolve(res.data);
                }, res => {
                	def.reject(res);
                });
                 return def.promise;
            },
        addCourts(index){
        	this.courts_choice = [];
          $('.court-item-check:checked').each(function(index, el) {
          		this.courts_choice.push(this.courts[$(el).val()]);      	         	
          }.bind(this));
        }
		}
	}
</script>