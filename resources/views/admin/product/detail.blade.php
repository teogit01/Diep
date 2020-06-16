
@extends('layouts/index')
@section('content')

<style type="text/css">
	.main { width: 100%; display: flex;flex-direction:column; padding: 15px; background-color: #fff}
    .title { color: blue; padding-top: 10px;}
    .main-content { display: flex; flex-direction: row; width: 100%; height: 100%;  }
    .left { width: 59%; box-shadow: 1px 1px 10px #999; border-radius: 10px; line-height: 45px; padding: 5px 20px;}
    .left table { width: 100%;}
    .left table tr ,.left table td { border-bottom: 1px solid #ddd; }
    input, textarea { border: none; width: 80 color:green; background-color: #fff}
    input:focus { outline: none; color: green }
    .main-content .right { width: 40%; box-shadow: 1px 1px 10px #999; border-radius: 0px; margin-left: 1%; max-height: 800px;overflow: scroll; }
    .btn { width: 30%; }
    .image { width: 100%; height: 65%;display: flex;flex-wrap: wrap; align-content: stretch;padding: 5px; }
    img { filter: drop-shadow(1px 1px 10px #ddd);object-fit: fill; width: 100%; height: 100%;}
    .image_sub { background-color:;width: 50%;height: 50%;padding: ;position: relative; }
    .outlay { background-color: black; width: 100%; height: 100%;position: absolute; opacity: 0;padding: 10px;z-index: 1 }
    .outlay:hover { opacity: 0.4;transition: 0.3s; }
    img:hover { transform: scale(0.9); transition: 0.3s; }
    .select { --height: 0px; }
   	.select:focus {  bottom: 1px solid #ddd }
	#showMessageDel { display: none; }
	th { width: 30% }
	td { width: 70% }
	#type{

		background-color: #fff;
		--color: yellow;
	}
	::placeholder {
 		 color: black;
	}
	/*.footer { position: fixed; width: 100%; bottom: 15px; }*/
</style>
	<!-- main -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="main">
		<div class="title">
			<h3>Thông tin chi tiêt <span style="color: black">{{$data->name}}</span></h3>
			@if($message = Session::get('success'))
			<div class="alert alert-success" role="alert" id='showMessage'
			style="position: fixed;width: 50%;padding: 7px; right: 0;top: 9%;">
				<span>{{$message}}</span>
			</div>
			@endif        
		</div>
		
	<div class="main-content">
		<div class="left">
			<form action="{{route('admin.product.edit',$data->id)}}" method="post" enctype="multipart/form-data">
				@csrf
				<table>
					<tr ondblclick='edit("code")'>
						<th>Mã</th>
						<td>
							<input type="text" id="code" name='code'placeholder="{{$data->code}}" disabled autocomplete="off">
						</td>
					</tr>
					<tr ondblclick='edit("name")'>
						<th>Tên</th>
						<td>
							<input type="text" id="name" name='name'placeholder="{{$data->name}}" disabled autocomplete="off">
						</td>
					</tr>
					<tr ondblclick='edit("type")'>
						<th>Loại</th>
						<td>
							<select id='type' name='type_code' class="form-control" title="">
								@foreach ($types as $type)
									<option value="{{$type->code}}">{{$type->name}}</option>
								@endforeach
							</select>
							
						</td>
					</tr>
					
					<tr ondblclick='edit("type")'>
						<th>Nhà sản xuất</th>
						<td>
							<select id='type' name='type_code' class="form-control" title="{{$data->producer->name}}">
								@foreach ($producers as $producer)
									<option value="{{$producer->code}}">{{$producer->name}}</option>
								@endforeach
							</select>
							
						</td>
					</tr>

					<tr ondblclick='edit("type")'>
						<th>Nhà phân phối</th>
						<td>
							<select id='type' name='type_code' class="form-control">
								@foreach ($distributors as $distributor)
									<option value="{{$distributor->code}}">{{$distributor->name}}</option>
								@endforeach
							</select>
						</td>
					</tr>

					<tr ondblclick='edit("price")'>
						<th>Giá</th>
						<td>
							<input type="text" id="price" name='price'placeholder="{{number_format($data->price,3	,'.','.')}} đ" disabled autocomplete="off">
						</td>
					</tr>
					<tr ondblclick='edit("amount")'>
						<th>Số lượng</th>
						<td>
							<input type="number" id="amount" name='amount'placeholder="{{$data->amount}}" disabled autocomplete="off">
						</td>
					</tr>
					<tr>
						<th>Size</th>
						<td>
							<div class="row">
								<div style="width: 50%; padding-right: 3%;">
									<select class="form-control select selectpicker" multiple data-size="auto" title="Thêm size" name="sizeAdds[]">
										@if ($sizeDiff)
											@foreach($sizeDiff as $sizediff)
												<option>{{$sizediff}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div style="width: 50%;">
									<select class="form-control select selectpicker" title="Xoá size" multiple="" name="sizeDels[]">
										@if ($sizes)
											@foreach($sizes as $size)
												<option>{{$size}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div style="width: 100%; padding-left: 3%; padding-top: 1%">
									@foreach($sizes as $size)
										<span style="color: black">{{$size}},</span>
									@endforeach
								</div>
							</div>
						</td>
					</tr>
					<tr ondblclick='edit("description")'>
						<th>Mô tả</th>
						<td>
							<textarea class="form-control" name="description" id='description' style="border:none">
								{{$data->description}}
							</textarea>
						</td>
					</tr>
					<tr>
						<th>Màu</th>
						<td>
							<div class="row">
								<div style="width: 50%; padding-right: 3%;">
									<select class="form-control select selectpicker" multiple data-size="auto" title="Thêm màu" name="colorAdds[]">
										@if ($colorDiff)
											@foreach($colorDiff as $colordiff)
												<option>{{$colordiff}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div style="width: 50%;">
									<select class="form-control select selectpicker" title="Xoá màu" multiple="" name="colorDels[]">
										@if ($colors)
											@foreach($colors as $color)
												<option>{{$color}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div style="width: 100%; padding-left: 3%; padding-top: 1%">
									@foreach($colors as $color)
										<span style="color: black">{{$color}},</span>
									@endforeach
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div style="display: flex;flex-direction: row;align-items: center;justify-content: space-around">
								<!-- <a href="#"><button class="btn btn-success">Quay lại</button></a> -->
								<a href="{{route('admin.product.index')}}" class="btn ">Quay lại</a>
								<button type="reset" class="btn btn-info" onclick='delImage({{$data->id}},"null")'>Huỷ</button>
								<button class="btn btn-primary">Lưu</button>
							</div>
						</td>
					</tr>
				</table>
		</div>
		
		<div class="right">                
               <div class="image showImage" style="">
                    
                    @foreach(json_decode($data->image) as $image)
                    <div class="image_sub" style="">
                        <div class="outlay" style="">
                            <!-- <p class="btn btn-danger" onclick="delImage({{$data->id}},'{{$image}}')" style="width: 100%;">Delete</p> -->
                            <p class="btn btn-danger" onclick='delImage({{$data->id}},"{{$image}}")' style="width: 100%;">Delete</p>
                        </div>
                        <div style="width: 100%; height: 100%;padding: 5px;">
                            <img src='{{asset("img/products/")}}/{{$image}}' style="">
                        </div>
                    </div>
                    @endforeach
                

                    <div class="image_sub" style=" z-index: 1">
                        <div style="width: 100%; height: 100%;padding: 5px;display: flex;flex-direction: column;justify-content:center;">                            
                            <input id='' type="file" name="images[]" multiple class="btn btn-info" style="width: 100%;justify-content: center;">

                        </div>
                   </div>
               </div>
			</form>
		</div>	
		
	</div>

	<!-- end mamin -->
	<script type="text/javascript">
		function edit(id){
            //alert(id);
            //$('#'+id).css('display','none')
            $('#'+id).removeAttr("disabled");
            $('#'+id).focus();
        }
         $(document).ready(function(){
            setTimeout(function(){
                $('#showMessage').hide()            
            },1000)
        })

         function delImage(id,image) {
            //if (confirm('Bạn có muốn xóa xe này không?')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: path +'admin/product/edit/image',
                    data : {id: id,Image: image},
                    success : function(data) {
                        $('.showImage').html(data)
                        // alert(data)
                    },
                    error : function(error) {
                        alert(error)
                        // console.log(error)
                    }
                })     
            //}
        }
          // function reset image delete
        const resetImageDel = function (){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: path +'admin/product/edit/image/resetimagedel',
                success : function(data) {
                        return 
                },
                error : function(error) {
                    alert(error)
                }
            })     
        }
        $(document).ready(function(){
        	$('#product').attr('class','active')
        	$('#type').css('backgroundColor','white')
        	$('#type').css('width','90%')
        	
        })

        $( window ).on('load',resetImageDel);
	</script>
@endsection


