@if(session()->has('success_msg') || session()->has('error_msg') || $errors->has())
<script type="text/javascript">
	$(document).ready(function() {
		@if (session()->has('success_msg'))
			showNotice('success', '{{ session('success_msg') }}', 'Success!');
        @endif
        @if (session()->has('error_msg'))
			showNotice('error', '{{ session('error_msg') }}', 'Error!');
        @endif
        @if ($errors->has())
            @foreach ($errors->all() as $error)
               showNotice('error', '{{ $error }}', 'Error!');
            @endforeach
        @endif
	});
</script>
@endif
