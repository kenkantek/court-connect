<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
	<div>
		Thank you for signing up for Court Connect. Please confirm your email address by clicking <a href='{{ route("verify",["code"=>$data["verify_code"]]) }}'>here</a>.
		<br>
		If you have any questions, please <a href="{{url("/contact")}}">contact us</a>
	</div>

</body>
</html>
