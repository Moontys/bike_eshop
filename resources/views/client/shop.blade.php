@extends('client_layout.client')

@php
	use App\Calculator\DiscountCalculator;
@endphp

@section('title')
    Shop
@endsection


@section('content')
<!-- start content -->

	{{-- <section id="home-section" class="hero">
		<div class="home-slider owl-carousel">
		
			@foreach ($allSlidersByStatus as $sliderByStatus)
				<div class="slider-item" style="background-image: url(/storage/slider_images/{{ $sliderByStatus->slider_image }});">

					<div class="overlay"></div>

					<div class="container">
						<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

							<div class="col-md-12 ftco-animate text-center">
								<h1 class="mb-2">{{ $sliderByStatus->slider_description1 }}</h1>
								<h2 class="subheading mb-4">{{ $sliderByStatus->slider_description2 }}</h2>
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
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
					
					<ul class="product-category">

						<li><a href="{{ url('/shop') }}" class="{{ request()->is('shop*') || request()->is('/') ? 'active' : '' }}">All</a></li>
					
						@foreach ($allCategories as $category)
							<li><a href="{{ url('/products-by-category/' . $category->category_name) }}" class="{{ request()->is('products-by-category/' . $category->category_name) ? 'active' : '' }}">{{ $category->category_name }}</a></li>
						@endforeach

					</ul>

    			</div>
    		</div>

    		<div class="row">
				@foreach ($allProductsByStatusOrByCategoryAndStatus->items() as $productByStatusOrByCategoryAndStatus)

					<div class="col-md-6 col-lg-3 ftco-animate">
						<div class="product">
							<a href="{{ url('/display-product/' . $productByStatusOrByCategoryAndStatus->id) }}" class="img-prod"><img class="img-fluid" src="{{ asset('storage/product_images/' . $productByStatusOrByCategoryAndStatus->product_image) }}" alt="Image">

								@if ($productByStatusOrByCategoryAndStatus->discount_id !== null)
									<span class="status"> -{{ $productByStatusOrByCategoryAndStatus->discount->discount_percentage }}% </span>
								@endif

								<div class="overlay"></div>
							</a>
							<div class="text py-3 pb-4 px-3 text-center">
								<h3><a href="3">{{ $productByStatusOrByCategoryAndStatus->product_name }}</a></h3>
								<div class="d-flex">
									<div class="pricing">
										<p class="price">

											@if ($productByStatusOrByCategoryAndStatus->discount_id !== null)
												<span class="mr-2 price-dc">{{ $productByStatusOrByCategoryAndStatus->product_price }}€ </span>
											@endif

											<span class="price-sale">{{ DiscountCalculator::calculateProductPriceAfterDiscount($productByStatusOrByCategoryAndStatus) }}€ </span>
										</p>
									</div>
								</div>

								<div class="bottom-area d-flex px-3">
									<div class="m-auto d-flex">
										<a href="{{ url('/display-product/' . $productByStatusOrByCategoryAndStatus->id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
											<span><i class="ion-ios-menu"></i></span>
										</a>
										<a href="{{ url('/add-to-cart/' . $productByStatusOrByCategoryAndStatus->id) }}" class="buy-now d-flex justify-content-center align-items-center mx-1">
											<span><i class="ion-ios-cart"></i></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				@endforeach
			</div>


			@if ($allProductsByStatusOrByCategoryAndStatus->lastPage() > 1)
				<div class="row mt-5">
					<div class="col text-center">
						<div class="block-27">
							<ul>
								<li><a href="#">&lt;</a></li>

								@for ($i = 1; $i <= $allProductsByStatusOrByCategoryAndStatus->lastPage(); $i++)
									<li class="{{ ($allProductsByStatusOrByCategoryAndStatus->currentPage() == $i) ? ' active' : '' }}"><span><a href="{{ $allProductsByStatusOrByCategoryAndStatus->url($i) }}">{{ $i }}</a></span></li>
								@endfor
								
								<li><a href="#">&gt;</a></li>
							</ul>
						</div>
					</div>
				</div>
			@endif



    	</div>
    </section>
<!-- end content -->

@endsection
	