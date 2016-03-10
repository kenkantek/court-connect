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
		props:['surface'],
		data() {
			return {
								court : {
										name:null,
										indoor_outdoor:null,
										surface_id:null,
										base_price:null,
									},
							}
		},
		methods: {

		}
	}
</script>