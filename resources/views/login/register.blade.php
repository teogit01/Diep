<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login/styles.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	
	<style type="text/css">
		label { font-size: 16px; }
	</style>
</head>
<!-- <body style="background: radial-gradient(circle, rgba(3,125,149,1) 19%, rgba(5,92,113,1) 98%);
}"> -->
<body>
	<div class="main" style="width: 50%">
		<h2>Đăng ký</h2>

		@if($message = Session::get('success'))
			<div class="alert alert-success" role="alert" id='showMessage'
				style="position: fixed;width: 50%;padding: 7px; right: 0;top: 9%;">
				<span>{{$message}}</span>
			</div>
		@endif 

		<div class="logo"></div>
		<div class="main-content">
			<form method="post" action="{{route('postRegister')}}">
				@csrf
				<div class="row">
					<div class="col-sm-3"><label>Họ tên</label></div>
					<div class="col-sm-9">
						<input type="text" name="name" class="form-control" placeholder="" autocomplete="off">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"><label>Số điện thoại</label></div>
					<div class="col-sm-9">
						<input type="text" name="phone" class="form-control" placeholder="" autocomplete="off">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"><label>Tên đăng nhập</label></div>
					<div class="col-sm-9">
						<input type="text" name="username" class="form-control" placeholder="" autocomplete="off">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"><label>Mật khẩu</label></div>
					<div class="col-sm-9">
						<input type="text" name="password" class="form-control" placeholder="" autocomplete="off">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"><label>Nhập lại mật khẩu</label></div>
					<div class="col-sm-9">
						<input type="text" name="confimpassword" class="form-control" placeholder="" autocomplete="off">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9">
						<input type="checkbox" name="remember" value="">
						<span>Remember Me</span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9">
						<button type="submit" class="btn btn-block btn-info">Đăng ký</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
            setTimeout(function(){
                $('#showMessage').hide()            
            },1000)
        })
	</script>
</body>
</html>