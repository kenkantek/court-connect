@extends('admin.layouts.master')
@section('title_heading')
	Super Admin
@stop
@section('content')

	<div class="box box-primary">
		<div class="box-header with-border content-header">
			<h3 class="box-title"><i class="fa fa-users"></i> Super Admin Setting</h3>
			<ol class="breadcrumb">
				<li><a href="{!! route('admin.index') !!}"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Super Admin Setting</li>
			</ol>
		</div>
		<div class="box-body">
		<report-setting
				:club-setting-id.sync="clubSettingId"
				></report-setting>
		</div>
	</div>

@stop
