@extends('admin.layouts.master')
@section('title_heading')
	Super Admin
@stop
@section('content')
	<div class="box box-primary">
		<div class="box-body">
		<report-setting
				:club-setting-id.sync="clubSettingId"
				></report-setting>
		</div>
	</div>
	<script>
		$(document).ready(function(){

		})
	</script>
@stop
