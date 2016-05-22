@extends('admin.layouts.master')
@section('title_heading')
	User & Teacher Manager
@stop
@section('content')

	<div class="box box-primary">
		<div class="box-body">
			<user-setting
					:club-setting-id = "clubSettingId"
					>
			</user-setting>
		</div>
	</div><!--end box data-->

@stop
