@extends('admin.layouts.master')
@section('title_heading')
	User Manager
@stop
@section('content')

	<div class="box box-primary">
		<div class="box-header with-border content-header">
			<h3 class="box-title"><i class="fa fa-users"></i>User list</h3>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">List users</li>
			</ol>
		</div>
		<div class="box-body">
			<user-setting
					:club-setting-id = "clubSettingId"
					>
			</user-setting>
		</div>
	</div><!--end box data-->

@stop
