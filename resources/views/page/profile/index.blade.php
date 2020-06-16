@extends('page/layouts/home')
@section('banner')

@endsection
@section('show')

<style type="text/css">
	.main { width: 100%; display: flex; }
	.left { width: 40%; }
	.left img { width: 200px; height: 250px }
	.right { width: 60%; }
	.th { width: 150px; }
	table { width: 100% }
	tr { border-bottom: 1px solid #ddd; height: 40px; }
	input { background-color: #fff; border: none; width: 100%;}
	input:focus { outline: none;}
	.p { --font-size: 100px;width: 70px; }
</style>
<section class="ftco-section ftco-cart">
	<div class="container">
		@if($message = Session::get('success'))
			<div class="alert alert-success" role="alert" id='showMessage'
			style="position: fixed;width: 50%;padding: 7px; right: 0;top: 9%;">
				<span>{{$message}}</span>
			</div>
			@endif
		<div class="main">	
			<div class="left">
				<form action="{{route('profile.edit',Auth::id())}}" method="post" enctype="multipart/form-data">
					@csrf
				@if ($user->avatar == null)
				<div class="left-content">
					<img src="https://via.placeholder.com/200x250">
				</div>
				@else
				<div class="left-content">
					<img src="{{asset('img/avatars')}}/{{$user->avatar}}">
				</div>
				@endif
				<br>
				<input type="file" name="avatar" class="">
			</div>
			<div class="right">
					<table class="">
						<tr ondblclick='edit("code")'>
							<th class="th">Mã</th>
							<td><input type="text" class="open" name="code" id='code' placeholder=""
							value="{{$user->code}}" disabled autocomplete="off"></td>
						</tr>
						<tr ondblclick='edit("name")'>
							<th class="th">Tên</th>
							<td><input type="text" class="open" name="name" id='name' placeholder="" value="{{$user->name}}" disabled autocomplete="off"></td>
						</tr>
						<tr ondblclick='edit("birthday")'>
							<th class="th">Ngày sinh</th>
							<td><input type="date" style="width: 200px;" class="open" name="birthday" id='birthday' placeholder="" value="{{$user->birthday}}" disabled autocomplete="off"></td>
						</tr>
						<tr ondblclick='edit("phone")'>
							<th class="th">Sđt</th>
							<td><input type="text" class="open" name="phone"id='phone' placeholder="" value="{{$user->phone}}" disabled autocomplete="off"></td>
						</tr>
						<tr ondblclick='edit("email")'>
							<th class="th">Email</th>
							<td><input type="text" class="open" name="email" id='email' placeholder="" value="{{$user->email}}" disabled autocomplete="off"></td>
						</tr>
						<tr ondblclick='edit("address")'>
							<th class="th">Địa chỉ</th>
							<td><input type="text" class="open" name="address" id='address' placeholder="" value="{{$user->address}}" disabled autocomplete="off"></td>
						</tr>
					</table>
					<br>
					<div style="text-align: right;margin-right: 50px">
						<p id='edit' class="btn btn-info p" style="border-radius: 4px">Sửa</p>
						<label for='submit'><p class="btn btn-info p" style="border-radius: 4px">Lưu</p></label>

						<button type="submit" style="display: none" id='submit'>asd</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		setTimeout(function(){
			$('#showMessage').hide()            
		},1000)
	})
	function edit(name){
		$('#'+name).removeAttr("disabled");
        $('#'+name).focus();
	}
	$('#edit').on('click',function(){
		$('.open').removeAttr("disabled");
		$('.open')[0].focus();
	})
</script>
@endsection