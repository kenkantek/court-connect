<template>
<div class="courtbox contacttimeperiod">
	<h3 class="title-box">Edit Contract Time Period</h3>
	<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" enctype="multipart/form-data">
	<table>
		<tbody><tr>
			<td width="30%"><label for="start_date">Start Date *</label></td>
			<td><input class="form-control" placeholder="First Day of the Contract Period" name="start_date" type="text" id="start_date"></td>
		</tr>
		<tr>
			<td width="30%"><label for="end_date">End Date *</label></td>
			<td><input class="form-control" placeholder="Last Day of the Contract Period" name="end_date" type="text" id="end_date"></td>
		</tr>
		<tr>
			<td width="30%"><label for="total_week">Total Weeks *</label></td>
			<td>34</td>
		</tr>
		<tr>
			<td width="30%"><label for="notes">Notes *</label></td>
			<td><input class="form-control" placeholder="Some test notes can go here" name="notes" type="text" id="notes"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input class="btn btn-primary pull-right" type="submit" value="Create Contract Time">
			</td>
		</tr>
	</tbody></table>
</form>
</div>
</template>
<script>
	
</script>