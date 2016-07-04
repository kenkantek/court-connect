@extends('admin.layouts.master')
@section('title_heading')
	Club Settings
@stop
@section('content')
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>

	<div class="box box-primary">
		<div class="row box-body">
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
