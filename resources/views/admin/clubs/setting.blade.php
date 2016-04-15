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
			<club-setting
				:club-setting-id = "clubSettingId"
			></club-setting>
		</div>
	</div>
	<script type="text/javascript">
		$(function() {
			$('.daterange').daterangepicker();
			$('#date_open').multiselect();
			$(".timepicker").timepicker();
			$('#monthly_opendays').monthly();

			$("#tabRate li").click(function(){
				$("#tabRate li").removeClass('active');
				$(this).addClass('active');
				$(".contentTab .content-item").slideUp();
				$($(this).attr('data-href')).slideDown();
			})
		});
	</script>
@stop
