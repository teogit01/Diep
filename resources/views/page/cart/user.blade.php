
@extends('page/layouts/home')
@section('banner')

@endsection
@section('show')
<div id='show'></div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="ftco-section ftco-cart">
	<div class="container">
		<!-- <h3>Chưa có sản phẩm</h3> -->
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@if ($cart_detail)
								@foreach($cart_detail as $index => $detail)
								<form method="post" action="{{route('cart.detail.remove',[Auth::id(),$detail->product_code])}}">
									@csrf
									<tr class="text-center">
										<td class="product-remove">
											<!-- <a href="#" onclick="remove_product('{{Auth::id()}}','{{$detail->product_code}}','{{Auth::user()->code}}')"><span class="ion-ios-close"></span></a> -->
											<label for='product-remove-{{$index}}'><span class="ion-ios-close"></span></label>
											<button type="submit" id='product-remove-{{$index}}' style="display: none"></button>
										</td>

										<td class="image-prod"><div class="img" style="background-image:url({{asset('img/products')}}/{{json_decode($detail->product[0]->image)[0]}});"></div></td>
										
										<td class="product-name">
											<h3>{{$detail->product[0]->name}}</h3>
											<p>Far far away, behind the word mountains, far from the countries</p>
										</td>

										<td class="price">{{$detail->product[0]->price}} vnđ</td>

										<td class="quantity">
											<div class="input-group mb-3">
												<input type="text" name="quantity" class="quantity form-control input-number" value="{{$detail->amount}}" min="1" max="100">
											</div>
										</td>

										<td class="total">{{$detail->product[0]->price * $detail->amount }} vnđ</td>
									</tr>
									</form>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row justify-content-start">
			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
				<div class="cart-total mb-3">
					<h3>Cart Totals</h3>
					<p class="d-flex">
						<span>Subtotal</span>
						<span>0</span>
					</p>
					<p class="d-flex">
						<span>Delivery</span>
						<span>0</span>
					</p>
					<p class="d-flex">
						<span>Discount</span>
						<span>0</span>
					</p>
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span>0</span>
					</p>
				</div>
				<p class="text-center"><a href="{{route('cart.pay',Auth::id())}}" class="btn btn-primary py-3 px-4">Thanh Toán</a></p>
			</div>
		</div>
	</div>
</section>
@endsection
