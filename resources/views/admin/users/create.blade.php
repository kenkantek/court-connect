@extends('admin.layouts.master')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border content-header">
		<h3 class="box-title"><i class="fa fa-users"></i> Create New User</h3>
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Create New User</li>
		</ol>
	</div>
	<div class="box-body">
		<div class="col-xs-12">
			{!! Form::open(['route' => 'users.list', 'method' => 'POST']) !!}
			
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop