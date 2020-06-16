
@extends('layouts/index')
@section('content')
<style type="text/css">
	*{ font-family: sans-serif;}
	.main { border-radius: 5px; }
	.main-content {
		display: flex; 
	}
	.left {
		width: 100%;
		padding: 5px 15px;
		background-color: #fff;
		box-shadow: 5px 5px 10px #ddd,5px 5px 10px #ddd;
		border-radius: 5px;
		--flex-direction:column;	
		--justify-content: center;
		line-height: 40px;
		--height: 350px;
		--max-height: 350px;
  		overflow: scroll;
	}
	.left table {
		width: 100%;
	}
	table tr {
		border-bottom: 1px solid #ddd;
	}

	table td, table th {
		--width: 25%;
	}
	table tbody tr:hover .action {
	  visibility: visible;
	}
	table tbody tr:hover { background-color: #fff; color: green; box-shadow: 5px 5px 25px 1px #ddd; transform: scale(1.01); transition: 0.2s}
	.action { visibility: hidden; }
	.stt { width: 4%; } a { list-style-type: none; }
	th { width: 10%; }
	
	#showMessageDel { display: none; }
	/*.footer { position: fixed; width: 100%; bottom: 15px; }*/
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
		<div style="display: flex;">
			<h3 style="color: black; width: 80%;padding-left: 20px;padding-top: 20px">Danh sách sản phẩm</h3>
			<a href="{{route('admin.product.getadd')}}" style="width: 15%;"><button class="btn btn-info" style="width: 100%">Thêm</button></a>
		</div>
		
		<hr style="opacity: 0.5;">
		<div class="main-content">
			<div class="left">
				<table>
					<thead>
						<tr>
							<th class="stt">#</th>
							<th>Image</th>
							<th>Ma</th>
							<th>Tên</th>
							<th>Màu</th>
							<th></th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="table-content">
						@if (isset($data))
							@foreach($data as $index => $item)
								<tr ondblclick="detail({{$item->id}})">
									<td class="stt">{{$index+1}}</td>
									<td>
										
											<img style="width: 100px;height: 150px" src='{{asset("img/products/")}}/{{json_decode($item->image)[0]}}'>
										
									</td>
									<td>{{$item->code}}</td>
									<td>{{$item->name}}</td>									
									<td  colspan="2">
										@if (isset($item->color))
										@foreach (json_decode($item->color) as $color)
											{{$color}}
										@endforeach
										@endif
									</td>
									<td>{{number_format($item->price,0,'.','.')}} đ</td>
									<td>{{$item->amount}}</td>
									<td><div class="action">
										<a href="#" onclick='del({{$item->id}})'><img src="{{asset('icon/delete.png')}}" style="width: 20px;"></a>
										</div>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
				<div style="text-align: right; margin-right: 100px;">{{ $data->links() }}</div>
			</div>
		</div>
	</div>	
	<script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){ 
                $('#showMessage').hide()
            }, 2000);
        });

        function del(id){
        	$.ajax({
        		headers: {
          			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          		},
        		type:'post',
        		url: path+'admin/product/delete',
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

        //Detail product
        	function detail($id){
        		window.location= path+'admin/product/detail/'+$id;
        		//window.location = 'http://127.0.0.1:8000/admin/product/add'
        	}
        $(document).ready(function(){
        	$('#product').attr('class','active')
        })
	</script>
@endsection