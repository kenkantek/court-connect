@extends('admin.layouts.master')
@section('title_heading')
    Customer Manager
@stop
@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <customer-setting
                    :club-setting-id = "clubSettingId"
            >
            </customer-setting>
        </div>
    </div><!--end box data-->

@stop
