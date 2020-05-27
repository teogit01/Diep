
@extends('layouts/index')
@section('content')
<!-- Latest compiled and minified CSS -->

<style type="text/css">
	*{ font-family: sans-serif; font-size: 14px;}
	.main { width: 98%; display: flex;flex-direction:column; padding: 20px 50px; margin: 0 1%; }
	.left { width: 70%; background-color: #fff; box-shadow: 1px 1px 10px #ddd; padding: 15px 20px; }
	.form {
        box-shadow: 1px 1px 10px #ddd;
        padding: 5px 20px;
        border-radius: 10px; 
    } 
    label {
        opacity: 0.8;
        --font-style: italic;
    }
    .form-control{
        border: none;
        border-bottom: 1px solid #bbb;
        padding-left: 50px
    }
    .form-control::placeholder{
        font-style: italic;
        font-size: 13px;
    }
   	textarea { border: none;}
   	.select { height: 40px; }
   	.select:focus {  bottom: 1px solid #ddd }
    img:hover { transform: scale(0.9); transition: 0.3s; }
	#showMessageDel { display: none; }
	button { width: 30%; }
	
</style>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="main">
		<div class="row">
			<h3 style="color: blue; width: 100%; border-bottom: 1px solid #aaa">Thêm sản phẩm </h3>
			@if($message = Session::get('success'))
		        <div class="alert alert-success" style="text-align: center;position: fixed;width: 40%;background-color:#4C9F70;opacity: 0.7;color: black;right: 0;top:9%;z-index: 1;" id='showMessage' role="alert">
		            {{$message}}
		            <p class="mb-0"></p>
		    	</div>
			@endif
		</div>
		<div class="main-content">
			<div class="left">
				<form action="{{route('admin.product.postadd')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Mã</label>	
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="code" name="code" placeholder="" autocomplete="off">						
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Tên</label>	
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="name" name="name" placeholder="" autocomplete="off">						
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Loại</label>	
							</div>
							<div class="col-sm-10">
								<select class="form-control select" name="type_code">
									<option></option>
									@if (isset($types))
										@foreach ($types as $type)
											<option value="{{$type->code}}">{{$type->name}}</option>
										@endforeach	
									@endif
								</select>					
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Giá</label>	
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="price" name="price" placeholder="" autocomplete="off">						
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Màu</label>	
							</div>
							<div class="col-sm-10">
								<!-- <input type="text" class="form-control" id="color" name="color" placeholder="" autocomplete="off">						 -->
								<select class="form-control select selectpicker" data-actions="true" name="colors[]" multiple data-style='btn-primar'>
									<option>Black</option>
									<option>White</option>
									<option>Green</option>
									<option>Red</option>
									<option>Pink</option>
								</select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Số lượng</label>	
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="amount" name="amount" placeholder="" autocomplete="off">						
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Size</label>	
							</div>
							<div class="col-sm-10">
								<!-- <input type="text" class="form-control" id="color" name="color" placeholder="" autocomplete="off">						 -->
								<select class="form-control select selectpicker" data-actions="true" name="sizes[]" multiple data-style='btn-primar'>
									<option>36</option>
									<option>37</option>
									<option>38</option>
									<option>39</option>
									<option>40</option>
									<option>41</option>
									<option>42</option>
								</select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Nam/Nữ</label>	
							</div>
							<div class="col-sm-10 row">
								<div class="col-sm-1">
									<input type="checkbox" class="form-control" id="gender[]" name="color" placeholder="" autocomplete="off">
								</div>
								<div class="col-sm-1">
									<input type="checkbox" class="form-control" id="gender[]" name="color" placeholder="" autocomplete="off">						
								</div>
								
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Hình</label>	
							</div>
							<div class="col-sm-10">
								<input type="file" class="form-control" id="amount" name="images[]" placeholder="" autocomplete="off" multiple>						
							</div>
						</div>
						
						
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="" class="control-label">Mô tả</label>	
							</div>
							<div class="col-sm-10">
								<!-- <input type="text" class="form-control" id="code" name="code" placeholder="" autocomplete="off"> -->						
								<textarea class="form-control" name='description'>
									
								</textarea>
							</div>
						</div>
					</div>
		                <div class="form-group">
		                	<!-- <a href="" class="btn btn-default">Trờ lại</a> -->
		                	<a href="{{route('admin.product.index')}}" class="btn ">Quay lại</a>
		                	<button type="submit" class="btn btn-primary">Thêm</button>
		                </div>

		        </form>
	
			</div>
		</div>
		<div class="right" style="background-color: red">
				
		</div>
	</div>	
	<script type="text/javascript">
  		$(document).ready(function(){
  			setTimeout(function(){
  				$('#showMessage').hide()
  			}, 1000)
  		})
	</script>
	<script type="text/javascript">
	</script>
	<!-- Latest compiled and minified JavaScript -->
@endsection