@extends('admin.layouts.master')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border content-header">
		<h3 class="box-title"><i class="fa fa-users"></i> List users</h3>
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">List users</li>
		</ol>
	</div>
	<div class="box-body">
		<div class="col-xs-12">
			<table class="table table-bordered" id="datatables">
				<thead>
					<tr>
						<th class="no-sort no-search">
							<input type="checkbox" class="group-checkable" data-set="#datatables .checkboxes"/>
						</th>
						<th>ID</th>
						<th class="text-left">Username</th>
						<th>Fullname</th>
						<th>Email</th>
						<th>Role</th>
						<th class="no-sort no-search">Operations</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="7" class="dataTables_empty">Data loading...</td>
					</tr>
				</tbody>
			</table>
			<div data-section='users.datatables'></div>
			<div data-route-create='users.create'></div>
			<div data-route-delete-many='users.delete.many'></div>
		</div>
	</div>
</div>
@include('admin.elements.modal.delete')
@stop
