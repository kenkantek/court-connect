@extends('admin.layouts.master')
@section('title_heading')
	Teacher Manager
@stop
@section('content')

	<div class="box box-primary">
		<div class="box-body">
			<teacher-setting
					:club-setting-id = "clubSettingId"
					>
			</teacher-setting>
		</div>
	</div><!--end box data-->

@stop
