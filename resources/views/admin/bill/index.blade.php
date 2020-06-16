	
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
		@if($message = Session::get('success'))
		<div class="alert alert-success" style="text-align: center;position: fixed;width: 40%;background-color:#4C9F70;opacity: 0.7;color: black;right: 0;top:10%;height: 45px;" id='showMessage' role="alert">
			<p>{{$message}}</p>
			<p class="mb-0"></p>
		</div>
		@endif	
	
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
									<th>{{ $bill->status == 0 ? 'Chờ duyệt' : $bill->status == 1 ? 'Đã duyệt' : 'Đã huỷ' }}</th>
									<th>{{ $bill->phone }}</th>
									<th>{{ number_format($bill->total,0,'.','.') }}</th>
									<th><img onclick='del({{$bill->id}})' src="{{asset('icon/delete.png')}}" style="width: 20px;"></th>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
				<br>				
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				setTimeout(function(){ 
					$('#showMessage').hide()
				}, 1000);
			});
			function detail(id){
				// alert(code);
				window.location= path+'admin/bill/detail/'+id;
			}
				$(document).ready(function(){
        		$('#bill').attr('class','active')
        	})
			function del(id){
				window.location= path+'admin/bill/delete/'+id;	
			}
		</script>

@endsection





