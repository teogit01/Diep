
<!DOCTYPE html>
<html lang="en">

@include('layouts/head')

<body class="">
  <div class="wrapper ">
    @include('layouts/left-menu')  

    <div class="main-panel" style="background-color: #eee">
      <!-- Navbar -->
      
        @include('layouts/header')    
        <br><br><br>
      
      
      <!-- End Navbar -->
      <div class="conten">
        @yield('content')
      </div>

      @include('layouts/footer')
    </div>
  </div>
  <!--   Core JS Files   -->
 @include('layouts/js')
</body>

</html>
