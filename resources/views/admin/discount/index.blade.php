
@extends('layouts/index')
@section('content')
<style type="text/css">
	*{ font-family: sans-serif; }
	.main{
		padding: 0 5%;
	}
	.main-content {
		display: flex;
	}
	.left {
		width: 60%;
		padding: 5px 15px;
		background-color: #fff;
		box-shadow: 5px 5px 10px #ddd,5px 5px 10px #ddd;
		border-radius: 5px;
		--flex-direction:column;	
		--justify-content: center;
		line-height: 40px;
		--height: 350px;
		max-height: 350px;
  		overflow: scroll;
	}
	.left table {
		width: 100%;
	}
	table tr {
		border-bottom: 1px solid #eee;
	}
	table td, table th {
		width: 25%;
	}
	table tbody tr:hover .action {
	  visibility: visible;
	}
	.action { visibility: hidden; }
	.stt { width: 15%; } a { list-style-type: none; }
	.right {
		width: 38%;
		height: 100%;
		margin-left: 2%;
		padding: 5px 15px;
		background-color: #fff;
		box-shadow: 5px 5px 10px #ddd,5px 5px 10px #ddd;
		border-radius: 5px;
		--flex-direction:column;	
		--justify-content: center;
		line-height: 40px;
	}
	.right input {
		border:none;
		border-bottom: 1px solid #eee;
		width:100%;
		font-size: 16px;
		text-align: center;
		background-color: #fff;
		padding-bottom: 5px;
		font-style: italic;
	}
	.right form input:focus {
		outline: none;
		font-size: 16px;
		font-style: italic;
	}
	.right:hover{
		transform: translateY(1px);
		box-shadow: 5px 5px 10px #ddd,5px 5px 2px #ddd;
		transition: all 0.1s;
	}	
	.right form input::placeholder{
		font-style: italic;
		color: #ddd;
	}
	#showMessageDel { display: none; }
	.footer { position: fixed; width: 100%; bottom: 15px; }
</style>
	@if($message = Session::get('success'))
        <div class="alert alert-success" style="text-align: center;position: fixed;width: 40%;background-color:#4C9F70;opacity: 0.7;color: black;right: 0;top:30%;" id='showMessage' role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
    	</div>
	@endif	
	 <div class="alert alert-success" style="text-align: center;position: fixed;width: 40%;background-color:#4C9F70;opacity: 0.7;color: black;right: 0;top:30%;" id='showMessageDel' role="alert">
            <p>Xoa thanh cong</p>
            <p class="mb-0"></p>
    	</div>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="main">
		<h3 style="color: blue">Quản lí Khuyến Mãi</h3>
		<hr style="opacity: 0.5;">
		<div class="main-content">
			<div class="left">
				<table>
					<thead>
						<tr>
							<th class="stt">#</th>
							<th class="ma">Mã</th>
							<th>Tên</th>
							<th>Phần trăm</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="table-content">
						@if (isset($data))
							@foreach($data as $index => $item)
								<tr>
									<td class='stt'>{{$index+1}}</td>
									<td class="ma">{{$item->code}}</td>
									<td class="ten">{{$item->name}}</td>
									<td class="ten">{{$item->percent}}%</td>
									<td><div class="action">
										<a href="#" onclick='del({{$item->id}})'>Xoa</a>
										<a href="#">sua</a>
										</div>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
					
				</table>
			</div>
			<div class="right">
				<form method="post" action="{{route('discount.postAdd')}}">
					@csrf
					<input type="text" name="code" class="form-contro" autocomplete="off" placeholder="Nhập mã khuyến mãi...">

					<input type="text" name="name" class="form-contro" autocomplete="off" placeholder="Nhập tên khuyến mãi...">
					<input type="number" name="percent" class="form-contro" autocomplete="off" placeholder="Nhập phần trăm khuyến mãi...">
					<br>
					<button class="btn btn-primary" style="margin: 5px 20px;width: 90%">Them</button>
				</form>
			</div>
		</div>
	</div>	
	<div class="footer">
	    @include('layouts/footer')
	</div>
	<script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){ 
                $('#showMessage').hide()
            }, 1000);
        });

        function del(id){
        	$.ajax({
        		headers: {
          			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          		},
        		type:'post',
        		url: 'http://127.0.0.1:8000/admin/discount/delete',
        		data:{id:id},
        		success: function(data){
					$('.table-content').html(data)
					$('#showMessageDel').css('display','block');
					setTimeout(function(){
						$('#showMessageDel').hide()
					}, 1000);

				},
				error: function(data) {
			 	//alert(JSON.stringify(data));
			 		alert('error');
			 	}
        	})
        }
        $(document).ready(function(){
        	$('#discount').attr('class','active')
        })
	</script>
@endsection