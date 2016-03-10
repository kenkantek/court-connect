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
			<club-setting club-id="{!! $club->id !!}"></club-setting>
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
