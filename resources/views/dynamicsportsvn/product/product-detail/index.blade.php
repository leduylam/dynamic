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
                            <h2>product Details</h2>
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
                <div class="col-lg-5">
                    
                    <div class="mySlides">
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
                    </div>
                    
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                
                    
                    <!-- Thumbnail images -->
                    <div class="row">
                        <div class="column">
                            <img class="demo cursor" src="{{ asset('dynamic/assets/img/categori/product1.png') }}" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="{{ asset('dynamic/assets/img/categori/product2.png') }}" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
                        </div>
                        <div class="column">
                            <img class="demo cursor" src="{{ asset('dynamic/assets/img/categori/product3.png') }}" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="single_product_text" style="margin: 0;">
                        <h3>Foam filling cotton slow rebound pillows</h3>
                        <h4 style="margin-top: 35px;">VND 621.754</h4>
                        <div style="border:1px solid #eee;"></div>
                        <p>
                             r organic sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences. Dramatically synthesize integrated schemas. with optimal networks.
                        </p>

                        <p style="font-size: 18px; font-weight:500">Thương hiệu: <span style="color:red; font-weight:300">Puma</span> </p>
                        <p>SKU: 0234276</p>
                        <div class="row">
                            <div class="col-lg-3 col-pd-3">
                                <h4>Size:</h4>
                                <div class="media select-itms">
                                    
                                    <div class="media-body nice-select">
                                        <span class="current">02</span>
                                        <ul class="list">
                                            <li class="option">03</li>
                                            <li class="option">01</li>
                                            <li class="option">04</li>
                                            <li class="option">05</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-pd-3">
                                
                                <h4>Color:</h4>
                                <div class="media select-itms">
                                    <div class="media-body nice-select">
                                        <span class="current">02</span>
                                        <ul class="list">
                                            <li class="option">03</li>
                                            <li class="option">01</li>
                                            <li class="option">04</li>
                                            <li class="option">05</li>
                                        </ul>
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
                                <p style=" margin:0; padding:20px; text-align: right;">6 pcs in stock</p>
                            </div>
                            <div class="d-flex mt-1 align-items-center">
                                <a href="#" class="btn_3" style="padding: 14px 80px;">add to cart</a>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
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