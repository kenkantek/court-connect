<template>
	<table class="table table-bordered table-hover table-th" id="datatables">
		<thead>
		<tr>
			<th></th>
			<th>Club Name</th>
			<th>Address</th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="(index,club) in clubs"  >
			<td><input type="checkbox" class="club-item-check" name="club-item-check" value="{{index}}" @click="addClubs(index)" ></td>
			<td>{{ club.name }}</td>
			<td>{{ club.address }}</td>
		</tr>
		
		</tbody>
	</table>
</template>
<script>
	 var _ = require('lodash'),
     deferred = require('deferred');
	export default {
		props:['clubs_choice','clubs','delete_club'],
			
		// asyncData(resolve, reject) {
  //        this.fetchclubs(0,40).done((clubs) => {
  //            resolve({clubs});
  //        }, (error) => {
  //            console.log(error);
  //        });

  //   },
		methods: {
				// fetchclubs(skip,limit) {
    //             let def = deferred(),
    //             url = laroute.route('super.clubs.list', {one : skip, two : limit});
    //             this.$http.get(url).then(res => {
    //             	def.resolve(res.data);
    //             }, res => {
    //             	def.reject(res);
    //             });
    //              return def.promise;
    //         },
        addClubs(index){
        	
        	var check = $('.club-item-check:eq('+index+')');
        	if(check.prop('checked')){
        		this.clubs_choice = this.clubs[index];
        		$('.club-item-check').prop('checked', false);
        		check.prop('checked', true);
        	}else{
        		this.clubs_choice = null;
        		check.prop('checked', false);
        	}
        }
		}
	}
</script>