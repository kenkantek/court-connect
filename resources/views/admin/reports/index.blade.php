@extends('admin.layouts.master')
@section('title_heading')
	Super Admin
@stop
@section('content')
	<div class="box box-primary">
		<div class="box-body">
		<report-setting
				:club-setting-id.sync="clubSettingId",
				:clubs.sync="clubs",
				:club-setting-index.sync="clubSettingIndex"
				></report-setting>
		</div>
	</div>
	<script>
		$(document).ready(function(){

		})
	</script>
@stop
