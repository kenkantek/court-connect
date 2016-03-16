<template>
	<div class="court_new courtbox" 
	v-if="courts_choice.length == 1"
	>
		<h3 class="title-box">Edit Court</h3>
		<table>
			<tbody><tr>
				<td width="30%"><label for="name">Court Name *</label></td>
				<td><input class="form-control" placeholder="Court name" name="name" type="text" id="name" 
				:value="courts_choice[0].name"></td>
			</tr>
			<tr>
				<td><label for="last_name">Indoor/Outdoor? *</label></td>
				<td>
					<select class="form-control" name="indoor_outdoor" v-model="courts_choice[0].indoor_outdoor">
					<option value="1">Indoor</option>
					<option value="2">Outdoor</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="surface_type">Surface Type *</label></td>
				<td>
					<select class="form-control" name="surface">
						<option value="indoor">Indoor</option>
						<option value="outdoor">Outdoor</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input class="btn btn-danger" value="Delete Court"></td>
				<td>
					<input class="btn btn-primary" value="Edit Court">

				</td>
			</tr>
		</tbody></table>
	</div>
</template>
<script>
	export default {
		props:['courts_choice','surface','courts','clubSettingId','reloadCourts']		
	}
</script>