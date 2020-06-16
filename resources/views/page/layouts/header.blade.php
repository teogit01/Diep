<div class="py-1 bg-black">
  		<div class="container">
  			<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
  				<div class="col-lg-12 d-block">
  					<div class="row d-flex">
  						<div class="col-md pr-4 d-flex topper align-items-center">
  							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
  							<span class="text">+ 079330000</span>
  						</div>
  						<div class="col-md pr-4 d-flex topper align-items-center">
  							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
  							<span class="text">diepadmin@email.com</span>
  						</div>
  						<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
  							<span class="text">3/2-Xuân Khánh-Cẩn Thơ &amp; Free Ship</span>
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
                <a class="dropdown-item" href="{{route('product.nam')}}">Nam</a>
                <a class="dropdown-item" href="{{route('product.nu')}}">Nữ</a>
                <!-- <a class="dropdown-item" href="checkout.html">Checkout</a> -->
              </div>
            </li>
	          <li class="nav-item"><a href="about.html" class="nav-link">Giới Thiệu</a></li>
	          <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
	          <li class="nav-item"><a href="contact.html" class="nav-link">Liên Hệ</a></li>

            @if (Auth::check())
              <li class="nav-item cta cta-colored"><a href="{{route('cart.user',Auth::id())}}" class="nav-link"><span class="icon-shopping_cart"></span>[<span id='amount_product'>{{ isset($amount_product) ? $amount_product : 0 }}</span>]</a></li>
              <li class="nav-item"><a href="{{route('profile',Auth::id())}}" class="nav-link">{{Auth::user()->name}}</a></li>
              <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">Đăng xuất</a></li>
            @else
              <li class="nav-item cta cta-colored"><a href="{{route('cart.index')}}" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
              <li class="nav-item"><a data-toggle="modal" data-target="#login" href="" class="nav-link">Đăng nhập</a></li>
              <li class="nav-item"><a data-toggle="modal" data-target="#register" href="" class="nav-link">Đăng ký</a></li>
            @endif

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!--Form Login-->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="--background-color: #DBCC8F">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Đăng Nhập</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="main">
              <div class="main-content">
                <form method="post" action="{{route('postLogin')}}">
                  @csrf
                  <label>Tài Khoản:</label>
                  <input type="text" name="user" class="form-contro" style="width: 100%;" placeholder="" autocomplete="off">
                  <label>Mật Khẩu:</label>
                  <input type="password" name="pass" class="form-contro" style="width: 100%" placeholder="" autocomplete="off">

                  <br>

                  <input type="checkbox" name="remember" value="">
                  <span>Remember Me</span>

                  <br>
                  <br>
                  <button type="submit" class="btn btn-block btn-info" style="border-radius: 4px">Đăng Nhập</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>

<!--Register-->
 <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="--background-color: #DBCC8F">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Đăng Ký</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="main">
              <div class="main-content">
                <form method="post" action="{{route('postRegister')}}">
                  @csrf
                  <label>Họ tên</label>
                  <input type="text" name="name" class="form-contro" style="width: 100%" placeholder="" autocomplete="off">

                  <label>Số điện thoại</label>
                  <input type="text" name="phone" class="form-contro" style="width: 100%" placeholder="" autocomplete="off">
                  
                  <label>Tên đăng nhập</label>
                  <input type="text" name="username" class="form-contro" style="width: 100%" placeholder="" autocomplete="off">

                  <label>Mật khẩu</label>
                  <input type="password" name="password" class="form-contro" style="width: 100%" placeholder="" autocomplete="off">

                  <label>Nhập lại mật khẩu</label>
                   <input type="password" name="confimpassword" style="width: 100%" class="form-contro" placeholder="" autocomplete="off">
                  
              
                    <input type="checkbox" name="remember" value="">
                    <span>Remember Me</span>
                    
                  <br><br>
              
                    <button type="submit" class="btn btn-block btn-info" style="border-radius: 4px">Đăng ký</button>
                  
                  
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
