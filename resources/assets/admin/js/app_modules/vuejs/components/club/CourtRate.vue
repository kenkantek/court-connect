<template>
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
</template>