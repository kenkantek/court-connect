@extends('admin.layouts.master')
@section('title_heading')
	Manager Bookings
@stop
@section('content')
	<div class="box box-primary">
		<div class="box-header with-border content-header">
			<h3 class="box-title"><i class="fa fa-users"></i>Manager Bookings</h3>
			<ol class="breadcrumb">
				<li><a href="{!! route('admin.index') !!}"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Manager Bookings</li>
			</ol>
		</div>
		<div class="box-body">
			<section class="col-xs-12 col-md-12">
				<div class="menu-action">
					<div class="pull-left" style="margin-bottom: 10px">
						<input type="text" class="datetimepicker" name="datebook">
					</div>
					<div class="pull-right" style="margin-bottom: 10px">
						<div class="btn btn-primary manage_multi_times">Manage Multiple Times</div>
						<div class="btn btn-primary create_new_book" data-toggle="modal" data-target="#myModal">Create New Booking</div>
					</div>
				</div>
				<div class="clearfix"></div>
				{!! Form::open(['method' => 'POST','files' => true, 'id'=>"form_search_booking"]) !!}
				<div class="pull-left col-xs-12 col-md-3">
					<h2 class="title-search">Find a Booking</h2>
				</div>
				<div class="pull-left col-xs-12 col-md-3">
					<div class="col-xs-12 col-md-10">
					{!! Form::label('reference_number', "Reference Number") !!}
					{!! Form::text('reference_number', old('reference_number'),['class'=>'form-control','name'=>'reference_number']) !!}
					</div>
					<div class="col-xs-12 col-md-2"><br><br> Or</div>
				</div>
				<div class="pull-left col-xs-12 col-md-3">
					{!! Form::label('customer_name', "Name") !!}
					{!! Form::text('customer_name', old('customer_name'),['class'=>'form-control','name'=>'customer_name']) !!}
				</div>
				<div class="pull-left col-xs-12 col-md-3">
					{!! Form::label(' ', ".",['style'=>'color: #fff']) !!}
					{!! Form::submit('Search',['class'=>'btn btn-primary','style'=>'display: block']) !!}
				</div>

				<div class="clearfix"></div>
				<div id="result_search">
					<h3 class="text-center">Search Results</h3>
					<table>
						<tr>
							<th>Booking Reference</th>
							<th>Customer Name</th>
							<th>Customer Phone</th>
							<th>Booking Details</th>
						</tr>
						<tr>
							<td>12345678</td>
							<td>Peter Vardy</td>
							<td>0123456789</td>
							<td>
								Court #1 - Friday 29th January 2016 @16:00
								<a href="#" class="viewbooking btn btn-primary">View</a>
								<a href="#" class="editbooking btn btn-primary">Edit</a>
								<a href="#" class="checkIn btn btn-primary">Check In</a>
							</td>
						</tr>
					</table>
				</div>
				{!! Form::close() !!}
			</section>

			<section class="col-xs-12 col-md-12" id="calendar_bookings">
				<div class="days-wrap">
					<div class="days-item" data-value="26/01/2016">Tuesday<span>29th Jan '16</span></div>
					<div class="days-item" data-value="26/01/2016">Wednesday<span>29th Jan '16</span></div>
					<div class="days-item" data-value="26/01/2016">Friday<span>29th Jan '16</span></div>
					<div class="days-item" data-value="26/01/2016">Saturday<span>29th Jan '16</span></div>
					<div class="days-item" data-value="26/01/2016">Sunday<span>29th Jan '16</span></div>
					<div class="days-item" data-value="26/01/2016">Monday<span>29th Jan '16</span></div>
				</div>
				<div id="day-view-content" class="day-view-content">
					<table class="grid-wrap table table-bordered table-th clearfix" style="margin-top: 20px; position: relative">
						<thead>
							<tr class="court-name-wrap">
								<th class="grid-header"></th>
								@for($i=1; $i<12; $i++)
									<th rowspan="2" class="grid-header">Court#{{$i}}</th>
								@endfor
							</tr>
						</thead>
						<tbody>
							<tr class="grid-row" data-row-hour="5am">
								<td rowspan="2" width="100" class="td_field_label">5am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid contracttime" data-hours="5am" data-court="1">Contract time</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="5:30am">
							</tr>

							<tr class="grid-row" data-row-hour="6am">
								<td rowspan="2" width="100" class="td_field_label">6am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Open Time Booking</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="5:30am">
							</tr>

							<tr class="grid-row" data-row-hour="7am">
								<td rowspan="2" width="100" class="td_field_label">7am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Open Time Booking</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid contracttime" data-hours="5am" data-court="1">Contract time</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="5:30am">
							</tr>

							<tr class="grid-row" data-row-hour="8am">
								<td rowspan="2" width="100" class="td_field_label">8am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Open Time Booking</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Open Time Booking</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid contracttime" data-hours="5am" data-court="1">Contract time</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="5:30am">
							</tr>

							<tr class="grid-row" data-row-hour="9am">
								<td rowspan="2" width="100" class="td_field_label">9am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Open Time Booking</td>
								<td rowspan="2" class="day-grid lesson" data-hours="5am" data-court="1">Lesson
								</td>
								<td rowspan="1" class="day-grid grid-null" data-hours="5am" data-court="1"></td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="5:30am">
								<td rowspan="1" class="day-grid grid-haft-top contracttime" data-hours="5am" data-court="1">Contract time1</td>
							</tr>

							<tr class="grid-row" data-row-hour="10am">
								<td rowspan="2" width="100" class="td_field_label">10am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="1" class="day-grid grid-haft-bottom contracttime" data-hours="5am" data-court="1">Contract time1</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="5:30am">
								<td></td>
							</tr>

							<tr class="grid-row" data-row-hour="11am">
								<td rowspan="2" width="100" class="td_field_label">11am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid contracttime" data-hours="5am" data-court="1">Contract time</td>
								<td rowspan="1" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid lesson" data-hours="5am" data-court="1">Lesson</td>
								<td rowspan="2" class="day-grid contracttime" data-hours="5am" data-court="1">Contract time</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="11:30am">
								<td class="day-grid grid-null"></td>
							</tr>

							<tr class="grid-row" data-row-hour="12am">
								<td rowspan="2" width="100" class="td_field_label">12am</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid unavailable" data-hours="5am" data-court="1"><strong>Unavailable</strong>
									<br> Court Maintinance
								</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Opentime</td>
								<td rowspan="2" class="day-grid contracttime" data-hours="5am" data-court="1">Contract time</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Opentime</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid opentime" data-hours="5am" data-court="1">Opentime</td>
								<td rowspan="2" class="day-grid contracttime" data-hours="5am" data-court="1">Contract time</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
								<td rowspan="2" class="day-grid available" data-hours="5am" data-court="1">Available</td>
							</tr>
							<tr class="grid-row" data-row-hour="5:30am">
							</tr>
						</tbody>
					</table>

					<!--
					<div class="grid-wrap">
						<div class="court-name-wrap">
							<div class="grid grid-null"></div>
							@for($i=1; $i<10; $i++)
								<div class="grid court-name">Court#{{$i}}</div>
							@endfor
						</div>
						<div class="grid-content-wap">
							<div class="grid-row">
								<div class="grid grid-hour grid-hour-text">5am</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available opentime">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
							</div>
							<div class="grid-row">
								<div class="grid grid-hour grid-hour-text">6am</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available leasson">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available opentime">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available opentime">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
							</div>
							<div class="grid-row">
								<div class="grid grid-hour grid-hour-text">7am</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour half"></div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
							</div>
							<div class="grid-row">
								<div class="grid grid-hour grid-hour-text">8am</div>
								<div class="grid grid-hour unvailable">Unvailable</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour contracttime">Contract time</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
							</div>
							<div class="grid-row">
								<div class="grid grid-hour grid-hour-text">8am</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour half_contracttime"></div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
								<div class="grid grid-hour available">Available</div>
							</div>

						</div>
					</div>
					-->
				</div>
			</section>

			<div class="clearfix"></div>

			<!-- available-slot-expanded -->
			<div class="available-slot-expanded" style="display: none">
				<div class="col-xs-8">
					<table class="table">
					<thead>
						<tr>
							<th>Quick Quotes</th>
							<th>8am-9pm <br> (1hour)</th>
							<th>8am-9pm <br> (1hour)</th>
							<th>8am-9pm <br> (1hour)</th>
							<th>8am-9pm <br> (1hour)</th>
							<th>8am-9pm <br> (1hour)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Member: </td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
						</tr>
						<tr>
							<td>Member: </td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
						</tr>
						<tr>
							<td>Member: </td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
							<td>$35</td>
						</tr>
					</tbody>
				</table>
				</div>
				<div class="col-xs-4">
					<div id="mb-make-time-unavailable">
						{!! Form::open(['method' => 'POST','files' => true,'class'=>'form-center', 'id'=>"form_make_unavailable"]) !!}
						<div class="btn btn-primary btn-mb-ex btn-in-expand icon-fa-angle-down icon-fa-make-unavailable">Make Time Unavailable</div>
						<div class="show-expand">
							{!! Form::label('input-reason','Enter Reason',['class'=>'text-center']) !!}
							{!! Form::text('input-reason','',['placeholder'=>'eg.Court Maintainance','class'=>'form-control','id'=>'input-reason']) !!}
							{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
						</div>
						{!! Form::close() !!}
					</div>
					<div id="mb-create-deal" style="margin-left: 20px" class="btn btn-primary btn-mb-ex icon-fa-star">Create Deal</div>
				</div>
			</div>
			<!-- end available-slot-expanded -->

			<!-- court booking-expanded -->
			<div class="court-booking-expanded">
				<div class="col-xs-3">
					<h3 class="title-part">Customer Details</h3>
					<table>
						<tr>
							<td align="right">Name:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Email:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Phone:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Address:</td>
							<td>Brian ABC</td>
						</tr>
					</table>
				</div>
				<div class="col-xs-3">
					<h3 class="title-part">Customer Details</h3>
					<table>
						<tr>
							<td align="right">Name:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Email:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Phone:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Address:</td>
							<td>Brian ABC</td>
						</tr>
					</table>
				</div>
				<div class="col-xs-3">
					<h3 class="title-part">Customer Details</h3>
					<table>
						<tr>
							<td align="right">Name:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Email:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Phone:</td>
							<td>Brian ABC</td>
						</tr>
						<tr>
							<td align="right">Address:</td>
							<td>Brian ABC</td>
						</tr>
					</table>
				</div>
				<div class="col-xs-3">
					<div id="mb-print-receipt" class="btn btn-primary btn-mb-ex icon-fa-print">Print Receipt</div>
					<div id="mb-accept-payment" class="btn btn-primary btn-mb-ex icon-fa-accept">Accept Payment</div>
					<div id="mb-check-players-in" class="btn btn-primary btn-mb-ex icon-fa-check">Check Players In</div>
					<div id="mb-edit-booking" class="btn btn-primary btn-mb-ex icon-fa-edit">Edit Booking</div>
					<div id="mb-cancel-booking" class="btn btn-primary btn-mb-ex btn-custom icon-fa-cancel">Cancel Booking</div>
				</div>
			</div>
			<!-- end court booking-expanded -->
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade mb-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
					<div id="mb-create-new-booking">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs mb-tabs" role="tablist">
							<li id="mb-booking-detail" role="presentation" class="active">Booking detail</li>
							<li id="mb-customer-details" role="presentation">Profile</li>
							<li id="mb-payment-details" role="presentation">Messages</li>
							<li id="mb-confirmation"role="presentation">Settings</li>
						</ul>
						<!-- Tab panes -->
						<div class=" mb-tab-content tab-content">
							<div role="tabpanel" class="tab-pane active" id="mb-tab-content-view">
								<div id="mb-booking-detail-content">
									<form action="">
										<div class="slc-type">
											<h4 class="mb-title-h4-modal text-center">Select a Booking Type</h4>
											<div class="col-xs-12 col-md-4">
												<input type="radio" name="book-type-opentime" id="book-type-opentime">
												<lable for="book-type-opentime">Open Time</lable>
											</div>
											<div class="col-xs-12 col-md-4">
												<input type="radio" name="book-type-opentime" id="book-type-opentime">
												<lable for="book-type-opentime">Contract Time</lable>
											</div>
											<div class="col-xs-12 col-md-4">
												<input type="radio" name="book-type-opentime" id="book-type-opentime">
												<lable for="book-type-opentime">Lesson</lable>
											</div>
										</div>
										<div class="slc-member">
											<h4 class="mb-title-h4-modal text-center">Member?</h4>
											<div class="col-xs-12 col-md-6 col-md-push-2">
												<input type="radio" name="book-member" id="book-member-yes">
												<lable for="book-member-yes">Yes</lable>
											</div>
											<div class="col-xs-12 col-md-6 col-md-pull-2">
												<input type="radio" name="book-member" id="book-member-no">
												<lable for="book-member-no">No</lable>
											</div>
										</div>
										<div class="slc-day-hour">
											<div class="col-xs-12 col-md-6">
												<input type="text" name="book-day" id="mb-book-day">
											</div>
											<div class="col-xs-12 col-md-6" style="margin: 20px 0px">
												<input id="mb-book-hour" class="ionslider" type="text" name="mb-book-hour" value="">
											</div>
										</div>
									</form>
								</div>
								<div id="mb-customer-details-content">
									<div class="info-booking-details">
										<h4 class="pull-left">Booking Details</h4>
										<a href="" id="mb-edit-booking-details" class="btn btn-primary"></a>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$(function() {
			$('.datetimepicker').datetimepicker({defaultDate: new Date(), format: 'DD/MM/YY'});
			var w_grid = ($('.days-wrap').width() - 100)/8;
			$('.day-view-content .day-grid').css('width',w_grid);
			$('.day-view-content .grid-wrap').css('width', w_grid * $('.day-view-content .court-name-wrap .grid-header').length);
			$('.daterange').daterangepicker();
			$(".day-view-content .day-grid.available").click(function(){
				$("#content-expand").remove();
				$(this).append('<div id="content-expand"><div class="available-slot-expanded">'+$('.available-slot-expanded').html()+'</div></div>');
				$("#content-expand").css('width',$(".day-view-content").width());
			})

			$(document).on("click",'.btn-in-expand',function(){ console.log("test");
				//console.log($(this).parent().find('.show-expand').html());
				$('.show-expand').slideToggle();
			});

			//test model open
			$(".create_new_book").click();

			$('#mb-book-day').datetimepicker({
				inline: true,
				sideBySide: false,
				format: 'YYYY-MM-DD',
			})
			$("#mb-book-hour").ionRangeSlider({
				min: 1,
				max: 7,
				type: 'single',
				step: 1,
				postfix: " Hour",
				prettify: false,
				hasGrid: false,
				hideMinMax: true,
			});
		});
	</script>
@stop
