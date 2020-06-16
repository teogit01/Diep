<div class="rating d-flex">
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
  </p>
  <!-- <p class="text-left mr-4">
    <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
  </p>
  <p class="text-left">
    <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
  </p> -->
</div>