@extends('admin.layouts.master')
@section('title_heading')
	Super Admin
@stop
@section('content')
	<div class="box box-primary">
		<div class="box-body">
		<super-setting
				:clubs.sync="clubs"
				:club-setting-id.sync="clubSettingId"
				:delete_club.sync = "delete_club"
				></super-setting>
		</div>
	</div>

@stop
