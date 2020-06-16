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
<meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="container">
    <div class="row">
      @foreach( $products as $product)
      <div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
        <div class="product d-flex flex-column"onclick="detail({{$product->id}})">
          <a class="img-prod"><img class="img-fluid" src="{{asset('img/products/')}}/{{json_decode($product->image)[0]}}" alt="Colorlib Template">
            <span class="status">50% Off</span>
            <div class="overlay"></div>
          </a>
          <div class="text py-3 pb-4 px-3">
            <div class="d-flex">
              <div class="cat">
                <span>Đánh giá</span>
              </div>
              <div class="rating">
                <p class="text-left mr-4">
                @for($i = 0; $i < $product->rate; $i++)
                  <a href="#"><span class="ion-ios-star rate" onclick="rate('rate',{{$i}},{{$product->id}})"></span></a>
                @endfor
                @if ($product->rate < 5)
                @for($i = $product->rate; $i < 5; $i++)
                  <a href="#"><span class="ion-ios-star ion-ios-star-outline unrate" onclick="rate('unrate',{{$i}},{{$product->id}})"></span></a>
                @endfor
                @endif
                
              </p>

              </div>
            </div>
            <h3><a href="#">{{$product->name}}</a></h3>
            <div class="pricing">
              <p class="price"><span>{{number_format($product->price,0,'','.')}} vnd</span></p>
            </div>
            <p class="bottom-area d-flex px-3">
              <a href="" class="add-to-cart text-center py-2 mr-1"  onclick='addToCart( "{{ $product->code }}")'><span>Thêm vào giỏ <i class="ion-ios-add ml-1"></i></span></a>
              <a href="#" class="buy-now text-center py-2">Mua<span><i class="ion-ios-cart ml-1"></i></span></a>
            </p>
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">

  function addToCart(codeProduct) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'post',
      url: path + 'cart/add',
      data:{codeProduct:codeProduct},
      success: function(data){
        $('#amount_product').html(data)
      },
      error: function(data) {
        //alert(JSON.stringify(data));
        alert('error');
      }
    })
  }

  function detail($id){
    window.location= path+'product/detail/'+$id;
    //window.location = 'http://127.0.0.1:8000/admin/product/add'
  }

</script>
@endif
@endsection

@section('main') 
  @include('page/layouts/main-content')
@endsection

@section('more')
  @include('page/layouts/more')
@endsection