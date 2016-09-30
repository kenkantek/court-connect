@extends('admin.layouts.master')
@section('title_heading')
	Super Admin
@stop
@section('content')
	<div class="box box-primary" style="box-shadow: none">
		<div class="box-body">
		<super-setting
				:clubs.sync="clubs"
				:club-setting-id.sync="clubSettingId"
				:delete_club.sync = "delete_club"
				></super-setting>
		</div>
	</div>

	<script type="text/javascript">

		jQuery(document).ready(function($) {
			$(".box.box-primary").css('min-height', $("#lch-form-new-club").height() + 70)
		});
	</script>
@stop
