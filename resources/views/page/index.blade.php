@extends('page/layouts/home')
@section('banner')
  @include('page/layouts/banner')
@endsection

@section('info')
  @include('page/layouts/info')
@endsection


@section('title_product')
  Sản Phẩm Mới
@endsection

@section('content')
@if (!empty($products))
  <div class="container">
    <div class="row">
      @foreach( $products as $product)
      <div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
        <div class="product d-flex flex-column">
          <a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/products/')}}/{{json_decode($product->image)[0]}}" alt="Colorlib Template">
            <span class="status">50% Off</span>
            <div class="overlay"></div>
          </a>
          <div class="text py-3 pb-4 px-3">
            <div class="d-flex">
              <div class="cat">
                <span>Lifestyle</span>
              </div>
              <div class="rating">
                <p class="text-right mb-0">
                  <a href="#"><span class="ion-ios-star-outline"></span></a>
                  <a href="#"><span class="ion-ios-star-outline"></span></a>
                  <a href="#"><span class="ion-ios-star-outline"></span></a>
                  <a href="#"><span class="ion-ios-star-outline"></span></a>
                  <a href="#"><span class="ion-ios-star-outline"></span></a>
                </p>
              </div>
            </div>
            <h3><a href="#">Nike Free RN 2019 iD</a></h3>
            <div class="pricing">
              <p class="price"><span>{{$product->price}} vnd</span></p>
            </div>
            <p class="bottom-area d-flex px-3">
              <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Thêm vào giỏ <i class="ion-ios-add ml-1"></i></span></a>
              <a href="#" class="buy-now text-center py-2">Mua<span><i class="ion-ios-cart ml-1"></i></span></a>
            </p>
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
@endif
@endsection

@section('main') 
  @include('page/layouts/main-content')
@endsection

@section('more')
  @include('page/layouts/more')
@endsection