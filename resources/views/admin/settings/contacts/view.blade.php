@extends('admin.settings.layouts.default')
@section('title_heading')
    New
@stop
@section('content-setting')

    <div class="panel panel-primary ">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Contact: #{{$item->id}}
            </h4>
        </div>

        <div class="panel-body">
        @include("errors.messages")
        <!-- form start -->
            <div class="col-md-12">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">Name:</th>
                                <td>{{$item->name}}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$item->email}}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{$item->phone}}</td>
                            </tr>
                            <tr>
                                <th>Dated:</th>
                                <td>{{date_from_database($item->created_at,'m-d-Y, h:m:i')}}</td>
                            </tr>
                            <tr>
                                <th>Messages:</th>
                                <td>{{$item->messages}}</td>
                            </tr>
                            </tbody></table>
                    </div>

                </div>

            </div>


            <div class="col-md-12">
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{!! route("admin.setting.contacts") !!}" type="submit" class="btn btn-default">Back</a>
                    <a href="{!! route("admin.setting.contacts.delete",$item->id) !!}" type="submit" class="btn btn-danger">Delete</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
    <style>
        .table th, .table th {
            background: none;
            color: #000;
        }
        .table td, .table th {
            text-align: left;
        }
    </style>
@stop

{{-- page level scripts --}}
@section('javascript')
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    <script>
        $(function () {
            CKEDITOR.replace('description');
        });
    </script>
@stop
