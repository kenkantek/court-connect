@extends('admin.settings.layouts.default')
@section('title_heading')
    Contacts
@stop
@section('content-setting')

    <div class="panel panel-primary ">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Contacts
            </h4>
        </div>

        <div class="panel-body">
            @include("errors.messages")

            <table id="dataTables" class="table table-condensed">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th width="110">Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@stop

{{-- page level scripts --}}
@section('javascript')
    <link rel="stylesheet" type="text/css" href="{{asset('resources/vendor/datatables/media/css/jquery.dataTables.css')}}" />
    <script src="{{asset('resources/vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script>
        $('#dataTables').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{!! route('admin.setting.contacts.list') !!}",
            columns: [
                { data: 'numrow', name: 'id' },
                { data: 'name', name: 'name', class: 'text-left'},
                { data: 'email', name: 'email', class: 'text-left' },
                { data: 'messages', name: 'messages', class: 'text-left'},
                { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-left'}
            ]
        });
    </script>

@stop
