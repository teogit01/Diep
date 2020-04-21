<!doctype html>
<html class="no-js" lang="">
    
    @include('layouts/head')

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
          <!-- Start Header Top Area -->
    
    @include('layouts/header-bar')

    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    @include('layouts/mobile-menu-start')
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    @include('layouts/top-menu')
    <!-- Main Menu area End-->
    @yield('content')
    <!-- Start Footer area-->
    @include('layouts/footer')
    <!-- End Footer area-->
    @include('layouts/script')
</body>

</html>