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
				<div class="days-in-month-wrap">
					<div class="days">
					</div>
					<div class="days-in-month-control">
						<div id="next-day-in-month"> > </div>
						<div id="prev-day-in-month"> < </div>
					</div>
				</div>
				<div class="clearfix"></div>
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
										<div class="slc-type mb-group-sl">
											<h4 class="mb-title-h4-modal text-center">Select a Booking Type</h4>
											<div class="col-xs-12 col-md-4">
												<input type="radio" name="book-type" value="open" id="book-type-open">
												<lable for="book-type-opentime">Open Time</lable>
											</div>
											<div class="col-xs-12 col-md-4">
												<input type="radio" name="book-type" value="contract" id="book-type-contract">
												<lable for="book-type-contract">Contract Time</lable>
											</div>
											<div class="col-xs-12 col-md-4">
												<input type="radio" name="book-type" value="lesson" id="book-type-lesson">
												<lable for="book-type-lesson">Lesson</lable>
											</div>
										</div>
										<div class="slc-member mb-group-sl">
											<h4 class="mb-title-h4-modal text-center">Member?</h4>
											<div class="col-xs-12 col-md-6">
												<input type="radio" name="book-member" id="book-member-yes">
												<lable for="book-member-yes">Yes</lable>
											</div>
											<div class="col-xs-12 col-md-6">
												<input type="radio" name="book-member" id="book-member-no">
												<lable for="book-member-no">No</lable>
											</div>
										</div>
										<div class="slc-day-hour">
											<div class="col-xs-12 col-md-6">
												<div class="slc-type-open slc-type-lesson slc-type-group">
													<h4 class="mb-title-h4-modal text-center">Select a Date</h4>
													<input type="text" class="form-control" name="mb-book-day-open" id="mb-book-day-open">
												</div>
												<div class="slc-type-contract slc-type-group">
													<h4 class="mb-title-h4-modal text-center">Select a Date Period</h4>
													<input type="text" class="form-control" name="mb-book-day-contract" id="mb-book-day-contract">
													<h4 class="mb-title-h4-modal text-center">Start Day</h4>
													<select name="mb-book-start-day-contract" class="form-control">
														<option value="mon">Monday</option>
														<option value="tue">Tuesday</option>
														<option value="web">Wednesday</option>
														<option value="thu">Thursday</option>
														<option value="fri">Friday</option>
														<option value="sat">Saturday</option>
														<option value="sun">Sunday</option>
													</select>
												</div>
											</div>
											<div class="col-xs-12 col-md-6">
												<h4 class="mb-title-h4-modal text-center">Select a Time</h4>
												<select name="mb-book-hour" class="form-control">
													@for($i=5; $i<13; $i++)
														<option value="{{$i}}am">{{$i}}AM</option>
													@endfor
													@for($i=1; $i<12; $i++)
														<option value="{{$i}}pm">{{$i}}PM</option>
													@endfor
												</select>
												<h4 class="mb-title-h4-modal text-center">length</h4>
												<input id="mb-book-in-hour" class="ionslider" type="text" name="mb-book-in-hour" value="">
											</div>
										</div>

										<div class="clearfix"></div>
										<div class="mb-group-sl slc-type-contract slc-type-group">
											<div class="col-xs-12 col-md-12">
												<span>Total day: 35</span>
											</div>
										</div>

										<div class="mb-group-sl">
											<div class="col-xs-12 col-md-12" style="margin: 20px 0px">
												<h4 class="mb-title-h4-modal text-center">Select a Court</h4>
												<select name="mb-book-court" class="form-control">
													@for($i=1; $i<110; $i++)
														<option value="{{$i}}">Court #{{$i}}</option>
													@endfor
												</select>
											</div>
										</div>
										<div class="mb-group-sl slc-type-contracttime slc-type-group">
											<div class="col-xs-12 col-md-12">
												<h4 class="mb-title-h4-modal text-center">Extras</h4>
												<input type="checkbox" class="styled">
												<label for="">Balls($10</label>
											</div>
										</div>
										<div class="mb-group-sl slc-type-lesson slc-type-group">
											<div class="col-xs-12 col-md-12">
												<h4 class="mb-title-h4-modal text-center">Choose a Teacher</h4>
												<select name="mb-book-teacher" class="form-control">
													@for($i=1; $i<110; $i++)
														<option value="{{$i}}">Teacher #{{$i}}</option>
													@endfor
												</select>
											</div>
										</div>

										<div class="clearfix"></div>
										<div class="mb-group-sl">
											<div class="col-xs-12 col-md-12">
												<h4 class="mb-title-h4-modal text-center">Order Total: <strong>$45</strong></h4>
											</div>
										</div>

										<div class="clearfix"></div>
										<div class="mb-group-sl">
											<div class="col-xs-12 col-md-12">
												<div class="pull-right">
													<input type="submit" value="Submit" class="btn btn-primary">
												</div>
											</div>
										</div>
									</form>
								</div>

								<div class="clearfix"></div>
								<div id="mb-customer-details-content">
									<div class="info-booking-details">
										<h4 class="bold pull-left">Booking Details</h4>
										<a href="" id="mb-edit-booking-details" class="btn btn-primary pull-right">Edit</a>
										<hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
									</div>
									<div class="clearfix"></div>
									<table class="tbl-info-booking-details" style="width: 100%">
										<tr>
											<td>
												<div>Booking Type: <b>Open Court</b></div>
												<div>Member: <b>Yes</b></div>
											</td>

											<td>
												<div>Date: <b>Friday </b></div>
												<div>Time: <b>9:00am</b></div>
												<div>Length: <b>1 Hour</b></div>
											</td>

											<td>
												<div>Court: <b>Court#1</b></div>
											</td>
											<td>
												<div>Cost: <b>$45</b></div>
											</td>
										</tr>
									</table>
									<div class="info-customers-details">
										<h4 class="pull-left bold">Customer Details</h4>
										<hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
										{!! Form::open(['method' => 'POST','files' => true]) !!}
										<div class="form-group">
											{!! Form::label('surname','Customer Lookup') !!}
											{!! Form::text('surname','',['class'=>'form-control','placeholder'=>'Surname']) !!}
										</div>
										<div class="form-group pull-left">
											{!! Form::label('title','Title *') !!}
											{!! Form::text('title','',['class'=>'form-control','placeholder'=>'Title']) !!}
										</div>
										<div class="form-group pull-left">
											{!! Form::label('firstname','Fist Name *') !!}
											{!! Form::text('firstname','',['class'=>'form-control','placeholder'=>'First name']) !!}
										</div>
										<div class="form-group pull-left">
											{!! Form::label('lastname','Last Name *') !!}
											{!! Form::text('lastname','',['class'=>'form-control','placeholder'=>'Lastname']) !!}
										</div>
										<div class="form-group clearfix">
											{!! Form::label('zipcode','Zipcode *') !!}
											{!! Form::text('title','',['class'=>'form-control','placeholder'=>'Enter Zip Code','style'=>'width: 50%; margin-right: 10px;']) !!}
											{!! Form::button('Address Lookup',['class'=>'btn btn-primary']) !!}
										</div>
										<div class="form-group">
											{!! Form::label('address1','Address 1 *') !!}
											{!! Form::text('address1','',['class'=>'form-control','placeholder'=>'Address Line 1']) !!}
										</div>
										<div class="form-group">
											{!! Form::label('address2','Address 2 *') !!}
											{!! Form::text('address2','',['class'=>'form-control','placeholder'=>'Address Line 2']) !!}
										</div>
										<div class="form-group">
											{!! Form::label('city','City *') !!}
											{!! Form::text('city','',['class'=>'form-control','placeholder'=>'City']) !!}
										</div>
										<div class="form-group">
											{!! Form::label('state','State *') !!}
											{!! Form::text('state','',['class'=>'form-control','placeholder'=>'State']) !!}
										</div>
										<div class="form-group">
											{!! Form::label('email','Email *') !!}
											{!! Form::text('email','',['class'=>'form-control','placeholder'=>'State']) !!}
										</div>
										<div class="form-group">
											{!! Form::label('phone','Phone *') !!}
											{!! Form::text('phone','',['class'=>'form-control','placeholder'=>'Phone']) !!}
										</div>
										<div class="form-group">
											{!! Form::submit('Next',['class'=>'btn btn-primary pull-right']) !!}
										</div>

										{!! Form::close() !!}
									</div>
								</div>

								<div class="clearfix"></div>
								<div id="mb-payment-details-content">
									<div class="info-booking-details">
										<h4 class="bold pull-left">Booking Details</h4>
										<a href="" id="mb-edit-booking-details" class="btn btn-primary pull-right">Edit</a>
										<hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
									</div>

									<div class="clearfix"></div>
									<table class="tbl-info-booking-details" style="width: 100%">
										<tr>
											<td>
												<div>Booking Type: <b>Open Court</b></div>
												<div>Member: <b>Yes</b></div>
											</td>

											<td>
												<div>Date: <b>Friday </b></div>
												<div>Time: <b>9:00am</b></div>
												<div>Length: <b>1 Hour</b></div>
											</td>

											<td>
												<div>Court: <b>Court#1</b></div>
											</td>
											<td>
												<div>Cost: <b>$45</b></div>
											</td>
										</tr>
									</table>
									<div class="info-customers-details">
										<div class="info-booking-details">
											<h4 class="bold pull-left">Booking Details</h4>
											<a href="" id="mb-edit-booking-details" class="btn btn-primary pull-right">Edit</a>
											<hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
										</div>
										<div class="clearfix"></div>
										<table style="width: 100%">
											<tr>
												<td>Name: </td>
												<td>Mr Anthony Cooper</td>
											</tr>
											<tr>
												<td>Address: </td>
												<td>ABC</td>
											</tr>
											<tr>
												<td>Email: </td>
												<td>abc@gmail.com</td>
											</tr>
											<tr>
												<td>Tel: </td>
												<td>0123456789</td>
											</tr>
										</table>
									</div>

									<div class="info-payment-details">
										<h4 class="bold pull-left">Payment Details</h4>
										<hr style="clear: both; margin-top: 0px; border: 1px solid #ddd;">
										<div class="clearfix"></div>
										{!! Form::open(['method' => 'POST','files' => true]) !!}
										<div class="form-group">
											<div class="col-xs-12 col-md-3">
												{!! Form::label('cost-adjustment','Cost Adjustment') !!}
												{!! Form::text('cost-adjustment','',['class'=>'form-control','placeholder'=>'-$10']) !!}
											</div>
											<div class="col-xs-12 col-md-9">
												{!! Form::label('adjustment-reason','Adjustment Reason') !!}
												{!! Form::text('adjustment-reason','',['class'=>'form-control','placeholder'=>'eg. Manager Discount']) !!}
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<div class="pull-left payment-item">
												<div class="img-wrap">
													<img src="{{url('/resources/admin/img/icon_payment_mastercard.png') }}" alt="mastercard">
												</div>
												<input name="payment" type="radio" value="mastercard" id="mastercard">
												<label for="mastercard">Mastercard</label>
											</div>
											<div class="pull-left payment-item">
												<div class="img-wrap">
												<img src="{{url('/resources/admin/img/icon_payment_visa.png') }}" alt="visa">
												</div>
												<input name="payment" type="radio" value="visa" id="visa">
												<label for="visa">Visa</label>
											</div>
											<div class="pull-left payment-item" style="width: 32%">
												<div class="img-wrap">
													<img src="{{url('/resources/admin/img/icon_payment_emerican_express.png') }}" alt="american-express">
												</div>
												<input name="payment" type="radio" value="american-express" id="american-express">
												<label for="mastercard">American Express</label>
											</div>
											<div class="pull-left payment-item">
												<div class="img-wrap">
													<img src="{{url('/resources/admin/img/icon_payment_discover.png') }}" alt="discover">
												</div>
												<input name="payment" type="radio" value="discover" id="discover">
												<label for="discover">Discover</label>
											</div>
											<div class="pull-left payment-item">
												<div class="img-wrap">
													<img src="{{url('/resources/admin/img/icon_payment_cash.png') }}" alt="cash">
												</div>
												<input name="cash" type="radio" value="cash" id="cash">
												<label for="mastercard">Cash</label>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<div class="pull-left">
												<label for="card-number">Card Number</label>
												<input type="text" name="card-number" class="form-control" id="card-number" placeholder="12345672234566" style="width: 240px;">
											</div>
											<div class="pull-left">
												<label for="card-expiry">Expiry</label>
												<input type="text" name="card-expiry" class="form-control" id="card-expiry" placeholder="06/17" style="width: 120px; margin: 0px 10px;">
											</div>
											<div class="pull-left">
												<label for="card-cvv">CVV*</label>
												<input type="text" name="card-cvv" class="form-control" id="card-expiry" placeholder="123" style="width: 100px; margin-right: 10px;">
											</div>
											<div class="pull-right">
												<img src="{{url('/resources/admin/img/icon_payment-cart.png') }}" alt="card" style="margin-top: 25px;" >
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="">
											<input type="submit" value="Next" class="btn btn-primary pull-right">
										</div>
										{!! Form::close() !!}
									</div>
									<div class="clearfix"></div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$(function() {

			//calendar
			function getDaysInMonth(month, year) {
				// Since no month has fewer than 28 days
				var date = new Date(year, month, 1)
				var days = [];
				while (date.getMonth() === month) {
					days.push(new Date(date));
					date.setDate(date.getDate() + 1);
				}
				return days;
			}

			var daysInMonth = getDaysInMonth(3,2016);
			var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
			var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			daysInMonth.forEach(function(date, index){
				var month = date.getMonth();
				var day = date.getDate();
				var year = date.getFullYear();
				$("#calendar_bookings .days-in-month-wrap .days").append('<div class="day-item" data-value="'+day+'/'+month+'/'+year+'">'+weekday[date.getDay()]+'<br><span>'+day+' '+ monthNames[month-1] + ' '+year+ ' </span></div>');
			});
			var w_grid = ($('#calendar_bookings .days-in-month-wrap').width())/7;
			$('#calendar_bookings .days .day-item').css('width',w_grid);
			$('#calendar_bookings .days-in-month-wrap .days').css({'width':w_grid * $('#calendar_bookings .days .day-item').length,'margin-left':0});

			$("body").on('click','#next-day-in-month',function(){
				var w_left = parseInt($('#calendar_bookings .days-in-month-wrap .days').css('margin-left'));
				w_grid = ($('#calendar_bookings .days-in-month-wrap').width())/7;
				w_left -= w_grid;
				$('#calendar_bookings .days-in-month-wrap .days').css('margin-left',w_left);
			});

			$("body").on('click','#prev-day-in-month',function(){
				var w_left = parseInt($('#calendar_bookings .days-in-month-wrap .days').css('margin-left'));
				w_grid = ($('#calendar_bookings .days-in-month-wrap').width())/7;
				w_left += w_grid;
				if(w_left > 3 )
					return;
				$('#calendar_bookings .days-in-month-wrap .days').css('margin-left',w_left);
			});


			// end calendar

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
			//$(".create_new_book").click();

			$('#mb-book-day-open').datetimepicker({
				inline: true,
				sideBySide: false,
				format: 'DD/MM',
			});
			$('#card-expiry').datetimepicker({
				format: 'YYYY-MM-DD',
			})
			$('#mb-book-day-contract').daterangepicker()
			$("#mb-book-in-hour").ionRangeSlider({
				min: 1,
				max: 7,
				type: 'single',
				step: 1,
				postfix: " Hour",
				prettify: false,
				hasGrid: true,
				hideMinMax: true,
			});
			$(".irs-slider.single").css('background',"abc");

			$("input[name='book-type']").on('change',function(){
				$(".slc-type-group").addClass('hidden');
				$(".slc-type-" + $(this).val()).removeClass('hidden');
			});
			//$("#book-type-open").prop("checked", true);
			$("#book-type-open").click();
		});
	</script>
@stop
