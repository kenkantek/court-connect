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
		<tr class="item_contract" v-for="contract in contracts">
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
		props:['clubSettingId','contracts','reloadContracts'],
		data() {
			return {
				reloadContracts:null,
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
    ready() {
    	$( "table" ).on('click', 'tr.item_contract', function(event) {
    		event.preventDefault();
    		$('#list_contract').find('tr').removeClass('bg-primary');
    		$(this).toggleClass('bg-primary');
    	});
    },
 		methods: {
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
