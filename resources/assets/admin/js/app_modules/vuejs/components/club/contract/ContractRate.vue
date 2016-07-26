<template>
<div class="courtbox contract_rate">
	<div>
	<h3 class="title-box">Contract Time Rates</h3>
	<div class="clearfix">
		Note: Before setting rates, ensure that all holiday and closed days are entered into the calendar to ensure that the total days figure is calculated correctly
	</div>
	<form>

			<strong>Enter Price</strong>
			<div class="no-padding col-md-12">
				<div class="no-padding col-md-4"><input class="price_contract_rate form-control" placeholder="Enter Price" name="price_contract_rate" type="text"></div>
				<div class="col-md-4"><button class="btn btn-primary">Set Price</button></div>			
				<div class="col-md-4 text-right"><button class="btn btn-primary">Apply</button></div>	
			</div>
			<p>Select hours from grid and press apply to adjust hours</p>
	</form>
	<div class="clearfix"></div>
	<table id="table-contract-rate" class="table table-bordered table-hover table-th clearfix ui-selectable" style="margin-top: 20px">
		<thead>
			<tr>
				<th style="text-align: right">
					Starting Date <br>
					Day of the Week <br>
					Total Days w/ Holidays
				</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Web</th>
				<th>Thur</th>
				<th>Fri</th>
				<th>Sat</th>
				<th>Sun</th>
			</tr>
		</thead>
		<tbody >
		<tr >
			<td class="td_field_label" > 12 pm</td>
			<td class="price_hours ui-selectee"  data-x="0" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="0" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="0" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="0" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="0" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="0" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="0" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 1 am</td>
			<td class="price_hours ui-selectee"  data-x="1" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="1" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="1" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="1" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="1" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="1" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="1" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 2 am</td>
			<td class="price_hours ui-selectee"  data-x="2" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="2" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="2" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="2" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="2" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="2" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="2" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 3 am</td>
			<td class="price_hours ui-selectee"  data-x="3" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="3" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="3" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="3" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="3" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="3" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="3" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 4 am</td>
			<td class="price_hours ui-selectee"  data-x="4" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="4" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="4" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="4" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="4" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="4" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="4" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 5 am</td>
			<td class="price_hours ui-selectee"  data-x="5" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="5" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="5" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="5" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="5" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="5" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="5" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 6 am</td>
			<td class="price_hours ui-selectee"  data-x="6" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="6" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="6" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="6" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="6" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="6" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="6" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 7 am</td>
			<td class="price_hours ui-selectee"  data-x="7" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="7" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="7" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="7" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="7" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="7" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="7" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 8 am</td>
			<td class="price_hours ui-selectee"  data-x="8" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="8" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="8" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="8" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="8" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="8" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="8" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 9 am</td>
			<td class="price_hours ui-selectee"  data-x="9" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="9" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="9" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="9" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="9" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="9" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="9" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 10 am</td>
			<td class="price_hours ui-selectee"  data-x="10" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="10" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="10" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="10" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="10" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="10" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="10" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 11 am</td>
			<td class="price_hours ui-selectee"  data-x="11" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="11" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="11" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="11" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="11" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="11" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="11" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 12 am</td>
			<td class="price_hours ui-selectee"  data-x="12" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="12" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="12" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="12" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="12" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="12" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="12" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 1 pm</td>
			<td class="price_hours ui-selectee"  data-x="13" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="13" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="13" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="13" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="13" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="13" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="13" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 2 pm</td>
			<td class="price_hours ui-selectee"  data-x="14" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="14" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="14" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="14" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="14" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="14" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="14" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 3 pm</td>
			<td class="price_hours ui-selectee"  data-x="15" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="15" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="15" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="15" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="15" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="15" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="15" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 4 pm</td>
			<td class="price_hours ui-selectee"  data-x="16" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="16" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="16" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="16" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="16" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="16" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="16" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 5 pm</td>
			<td class="price_hours ui-selectee"  data-x="17" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="17" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="17" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="17" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="17" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="17" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="17" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 6 pm</td>
			<td class="price_hours ui-selectee"  data-x="18" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="18" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="18" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="18" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="18" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="18" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="18" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 7 pm</td>
			<td class="price_hours ui-selectee"  data-x="19" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="19" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="19" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="19" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="19" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="19" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="19" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 8 pm</td>
			<td class="price_hours ui-selectee"  data-x="20" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="20" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="20" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="20" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="20" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="20" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="20" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 9 pm</td>
			<td class="price_hours ui-selectee"  data-x="21" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="21" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="21" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="21" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="21" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="21" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="21" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 10 pm</td>
			<td class="price_hours ui-selectee"  data-x="22" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="22" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="22" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="22" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="22" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="22" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="22" data-y="A7">$1200</td>
		</tr><tr >
			<td class="td_field_label" > 11 pm</td>
			<td class="price_hours ui-selectee"  data-x="23" data-y="A1">$1200</td><td class="price_hours ui-selectee"  data-x="23" data-y="A2">$1200</td><td class="price_hours ui-selectee"  data-x="23" data-y="A3">$1200</td><td class="price_hours ui-selectee"  data-x="23" data-y="A4">$1200</td><td class="price_hours ui-selectee"  data-x="23" data-y="A5">$1200</td><td class="price_hours ui-selectee"  data-x="23" data-y="A6">$1200</td><td class="price_hours ui-selectee"  data-x="23" data-y="A7">$1200</td>
		</tr>
		</tbody>
	</table>
		

</div>
<div class="courtbox extras clearfix">
		<div class="col-xs-12 col-md-6">
			<h3 class="title-box pull-left">Extras</h3>
			<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Add Extra</a>
					<table class="table table-bordered table-hover table-th" id="datatables">
						<thead>
							<tr>
								<th>Extra Name</th>
								<th>Cost</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Balls</td>
								<td>$10</td>
							</tr>
							<tr>
								<td><input class="extra_name form-control" name="extra_name" type="text"></td>
								<td><input class="extra_cost form-control" name="extra_cost" type="text"></td>
							</tr>
						</tbody>
					</table>
		</div>
		<div class="col-xs-12 col-md-6">
			<h3 class="title-box">Allow Members Price</h3>
				<div class="form-group">
		          <label>
		            <input type="radio" name="is_member" value="1" selected="selected">
		            Yes
		          </label>
		          <label>
		            <input type="radio" name="is_member" value="2">
		            No
		          </label>
			  </div>
		</div>
		<div class="col-md-12">
			<button class="btn btn-danger pull-right">Update</button>
			<button class="btn btn-primary pull-right" style="margin-right:120px;">Delete</button>
		</div>
	</div>
	<div class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
			  	<div class="notify">
			  		<p><i class="fa fa-exclamation-triangle"></i></p>
				    <p>Select Contract Timer Previod Above to Edit Price</p>
			  	</div>
			    
			  </div>

			</div>
	</div>
	</template>