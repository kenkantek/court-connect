@extends('admin.layouts.master')
@section('title_heading')
    Settings
@stop
@section('content')
    <div class="container" style="position: relative">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="col-md-3">
            @include('admin.settings.layouts._left_menu')
        </aside>
        <div class="col-md-9">
            @yield('content-setting')
        </div>
    </div>
@stop


