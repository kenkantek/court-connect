@extends('admin.settings.layouts.default')
@section('title_heading')
    New
@stop
@section('content-setting')

    <div class="panel panel-primary ">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                New Page
            </h4>
        </div>

        <div class="panel-body">
            @include("errors.messages")
            <!-- form start -->
                {!! Form::open(array('url' => route('admin.setting.pages.create'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true)) !!}
                <div class="col-md-12">
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', 'Title',['class'=>'col-sm-2 control-label text-left']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('title', null, array('id'=>'','class' => 'form-control', 'required' => 'required', 'placeholder'=> 'Title')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description',['class'=>'col-sm-2 control-label text-left']) !!}
                            <div class="col-sm-10">
                                {!! Form::textarea('description', isset($item) ? $item->code : null, array('class' => 'form-control', 'placeholder'=> 'Description')) !!}
                            </div>
                        </div>

                    </div>

                </div>


                <div class="col-md-12">
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{!! route("admin.setting.pages") !!}" type="submit" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info pull-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                {!! Form::close() !!}
        </div>
    </div>

@stop

{{-- page level scripts --}}
@section('javascript')
    <!-- CK Editor -->
    <script src="http://ckeditor.com/latest/ckeditor.js"></script>

    <script>
        $(function () {
            CKEDITOR.replace('description',{
                uiColor: '#14B8C4',
                toolbarCanCollapse: true,
                height: 300
            });
        });
    </script>
@stop
