
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
	/*table tbody tr:hover { background-color: #fff; color: green; box-shadow: 5px 5px 15px 1px #eee; --transform: scale(1.01); transition: 0.2s}*/
	.action { visibility: hidden; }
	.stt { width: 4%; } a { list-style-type: none; }
	th { width: 15%; }

	.tr:last-child {
		border-bottom: none;
	}
	
	#showMessageDel { display: none; }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="main">
		<div class="title"><h3>Chi tiết hoá đơn <strong>{{$bill->code}}</strong></h3></div>
		<div class="left">
				<table>
					<thead>
						<tr>
							
							<th>Mã</th>
							<td>{{ $bill->code }}</td>
						</tr>
						<tr>
							<th>Sản phẩm</th>
							<td>Danh sách sản phẩm </td>
						</tr>
						<tr>
							<th></th>
							<td>
								<table>
									<?php $total = 0; ?>
									@foreach($products as $index => $product)
										<tr class="tr">
											<th>{{$product}} ({{$codes[$index]}})</th>
											<th>{{ number_format($prices[$index],0,'.','.') }} </th>
											<th>x {{$amounts[$index]}} </th>
											<th>{{ number_format($amounts[$index]*$prices[$index],0,'.','.') }} </th>
											<?php $total = $total + $amounts[$index]*$prices[$index]; ?>
										</tr>
									@endforeach
									<tr class="tr">
										<th colspan="3" style="text-align: right;padding-right: 30px;">Tổng cộng:</th>
										<th colspan="1" style="--padding-left: 60%;--background-color: red">{{ number_format($total,0,'.','.') }}</th>
									</tr>
									@if($bill->discount != 0)
									<tr class="tr">
										<th colspan="3" style="text-align: right;padding-right: 30px;">Khuyến mãi ({{ 100/($total/$bill->discount)}}%):</th>
										<th colspan="1" style="--padding-left: 60%;--background-color: red">{{ number_format($bill->discount,0,'.','.') }}</th>
									</tr>
									@endif
									
								</table>
							</td>
						</tr>
						<tr>
							<th>Tên khách hàng</th>
							<td>{{ $bill->name }}</td>
						</tr>
						<tr>
							<th>Ngày đặt</th>
							<td>{{ $bill->date }}</td>
						</tr>
						<tr>
							<th>Tình trạng</th>
							<td>
								<input type="text" name="" id='status' value="{{ $bill->status == 0 ? 'Chờ duyệt' : $bill->status == 1 ? 'Dã duyệt': 'Đã huỷ' }}" class="" style="width: 100%;margin-left: -5px;border: none;background-color: #fff" disabled>
							</td>
						</tr>
							<th>Liên hệ </th>
							<td>{{ $bill->phone }}</td>
						</tr>
						<tr>
							<th>Địa chỉ</th>
							<td>{{ $bill->address }}</td>
						</tr>
						<tr>
							<th>Ghi chú</th>
							<td>{{ $bill->note }}</td>
						</tr>
						<tr>
							<th>Tổng tiền</th>
							<td><b>{{ number_format($bill->total,0,'.','.') }} VNĐ</b></td>
						</tr>
					</thead>
				</table>
				<div style="width: 100%;text-align: right;">
					<a href="{{route('bill')}}" style="text-align: right;--margin-right: 200px;background-color: #ddd" onclick='duyet({{$bill->id}})' class="btn btn-secondary">Quay Lại</a>
					<button style="text-align: right;--margin-right: 200px" onclick='duyet({{$bill->id}})' class="btn btn-success">Duyệt</button>
					<button style="text-align: right;margin-right: 150px" onclick='cancel({{$bill->id}})' class="btn btn-danger">Huỷ đơn</button>
				</div>
				<!-- <button class="btn btn-success">Duyệt</button> -->
				<br>				
		</div>
		<script type="text/javascript">
			
			$(document).ready(function(){
        		$('#bill').attr('class','active')
        	})

        	function duyet(id){
        		
        		$.ajax({
        			headers: {
        				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        			},
        			type:'post',
        			url: path + 'admin/bill/confirm',
        			data:{id:id},
        			success: function(data){
						//alert(data)
						$('#status').val(data)
					},
					error: function(data) {
        				//alert(JSON.stringify(data));
        				alert('error');
        			}
        		})
        	}

        	function cancel(id){
        		$.ajax({
        			headers: {
        				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        			},
        			type:'post',
        			url: path + 'admin/bill/cancel',
        			data:{id:id},
        			success: function(data){
						//alert(data)
						$('#status').val(data)
					},
					error: function(data) {
        				//alert(JSON.stringify(data));
        				alert('error');
        			}
        		})
        	}
		</script>

@endsection





