@extends('page/layouts/home')
@section('banner')
  <br><br><br>
@endsection
@section('main')
  <style type="text/css">
 
  .pagination { --display: none; }

  .page-link {  }
</style>
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

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			@yield('all-product')

    			@include('page/layouts/menu-category')
    		</div>
    	</div>
    </section>

@endsection

@yield('js')

