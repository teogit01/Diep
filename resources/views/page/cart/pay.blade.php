@extends('page/layouts/home')
@section('banner')

@endsection
@section('show')


<!-- <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
				<h1 class="mb-0 bread">Checkout</h1>
			</div>
		</div>
	</div>
</div> -->

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-11 ftco-animate">
				<form action="{{route('cart.post.pay',Auth::id())}}" class="billing-form" method="post">
					@csrf
					<input type="text" name="total" value="{{$total}}" style="display: none">
					<input type="text" name="precent" value="{{$precent}}" style="display: none">
					<h3 class="mb-4 billing-heading">Thông Tin Thanh Toán</h3>
					<div class="row col-sm-12" style="--background-color: #ddd">
						<div class="col-sm-7" style="--background-color: blue">
							<div class="row align-items-end">
								<div class="col-md-12">
									<div class="form-group">
										<label for="name">Tên</label>
										<input type="text" name="name" class="form-control d" placeholder="{{Auth::user()->name}}">
									</div>
								</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="lastname">Số điện thoại</label>
									<input type="text" name="phone" class="form-control" placeholder="{{Auth::user()->phone}}">
								</div>
							</div>
						
							<div class="col-md-12">
								<div class="form-group">
									<label for="phone">Địa chỉ giao hàng</label>
									<input type="text" name="address" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="emailaddress">Ghi chú (nếu có) </label>
									<input type="text" name="note" class="form-control" placeholder="">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-12">
								<!-- <div class="form-group mt-4">
									<div class="radio">
										<label class="mr-3"><input type="radio" name=""> Create an Account? </label>
										<label><input type="radio" name=""> Ship to different address</label>
									</div>
								</div> -->

								<div class="col-sm-12" style="">
									<button type="submit" class="btn btn-primary py-3 px-4">Thanh Toán</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5" style="padding-left: 50px;">
						<div class="row col-sm-12" style="--background-color: red">
							
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Thành Tiền</h3>
								<p class="d-flex">
									<span>Tạm Tính</span>
									<span>{{number_format($total+$precent,3,'.','.')}} vnd</span>
								</p>
								<p class="d-flex">
									<span>Khuyến Mãi</span>
									<span>{{number_format($precent,3,'.','.')}}</span>
								</p>
								<hr>
								<p class="d-flex total-price">
									<span>Tổng Cộng</span>
									<span>{{number_format($total,3,'.','.')}} vnd</span>
								</p>
							</div>
							

							<div class="col-md-12">
								<h3 class="billing-heading mb-4" style="font-size: 17px;">Phương Thức Thanh Toán</h3>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" name="optradio" checked="" class="mr-2"> Tiền mặt</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" name="optradio" class="mr-2"> PayPal</label>
										</div>
									</div>
								</div>
								<!-- <div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
										</div>
									</div>
								</div> -->
								<!-- <div class="form-group">
									<div class="col-md-12">
										<div class="checkbox">
											<label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
										</div>
									</div>
								</div>
								<p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p> -->
						</div>

					</div>
						
					<!-- <div class="col-sm-6" style="background-color: black">
							<button type="submit" class="btn btn-success">Thanh Toán</button>
						</div> -->
				</form><!-- END -->
				</div>
			</div> <!-- .col-md-8 -->
		</div>
	</div>
</section> <!-- .section -->

@endsection