<template>
	<div class="court_rate courtbox">
		<h3 class="title-box pull-left">Court Rates For 
		<span v-if="courts_choice.length == 0"><strong>New Court</strong></span>
		<span v-else v-for="c in courts_choice">
		<strong>{{ c.name }}</strong>
		</span>

		</h3>
		<div class="pull-right">
			<ul id="tabRate">
				<li class="active" @click="setMember(1)">Members</li>
				<li  @click="setMember(0)">Non/Members</li>
			</ul>
		</div>
		<div class="clearfix"></div>
			<div id="contentMember" class="content-item">
				<div class="pull-right">
					<div class="add_new_date_period">
						<a class="add_tooltip" href="#"><strong>Add New Date Period</strong></a>
						<div class="new_date_preiod tooltip1 hidden">
							<div class="pull-left">
								<strong>Select Date Range</strong>
								<input id="date-picker-rate" class="daterange form-control pull-right" name="daterange_period" type="text" v-model="dataRate.name">
							</div>
							<br>
							<div class="pull-right">
								<input class="btn btn-primary" type="button" value="Apply" @click.prevent="addNewCourtRate()">
								
							</div>
						</div>
					</div>
				</div>
				<div class="pull-left">
					<strong>Date Period</strong>
					<div>
						<div>
							<select name="list-period" id="inputList-Period" class="form-control" required="required" v-model="indexDataRates">
								<option v-for="(index,d) in dataRates" v-text = "d.name" track-by="$index" value="{{index}}"></option>
							</select>
						</div>
						<div class="date_period">
							<button v-if="dataRates.length > 0" class="btn btn-danger" style="margin-right:30px" @click="deleteDataRate()">Delete</button>
							<button class="btn btn-primary" v-show="courts_choice.length > 1" @click="updateMulti">Update Rates</button>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<br>
				<div>
					<div class="pull-left">
						<strong>Enter Price</strong>
						<input class="price form-control" placeholder="Enter Price" name="price" type="number" v-model="priceSet">
						<span>Select hours from grid and press apply to adjust hours</span>
					</div>
					<div class="pull-right">					
						<button class="btn btn-primary"  @click="setPrice()">Apply</button>
					</div>
				</div>		
				<div class="clearfix"></div>
				<table class="table table-bordered table-hover table-th clearfix" style="margin-top: 20px" id="table-rate">
					<thead>
					<tr>
						<th></th>
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
					<tr v-for="(index,time) in dataRate.rates" track-by="$index">
						<td class="td_field_label" v-if="index > 7"> {{ index - 7 }} pm</td>
						<td class="td_field_label" v-else> {{ index + 5 }} am</td>
						<td v-for="(key,rate) in time" class="price_hours" data-x="{{ index }}" data-y="{{key}}" track-by="$index" >${{rate}}</td>
					</tr>
														
					</tbody>
				</table>
			</div>
			<!-- The Modal -->
			<div id="myModal" class="modal" v-show="showNotice">

			  <!-- Modal content -->
			  <div class="modal-content">
			  	<div class="notify">
			  		<p><i class="fa fa-exclamation-triangle"></i></p>
				    <p>Multiple Courts Selected</p>
				    <p>Updating prices will affect all courts selected and overwrite and existing prices input</p>
				    <p><button class="btn btn-primary" @click="continueRate">Continue</button></p>
			  	</div>
			    
			  </div>

			</div>

	</div>
</template>
<style scope>
#table-rate .ui-selected {
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
	 var _ = require('lodash'),
     deferred = require('deferred');
	export default {
			props:   ['clubSettingId','dataRates','courts_choice'],
			
			data() {
						return {
							dataRate : {
									rates :[
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },
													 { A1: 20 , A2: 20, A3: 20, A4: 20, A5: 20, A6: 25, A7: 25 },	
												],
									end_date:0,
									start_date:0,
									name:null,
									is_member:1,
							},							
							selected:  [],
							priceSet: 20,
							indexDataRates:0,
							showNotice:false,					
						}
					},
			watch: {
				indexDataRates: function () {
					if (this.dataRates.length >0 ) {
						var index = this.indexDataRates ;
						this.dataRate = this.dataRates[index];
					}
				},
				courts_choice: function () {
					if (this.courts_choice.length > 1) {
						this.showNotice = true;
					}else{
						this.showNotice = false;
					}
					
					if (this.dataRates.length >0 ) {
						var index = this.indexDataRates ;
						this.dataRate = this.dataRates[index];
					}
				}
			},		
			ready(){
				$('.add_tooltip').click(function(event) {					
					event.preventDefault();
					$('.tooltip1').toggleClass('hidden');
				});				
				$('#table-rate').selectable({
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
				 $('.daterange').daterangepicker(
       		{
       				showDropdowns: true,
          		startDate: moment().startOf('month'),
          		endDate: moment().add(3, 'months').endOf('month'),
         });
			},
			methods: {
				updateMulti(){
					const courts = _.cloneDeep(this.courts_choice);
					const dataRates = _.cloneDeep(this.dataRates);
					console.log(courts);
					this.$http.post(laroute.route('courts.update.multi'), {courts,dataRates}).then(res => {
				    this.reloadCourts =  Math.floor(Math.random() * 10000);
							 this.courts_choice = [];
							 this.dataRates = [];
					  showNotice('success', res.data.success_msg, 'Update Multi Success!');
					}, (res) => {
							showNotice('error', 'Error', 'Error!');
						});
				},
				continueRate() {
					this.showNotice = false;
				},
				deleteDataRate() {
						let name = this.dataRates[this.indexDataRates].name;
						this.dataRates.splice(this.indexDataRates, 1);
						showNotice('success', 'Delete '+ name, 'Success!');
				},
				setMember(number){
					this.$set('dataRate.is_member', number);
				},
				addNewCourtRate(){
					const p = _.cloneDeep(this.dataRate);					
					p.name = this.dataRate.name,
					p.is_member = this.dataRate.is_member,
					p.end_date =  $(".daterange").data('daterangepicker').endDate.format('MM/DD/YYYY');
					p.start_date =  $(".daterange").data('daterangepicker').startDate.format('MM/DD/YYYY');
					this.dataRates.push(p);
					$('.new_date_preiod').addClass('hidden');
				},
				setPrice(){
					this.selected.forEach(s => {
						const {x, y} = s;
						this.dataRate.rates[x][y] = this.priceSet;
					});
				}
			}

	 }
</script>