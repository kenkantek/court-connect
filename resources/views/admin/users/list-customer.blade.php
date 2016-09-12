@extends('admin.layouts.master')
@section('title_heading')
    Customer Manager
@stop
@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <customer-setting
                    :club-setting-id = "clubSettingId",
                    :clubs = "clubs"
            >
            </customer-setting>
        </div>
    </div><!--end box data-->

    <script>
        $(document).ready(function(){
            $('#cc-ms').change(function() {
            }).multipleSelect({
                width: '100%',
            });
        })
    </script>
@stop
