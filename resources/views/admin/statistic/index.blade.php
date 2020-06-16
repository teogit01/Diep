
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
			<h3 style="color: black; width: 80%;margin-left: 20px;margin-top: 10px;">Thống Kê</h3>
			<!-- <a href="{{route('admin.product.getadd')}}" style="width: 15%;"><button class="btn btn-info" style="width: 100%">Thêm</button></a> -->
		</div>
		<div style="display: flex;width: 100%">
			<select class="form-control quy" style="width: 25%;margin-left: 10px;">
				<option>Thống kê theo quý</option>
				{{$start = 1}}
				@for($i=0; $i<4; $i++)
					{{$end = $start+2}}
				<option value="{{$start}}">Quý {{$i+1}} (tháng {{$start}} - tháng {{$end}})</option>
					{{$start = $end+1}}
				@endfor
			</select>
			&nbsp;&nbsp;
			<select class="form-control month" style="width: 25%">
				<option>Thống kê tháng</option>
				@for($i=0;$i<12;$i++)
					<option value={{$i+1}} >Tháng {{ $i+1 }}</option>
				@endfor
			</select>
			&nbsp;&nbsp;
			<input type="text" name="" class="form-control" style="width: 25%;" value="{{date('Y')}}">
		</div>
		
		<div class="main-content">
			<div class="left">
				<div class="load-data">
					<div><b>Tổng cộng: </b> {{number_format(isset($total) ? $total : 0,3,'.','.')}} VNĐ</div>
					<div style="width: 100%; height: 500px;"></div>
				</div>
			<div style="text-align: right; margin-right: 100px;"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript">		
		$('.month').on('change',function(){
			const month = $('.month').val()
			$.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: path +'admin/statistic/month',
                    data : {month: month},
                    success : function(data) {

                        $('.load-data').html(data)
                        
                    },
                    error : function(error) {
                    	
                        alert('error')
                        //console.log(error)
                    }
            	})  
		})

		$('.quy').on('change',function(){
			const start = $('.quy').val()
			$.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: path +'admin/statistic/quy',
                    data : {start: start},
                    success : function(data) {

                       $('.load-data').html(data)
                      
                        
                    },
                    error : function(error) {
                    	
                        alert('error')
                        //console.log(error)
                    }
            	})  
		})
	</script>	
@endsection