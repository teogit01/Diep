<style type="text/css">
  .sidebar { color: red }
  p { color: black }
</style>
<div class="sidebar" data-color="white" data-active-color="danger">
  <div class="logo">
    <a href="https://www.creative-tim.com" class="simple-text logo-mini">
      <div class="logo-image-small">
        <img src="{{asset('assets/img/logo-small.png')}}">
      </div>
      <!-- <p>CT</p> -->
    </a>
    <a href="https://www.creative-tim.com" class="simple-text logo-normal">
      Creative Tim
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <!-- <li class="act">
        <a href="./dashboard.html">
          <i class="nc-icon nc-bank"></i>
          <p>Dashboard</p>
        </a>
      </li> -->
      <li class="" id ='product'>
        <a href="{{route('admin.product.index')}}">
          <i class="nc-icon nc-diamond"></i>
          <p>Sản Phẩm</p>
        </a>
      </li>
      <li class="" id='type'>
        <a href="{{route('type.index')}}">
          <i class="nc-icon nc-pin-3" ></i>
          <p>Loại</p>
        </a>
      </li>
      <li class="" id='producer'>
        <a href="{{route('producer.index')}}">
          <i class="nc-icon nc-bell-55"></i>
          <p>Nhà Sản Xuất</p>
        </a>
      </li>
      <li class="" id='distributor'>
        <a href="{{route('distributor.index')}}">
          <i class="nc-icon nc-single-02"></i>
          <p>Nhà Phân Phối</p>
        </a>
      </li>
      <li class="" id='discount'>
        <a href="{{route('discount.index')}}">
          <i class="nc-icon nc-tile-56"></i>
          <p>Khuyến Mãi</p>
        </a>
      </li>
      <li class="" id='user'>
        <a href="{{route('user.index')}}">
          <i class="nc-icon nc-caps-small"></i>
          <p>Khách Hàng</p>
        </a>
      </li>
      <li class="" id='bill'>
        <a href="{{route('bill')}}">
          <i class="nc-icon nc-spaceship"></i>
          <p>Hóa Đơn</p>
        </a>
      </li>
      <li class="" id='statistic'>
        <a href="{{route('statistic')}}">
          <i class="nc-icon nc-spaceship"></i>
          <p>Thống Kê</p>
        </a>
      </li>
    </ul>
  </div>
</div>
<script type="text/javascript">
  $('.act').on('click',function(){
    //$(this).append('<div>ok</div>')
    //$(this).css('color','greens')
  })
</script>