<!DOCTYPE HTML>
<html>
	<head>
		<title>Email Confirmation</title>
	</head>
	<body>
		<h1>Thank for Signing Up With Us!</h1>
		<p>
			<a href = "{{ url('register/confirm/{$user->token}') }}">
				Click this link to confirm your email
			</a>
		</p>
	</body>
</html>
