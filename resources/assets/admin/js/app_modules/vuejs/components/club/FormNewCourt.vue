<template>
	<div class="court_new courtbox">
		<h3 class="title-box">Add New Court</h3>
		<table>
			<tbody><tr>
				<td width="30%"><label for="name">Court Name *</label></td>
				<td><input class="form-control" placeholder="Court name" name="name" type="text" id="name" 
				v-model='court.name'></td>
			</tr>
			<tr>
				<td><label for="last_name">Indoor/Outdoor? *</label></td>
				<td>
					<select class="form-control" name="indoor_outdoor" v-model='court.indoor_outdoor'>
					<option value="1">Indoor</option>
					<option value="2">Outdoor</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="surface_type">Surface Type *</label></td>
				<td>
					<select class="form-control" name="surface" v-model='court.surface_id'>
						<option 
							v-for="val in surface"
						 	:value="val.id">
						 		{{ val.label }}
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="basic_price">Basic Price</label></td>
				<td>
						<select class="form-control" name="price" v-model='court.base_price'>
						</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<slot name="temp"></slot>
					<input class="btn btn-primary pull-right" value="Add Court" @click.prevent="addCourt()">
				</td>			
			</tr>
		</tbody></table>
	</div>
</template>
<script>
	export default {
		props:['surface','courts','clubSettingId','reloadCourts'],
		data() {
			return {
								court : {
										name:null,
										indoor_outdoor:null,
										surface_id:null,
										base_price:null,
										club_id:null,
									},
							}
		},
		methods: {
			addCourt(){
				this.$set('court.club_id', this.clubSettingId);
				const court = this.court;
				this.$http.post(laroute.route('courts.create'), court).then(res => {
          this.reloadCourts =  Math.floor(Math.random() * 10000);
					this.$set('court.name', null);
					this.$set('court.indoor_outdoor', null);
					this.$set('court.surface_id', null);
					this.$set('court.base_price', null);
          showNotice('success', res.data.success_msg, 'Success!');
        }, (res) => {
                showNotice('error', 'Error', 'Error!');
            });
			}
		}
	}
</script>