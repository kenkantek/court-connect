<template v-if="ifContractEdit">
	<div class="courtbox contract_rate" >
		<div>
			<h3 class="title-box">Contract Time Rates</h3>
			<div class="clearfix">
				Note: Before setting rates, ensure that all holiday and closed days are entered into the calendar to ensure that the total days figure is calculated correctly
			</div>
			<form>

				<strong>Enter Price</strong>
				<div class="no-padding col-md-12">
					<div class="no-padding col-md-4"><input v-model="priceSet" class="price_contract_rate form-control" placeholder="Enter Price" name="price_contract_rate" type="text"></div>
					<div class="col-md-4"><button class="btn btn-primary" @click.prevent="setPrice()">Set Price</button></div>
					<div class="col-md-4 pull-left">
						<button class="btn btn-primary unSelected hidden" @click="removeSelect()">Remove all select</button>
					</div>
				</div>
				<p>Select hours from grid and press apply to adjust hours</p>
			</form>
			<div class="clearfix"></div>
			<div id="table-contract-rate-edit" class="table table-bordered table-hover table-th clearfix" style="position: relative; padding-bottom: 210px;; margin-top: 20px"  >
				<div class="th" style="text-align: right; font-size: 11px;">
					Starting Date <br>
					Day of the Week <br>
					Total Days w/ Holidays
				</div>
				<div v-for="(index,item) in contractSelect.daysOfWeek" class="th" track-by="$index">
					<div class="db-tb-day">{{item.date_first}}</div>
					<div class="db-tb-day">{{index}}</div>
					<div class="db-tb-day">{{item.count + "-days"}}</div>
				</div>

				<div v-for="(index,time) in contractSelect.rates" class="{{index < 6 ? 'clearfix row-edit row-edit'+index : 'clearfix' }}" track-by="$index">
					<div class="td_field_label">{{index == 0 ? "12 am" : (index < 12 ? index + "am" : (index == 12 ? index + "pm" : (index -12) + "pm") )}}</div>
					<div v-for="(key,rate) in time" class="price_hours box-price" data-x="{{ index }}" data-y="{{key}}" track-by="$index" >${{rate}}</div>
				</div>
			</div>

		</div>
		<div class="courtbox extras clearfix">
			<div class="col-xs-12 col-md-6">
				<h3 class="title-box pull-left">Extras</h3>
				<a class="btn btn-primary pull-right btn-new-court" href="" @click.prevent="addExtra()"><i class="fa fa-plus-circle"></i> Add Extra</a>
				<table class="table table-bordered table-hover table-th" id="datatables">
					<thead>
					<tr>
						<th>Extra Name</th>
						<th>Cost</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<tr v-for="(index,extra) in contractSelect.extras">
						<td>{{ extra.name }}</td>
						<td >{{ extra.value }}</td>
						<td><button class="btn btn-danger" @click="deteteExtra(index)"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button></td>
					</tr>
					<tr>
						<td><input class="extra_name form-control" name="extra_name" type="text" v-model="keyExtra"></td>
						<td><input class="extra_cost form-control" name="extra_cost" type="text" v-model="valueExtra"></td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-md-6">
				<h3 class="title-box">Price of</h3>
				<div class="form-group">
					<label>
						<input v-model="contractSelect.is_member" type="radio" name="is_member" value="1">
						Member
					</label>
					<label>
						<input v-model="contractSelect.is_member" type="radio" name="is_member" value="0">
						Non member
					</label>
				</div>
			</div>
			<div class="col-md-12">
				<button class="btn btn-primary pull-right" @click.prevent="updateContractRate()">Update</button>
				<button class="btn btn-danger pull-right" @click.prevent="deleteContractRate()"style="margin-right:120px;">Delete</button>
			</div>
		</div>
	</div>
	</div>
</template>
<style scoped>
	.row-edit{
		clear: both;
		width: 100%;
		height: 35px;
		position: absolute;
		bottom: 0px;
	}
	.row-edit5{
		bottom: 0px;
	}
	.row-edit4{
		bottom: 35px;
	}
	.row-edit3{
		bottom: 70px;
	}
	.row-edit2{
		bottom: 105px;
	}
	.row-edit1{
		bottom: 140px;
	}
	.row-edit0{
		bottom: 175px;
	}
	.th{
		float: left;
		border: 1px solid #ddd;
		padding: 8px;
		background: #f2f2f2;
		color: #000;
		width: calc( 100% / 8);
		height: 100px;
	}
	.td_field_label{
		float: left;
		width: calc( 100% / 8);
		height: 35px;
		border: 1px solid #ddd;
		border-top: 0px;
		text-align: center;
		line-height: 1.42857143;
		padding: 8px;
		background: #f2f2f2;
	}
	.box-price{
		width: calc( 100% / 8);
		height: 35px;
		float: left;
		border-bottom: 1px solid #ddd;
		border-right: 1px solid #ddd;
		text-align: center;
		line-height: 1.42857143;
		padding: 8px;
	}
	#table-contract-rate-edit .ui-selected {
		background: #0f494d;
		color: white;
	}
</style>
<script>
	export default {
		props:   ['clubSettingId','contractSelect','reloadContracts','ifContractEdit','showContract'],
		data() {
			return {
				rates :[
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
					{ A1: 1200 , A2: 1200, A3: 1200, A4: 1200, A5: 1200, A6: 1200, A7: 1200 },
				],
				selected:  [],
				priceSet: 1200,
				keyExtra:null,
				valueExtra:null,
			}
		},
		watch: {
			contractSelect: function(){
				this.calTotalDay();
			},
			now () {
				this.calTotalDay();
			}
		},
		ready(){
			//this.calTotalDay();
			$("#table-contract-rate-edit").selectable({
				filter: ".price_hours",
				selected: ( event, ui ) => {
					$(".unSelected").removeClass('hidden');
					const x = $(ui.selected).data('x'), y = $(ui.selected).data('y');
					this.selected.push({x , y});
				},
				unselected:( event, ui ) => {
					const x = $(ui.unselected).data('x'), y = $(ui.unselected).data('y');
					$(".unSelected").removeClass('hidden');
					this.selected = _.reject(this.selected, {x, y});
				}
			});
		},
		methods: {
			removeSelect(){
				$("#table-contract-rate-edit .ui-selected").removeClass("ui-selected").addClass("ui-unselecting");
				this.selected  = [];
				$(".unSelected").addClass('hidden');
			},
			deleteContractRate(){
				const contractSelect = this.contractSelect;
				this.$http.delete(laroute.route('contracts.delete'), contractSelect).then(res => {
					showNotice('success', res.data.success_msg, 'Success!');
				this.reloadContracts =  Math.floor(Math.random() * 10000);
				this.$set('contractSelect', null);
				this.ifContractEdit = false;
			},(res) => {
					showNotice('error', 'Error', 'Error Delete!');
				});
			},
			addExtra(){
				if(this.keyExtra != '' && this.valueExtra){
					var key 	= this.keyExtra ,
							value = this.valueExtra;
					var temp = { name : key , value : value};
					this.contractSelect.extras.push(temp);
					this.keyExtra = null;
					this.valueExtra = null;
				}

			},
			calTotalDay(){
				var start_date = moment(this.contractSelect.start_date, 'MM/DD/YY');
				var end_date = moment(this.contractSelect.end_date, 'MM/DD/YY');
				var dayOfWeek=["Mon","Tue","Wed","Thur","Fri","Sat","Sun"];
				var dataDateTb = [];
				var clone_start_date = start_date.clone();
				for(var i= 0; i < 7; i++) {
					if(i==0)
						clone_start_date = start_date;
					else
						clone_start_date = start_date.add(1,"days");
					dataDateTb[i] = {};
					dataDateTb[i].count_weekday = this.weekdaysBetween(clone_start_date, end_date, clone_start_date.isoWeekday());
					dataDateTb[i].date = clone_start_date.format('MM/DD');
					dataDateTb[i].day_of_week = dayOfWeek[clone_start_date.isoWeekday() - 1];
				}
				return dataDateTb;
			},
			weekdaysBetween(d1, d2, isoWeekday) {
				var daysToAdd = ((7 + isoWeekday) - d1.isoWeekday()) % 7;
				var nextTuesday = d1.clone().add(daysToAdd, 'days');

				if (nextTuesday.isAfter(d2)) {
					return 0;
				}

				var weeksBetween = d2.diff(nextTuesday, 'weeks');
				return weeksBetween + 1;
			},
			setPrice(){
				this.selected.forEach(s => {
					const {x, y} = s;
				this.contractSelect.rates[x][y] = this.priceSet;
			});
			},
			updateContractRate(){
				const contractSelect = this.contractSelect;
				$("#clubSetting-wrapper").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
				this.$http.post(laroute.route('contracts.update'), contractSelect).then(res => {
					this.resetContractRate();
				this.reloadContracts =  Math.floor(Math.random() * 10000);
				showNotice('success', res.data.success_msg, 'Update Success!');
				this.removeSelect();
				$("#clubSetting-wrapper .loading").remove();
				this.ifContractEdit = false;
			}, (res) => {
					showNotice('error', 'Error', 'Error!');
					$("#clubSetting-wrapper .loading").remove();
				});
			},
			resetContractRate(){
				this.contractSelect = null;
				this.rates = [
					{ _5_1: 1200 , _5_2: 1200, _5_3: 1200, _5_4: 1200, _5_5: 1200, _5_6: 1500, _5_7: 1500 },
					{ _6_1: 1200 , _6_2: 1200, _6_3: 1200, _6_4: 1200, _6_5: 1200, _6_6: 1500, _6_7: 1500 },
					{ _7_1: 1200 , _7_2: 1200, _7_3: 1200, _7_4: 1200, _7_5: 1200, _7_6: 1500, _7_7: 1500 },
					{ _8_1: 1200 , _8_2: 1200, _8_3: 1200, _8_4: 1200, _8_5: 1200, _8_6: 1500, _8_7: 1500 },
					{ _9_1: 1200 , _9_2: 1200, _9_3: 1200, _9_4: 1200, _9_5: 1200, _9_6: 1500, _9_7: 1500 },
					{ _10_1: 1200 , _10_2: 1200, _10_3: 1200, _10_4: 1200, _10_5: 1200, _10_6: 1500, _10_7: 1500 },
					{ _12_1: 1200 , _12_2: 1200, _12_3: 1200, _12_4: 1200, _12_5: 1200, _12_11: 1500, _12_7: 1500 },
					{ _13_1: 1200 , _13_2: 1200, _13_3: 1200, _13_4: 1200, _13_5: 1200, _13_11: 1500, _13_7: 1500 },
					{ _14_1: 1200 , _14_2: 1200, _14_3: 1200, _14_4: 1200, _14_5: 1200, _14_11: 1500, _14_7: 1500 },
					{ _15_1: 1200 , _15_2: 1200, _15_3: 1200, _15_4: 1200, _15_5: 1200, _15_11: 1500, _15_7: 1500 },
					{ _16_1: 1200 , _16_2: 1200, _16_3: 1200, _16_4: 1200, _16_5: 1200, _16_11: 1500, _16_7: 1500 },
					{ _17_1: 1200 , _17_2: 1200, _17_3: 1200, _17_4: 1200, _17_5: 1200, _17_11: 1500, _17_7: 1500 },
					{ _18_1: 1200 , _18_2: 1200, _18_3: 1200, _18_4: 1200, _18_5: 1200, _18_11: 1500, _18_7: 1500 },
					{ _20_1: 1200 , _20_2: 1200, _20_3: 1200, _20_4: 1200, _20_5: 1200, _20_11: 1500, _20_7: 1500 },
					{ _21_1: 1200 , _21_2: 1200, _21_3: 1200, _21_4: 1200, _21_5: 1200, _21_11: 1500, _21_7: 1500 },
					{ _22_1: 1200 , _22_2: 1200, _22_3: 1200, _22_4: 1200, _22_5: 1200, _22_11: 1500, _22_7: 1500 },

				];
				this.selected =  [];
				this.priceSet  =  1200;
				this.keyExtra  = null;
				this.valueExtra  = null;
			},
			deteteExtra(index){
				console.log(index);
				this.contractSelect.extras.splice(index,1);
			}
		}
	}
</script>