@extends('page/layouts/home')
@section('show')
<style type="text/css">
  .srcoll::-webkit-scrollbar {
    display: none;
  }
  .a { cursor: pointer; }
</style>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Shop</span></p>
            <h1 class="mb-0 bread">Shop</h1>
          </div>
        </div>
      </div>
    </div> -->

    <section class="ftco-section">
      <div class="container">

        <div class="row" >
          <div class="col-lg-6 mb-5 ftco-animate"  >
            <a href="images/product-1.png" style="transform: scale(0.8); margin-top: -10%;" class="image-popup prod-img-bg"><img src="{{asset('img/products')}}/{{json_decode($product->image)[0]}}" class="img-fluid" alt="Colorlib Template"></a>
          </div>
          <div class="col-lg-6 product-details pl-md-5 ftco-animate">
            <h3>{{$product->name}}</h3>
            <div class="rating d-flex" id='updateRate'>
              <p class="text-left mr-4">
                <a href="#" class="mr-2">{{$product->rate}}.0</a>
                @for($i = 0; $i < $product->rate; $i++)
                  <a href="#"><span class="ion-ios-star rate" onclick="rate('rate',{{$i}},{{$product->id}})"></span></a>
                @endfor
                @if ($product->rate < 5)
                @for($i = $product->rate; $i < 5; $i++)
                  <a href="#"><span class="ion-ios-star ion-ios-star-outline unrate" onclick="rate('unrate',{{$i}},{{$product->id}})"></span></a>
                @endfor
                @endif
                <!-- <a href="#"><span class="ion-ios-star ion-ios-star-outline"></span></a>
                <a href="#"><span class="ion-ios-star ion-ios-star-outline"></span></a>
                <a href="#"><span class="ion-ios-star ion-ios-star-outline"></span></a>
                <a href="#"><span class="ion-ios-star ion-ios-star-outline"></span></a>
                <a href="#"><span class="ion-ios-star-outline"></span></a> -->
              </p>
              <!-- <p class="text-left mr-4">
                <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
              </p>
              <p class="text-left">
                <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
              </p> -->
            </div>
            <p class="price"><span>{{number_format($product->price,3,'.','.')}} VNĐ</span></p>
            <p>{{$product->description}}</p>
            
            <div class="row mt-4">
              <div class="col-md-6">
                <div class="form-group d-flex">
                  <div class="select-wrap" style="width: 100%;">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="" id="size" class="form-control">
                      <option>Size</option>
                      @foreach(json_decode($product->size) as $size)
                        <option value="{{$size}}">{{$size}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group d-flex">
                  <div class="select-wrap" style="width: 100%;">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="" id="color" class="form-control">
                      <option>Color</option>
                      @foreach(json_decode($product->color) as $color)
                        <option value="{{$color}}">{{$color}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              

              <div class="w-100"></div>
              <div class="input-group col-md-6 d-flex mb-3">
                <span class="input-group-btn mr-2">
                    <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                     <i class="ion-ios-remove"></i>
                    </button>
                  </span>
                <input type="number" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                <span class="input-group-btn ml-2">
                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                       <i class="ion-ios-add"></i>
                   </button>
                </span>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">
                <p style="color: #000;"></p>
              </div>
            </div>
            <p><a href='#' onclick='addToCart( "{{ $product->code }}")' class="btn btn-black py-3 px-5 mr-2">Thêm vào giỏ</a><a href="{{route('cart.user',Auth::id())}}" onclick='addToCart( "{{ $product->code }}")' class="btn btn-primary py-3 px-5">Mua</a></p>

            <br>
            <hr>
  
              
              <p>
                <img style="width: 20px;height: 20px;" src='{{asset("icon/comment.png")}}'>&nbsp;
                  &nbsp;
                <a style="color: black" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Bình luận &nbsp; <input type="number" id='count-comment' value="{{count($comments)}}" disabled style="border: none;background-color: #fff;color: black">
                </a>
              </p>
              <div class="collapse srcoll" id="collapseExample" style="max-height: 350px;overflow: scroll;">
                <div class="card card-body" style="border: none;margin-top: -10px;margin-left: 10px;">
                  <div id='load-comment'>
                    <div>
                      @if (isset($comments))
                      @foreach ($comments as $comment)
                        <div style="width: 100%; display: flex;">
                          <div style="width: 15%">{{$comment->user->name}}:</div>
                          <div style="width: 80%">{{$comment->content}}</div>
                          @if(Auth::id() == $comment->user->id)
                           <a class="a" onclick='delComment({{$comment->id}})'><img src="{{asset('icon/delete.png')}}" style="width: 15px; height: 15px;"></a>
                          @endif
                        </div>
                      @endforeach
                      @endif
                    </div>
                  </div>

                </div>
              </div>
              <div style="width: 100%">
                    <input type="text" id='comment' autocomplete=off style="border: 1px solid #eee;width: 90%">
                    <img onclick='comment("{{Auth::user()->code}}","{{$product->code}}")'style="width: 20px;height: 20px;" src='{{asset("icon/send.png")}}'>
                  </div>
          </div>
        </div>

      
        <!-- <div class="row mt-5">
          <div class="col-md-12 nav-link-wrap" style='margin-top:-150px'>
            <div style="transform: scale(0.8);" class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Mô tả</a>

              <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Chi tiết</a>

              <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Bình luận</a>

            </div>
          </div>
          <div class="col-md-12 tab-wrap">
            
            <div class="tab-content bg-light" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                <div class="p-4">
                  <h3 class="mb-4">Nike Free RN 2019 iD</h3>
                  <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                <div class="p-4">
                  <h3 class="mb-4">Manufactured By Nike</h3>
                  <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                <div class="row p-4">
                  <div class="col-md-7">
                    <h3 class="mb-4">23 Reviews</h3>
                    <div class="review">
                      <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                      <div class="desc">
                        <h4>
                          <span class="text-left">Jacob Webb</span>
                          <span class="text-right">14 March 2018</span>
                        </h4>
                        <p class="star">
                          <span>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                          </span>
                          <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                        </p>
                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                      </div>
                    </div>
                    <div class="review">
                      <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                      <div class="desc">
                        <h4>
                          <span class="text-left">Jacob Webb</span>
                          <span class="text-right">14 March 2018</span>
                        </h4>
                        <p class="star">
                          <span>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                          </span>
                          <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                        </p>
                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                      </div>
                    </div>
                    <div class="review">
                      <div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                      <div class="desc">
                        <h4>
                          <span class="text-left">Jacob Webb</span>
                          <span class="text-right">14 March 2018</span>
                        </h4>
                        <p class="star">
                          <span>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                            <i class="ion-ios-star-outline"></i>
                          </span>
                          <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                        </p>
                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="rating-wrap">
                      <h3 class="mb-4">Give a Review</h3>
                      <p class="star">
                        <span>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          (98%)
                        </span>
                        <span>20 Reviews</span>
                      </p>
                      <p class="star">
                        <span>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          (85%)
                        </span>
                        <span>10 Reviews</span>
                      </p>
                      <p class="star">
                        <span>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          (98%)
                        </span>
                        <span>5 Reviews</span>
                      </p>
                      <p class="star">
                        <span>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          (98%)
                        </span>
                        <span>0 Reviews</span>
                      </p>
                      <p class="star">
                        <span>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          <i class="ion-ios-star-outline"></i>
                          (98%)
                        </span>
                        <span>0 Reviews</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </section>
    <script type="text/javascript">
      // comment
      function comment(codeUser,codeProduct){
        const comment = $('#comment').val()
        var count = parseInt($('#count-comment').val())
        
        // alert(codeProduct)
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: path + 'product/comment',
          data:{codeProduct:codeProduct,codeUser:codeUser,comment:comment},
          success: function(data){
            //alert(data)
            $('#load-comment').html(data)
            $('#count-comment').val(count+1)
            $('#comment').val('')
          },
          error: function(data) {
            //alert(JSON.stringify(data));
            alert('error');
          }
        })
      }

      function delComment(id){

        var count = parseInt($('#count-comment').val())
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: path + 'product/comment/delete',
          data:{id:id},
          success: function(data){
            //alert(data)
            $('#load-comment').html(data)
            $('#count-comment').val(count-1)
            $('#comment').val('')
          },
          error: function(data) {
            //alert(JSON.stringify(data));
            alert('error');
          }
        })
      }
    </script>
    <script type="text/javascript">
      function addToCart(codeProduct) {
        const color = $('#color').val()
        const size = $('#size').val()
        const amount = $('#quantity').val()
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: path + 'cart/add',
          data:{codeProduct:codeProduct,color:color,size:size,amount:amount},
          success: function(data){
            //alert(data)
            $('#amount_product').html(data)
          },
          error: function(data) {
            //alert(JSON.stringify(data));
            alert('error');
          }
      })
    }

  // rate 
  function rate(rate,position,idProduct) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'post',
      url: path + 'rate',
      data:{idProduct:idProduct,position:position+1,checkRate:rate},
      success: function(data){
        //alert(data)
        $('#updateRate').html(data)
      },
      error: function(data) {
        //alert(JSON.stringify(data));
        alert('error');
      }
    })
  }
</script>

  <script>
    $(document).ready(function(){

    var quantitiy=0;
       $('.quantity-right-plus').click(function(e){
            
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
                
                $('#quantity').val(quantity + 1);

              
                // Increment
            
        });

         $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
          
                // Increment
                if(quantity>0){
                $('#quantity').val(quantity - 1);
                }
        });
        
    });
  </script>
    
@endsection


