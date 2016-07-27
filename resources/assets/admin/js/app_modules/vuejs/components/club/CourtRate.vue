<template>
	<div class="court_rate courtbox">
		<h3 class="title-box pull-left">Rates For
			<span v-if="courts_choice.length == 0"><strong>New Court</strong></span>
		<span v-else v-for="c in courts_choice">
		<strong>{{ c.name }}</strong>
		</span>

		</h3>
		<div class="pull-right">
			<div id="offer-price-court-rate" class="overlight">
				<label>
					<span>Offer member price</span>
					<input type="checkbox" id="lch-same_price" data-check="false" @click="checkSamePrice()" style="width: 100%; height: 100%;">
				</label>
				<ul id="tabRate" class="h">
					<li :class="{'active': is_member == 1}"  @click="setMember(1)">Members</li>
					<li :class="{'active': is_member == 0}"  @click="setMember(0)">NonMembers</li>
				</ul>
			</div>
		</div>
		<div class="clearfix"></div>
		<div id="contentMember" class="content-item">
			<div class="pull-right">
				<div class="add_new_date_period">
					<a class="add_tooltip" href="#"><strong>Add New Date Period</strong></a>
					<div class="new_date_preiod tooltip1 hidden">
						<div class="pull-left">
							<strong>Select Date Range</strong>
							<input id="date-picker-rate" class="daterange form-control pull-right" name="daterange_period" type="text" v-model="daterange_period">
						</div>
						<br>
						<div class="pull-right">
							<button class="btn btn-primary" type="button" @click.prevent="addNewCourtRate()">Ok</button>
						</div>
					</div>
				</div>
			</div>
			<div class="pull-left">
				<strong>Date Period</strong>
				<div>
					<select name="list-period" id="inputList-Period" class="form-control" required="required" v-model="indexDataRates">
						<option v-for="(index,d) in dataRates" track-by="$index" dataId="{{d.datarate.id}}" value="{{index}}" :selected="index == 0 ? 'selected':''">
							{{d.datarate.name}} -- {{d.nameCourt}} -- created: {{d.datarate.created_at | formatDate}}
						</option>
					</select>
				</div>
				<div class="date_period">
					<button v-if="dataRates.length > 0 && indexDataRates != null" class="btn btn-danger" style="margin-right:30px" @click="deleteDataRate()">Delete</button>
					<button class="btn btn-primary" v-show="courts_choice.length > 0" @click="updateMulti">Update Rates</button>
				</div>
			</div>
			<div class="clearfix"></div>
			<br>

			<div class="box-data-rates">
				<div class="overlight"></div>
				<div class="row">
					<div class="col-md-5">
						<strong>Enter Price</strong>
						<input class="price form-control" placeholder="Enter Price" name="price" type="number" v-model="priceSet">
						<span>Select hours from grid and press apply to adjust hours</span>
					</div>
					<div class="col-md-4">
						<button class="btn btn-primary"  @click="setPrice()" style="margin-top: 20px;">Set Price</button>
					</div>
					<div class="col-md-3 text-right">
						<button class="btn btn-primary unSelected hidden" style="margin-top: 20px; margin-left: 20px" @click="removeSelect()">Remove all select</button>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="table table-bordered table-hover table-th clearfix" style="margin-top: 20px; padding-bottom: 210px;" id="table-rate">
					<div>
						<div class="th"></div>
						<div class="th">Mon</div>
						<div class="th">Tue</div>
						<div class="th">Web</div>
						<div class="th">Thur</div>
						<div class="th">Fri</div>
						<div class="th">Sat</div>
						<div class="th">Sun</div>
					</div>

					<template v-if="this.is_member == 1">
						<div v-for="(index,time) in dataRate.rates_member" class="{{index < 6 ? 'clearfix row-edit row-edit'+index : 'clearfix' }}" track-by="$index">
							<div class="td_field_label">{{index == 0 ? "12 am" : (index < 12 ? index + "am" : (index == 12 ? index + "pm" : (index -12) + "pm") )}}</div>
							<div v-for="(key,rate) in time" class="price_hours box-price" data-x="{{ index }}" data-y="{{key}}" track-by="$index" >${{rate}}</div>
						</div>
					</template>
					<template v-if="this.is_member == 0">
						<div v-for="(index,time) in dataRate.rates_nonmember" class="{{index < 6 ? 'clearfix row-edit row-edit'+index : 'clearfix' }}" track-by="$index">
							<div class="td_field_label">{{index == 0 ? "12 am" : (index < 12 ? index + "am" : (index == 12 ? index + "pm" : (index -12) + "pm") )}}</div>
							<div v-for="(key,rate) in time" class="price_hours box-price" data-x="{{ index }}" data-y="{{key}}" track-by="$index" >${{rate}}</div>
						</div>
					</template>

				</div>
			</div>

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
		<div id="myModal2" class="modal" v-show="this.courts_choice.length == 0 && btnAddCourt == false">

			<!-- Modal content -->
			<div class="modal-content">
				<div class="notify">
				</div>
			</div>

		</div>

	</div>
</template>
<style scope>
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
		height: 35px;
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
	#tabRate{
		display: inline-block;
		position: relative;
	}
	#tabRate.h:before{
		display: block;
		content: ' ';
		width: 100%;
		height: 100%;
		background: rgba(255,255,255,.7);
		position: absolute;
		z-index: 999;
	}
	#lch-same_price{
		display: inline-block;
	}
</style>
<script>
	var _ = require('lodash'),
			deferred = require('deferred');
	export default {
		props:   ['clubSettingId','dataRates','courts_choice','btnAddCourt','reloadCourts','indexDataRates','defaultPrice'],
		data() {
			return {
				daterange_period: null,
				dataRate : {
					rates_member: null,
					rates_nonmember: null,
					end_date:0,
					start_date:0,
					name:null,
					is_same_price: 1
				},
				defaultRate : {
					rates_member: [
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					],
					rates_nonmember:[
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
						{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					],
					end_date:0,
					start_date:0,
					name:null,
					is_same_price: 1
				},
				selected:  [],
				priceSet: 20,
				showNotice:false,
				rateIndex:null,
				is_member: 0,
				text: null,
				same_price: 1
			}
		},
		filters: {
			formatDate: function (date) {
				return moment(date).format('MM-DD-YYYY, hh:mm:ss a');
			}
		},
		watch: {
			defaultPrice: function(){

			},
			indexDataRates: function () {
				this.resetSamePrice();
				if (this.dataRates.length >0 && this.indexDataRates != null) {
					var index = this.indexDataRates ;
					this.dataRate = this.dataRates[index].datarate;
					this.rateIndex = index;

					if(this.dataRate.is_same_price == 0){
						this.same_price = 0;
						$("#tabRate").removeClass('h');
						$('#lch-same_price').bootstrapSwitch('state',true);
					}else{
						this.same_price = 1;
						$("#tabRate").addClass('h');
						$('#lch-same_price').bootstrapSwitch('state',false);
					}
				}
				if(this.indexDataRates != null){
					$(".box-data-rates .overlight").hide();
					$("#offer-price-court-rate").removeClass('overlight');
				}
				else {
					$(".box-data-rates .overlight").show();
					$("#offer-price-court-rate").addClass('overlight');
				}

				$("#inputList-Period option").each(function(){
					$(this).siblings("[dataId='"+ $(this).attr('dataId')+"']").remove();
				});
			},
			reloadCourts: function () {
				this.priceSet =  20;
				this.dataRate = _.cloneDeep(this.defaultRate);
				this.dataRates = [];
			},
			courts_choice: function () {

				if (this.courts_choice.length > 1) {
					this.showNotice = true;
					//this.indexDataRates = 0;
				}else{
					this.showNotice = false;
					this.indexDataRates = null;
				}

				if (this.dataRates.length >0 && this.indexDataRates != null) {
					var index = this.indexDataRates ;
					this.dataRate = this.dataRates[index].datarate;
				}else{
					this.dataRate = _.cloneDeep(this.defaultRate);
				}
				this.resetSamePrice();
			}
		},
		ready(){
			this.resetSamePrice();
			var _this = this;
			$(".bootstrap-switch-id-lch-same_price span").on('click',function(){
				_this.checkSamePrice();
			});
			$('.add_tooltip').click(function(event) {
				event.preventDefault();
				$('.tooltip1').toggleClass('hidden');
			});

			$('#table-rate').selectable({
				filter: ".price_hours",
				selected: ( event, ui ) => {
					$(".unSelected").removeClass('hidden');
					const x = $(ui.selected).data('x'),
						y = $(ui.selected).data('y');
					this.selected.push({x , y});
				},
				unselected:( event, ui ) => {
					const x = $(ui.unselected).data('x'),
							y = $(ui.unselected).data('y');
					$(".unSelected").removeClass('hidden');
					this.selected = _.reject(this.selected, {x, y});
				}
			});
			$('.daterange').daterangepicker({
				showDropdowns: true,
				startDate: moment().startOf('month'),
				endDate: moment().add(3, 'months').endOf('month'),
			});
		},
		methods: {
			removeSelect(){
				$("#table-rate .ui-selected").removeClass("ui-selected").addClass("ui-unselecting");
				this.selected  = [];
				$(".unSelected").addClass('hidden');
			},
			updateMulti(){
				const courts = _.cloneDeep(this.courts_choice);
				const dataRates = _.cloneDeep(this.dataRates);

				//check price same both of member and nonmember
				var cal_fl_price_of_member = this.is_member;
				if(!this.same_price)
					cal_fl_price_of_member = -1;
				$("#clubSetting-wrapper").append('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
				this.$http.post(laroute.route('courts.update.multi'), {courts,dataRates,cal_fl_price_of_member}).then(res => {
					this.reloadCourts =  Math.floor(Math.random() * 10000);
				this.courts_choice = [];
				this.dataRates = [];
				this.dataRate = _.cloneDeep(this.defaultRate);
				showNotice('success', res.data.success_msg, 'Rate for Multiple Courts Updated !');
				$("#clubSetting-wrapper .loading").remove();
				this.removeSelect();
			}, (res) => {
					showNotice('error', 'Error', 'Error!');
					$("#clubSetting-wrapper .loading").remove();
				});
			},
			continueRate() {
				this.showNotice = false;
			},
			deleteDataRate() {
				let name = this.dataRates[this.indexDataRates].datarate.name;
				this.dataRates.splice(this.indexDataRates, 1);
				showNotice('success', 'Delete '+ name, 'Success!');
			},
			setMember(number){
				this.$set('is_member', number);
				this.removeSelect();
			},
			checkSamePrice(){
				if($(".bootstrap-switch-id-lch-same_price").hasClass('bootstrap-switch-off')){
					$("#tabRate").addClass('h');
					this.dataRates[this.indexDataRates].datarate.is_same_price = 1;
					this.same_price = 1;
					this.is_member = 0;
				}else if($(".bootstrap-switch-id-lch-same_price").hasClass('bootstrap-switch-on')){
					$("#tabRate").removeClass('h');
					this.same_price = 0;
					this.dataRates[this.indexDataRates].datarate.is_same_price = 0;
				}
			},
			resetSamePrice(){
				this.same_price = true;
				$("#tabRate").addClass('h');
				$('#lch-same_price').bootstrapSwitch('state',false);
			},
			addNewCourtRate(){
				this.defaultRate.rates_member = [
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
				];
				this.defaultRate.rates_nonmember = [
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
					{ A1: this.defaultPrice , A2: this.defaultPrice, A3: this.defaultPrice, A4: this.defaultPrice, A5: this.defaultPrice, A6: this.defaultPrice, A7: this.defaultPrice },
				];

				//set price default
				this.dataRate = _.cloneDeep(this.defaultRate);

				const p = {};
				p.datarate = this.dataRate;
				p.datarate.name = this.daterange_period,
						p.datarate.end_date =  $(".daterange").data('daterangepicker').endDate.format('MM/DD/YYYY');
				p.datarate.start_date =  $(".daterange").data('daterangepicker').startDate.format('MM/DD/YYYY');
				this.dataRates.push(p);
				$('.new_date_preiod').addClass('hidden');
				//set indexrates
				this.indexDataRates = this.dataRates.length -1 ;
			},
			setPrice(){
				if(this.is_member) {
					this.selected.forEach(s => {
						const {x, y} = s;
					this.dataRate.rates_member[x][y] = this.priceSet;
				});
				}else{
					this.selected.forEach(s => {
						const {x, y} = s;
					this.dataRate.rates_nonmember[x][y] = this.priceSet;
				});
				}
				this.dataRates[this.indexDataRates]['datarate']['rates_member'] = this.dataRate['rates_member'];
				this.dataRates[this.indexDataRates]['datarate']['rates_nonmember'] = this.dataRate['rates_nonmember'];
			}

		},

	}
</script>
