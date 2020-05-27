<div class="py-1 bg-black">
  		<div class="container">
  			<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
  				<div class="col-lg-12 d-block">
  					<div class="row d-flex">
  						<div class="col-md pr-4 d-flex topper align-items-center">
  							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
  							<span class="text">+ 1235 2355 98</span>
  						</div>
  						<div class="col-md pr-4 d-flex topper align-items-center">
  							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
  							<span class="text">youremail@email.com</span>
  						</div>
  						<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
  							<span class="text">3-5 Business days delivery &amp; Free Returns</span>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Minishop</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="{{route('home')}}" class="nav-link">Trang chủ</a></li>
	          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nam, Nữ</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="{{route('product.all')}}">Tất cả</a>
                <a class="dropdown-item" href="product-single.html">Nam</a>
                <a class="dropdown-item" href="cart.html">Nữ</a>
                <a class="dropdown-item" href="checkout.html">Checkout</a>
              </div>
            </li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>

            @if (Auth::check())
              <li class="nav-item cta cta-colored"><a href="{{route('cart.user',Auth::id())}}" class="nav-link"><span class="icon-shopping_cart"></span>[<span id='amount_product'>{{ isset($amount_product) ? $amount_product : 0 }}</span>]</a></li>
              <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">{{Auth::user()->name}}</a></li>
              <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">Đăng xuất</a></li>
            @else
              <li class="nav-item cta cta-colored"><a href="{{route('cart.index')}}" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
              <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Đăng nhập</a></li>
              <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Đăng ký</a></li>
            @endif

	        </ul>
	      </div>
	    </div>
	  </nav>