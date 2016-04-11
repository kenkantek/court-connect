<template>
<div class="courtbox contract_rate">
	<div>
	<h3 class="title-box">Contract Time Rates</h3>
	<div class="clearfix">
		Note: Before setting rates, ensure that all holiday and closed days are entered into the calendar to ensure that the total days figure is calculated correctly
	</div>
	<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" class="form-court" id="form_search_contract_rate" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">

			<strong>Enter Price</strong>
			<div class="no-padding col-md-12">
				<div class="no-padding col-md-4"><input v-model="priceSet" class="price_contract_rate form-control" placeholder="Enter Price" name="price_contract_rate" type="text"></div>
				<div class="col-md-4"><button class="btn btn-primary" @click.prevent="setPrice()">Set Price</button></div>			
				<div class="col-md-4 text-right"><button class="btn btn-primary">Apply</button></div>	
			</div>
			<p>Select hours from grid and press apply to adjust hours</p>
	</form>
	<div class="clearfix"></div>
	<table id="table-contract-rate" class="table table-bordered table-hover table-th clearfix" style="margin-top: 20px">
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
			<tr v-for="(index,time) in rates" track-by="$index">
				<td class="td_field_label" v-if="index > 7"> {{ index - 7 }} pm</td>
				<td class="td_field_label" v-else> {{ index + 5 }} am</td>
				<td v-for="(key,rate) in time" class="price_hours" data-x="{{ index }}" data-y="{{key}}" track-by="$index" >${{rate}}</td>
			</tr>	
		</tbody>
	</table>
		<div class="modal" v-show="showNotice">

			  <!-- Modal content -->
			  <div class="modal-content">
			  	<div class="notify">
			  		<p><i class="fa fa-exclamation-triangle"></i></p>
				    <p>Select Contract Timer Previod Above to Edit Price</p>
			  	</div>
			    
			  </div>

			</div>
	</div>

</div>
<div class="courtbox extras">
	<div class="col-xs-12 col-md-6">
		<h3 class="title-box pull-left">Extras</h3>
		<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Add Extra</a>
			<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" id="form_add_extra" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
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
			</form>

	</div>
</div>

</template>
<style scoped>
.contract_rate {
	position: relative;
}
#table-contract-rate .ui-selected {
    background: #0f494d;
    color: white;
}
.date_period {
	margin-top: 20px;
}
.modal {
    display: block; /* Hidden by default */
    position: absolute; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: transparent;
    margin: auto;
    border: 1px solid #888;
    text-align: center;
    color: #fff;
    display: table;
    width: 100%;
    height: 100%;
}
.notify {
	    display: table-cell;
    vertical-align: middle;
}
/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
<script>
	export default {
			props:   ['clubSettingId'],			
			data() {
							return {
									rates :[
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },
												 { A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1500, A7: 1500 },	
											],
								 showcontractrate : true,
								 selected:  [],
								 priceSet: 1200,
								}
				},
				ready(){		
								$('#table-contract-rate').selectable({
									filter: ".price_hours",
									selected: ( event, ui ) => {
										const x = $(ui.selected).data('x'),
													y = $(ui.selected).data('y');
										this.selected.push({x , y});
									},
									unselected:( event, ui ) => {
										const x = $(ui.unselected).data('x'),
													y = $(ui.unselected).data('y');

										this.selected = _.reject(this.selected, {x, y});
									}
								});
						},
				methods: {
					setPrice(){
								this.selected.forEach(s => {
									const {x, y} = s;
									this.rates[x][y] = this.priceSet;
								});
							}
				}
			}
</script>