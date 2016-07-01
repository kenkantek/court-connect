@if(count($errors) > 0)
    <div class="alert alert-danger error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="success alert alert-success callout callout-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em>
    </div>
@endif

@if(Session::has('error'))
    <div class="error alert alert-danger callout callout-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-remove"></span><em> {!! session('error') !!}</em>
    </div>
@endif