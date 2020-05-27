
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
		<div class="title"><h3>Danh sách hoá đơn</h3></div>
		<div class="left">
				<table>
					<thead>
						<tr>
							<th class="stt">#</th>
							<th>Mã</th>
							<th>Tên</th>
							<th>Ngày</th>
							<th>Tình trạng</th>
							<th>Liên hệ </th>
							<th>Tổng tiền</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="table-content">
						@if(!empty($bills))
							@foreach ($bills as $index => $bill) 
								<tr ondblclick='detail({{$bill->id}})'>
									<th>{{ $index + 1 }}</th>
									<th>{{ $bill->code }}</th>
									<th>{{ $bill->name }}</th>
									<th>{{ $bill->date }}</th>
									<th>{{ $bill->status == 0 ? 'Chờ duyệt' : 'Đã duyệt'  }}</th>
									<th>{{ $bill->phone }}</th>
									<th></th>
									<th></th>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
				<br>				
		</div>
		<script type="text/javascript">
			function detail(id){
				// alert(code);
				window.location= path+'admin/bill/detail/'+id;
			}
		</script>

@endsection





