<template>
	<div class="court_rate courtbox">
		<h3 class="title-box pull-left">Court Rates For <strong>New Court</strong></h3>
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
					<select name="list-period" id="inputList-Period" class="form-control" required="required" v-model="indexDataRates">
						<option v-for="(index,d) in dataRates" v-text = "d.name" track-by="$index" value="{{index}}"></option>
					</select>
				</div>
				<div class="clearfix"></div>
				<br>
				<div class="pull-left">
					<strong>Enter Price</strong>
					<input class="price form-control" placeholder="Enter Price" name="price" type="number" v-model="priceSet">
					<span>Select hours from grid and press apply to adjust hours</span>
				</div>
				<div class="pull-right">
					<button v-if="dataRates.length > 0" class="btn btn-danger" style="margin-right:100px" @click="deleteDataRate()">Delete</button>
					<button class="btn btn-primary"  @click="setPrice()">Apply</button>
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
			<div id="contentNonmember" class="content-item">

			</div>

	</div>
</template>
<style>
	#table-rate .ui-selected {
    background: #0f494d;
    color: white;
}
</style>
<script>
	 var _ = require('lodash'),
     deferred = require('deferred');
	export default {
			props:   ['clubSettingId','dataRates'],
			
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
									endDate:0,
									startDate:0,
									name:null,
									isMember:1,
							},							
							selected:  [],
							priceSet: 20,
							indexDataRates:0,					
						}
					},
			watch: {
				indexDataRates: function () {
					var index = this.indexDataRates ;
					this.dataRate = this.dataRates[index];
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
				deleteDataRate() {
						let name = this.dataRates[this.indexDataRates].name;
						this.dataRates.splice(this.indexDataRates, 1);
						showNotice('success', 'Delete '+ name, 'Success!');
				},
				setMember(number){
					this.$set('dataRate.isMember', number);
				},
				addNewCourtRate(){
					const p = _.cloneDeep(this.dataRate);					
					p.name = this.dataRate.name,
					p.isMember = this.dataRate.isMember,
					p.endDate =  $(".daterange").data('daterangepicker').endDate.format('MM/DD/YYYY');
					p.startDate =  $(".daterange").data('daterangepicker').startDate.format('MM/DD/YYYY');
					this.dataRates.push(p);
					console.log(this.dataRates);
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