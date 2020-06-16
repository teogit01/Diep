<!DOCTYPE html>
<html lang="en">
  @include('page/layouts/head')
  <body class="goto-here">
  	@include('page/layouts/header')
    <!-- END nav -->
  
    @yield('banner')
    <!-- show info (3 infomatin) -->
    <!-- @yield('info') -->
    <!-- custom -->
    @yield('show')
    
    @yield('main')

    <!-- show more -->
    @yield('more')
    @include('page/layouts/follow-instagram')
   	@include('page/layouts/footer')
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


 	@include('page/layouts/js')
    
  </body>
</html>