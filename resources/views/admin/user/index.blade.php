
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
		<div class="title"><h3>Danh sách khách hàng</h3></div>
		<div class="left">
				<table>
					<thead>
						<tr>
							<th class="stt">#</th>
							<th>Ma</th>
							<th>Tên</th>
							<th>Sinh nhật</th>
							<th>Email</th>
							<th>Sđt</th>
							<th>Địa chỉ</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="table-content">
						@if(!empty($users))
							@foreach ($users as $index => $user) 
								<tr>
									<th>{{ $index + 1 }}</th>
									<th>{{ $user->code }}</th>
									<th>{{ $user->name }}</th>
									<th>{{ $user->birthday }}</th>
									<th>{{ $user->email }}</th>
									<th>{{ $user->phone }}</th>
									<th colspan="2">{{ $user->address }}</th>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
				<br>
				<div style="width: 90%;display: flex;justify-content: center;">
						{{ $users->links() }}
				</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
        	$('#user').attr('class','active')
        })
		</script>
@endsection