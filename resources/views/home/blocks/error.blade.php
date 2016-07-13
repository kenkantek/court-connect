@if(count($errors) > 0)
    <div class="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="list-style: none; color: red; font-weight: bold">{!! $error !!}</li>
            @endforeach
        </ul>        
    </div>
@endif