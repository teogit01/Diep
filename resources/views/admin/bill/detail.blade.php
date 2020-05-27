
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
	table tbody tr:hover { background-color: #fff; color: green; box-shadow: 5px 5px 15px 1px #eee; --transform: scale(1.01); transition: 0.2s}
	.action { visibility: hidden; }
	.stt { width: 4%; } a { list-style-type: none; }
	th { width: 10%; }
	
	#showMessageDel { display: none; }
</style>
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
							<td>{{ $bill->product }}</td>
							<!-- <td>san pham 1 : 4, sanr pham 2: 3</td> -->
						</tr>
						<tr>
							<th>Tên</th>
							<td>{{ $bill->name }}</td>
						</tr>
						<tr>
							<th>Ngày</th>
							<td>{{ $bill->date }}</td>
						</tr>
						<tr>
							<th>Tình trạng</th>
							<td> {{ $bill->status == 0 ? 'Chờ duyệt' : 'Đã duyệt' }}</td>
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
							<td>{{ $bill->total }}</td>
						</tr>
						<tr>
							<th><button class="btn btn-success">Duyệt</button></th>
							<td></td>
						</tr>
					</thead>
				</table>
				<!-- <button class="btn btn-success">Duyệt</button> -->
				<br>				
		</div>
		<script type="text/javascript">
			function detail(id){
				// alert(code);
				window.location= path+'admin/bill/detail/'+;
			}
		</script>

@endsection





