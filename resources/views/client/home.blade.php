@extends('client_layout.client')


@section('title')

    Home

@endsection


@section('content')
<!-- start content -->

{{-- <section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
    
        @foreach ($allSlidersFromTableByStatus as $sliderFromTableWhereStatus)
            <div class="slider-item" style="background-image: url(/storage/slider_images/{{ $sliderFromTableWhereStatus->slider_image }});">

                <div class="overlay"></div>

                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">{{ $sliderFromTableWhereStatus->slider_description1 }}</h1>
                            <h2 class="subheading mb-4">{{ $sliderFromTableWhereStatus->slider_description2 }}</h2>
                            <p><a href="#" class="btn btn-primary">View Details</a></p>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
</section> --}}



<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading">Featured Products</span>
        <h2 class="mb-4">Our Products</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
      </div>
    </div>   		
  </div>
  <div class="container">
    <div class="row">
      @foreach ($allProductsFromTableByStatus as $productFromTableByStatus)
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="product">
            <a href="#" class="img-prod">
              <img class="img-fluid" src="storage/product_images/{{ $productFromTableByStatus->product_image }}" alt="Colorlib Template">
              <span class="status">30%</span>
              <div class="overlay"></div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
              <h3><a href="#">{{ $productFromTableByStatus->product_name }}</a></h3>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price">
                    <span class="mr-2 price-dc"></span>
                    <span class="price-sale">{{ $productFromTableByStatus->product_price }}</span>
                  </p>
                </div>
              </div>
              <div class="bottom-area d-flex px-3">
                <div class="m-auto d-flex">
                  <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                    <span><i class="ion-ios-menu"></i></span>
                  </a>
                  <a href="{{ url('/add-to-cart/' . $productFromTableByStatus->id) }}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                    <span><i class="ion-ios-cart">{{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}</i></span>
                  </a>
                  <a href="#" class="heart d-flex justify-content-center align-items-center ">
                    <span><i class="ion-ios-heart"></i></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

 

<hr>



<!-- end content -->
@endsection