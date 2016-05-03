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
		<tbody>
			<tr>
				<td class="td_field_label"> 5 am</td>
				<td data-x="0" data-y="_5_1">$1200</td><td data-x="0" data-y="_5_2">$1200</td><td data-x="0" data-y="_5_3">$1200</td><td data-x="0" data-y="_5_4">$1200</td><td data-x="0" data-y="_5_5">$1200</td><td data-x="0" data-y="_5_6">$1500</td><td data-x="0" data-y="_5_7">$1500</td>
			</tr>
			<tr>
				<td class="td_field_label"> 6 am</td>
				
				<td data-x="1" data-y="_6_1">$1200</td><td data-x="1" data-y="_6_2">$1200</td><td data-x="1" data-y="_6_3">$1200</td><td data-x="1" data-y="_6_4">$1200</td><td data-x="1" data-y="_6_5">$1200</td><td data-x="1" data-y="_6_6">$1500</td><td data-x="1" data-y="_6_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 7 am</td>
				
				<td data-x="2" data-y="_7_1">$1200</td><td data-x="2" data-y="_7_2">$1200</td><td data-x="2" data-y="_7_3">$1200</td><td data-x="2" data-y="_7_4">$1200</td><td data-x="2" data-y="_7_5">$1200</td><td data-x="2" data-y="_7_6">$1500</td><td data-x="2" data-y="_7_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 8 am</td>
				
				<td data-x="3" data-y="_8_1">$1200</td><td data-x="3" data-y="_8_2">$1200</td><td data-x="3" data-y="_8_3">$1200</td><td data-x="3" data-y="_8_4">$1200</td><td data-x="3" data-y="_8_5">$1200</td><td data-x="3" data-y="_8_6">$1500</td><td data-x="3" data-y="_8_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 9 am</td>
				
				<td data-x="4" data-y="_9_1">$1200</td><td data-x="4" data-y="_9_2">$1200</td><td data-x="4" data-y="_9_3">$1200</td><td data-x="4" data-y="_9_4">$1200</td><td data-x="4" data-y="_9_5">$1200</td><td data-x="4" data-y="_9_6">$1500</td><td data-x="4" data-y="_9_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 10 am</td>
				
				<td data-x="5" data-y="_10_1">$1200</td><td data-x="5" data-y="_10_2">$1200</td><td data-x="5" data-y="_10_3">$1200</td><td data-x="5" data-y="_10_4">$1200</td><td data-x="5" data-y="_10_5">$1200</td><td data-x="5" data-y="_10_6">$1500</td><td data-x="5" data-y="_10_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 11 am</td>
				
				<td data-x="6" data-y="_12_1">$1200</td><td data-x="6" data-y="_12_2">$1200</td><td data-x="6" data-y="_12_3">$1200</td><td data-x="6" data-y="_12_4">$1200</td><td data-x="6" data-y="_12_5">$1200</td><td data-x="6" data-y="_12_11">$1500</td><td data-x="6" data-y="_12_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 12 am</td>
				
				<td data-x="7" data-y="_13_1">$1200</td><td data-x="7" data-y="_13_2">$1200</td><td data-x="7" data-y="_13_3">$1200</td><td data-x="7" data-y="_13_4">$1200</td><td data-x="7" data-y="_13_5">$1200</td><td data-x="7" data-y="_13_11">$1500</td><td data-x="7" data-y="_13_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 1 pm</td>
				
				<td data-x="8" data-y="_14_1">$1200</td><td data-x="8" data-y="_14_2">$1200</td><td data-x="8" data-y="_14_3">$1200</td><td data-x="8" data-y="_14_4">$1200</td><td data-x="8" data-y="_14_5">$1200</td><td data-x="8" data-y="_14_11">$1500</td><td data-x="8" data-y="_14_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 2 pm</td>
				
				<td data-x="9" data-y="_15_1">$1200</td><td data-x="9" data-y="_15_2">$1200</td><td data-x="9" data-y="_15_3">$1200</td><td data-x="9" data-y="_15_4">$1200</td><td data-x="9" data-y="_15_5">$1200</td><td data-x="9" data-y="_15_11">$1500</td><td data-x="9" data-y="_15_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 3 pm</td>
				
				<td data-x="10" data-y="_16_1">$1200</td><td data-x="10" data-y="_16_2">$1200</td><td data-x="10" data-y="_16_3">$1200</td><td data-x="10" data-y="_16_4">$1200</td><td data-x="10" data-y="_16_5">$1200</td><td data-x="10" data-y="_16_11">$1500</td><td data-x="10" data-y="_16_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 4 pm</td>
				
				<td data-x="11" data-y="_17_1">$1200</td><td data-x="11" data-y="_17_2">$1200</td><td data-x="11" data-y="_17_3">$1200</td><td data-x="11" data-y="_17_4">$1200</td><td data-x="11" data-y="_17_5">$1200</td><td data-x="11" data-y="_17_11">$1500</td><td data-x="11" data-y="_17_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 5 pm</td>
				
				<td data-x="12" data-y="_18_1">$1200</td><td data-x="12" data-y="_18_2">$1200</td><td data-x="12" data-y="_18_3">$1200</td><td data-x="12" data-y="_18_4">$1200</td><td data-x="12" data-y="_18_5">$1200</td><td data-x="12" data-y="_18_11">$1500</td><td data-x="12" data-y="_18_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 6 pm</td>
				
				<td data-x="13" data-y="_20_1">$1200</td><td data-x="13" data-y="_20_2">$1200</td><td data-x="13" data-y="_20_3">$1200</td><td data-x="13" data-y="_20_4">$1200</td><td data-x="13" data-y="_20_5">$1200</td><td data-x="13" data-y="_20_11">$1500</td><td data-x="13" data-y="_20_7">$1500</td>
			</tr><tr>
				<td class="td_field_label"> 7 pm</td>
				
				<td>$1200</td><td>$1200</td><td>$1200</td><td>$1200</td><td>$1200</td><td>$1500</td><td>$1500</td>
			</tr>
			<tr>
				<td class="td_field_label"> 8 pm</td>
				
				<td>$1200</td><td>$1200</td><td>$1200</td><td>$1200</td><td>$1200</td><td>$1500</td><td>$1500</td>
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