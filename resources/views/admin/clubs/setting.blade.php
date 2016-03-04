@extends('admin.layouts.master')
@section('title_heading')
	Club Settings
@stop
@section('content')
	<div class="box box-primary">
		<div class="box-header with-border content-header">
			<h3 class="box-title"><i class="fa fa-users"></i> Club Settings</h3>
			<ol class="breadcrumb">
				<li><a href="{!! route('admin.index') !!}"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Club Settings</li>
			</ol>
		</div>
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
							<td><input type="checkbox" class="styled court-item-check" data-value=""></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						<tr>
							<td><input type="checkbox" class="styled court-item-check" data-value=""></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						<tr>
							<td><input type="checkbox" class="styled court-item-check" data-value=""></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						<tr>
							<td><input type="checkbox" class="styled court-item-check" data-value=""></td>
							<td>Court#1</td>
							<td>Indoor</td>
							<td>Hard</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="court_new courtbox">
					<h3 class="title-box">Add New Court</h3>
					{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true]) !!}
					<table>
						<tr>
							<td width="30%">{!! Form::label('name', 'Court Name *') !!}</td>
							<td>{!! Form::text('name', old('name'),['class'=>'form-control','placeholder'=>'Court name']) !!}</td>
						</tr>
						<tr>
							<td>{!! Form::label('last_name', 'Indoor/Outdoor? *') !!}</td>
							<td>{!!
					Form::select('indoor_outdoor', array('indoor' => 'Indoor', 'outdoor' => 'Outdoor'), 'user', array('class'=>'select-full form-control'))
                    !!}
							</td>
						</tr>
						<tr>
							<td>{!! Form::label('surface_type', 'Surface Type *') !!}</td>
							<td>{!!
					Form::select('surface_type', array('hard' => 'Hard'), 'user', array('class'=>'form-control select-full'))
                    !!}</td>
						</tr>
						<tr>
							<td>{!! Form::label('basic_price', 'Basic Price *') !!}</td>
							<td>{!!
					Form::select('basic_price', array('1' => 'Base off Court#2 Rates'), 'user', array('class'=>'form-control select-full'))
                    !!}
							</td>
						</tr>
						<tr>
							<td></td>
							<td>When creating a new court you can set the initial prices to match a previously created court. Select the court
								you'd like to copy the prices from.
								<br>
								{!! Form::submit("Add Court",['class'=>'btn btn-primary pull-right']) !!}
							</td>
						</tr>
					</table>
					{!! Form::close() !!}
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
										{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true, 'class'=>'form-court', 'id'=>"form_add_date_period"]) !!}
										<div class="pull-left">
											<strong>Select Date Range</strong>
											{!! Form::text('daterange_period', old('daterange_period'),['class'=>'daterange form-control','name'=>'daterange_period']) !!}
										</div>
										<br>
										<div class="pull-right">
											{!! Form::submit("Apply",['class'=>'btn btn-primary']) !!}
										</div>
										{!! Form::close() !!}
									</div>
								</div>
							</div>

							{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true, 'class'=>'form-court', 'id'=>"form_search_rate"]) !!}
							<div class="pull-left">
								<strong>Date Period</strong>
								{!! Form::text('daterange_rate', old('daterange_rate'),['class'=>'daterange form-control','name'=>'daterange_rate']) !!}
							</div>
							<div class="clearfix"></div>
							<br>
							<div class="pull-left">
								<strong>Enter Price</strong>
								{!! Form::text('price', old('price'),['class'=>'price form-control','placeholder'=>'Enter Price']) !!}
								<span>Select hours from grid and press apply to adjust hours</span>
							</div>
							<div class="pull-right">
								{!! Form::submit("Apply",['class'=>'btn btn-primary']) !!}
							</div>
							{!! Form::close() !!}

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
								@for($i=5; $i<13; $i++)
									<tr>
										<td class="td_field_label">{!! $i !!}am</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
								@endfor
								@for($i=1; $i<11; $i++)
									<tr>
										<td class="td_field_label">{!! $i !!}pm</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
										<td>$20</td>
									</tr>
								@endfor
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
					{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true, 'id'=>"form_set_openday"]) !!}
					<div class="pull-left form-box">
						{!! Form::label('date', 'Select day(s) of the week') !!}
						<br>
						{!! Form::select('date_open',array(
                            'mon'=> 'Monday',
                            'tue'=> 'Tuesday',
                            'wed'=> 'Wednesday',
                            'thur'=> 'Thursday',
                            'fri'=> 'Friday',
                            'sat'=> 'Saturday',
                            'sun'=> 'Sunday'
                            ),null,['class' =>'form-control','name'=>'date_open','id'=>'date_open','multiple'=>'multiple']) !!}
					</div>
					<div class="pull-left form-box">
						{!! Form::label('daterange_open', 'Date range') !!}
						{!! Form::text('daterange_open', old('daterange_open'),['class'=>'daterange form-control','name'=>'daterange_open']) !!}
					</div>
					<div class="pull-left form-box">
						{!! Form::label('opentime', 'Open Time') !!}
						{!! Form::text('opentime', old('opentime'),['id'=>'opentime','class'=>'timepicker opentime form-control','placeholder'=>'']) !!}
					</div>
					<div class="pull-left form-box">
						{!! Form::label('closetime', 'Closing Time') !!}
						{!! Form::text('closetime', old('closetime'),['class'=>'timepicker closetime form-control','placeholder'=>'']) !!}
					</div>
					<div class="pull-left">
						<br>
						{!! Form::submit("Apply",['class'=>'btn btn-primary','style'=>'margin-top: 6px;']) !!}
					</div>
					{!! Form::close() !!}
				</div>

				<div class="calendar-box">
					<div class="monthly" id="monthly_opendays"></div>
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

					{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true,'class'=>'form-court', 'id'=>"form_search_contract_rate"]) !!}
					<div class="pull-left">
						<strong>Enter Price</strong>
						{!! Form::text('price_contract_rate', old('price_contract_rate'),['class'=>'price_contract_rate form-control','placeholder'=>'Enter Price']) !!}
						<span>Select hours from grid and press apply to adjust hours</span>
					</div>
					<div class="pull-right">
						{!! Form::submit("Apply",['class'=>'btn btn-primary']) !!}
					</div>
					{!! Form::close() !!}

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
						@for($i=5; $i<13; $i++)
							<tr>
								<td class="td_field_label">{!! $i !!}am</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
						@endfor
						@for($i=1; $i<11; $i++)
							<tr>
								<td class="td_field_label">{!! $i !!}pm</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
								<td>$20</td>
							</tr>
						@endfor
						</tbody>
					</table>
				</div>

				<div class="courtbox extras">
					<div class="col-xs-12 col-md-6">
						<h3 class="title-box pull-left">Extras</h3>
						<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Add Extra</a>
						{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true, 'id'=>"form_add_extra"]) !!}
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
								<td>{!! Form::text('extra_name', old('extra_name'),['class'=>'extra_name form-control','name'=>'extra_name']) !!}</td>
								<td>{!! Form::text('extra_cost', old('extra_cost'),['class'=>'extra_cost form-control','name'=>'extra_cost']) !!}</td>
							</tr>
							</tbody>
						</table>
						{!! Form::close() !!}
					</div>
					<div class="col-xs-12 col-md-6">
						<h3 class="title-box">Allow Members Prices ? </h3>
						{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true, 'id'=>"form_allow_member_price"]) !!}

						{!! Form::radio('allow_member_price', '1') !!}
						{!! Form::label(' ', 'Yes') !!}

						{!! Form::radio('allow_member_price', '0') !!}
						{!! Form::label(' ', 'No') !!}
						{!! Form::close() !!}
					</div>
				</div>
			</section>

			<section class="col-xs-12 col-md-5">
				<div class="courtbox contacttimeperiod">
					<h3 class="title-box">Create Contract Time Period</h3>
					{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true]) !!}
					<table>
						<tr>
							<td width="30%">{!! Form::label('start_date', 'Start Date *') !!}</td>
							<td>{!! Form::text('start_date', old('start_date'),['class'=>'form-control','placeholder'=>'First Day of the Contract Period']) !!}</td>
						</tr>
						<tr>
							<td width="30%">{!! Form::label('end_date', 'End Date *') !!}</td>
							<td>{!! Form::text('end_date', old('end_date'),['class'=>'form-control','placeholder'=>'Last Day of the Contract Period']) !!}</td>
						</tr>
						<tr>
							<td width="30%">{!! Form::label('total_week', 'Total Weeks *') !!}</td>
							<td>34</td>
						</tr>
						<tr>
							<td width="30%">{!! Form::label('notes', 'Notes *') !!}</td>
							<td>{!! Form::text('notes', old('notes'),['class'=>'form-control','placeholder'=>'Some test notes can go here']) !!}</td>
						</tr>
						<tr>
							<td></td>
							<td>
								{!! Form::submit("Create Contract Time",['class'=>'btn btn-primary pull-right']) !!}
							</td>
						</tr>
					</table>
					{!! Form::close() !!}
				</div>
			</section>
		</div>
	</div>
	<script type="text/javascript">
		$(function() {
			$('.daterange').daterangepicker();
			$('#date_open').multiselect();
			$("#opentime, #closetime").timepicker();
			$('#monthly_opendays').monthly();
			$('#monthly_opendays .monthly-day[data-number="16"] .monthly-indicator-wrap').html("close").parent().addClass('day_close');
			$('#monthly_opendays .monthly-day[data-number="23"] .monthly-indicator-wrap').html("Holiday<br>6am-8pm").parent().addClass('day_holiday');
			$('#monthly_opendays .monthly-day[data-number="1"] .monthly-indicator-wrap')
					.html('<div class="overflow"><div class="btn-close action"><img src="{{url('/resources/admin/img/close_icon.png') }}" alt=""></div> <div class="btn-plane action"><img src="{{url('/resources/admin/img/plane_icon.png') }}" alt=""></div> <div class="btn-clock action"><img src="{{url('/resources/admin/img/clock_icon.png') }}" alt=""></div> </div> ');

			$("#tabRate li").click(function(){
				$("#tabRate li").removeClass('active');
				$(this).addClass('active');
				$(".contentTab .content-item").slideUp();
				$($(this).attr('data-href')).slideDown();
			})
		});
	</script>
@stop
