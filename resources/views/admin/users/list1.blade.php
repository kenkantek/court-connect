@extends('admin.layouts.master')
@section('title_heading')
User Manager
@stop
@section('content')
<div class="row">
		<div class="col-xs-12 col-md-7">
			<div class="box box-primary">
				<div class="box-header with-border content-header">
					<h3 class="box-title"><i class="fa fa-users"></i>User list</h3>
					<ol class="breadcrumb">
						<li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">List users</li>
					</ol>
				</div>
				<div class="box-body">

						<table class="table table-bordered" id="datatables">
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Email</th>
									<th>Is Admin?</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="7" class="dataTables_empty">Data loading...</td>
								</tr>
							</tbody>
						</table>
				</div>
			</div><!--end box data-->
		</div>
		<div class="col-xs-12 col-md-5">
				<div class="box box-primary" id="box-form-create">
        <div class="box-header with-border">
          <h3 class="box-title">Add New User</h3>
        </div>
				{!! Form::open(['route' => 'users.create.post', 'method' => 'POST','files' => true , 'class' => 'form-horizontal' , 'id' => 'form-user']) !!}
					<input type="hidden" name="user_id" id="user_id">
					<div class="box-body">
			      <div class="form-group">
							{!! Form::label('fullname', 'Name' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!! Form::text('fullname', old('fullname'),['class'=>'form-control','placeholder'=>'Enter full name','id'=>'fullname'])	 !!}
              </div>
            </div>
            <div class="form-group">
							{!! Form::label('password', 'Password' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Create a password','id'=>'password'])	 !!}
              </div>
            </div>
            <div class="form-group">
							{!! Form::label('email', 'Email' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!! Form::text('email', old('email'),['class'=>'form-control','placeholder'=>'Enter word Email Address','id'=>'email'])	 !!}
              </div>
            </div>
            <div class="form-group">
							{!! Form::label('is_admin', 'Is Admin?' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!!Form::checkbox('is_admin', '1', false,['id'=>'is_admin','class'=>'styled'])	 !!}
              </div>
            </div>
			    </div>
			    <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat pull-right" id="btnUserSubmit">Add User</button>
          </div>
				{!! Form::close() !!}
				</div>
				<div class="box box-primary hidden" id="box-form-edit">
        <div class="box-header with-border">
          <h3 class="box-title">Edit User</h3>
        </div>
				{!! Form::open(['route' => 'users.edit.post', 'method' => 'POST','files' => true , 'class' => 'form-horizontal' , 'id' => 'form-user-edit']) !!}
					<div class="box-body">
			      <div class="form-group">
							{!! Form::label('fullname', 'Name' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!! Form::text('fullname', old('fullname'),['class'=>'form-control','placeholder'=>'Enter full name','id'=>'fullname-edit' , 'autocomplete' =>'off'])	 !!}
              </div>
            </div>
            <div class="form-group">
							{!! Form::label('password', 'Password' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Create a password','id'=>'password-edit'])	 !!}
              </div>
            </div>
            <div class="form-group">
							{!! Form::label('email', 'Email' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!! Form::text('email', old('email'),['class'=>'form-control','placeholder'=>'Enter word Email Address','id'=>'email-edit'])	 !!}
              </div>
            </div>
            <div class="form-group">
							{!! Form::label('is_admin', 'Is Admin?' ,['class'=>'col-sm-4 control-label']) !!}
              <div class="col-sm-8">
                {!!Form::checkbox('is_admin', '1', false,['id'=>'is_admin-edit','class'=>'styled'])	 !!}
              </div>
            </div>
			    </div>
			    <div class="box-footer">

            <button type="submit" class="btn btn-primary btn-flat pull-right" id="btnUserEdit">Update </button>
            <button type="button" class="btn btn-danger btn-flat pull-right" id="btnUserDelete" style="margin-right: 85px;">Delete User</button>
          </div>
				{!! Form::close() !!}
				</div>
		</div>


<div data-links="{{ json_encode(['datatables' => 'users.datatables', 'create' => 'users.create'], JSON_HEX_APOS) }}"></div>
@include('admin.elements.modal.delete')
@stop
