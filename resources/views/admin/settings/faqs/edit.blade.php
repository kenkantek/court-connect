@extends('admin.settings.layouts.default')
@section('title_heading')
    New Question&Answer
@stop
@section('content-setting')

    <div class="panel panel-primary ">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Edit Question&Answer: {{$item->title}}
            </h4>
        </div>

        <div class="panel-body">
        @include("errors.messages")
        <!-- form start -->
            {!! Form::open(array('url' => route('admin.setting.faq.edit',$item->id), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true)) !!}
            <div class="col-md-12">
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('question', 'Question',['class'=>'col-sm-3 control-label text-left']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('question', $item->question, array('id'=>'','class' => 'form-control', 'required' => 'required', 'placeholder'=> 'Question')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('answer', 'Answer',['class'=>'col-sm-3 control-label text-left']) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('answer', $item->answer, array('class' => 'form-control', 'placeholder'=> 'Answer')) !!}
                        </div>
                    </div>

                </div>

            </div>


            <div class="col-md-12">
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{!! route("admin.setting.faq") !!}" type="submit" class="btn btn-default">Cancel</a>
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
            CKEDITOR.replace('answer',{
                uiColor: '#14B8C4',
                toolbarCanCollapse: true,
                height: 300
            });
        });
    </script>
@stop
