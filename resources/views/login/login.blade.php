<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login/styles.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	
	</style>
</head>
<!-- <body style="background: radial-gradient(circle, rgba(3,125,149,1) 19%, rgba(5,92,113,1) 98%);
}"> -->
<body>
	<div class="main">
		<h2>Đăng ký</h2>
		<div class="logo"></div>
		<div class="main-content">
			<form method="post" action="">
				@csrf
				<label>UserName:</label>
				<input type="text" name="user" class="form-control" placeholder="" autocomplete="off">
				<label>Password:</label>
				<input type="password" name="pass" class="form-control" placeholder="" autocomplete="off">

				<br>

				<input type="checkbox" name="remember" value="">
				<span>Remember Me</span>

				<br>
				<br>
				<button type="submit" class="btn btn-block btn-info">Login</button>
			</form>
		</div>
	</div>
</body>
</html>