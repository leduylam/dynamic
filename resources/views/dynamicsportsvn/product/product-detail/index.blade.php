@extends('dynamicsportsvn.layouts.app')

@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('dynamic/assets/img/hero/category.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $product->sku }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

  <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" style="padding-bottom: 50px">
                    @foreach ($product->images as $item => $image)
                    <div class="mySlides">
                        <div class="numbertext">1 / 6</div>
                            <img src="{{ \Storage::disk('s3')->url('product/'.$image->description) }}" style="width:100%; height:450px;">
                    </div>
                    @endforeach
                    {{-- <div class="mySlides">
                        <div class="numbertext">1 / 6</div>
                            <img src="{{ asset('dynamic/assets/img/categori/product1.png') }}" style="width:100%">
                    </div>
                    <div class="mySlides">
                        <div class="numbertext">2 / 6</div>
                            <img src="{{ asset('dynamic/assets/img/categori/product2.png') }}" style="width:100%">
                    </div>
                    
                    <div class="mySlides">
                        <div class="numbertext">3 / 6</div>
                            <img src="{{ asset('dynamic/assets/img/categori/product3.png') }}" style="width:100%">
                    </div> --}}
                    
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                
                    
                    <!-- Thumbnail images -->
                    <div class="row">
                        @foreach ($product->images as $item => $image)
                        <div class="column">
                            <img class="demo cursor" src="{{ \Storage::disk('s3')->url('product/'.$image->description) }}" style="width:100%; height:56px;" onclick="currentSlide({{ $image->id }})" alt="The Woods">
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <div class="col-lg-6" style="padding-bottom: 50px">
                    <div class="single_product_text" style="margin: 0;">
                        <h3>{{ $product->name }}</h3>
                        <div style="border:1px solid #eee;"></div>
                        <p>
                             {{ $product->description }}
                        </p>
                        <p>SKU: {{ $product->sku }}</p>
                        
                        <p style="font-size: 18px; font-weight:500">Thương hiệu: <span style="color:red; font-weight:300"></span> </p>
                        <div class="row">
                            <div class="col-lg-3 col-pd-3">
                                <h4>Size:</h4>
                                <div class="media select-itms">
                                    <div class="media-body nice-select">
                                        @if ($product->sizes)
                                        <span class="current">Size</span>
                                        <ul class="list">
                                            @foreach ($product->sizes as $item => $size)
                                            <li class="option">{{ $size->size }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-pd-3">
                                
                                <h4>Color:</h4>
                                <div class="media select-itms">
                                    <div class="media-body nice-select">
                                        @if (!empty($product->colors))
                                        <span class="current">Color</span>
                                        <ul class="list">
                                            @foreach ($product->colors as $item => $color)
                                            <li class="option">{{ $color->description }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="dsc-product">
                            
                            <div class="dsc-product-count">
                                <p class="product-qty-text">Quantity</p>
                                <div class="product_count d-inline-block">
                                    <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="product_count_item input-number dsc_input_number" type="text" value="1" min="1" max="100">
                                    <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                
                            </div>
                            <div class="d-flex mt-1 align-items-center">
                                <a href="#" class="btn_3" style="padding: 14px 80px;">add to cart</a>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <div style="border-bottom: 1px solid #e8e8e8; width:100%;"></div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
    <section class="sample-text-area">
		<div class="container box_1170">
			<h3 class="text-heading">Specification</h3>
			<p class="sample-text">92% Polyester, 8% Elastane</p>
			<p class="sample-text">Circular Knit</p>
			<p class="sample-text">UV Resistant 50 UPF</p>
			<p class="sample-text">Moisture wicking</p>
			<p class="sample-text">4 way stretch</p>
			<p class="sample-text">Volition Lockup logo on back</p>
			<p class="sample-text">Flag Graphic on chest</p>
			<p class="sample-text">Style #: {{ $product->sku }}</p>
		</div>
	</section>
@endsection
@push('slide-product')
    <script>

        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        }
    </script>
@endpush