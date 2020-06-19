
@extends('page/layouts/home')
@section('banner')

@endsection
@section('show')

<div id='show'></div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="ftco-section ftco-cart">
	<div class="">
	<div class="container load-data">
		<!-- <h3>Chưa có sản phẩm</h3> -->
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th></th>
								<th>Sản phẩm</th>
								<th>Màu</th>
								<th>Size</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody class="">
							@if (isset($cart_detail))
								@foreach($cart_detail as $index => $detail)
								<form method="post" action="{{route('cart.detail.remove',[Auth::id(),$detail->product_code])}}">
									@csrf
									<tr class="text-center">
										<td class="product-remove">
											<label for='product-remove-{{$index}}'><span class="ion-ios-close"></span></label>
											<button type="submit" id='product-remove-{{$index}}' style="display: none"></button>
										</td>

										<td class="image-prod"><div class="img" style="height: 100px;background-image:url({{asset('img/products')}}/{{json_decode($detail->product[0]->image)[0]}});"></div></td>
										
										<td class="total">
											<h3>{{$detail->product[0]->name}}</h3>
											<!-- <p>Far far away, behind the word mountains, far from the countries</p> -->
										</td>
										<td class="total">
											<select name="" class="form-contrl" style="border: none">
												@if(isset($detail->color))
													<option>{{$detail->color}}</option>
												@else
													<option>Color</option>
												@endif
												@foreach (json_decode($colors[$index]) as $color)
													
													<option>{{$color}}</option>
													
												@endforeach
											</select>
										</td>


										<td class="total">
											<select name="" class="form-contro" style="border: none;">
												@if(isset($detail->size))
													<option>{{$detail->size}}</option>
												@else
													<option>Size</option>
												@endif
												
												
												@foreach (json_decode($sizes[$index]) as $size)
													<option>{{$size}}</option>
												@endforeach
												

											</select>
										</td>

										<td class="total"> {{number_format($detail->product[0]->price,0,'.','.')}}
											<input type="text" style="display: none" value="{{$detail->product[0]->price}}" id='price-{{$index}}' name="">
										</td>
										<td class="total" style="width: 150px;">
											<div class="input-group mb-3" style="width: 100%;margin-left: 40px;">
												<input type="number" name="quantity" id="{{$cart_detail[$index]->id}}" class="quatity form-control" value="{{$detail->amount}}" min="1" max="100" style="border: none;width: 100%">
											</div>
										</td>

										<td class="total"><input type="text" class="tamtinh-{{$index}}" name="" value="{{number_format($detail_total[$index],0,'.','.')}}" style="width: 40%;padding-left: 10px;border: none;background-color: #fff" disabled>
										</td>
									</tr>
									</form>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>		
		<div class="row justify-content-start" style="margin-top:-60px;">
			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
				<form method="post" action="{{route('cart.post.checkout',Auth::id())}}">
					@csrf
				<div class="cart-total mb-3">
					<h3>Thông tin thanh toán</h3>
					<p class="d-flex">
						<span>Mã khuyễn mãi</span>
						<span><input type="text" class="" id='discount' value="" style="border: 1px solid #ddd" name=""></span>
					</p>
					<p class="d-flex">
						<span>Delivery</span>
						<span><input type="text" disabled style="border: none;background-color: #fff" value="0" id="precent" name=""></span>
						<input type="text" id='precent_submit' value="0" name="precent" style="display: none">
						
						
					</p>
					<p class="d-flex">
						<span>Khuyến mãi</span>
						<span>0</span>
					</p>
					<hr>
					<p class="d-flex total-price">
						<span>Tổng tiền</span>
						<span>
							<input type="text" id='tong' disabled style="border: none;background-color: #fff" name="" value="{{number_format($total,0,'.','.')}} vnd">
							<input type="text" id='total_submit' style="display: none" name="total" value="{{$total}}">
						</span>
					</p>
				</div>
				<p class="text-center"> <label for='thanhtoan' style="width: 100%"><a class="btn btn-primary py-3 px-4">
						Thanh Toán
					</a></label>
					<button type="submit" id='thanhtoan' style="display: none"></button>
				</p>
			</form>
			</div>
		</div>
	</div>
	</div>
</section>
<script type="text/javascript">
	$('#discount').on('change',function(){
		const discount = $('#discount').val()
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type:'post',
			url: path + 'cart/discount/check',
			data:{discount:discount},
			success: function(data){
				//alert(data)
				if (parseInt(data) == 0){
					alert('Khuyến mãi không hợp lệ')
				} else {
					const total = $('#total_submit').val() - $('#total_submit').val() * data / 100
					const precent = $('#total_submit').val() * data / 100
					$('#precent').val(precent)
					$('#precent').val(precent+' ('+data+'%)')
					$('#tong').val(total+ ' Vnd')

					$('#total_submit').val(total)
					$('#precent_submit').val(precent)
					//alert(total)
				}
				//alert(data)
				//$('#amount_product').html(data)
			},
			error: function(data) {
        		//alert(JSON.stringify(data));
        		alert('error');
    		}
		})
	})
	// $('.quatity').on('change',function(){
	// 	const quatity = $(this).val()
	// 	const id_cart = $(this)[0].id;
	// 	// alert(id_cart)
	// 	// const tamtinh = $('.tamtinh-0').val()
	// 	$.ajax({
	// 		headers: {
	// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 		},
	// 		type:'post',
	// 		url: path + 'cart/check/quatity',
	// 		data:{quatity:quatity,id_cart:id_cart},
	// 		success: function(data){
	// 			$('.load-data').html(data)
	// 			//alert(data)			
	// 			//console.log(data)
	// 		},
	// 		error: function(data) {
 //        		//alert(JSON.stringify(data));
 //        		alert('error');
 //    		}
	// 	})
	
	// })
	$('.quatity').on('change',function(){
		const quatity = $(this).val()
		const id_cart = $(this)[0].id;
		// alert(id_cart)
		// const tamtinh = $('.tamtinh-0').val()
		window.location= path+'cart/check/amount/'+quatity+'/'+id_cart;
	
	})
</script>
@endsection
