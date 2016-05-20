<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
	<h2>Create Account Player in CourtConnect</h2>
	<div>
		Thank you for signing up to Page "Court Connect".
		Please follow the link below to verify your email address
		<a href='{{ route("verify",["code"=>$data["verify_code"]]) }}'>Confirm</a>
		Thanks,
		<br>
		Page "Court Connect"

		P.S. Need help? <a href="{{url("/contact")}}">Contact us</a> anytime with your questions and/or feedback.
	</div>

</body>
</html>
