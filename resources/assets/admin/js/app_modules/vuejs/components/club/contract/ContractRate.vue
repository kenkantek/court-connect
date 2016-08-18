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
			<div id="table-contract-rate-edit1" class="table table-bordered table-hover table-th clearfix" style="position: relative; padding-bottom: 210px;; margin-top: 20px" _v-bdd116c0="">
				<div class="th" style="text-align: right; font-size: 11px;" _v-bdd116c0="">
					Starting Date <br _v-bdd116c0="">
					Day of the Week <br _v-bdd116c0="">
					Total Days w/ Holidays
				</div>
				<div class="th" _v-bdd116c0="">
					<div class="db-tb-day" _v-bdd116c0="">05/10</div>
					<div class="db-tb-day" _v-bdd116c0="">Tue</div>
					<div class="db-tb-day" _v-bdd116c0="">56-days</div>
				</div><div class="th" _v-bdd116c0="">
				<div class="db-tb-day" _v-bdd116c0="">05/11</div>
				<div class="db-tb-day" _v-bdd116c0="">Wed</div>
				<div class="db-tb-day" _v-bdd116c0="">50-days</div>
			</div><div class="th" _v-bdd116c0="">
				<div class="db-tb-day" _v-bdd116c0="">05/12</div>
				<div class="db-tb-day" _v-bdd116c0="">Thur</div>
				<div class="db-tb-day" _v-bdd116c0="">0-days</div>
			</div><div class="th" _v-bdd116c0="">
				<div class="db-tb-day" _v-bdd116c0="">05/13</div>
				<div class="db-tb-day" _v-bdd116c0="">Fri</div>
				<div class="db-tb-day" _v-bdd116c0="">0-days</div>
			</div><div class="th" _v-bdd116c0="">
				<div class="db-tb-day" _v-bdd116c0="">05/14</div>
				<div class="db-tb-day" _v-bdd116c0="">Sat</div>
				<div class="db-tb-day" _v-bdd116c0="">0-days</div>
			</div><div class="th" _v-bdd116c0="">
				<div class="db-tb-day" _v-bdd116c0="">05/15</div>
				<div class="db-tb-day" _v-bdd116c0="">Sun</div>
				<div class="db-tb-day" _v-bdd116c0="">0-days</div>
			</div><div class="th" _v-bdd116c0="">
				<div class="db-tb-day" _v-bdd116c0="">05/16</div>
				<div class="db-tb-day" _v-bdd116c0="">Mon</div>
				<div class="db-tb-day" _v-bdd116c0="">0-days</div>
			</div>

				<div _v-bdd116c0="" class="clearfix row-edit row-edit0">
					<div class="td_field_label" _v-bdd116c0="">12 am</div>
					<div class="price_hours box-price" _v-bdd116c0="" data-x="0" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="0" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="0" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="0" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="0" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="0" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="0" data-y="A7">$1200</div>
				</div><div _v-bdd116c0="" class="clearfix row-edit row-edit1">
				<div class="td_field_label" _v-bdd116c0="">1am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="1" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="1" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="1" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="1" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="1" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="1" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="1" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix row-edit row-edit2">
				<div class="td_field_label" _v-bdd116c0="">2am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="2" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="2" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="2" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="2" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="2" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="2" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="2" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix row-edit row-edit3">
				<div class="td_field_label" _v-bdd116c0="">3am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="3" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="3" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="3" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="3" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="3" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="3" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="3" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix row-edit row-edit4">
				<div class="td_field_label" _v-bdd116c0="">4am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="4" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="4" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="4" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="4" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="4" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="4" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="4" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix row-edit row-edit5">
				<div class="td_field_label" _v-bdd116c0="">5am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="5" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="5" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="5" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="5" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="5" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="5" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="5" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">6am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="6" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="6" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="6" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="6" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="6" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="6" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="6" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">7am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="7" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="7" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="7" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="7" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="7" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="7" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="7" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">8am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="8" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="8" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="8" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="8" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="8" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="8" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="8" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">9am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="9" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="9" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="9" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="9" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="9" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="9" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="9" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">10am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="10" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="10" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="10" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="10" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="10" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="10" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="10" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">11am</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="11" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="11" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="11" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="11" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="11" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="11" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="11" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">12pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="12" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="12" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="12" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="12" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="12" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="12" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="12" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">1pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="13" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="13" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="13" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="13" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="13" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="13" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="13" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">2pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="14" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="14" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="14" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="14" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="14" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="14" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="14" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">3pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="15" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="15" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="15" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="15" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="15" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="15" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="15" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">4pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="16" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="16" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="16" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="16" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="16" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="16" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="16" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">5pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="17" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="17" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="17" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="17" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="17" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="17" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="17" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">6pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="18" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="18" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="18" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="18" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="18" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="18" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="18" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">7pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="19" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="19" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="19" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="19" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="19" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="19" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="19" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">8pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="20" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="20" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="20" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="20" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="20" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="20" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="20" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">9pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="21" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="21" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="21" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="21" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="21" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="21" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="21" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">10pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="22" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="22" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="22" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="22" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="22" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="22" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="22" data-y="A7">$1200</div>
			</div><div _v-bdd116c0="" class="clearfix">
				<div class="td_field_label" _v-bdd116c0="">11pm</div>
				<div class="price_hours box-price" _v-bdd116c0="" data-x="23" data-y="A1">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="23" data-y="A2">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="23" data-y="A3">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="23" data-y="A4">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="23" data-y="A5">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="23" data-y="A6">$1200</div><div class="price_hours box-price" _v-bdd116c0="" data-x="23" data-y="A7">$1200</div>
			</div>
			</div>
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
					<p>Select Contract Time Period Above to Edit Price</p>
				</div>

			</div>

		</div>
	</div>

</template>
<script>
	export default {
		props:   ['clubSettingId','contractSelect','reloadContracts','ifContractEdit','showContract'],
		ready(){

			$('#table-contract-rate-edit').selectable({
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
			}
		}
	}
</script>