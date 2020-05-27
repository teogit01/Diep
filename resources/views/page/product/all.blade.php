@extends('page/layouts/product')
@section('all-product')
<div class="col-md-8 col-lg-10 order-md-last">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="row">
    @if(!empty($products))
    @foreach($products as $product)
    <div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
      <div class="product d-flex flex-column">
        <a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/products/')}}/{{json_decode($product->image)[0]}}" alt="Colorlib Template">
          <span class="status">50% Off</span>
          <div class="overlay"></div>
        </a>
        <div class="text py-3 pb-4 px-3">
          <div class="d-flex">
            <div class="cat">
              <span>Đánh giá</span>
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
          <h3><a href="#">{{ $product->name }}</a></h3>
          <div class="pricing">
            <p class="price"><span>{{ $product->price }} vnd</span></p>
          </div>
          <p class="bottom-area d-flex px-3">
            <a href="#" onclick='addToCart( "{{ $product->code }}")' class="add-to-cart text-center py-2 mr-1"><span>Thêm vào giỏ <i class="ion-ios-add ml-1"></i></span></a>
            <a href="#" class="buy-now text-center py-2">Mua<span><i class="ion-ios-cart ml-1"></i></span></a>
          </p>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>

  <div class="row mt-5">
    <div class="col text-center">
      <div class="block-27">{{ $products->links() }}</div>
      <div class="block-27">
        <ul>
          <li><a href="#">&lt;</a></li>
          <li class="active"><span>1</span></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">&gt;</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
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


</script>
@endsection






