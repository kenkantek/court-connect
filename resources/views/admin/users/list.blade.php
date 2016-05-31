@extends('admin.layouts.master')
@section('title_heading')
	User Manager
@stop
@section('content')

	<div class="box box-primary">
		<div class="box-body">
			<user-setting
					:club-setting-id = "clubSettingId"
					:clubs = "clubs"
					>
			</user-setting>
		</div>
	</div><!--end box data-->
	<script>
		$(document).ready(function(){
			$('#cc-ms').change(function() {
			}).multipleSelect({
				width: '100%',
			});
		})
	</script>
@stop
