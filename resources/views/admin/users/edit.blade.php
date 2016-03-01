@extends('admin.layouts.master')
@section('title_heading')
User Manager
@stop
@section('content')
<div class="box box-primary">
	<div class="box-header with-border content-header">
		<h3 class="box-title"><i class="fa fa-users"></i> Edit User </h3>
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Edit User</li>
		</ol>
	</div>
	<div class="box-body">
		<div class="col-xs-12">
			{!! Form::open(['route' => ['users.edit.post',$user->id], 'method' => 'POST','files' => true]) !!}
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
		          {{ Form::label('first_name', 'First name') }}
		          {{ Form::text('first_name', $user->first_name,['class'=>'form-control','placeholder'=>'Enter First name']) }}
		        </div>
		        <div class="form-group">
		          {{ Form::label('last_name', 'Last name') }}
		          {{ Form::text('last_name', $user->last_name,['class'=>'form-control','placeholder'=>'Enter Last name']) }}
		        </div>
						<div class="form-group">
		          {{ Form::label('username', 'User name') }}
		          {{ Form::text('username', $user->username,['class'=>'form-control','placeholder'=>'Enter user name']) }}
		        </div>
						<div class="form-group">
		          {{ Form::label('email', 'E-Mail address') }}
		          {{ Form::email('email', $user->email,['class'=>'form-control','placeholder'=>'Enter email']) }}
		        </div>
		        <div class="form-group">
		          {{ Form::label('password', 'Password') }}
		          {{ Form::password('password',['class'=>'form-control','placeholder'=>'Enter password']) }}
		        </div>

		        <div class="form-group">
		        	{!! Form::label('gender', 'Gender') !!}
		        	<div>
		        	<span>
		        		{!! Form::label('gender', 'Male') !!}
		        		{!! Form::radio('gender', '1', $user->gender, ['class' => 'field']) !!}
		        	</span>
		        	<span>
		        	{!! Form::label('gender', 'Female') !!}
		        	{!! Form::radio('gender', '0', $user->gender,['class' => 'field']) !!}
							</span>
							</div>
		        </div>
		        <div class="form-group">
		        	{{ Form::label('role', 'Role') }}
		        	{{
		        		Form::select('role', array('admin' => 'Adminstrator', 'user' => 'User'), 'user', array('class'=>'form-control'))
							}}
		        </div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<div class="kv-avatar center-block" style="width:200px">
						        <input id="avatar" name="avatar" type="file" class="file-loading">
						    </div>
							</div>
							<div class="form-group">
			          {{ Form::label('phone', 'Phone') }}
			          {{ Form::text('phone', $user->phone,['class'=>'form-control','placeholder'=>'Enter number phone']) }}
			        </div>

			        <div class="form-group">
			          {{ Form::label('facebook', 'Facebook') }}
			          {{ Form::text('facebook', $user->facebook,['class'=>'form-control','placeholder'=>'Enter facebook']) }}
			        </div>
			        <div class="form-group">
			          {{ Form::label('google', 'Google') }}
			          {{ Form::text('google', $user->google,['class'=>'form-control','placeholder'=>'Enter google']) }}
			        </div>
			        <div class="form-group">
			          {{ Form::label('zipcode', 'Zipcode') }}
			          {{ Form::number('zipcode', $user->zipcode,['class'=>'form-control','placeholder'=>'Enter zipcode']) }}
			        </div>
					</div>
				</div>
			</div>
	</div>
	<div class="box-footer">
		<div class="form-group">
			<button type="submit" class="btn btn-flat btn-default pull-right">Cancel</button>
      <button type="submit" class="btn btn-flat btn-primary pull-right">Update user</button>
		</div>
  </div>
			{!! Form::close() !!}


</div>

@stop
