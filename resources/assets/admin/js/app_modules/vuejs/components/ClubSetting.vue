<template>
<div class="box-body">
			<section class="col-xs-12 col-md-5">
				<div class="court_list courtbox">
					<h3 class="title-box pull-left">Courts</h3>
					<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Add New Court</a>
					<table class="table table-bordered table-hover table-th" id="datatables">
						<thead>
						<tr>
							<th></th>
							<th>Court Name</th>
							<th>Indoor/Outdoor</th>
							<th>Surface</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td><div class="checker"><span><input type="checkbox" class="styled court-item-check" data-value=""></span></div></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						<tr>
							<td><div class="checker"><span><input type="checkbox" class="styled court-item-check" data-value=""></span></div></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						<tr>
							<td><div class="checker"><span><input type="checkbox" class="styled court-item-check" data-value=""></span></div></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						<tr>
							<td><div class="checker"><span><input type="checkbox" class="styled court-item-check" data-value=""></span></div></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="court_new courtbox">
					<h3 class="title-box">Add New Court</h3>
					<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
					<table>
						<tbody><tr>
							<td width="30%"><label for="name">Court Name *</label></td>
							<td><input class="form-control" placeholder="Court name" name="name" type="text" id="name"></td>
						</tr>
						<tr>
							<td><label for="last_name">Indoor/Outdoor? *</label></td>
							<td><select class="select-full form-control select2-hidden-accessible" name="indoor_outdoor" tabindex="-1" aria-hidden="true"><option value="indoor">Indoor</option><option value="outdoor">Outdoor</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-indoor_outdoor-aa-container"><span class="select2-selection__rendered" id="select2-indoor_outdoor-aa-container" title="Indoor">Indoor</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
							</td>
						</tr>
						<tr>
							<td><label for="surface_type">Surface Type *</label></td>
							<td><select class="form-control select-full select2-hidden-accessible" id="surface_type" name="surface_type" tabindex="-1" aria-hidden="true"><option value="hard">Hard</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-surface_type-container"><span class="select2-selection__rendered" id="select2-surface_type-container" title="Hard">Hard</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></td>
						</tr>
						<tr>
							<td><label for="basic_price">Basic Price *</label></td>
							<td><select class="form-control select-full select2-hidden-accessible" id="basic_price" name="basic_price" tabindex="-1" aria-hidden="true"><option value="1">Base off Court#2 Rates</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-basic_price-container"><span class="select2-selection__rendered" id="select2-basic_price-container" title="Base off Court#2 Rates">Base off Court#2 Rates</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>When creating a new court you can set the initial prices to match a previously created court. Select the court
								you'd like to copy the prices from.
								<br>
								<input class="btn btn-primary pull-right" type="submit" value="Add Court">
							</td>
						</tr>
					</tbody></table>
					</form>
				</div>
			</section>

			<section class="col-xs-12 col-md-7">
				<div class="court_rate courtbox">
					<h3 class="title-box pull-left">Court Rates For <strong>New Court</strong></h3>
					<div class="pull-right">
						<ul id="tabRate">
							<li data-href="#contentMember" class="active">Members</li>
							<li data-href="#contentNonmember">Non/Members</li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<div class="contentTab">
						<div id="contentMember" class="content-item">
							<div class="pull-right">
								<div class="add_new_date_period">
									<strong>Add New Date Period</strong>
									<div class="tooltip">
										<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" class="form-court" id="form_add_date_period" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
										<div class="pull-left">
											<strong>Select Date Range</strong>
											<input class="daterange form-control" name="daterange_period" type="text">
										</div>
										<br>
										<div class="pull-right">
											<input class="btn btn-primary" type="submit" value="Apply">
										</div>
										</form>
									</div>
								</div>
							</div>

							<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" class="form-court" id="form_search_rate" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
							<div class="pull-left">
								<strong>Date Period</strong>
								<input class="daterange form-control" name="daterange_rate" type="text">
							</div>
							<div class="clearfix"></div>
							<br>
							<div class="pull-left">
								<strong>Enter Price</strong>
								<input class="price form-control" placeholder="Enter Price" name="price" type="text">
								<span>Select hours from grid and press apply to adjust hours</span>
							</div>
							<div class="pull-right">
								<input class="btn btn-primary" type="submit" value="Apply">
							</div>
							</form>

							<div class="clearfix"></div>
							<table class="table table-bordered table-hover table-th clearfix" style="margin-top: 20px">
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
																	<tr>
										<td class="td_field_label">5am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">6am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">7am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">8am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">9am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">10am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">11am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">12am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																									<tr>
										<td class="td_field_label">1pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">2pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">3pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">4pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">5pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">6pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">7pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">8pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">9pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																	<tr>
										<td class="td_field_label">10pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
																</tbody>
							</table>
						</div>
						<div id="contentNonmember" class="content-item">

						</div>
					</div>
				</div>
			</section>

			<section class="col-xs-12 col-md-12">
				<h3 class="title-box">Set Opening Hours/Holiday Days</h3>
				<p>This form allows you to change multiple dates at the same time.
					Start by selecting the day(s) of the week you want to apply the opening times to and then a range of dates for this to be applied.
					The opening times you enter will then be changed for all dates in the date range where the day matches what you've selected. Holiday days and closed days will not count towards contract time bookings</p>

				<div class="clearfix"></div>
				<div class="">
					<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" id="form_set_openday" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
					<div class="pull-left form-box">
						<label for="date">Select day(s) of the week</label>
						<br>
						<select class="form-control" name="date_open" id="date_open" multiple="multiple" style="display: none;"><option value="mon">Monday</option><option value="tue">Tuesday</option><option value="wed">Wednesday</option><option value="thur">Thursday</option><option value="fri">Friday</option><option value="sat">Saturday</option><option value="sun">Sunday</option></select><div class="btn-group"><button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text">None selected</span> <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="mon"> Monday</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="tue"> Tuesday</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="wed"> Wednesday</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="thur"> Thursday</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="fri"> Friday</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="sat"> Saturday</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="sun"> Sunday</label></a></li></ul></div>
					</div>
					<div class="pull-left form-box">
						<label for="daterange_open">Date range</label>
						<input class="daterange form-control" name="daterange_open" type="text" id="daterange_open">
					</div>
					<div class="pull-left form-box">
						<label for="opentime">Open Time</label>
						<input id="opentime" class="timepicker opentime form-control" placeholder="" name="opentime" type="text">
					</div>
					<div class="pull-left form-box">
						<label for="closetime">Closing Time</label>
						<input class="timepicker closetime form-control" placeholder="" name="closetime" type="text" id="closetime">
					</div>
					<div class="pull-left">
						<br>
						<input class="btn btn-primary" style="margin-top: 6px;" type="submit" value="Apply">
					</div>
					</form>
				</div>

				<div class="calendar-box">
					<div class="monthly" id="monthly_opendays"><div class="monthly-header"><div class="monthly-header-title">Mar 2016</div><a href="#" class="monthly-prev"></a><a href="#" class="monthly-next"></a></div><div class="monthly-day-title-wrap"><div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div></div><div class="monthly-day-wrap"><div class="monthly-day-blank"><div class="monthly-day-number"></div></div><div class="monthly-day-blank"><div class="monthly-day-number"></div></div><div class="monthly-day" data-number="1"><div class="monthly-day-number">1</div><div class="monthly-indicator-wrap"><div class="overflow"><div class="btn-close action"><img src="http://courtconnect.local/resources/admin/img/close_icon.png" alt=""></div> <div class="btn-plane action"><img src="http://courtconnect.local/resources/admin/img/plane_icon.png" alt=""></div> <div class="btn-clock action"><img src="http://courtconnect.local/resources/admin/img/clock_icon.png" alt=""></div> </div> </div></div><div class="monthly-day" data-number="2"><div class="monthly-day-number">2</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="3"><div class="monthly-day-number">3</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="4"><div class="monthly-day-number">4</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="5"><div class="monthly-day-number">5</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="6"><div class="monthly-day-number">6</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="7"><div class="monthly-day-number">7</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="8"><div class="monthly-day-number">8</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="9"><div class="monthly-day-number">9</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="10"><div class="monthly-day-number">10</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="11"><div class="monthly-day-number">11</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="12"><div class="monthly-day-number">12</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="13"><div class="monthly-day-number">13</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="14"><div class="monthly-day-number">14</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="15"><div class="monthly-day-number">15</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day day_close" data-number="16"><div class="monthly-day-number">16</div><div class="monthly-indicator-wrap">close</div></div><div class="monthly-day" data-number="17"><div class="monthly-day-number">17</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="18"><div class="monthly-day-number">18</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="19"><div class="monthly-day-number">19</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="20"><div class="monthly-day-number">20</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="21"><div class="monthly-day-number">21</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="22"><div class="monthly-day-number">22</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day day_holiday" data-number="23"><div class="monthly-day-number">23</div><div class="monthly-indicator-wrap">Holiday<br>6am-8pm</div></div><div class="monthly-day" data-number="24"><div class="monthly-day-number">24</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="25"><div class="monthly-day-number">25</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="26"><div class="monthly-day-number">26</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="27"><div class="monthly-day-number">27</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="28"><div class="monthly-day-number">28</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="29"><div class="monthly-day-number">29</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="30"><div class="monthly-day-number">30</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day" data-number="31"><div class="monthly-day-number">31</div><div class="monthly-indicator-wrap"></div></div><div class="monthly-day-blank"><div class="monthly-day-number"></div></div><div class="monthly-day-blank"><div class="monthly-day-number"></div></div></div><div class="monthly-event-list"></div></div>
				</div>
			</section>

			<section class="col-xs-12 col-md-7">
				<div class="courtbox contacttime">
					<h3 class="title-box pull-left">Contract Time</h3>
					<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Create Contract Time Period</a>
					<div class="clearfix"></div>
					<div class="clearfix">
						Creating a contract time period will allow a user to book a regular time slot each week.
						When creating a contract time period, each day of the week can be set to a  different price.
					</div>
					<table class="table table-bordered table-hover table-th" id="datatables" style="margin-top: 10px">
						<thead>
						<tr>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Total Weeks</th>
							<th>Notes</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Monday 1st Sep 2016</td>
							<td>Sunday 31st May 2017</td>
							<td>36</td>
							<td>Use for booking courts 1-5 indoors</td>
						</tr>
						<tr>
							<td>Monday 1st Sep 2016</td>
							<td>Sunday 31st May 2017</td>
							<td>36</td>
							<td>Use for booking courts 1-5 indoors</td>
						</tr>
						<tr>
							<td>Monday 1st Sep 2016</td>
							<td>Sunday 31st May 2017</td>
							<td>36</td>
							<td>Use for booking courts 1-5 indoors</td>
						</tr>
						<tr>
							<td>Monday 1st Sep 2016</td>
							<td>Sunday 31st May 2017</td>
							<td>36</td>
							<td>Use for booking courts 1-5 indoors</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="courtbox contacttimerate">
					<h3 class="title-box">Contract Time Rates</h3>
					<div class="clearfix">
						Note: Before setting rates, ensure that all holiday and closed days are entered into the calendar to ensure that the total days figure is calculated correctly
					</div>

					<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" class="form-court" id="form_search_contract_rate" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
					<div class="pull-left">
						<strong>Enter Price</strong>
						<input class="price_contract_rate form-control" placeholder="Enter Price" name="price_contract_rate" type="text">
						<span>Select hours from grid and press apply to adjust hours</span>
					</div>
					<div class="pull-right">
						<input class="btn btn-primary" type="submit" value="Apply">
					</div>
					</form>

					<div class="clearfix"></div>
					<table class="table table-bordered table-hover table-th clearfix" style="margin-top: 20px">
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
								<td class="td_field_label">5am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">6am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">7am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">8am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">9am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">10am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">11am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">12am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
																			<tr>
								<td class="td_field_label">1pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">2pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">3pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">4pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">5pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">6pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">7pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">8pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">9pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
													<tr>
								<td class="td_field_label">10pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
												</tbody>
					</table>
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
					<div class="col-xs-12 col-md-6">
						<h3 class="title-box">Allow Members Prices ? </h3>
						<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" id="form_allow_member_price" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">

						<input name="allow_member_price" type="radio" value="1">
						<label for=" ">Yes</label>

						<input name="allow_member_price" type="radio" value="0">
						<label for=" ">No</label>
						</form>
					</div>
				</div>
			</section>

			<section class="col-xs-12 col-md-5">
				<div class="courtbox contacttimeperiod">
					<h3 class="title-box">Create Contract Time Period</h3>
					<form method="POST" action="http://courtconnect.local/sadmin/users/create" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="My7S1d0Ttnzpw9U0SEC5sYIUh7zCUiHqDy93EJHA">
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
			</section>
		</div>
</template>
