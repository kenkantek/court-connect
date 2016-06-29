@extends('admin.layouts.master')
@section('title_heading')
	Club Settings
@stop
@section('content')
	<div class="box box-primary">
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
			$(function(argument) {
				$('#lch-same_price').bootstrapSwitch();
			})
		});
	</script>
@stop
