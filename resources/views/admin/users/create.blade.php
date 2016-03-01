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
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
		          {{ Form::label('firstname', 'First name') }}
		          {{ Form::text('firstname', old('firstname'),['class'=>'form-control','placeholder'=>'Enter First name']) }}
		        </div>
		        <div class="form-group">
		          {{ Form::label('lastname', 'Last name') }}
		          {{ Form::text('lastname', old('lastname'),['class'=>'form-control','placeholder'=>'Enter Last name']) }}
		        </div>
						<div class="form-group">
		          {{ Form::label('username', 'User name') }}
		          {{ Form::text('username', old('username'),['class'=>'form-control','placeholder'=>'Enter user name']) }}
		        </div>
						<div class="form-group">
		          {{ Form::label('email', 'E-Mail address') }}
		          {{ Form::email('email', old('email'),['class'=>'form-control','placeholder'=>'Enter email']) }}
		        </div>
		        <div class="form-group">
		          {{ Form::label('password', 'Password') }}
		          {{ Form::text('password',null,['class'=>'form-control','placeholder'=>'Enter password']) }}
		        </div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
			          {{ Form::label('phone', 'Phone') }}
			          {{ Form::text('phone', old('phone'),['class'=>'form-control','placeholder'=>'Enter number phone']) }}
			        </div>

			        <div class="form-group">
			          {{ Form::label('facebook', 'Facebook') }}
			          {{ Form::text('facebook', old('facebook'),['class'=>'form-control','placeholder'=>'Enter facebook']) }}
			        </div>
			        <div class="form-group">
			          {{ Form::label('google', 'Google') }}
			          {{ Form::text('google', old('google'),['class'=>'form-control','placeholder'=>'Enter google']) }}
			        </div>
			        <div class="form-group">
			          {{ Form::label('zipcode', 'Zipcode') }}
			          {{ Form::number('zipcode', old('zipcode'),['class'=>'form-control','placeholder'=>'Enter zipcode']) }}
			        </div>
					</div>
				</div>
			</div>
	</div>
	<div class="box-footer">
                <button type="submit" class="btn btn-flat btn-default">Cancel</button>
                <button type="submit" class="btn btn-flat btn-primary pull-right">Add user</button>
              </div>
			{!! Form::close() !!}

</div>
@stop
