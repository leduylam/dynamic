@extends('dynamicsportsvn.layouts.app')

@section('content')
<main>

    <!-- slider Area Start -->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider slider-height" data-background="{{ asset('dynamic/assets/img/hero/h1_hero.jpg') }}">
                <div class="container">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                            <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                {{-- <img src="{{ \Storage::disk('s3')->url('categories/'.$category->image) }}" alt=""> --}}
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                            <div class="hero__caption">
                                <span data-animation="fadeInRight" data-delay=".4s">60% Discount</span>
                                <h1 data-animation="fadeInRight" data-delay=".6s">Winter <br> </h1>
                                <p data-animation="fadeInRight" data-delay=".8s">Best Cloth Collection By 2020!</p>
                                <!-- Hero-btn -->
                                <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                    <a href="industries.html" class="btn hero-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider slider-height" data-background="{{ asset('dynamic/assets/img/hero/h1_hero.jpg') }}">
                <div class="container">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                            <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                <img src="{{ asset('dynamic/assets/img/hero/hero_man.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                            <div class="hero__caption">
                                <span data-animation="fadeInRight" data-delay=".4s">60% Discount</span>
                                <h1 data-animation="fadeInRight" data-delay=".6s">Winter <br> Collection</h1>
                                <p data-animation="fadeInRight" data-delay=".8s">Best Cloth Collection By 2020!</p>
                                <!-- Hero-btn -->
                                <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                    <a href="industries.html" class="btn hero-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- slider Area End-->
    <!-- Category Area Start-->
    <section class="category-area section-padding30">
        <div class="container-fluid">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center mb-85">
                        <h2>Shop by Category</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="single-category mb-30">
                        <div class="category-img">
                            <img src="{{ asset('dynamic/assets/img/categori/cat1.jpg') }}" alt="">
                            <div class="category-caption">
                                <h2>Owmen`s</h2>
                                <span class="best"><a href="#">Best New Deals</a></span>
                                <span class="collection">New Collection</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="single-category mb-30">
                        <div class="category-img text-center">
                            <img src="{{ asset('dynamic/assets/img/categori/cat2.jpg') }}" alt="">
                            <div class="category-caption">
                                <span class="collection">Discount!</span>
                                <h2>Winter Cloth</h2>
                            <p>New Collection</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="single-category mb-30">
                        <div class="category-img">
                            <img src="{{ asset('dynamic/assets/img/categori/cat3.jpg') }}" alt="">
                            <div class="category-caption">
                                {{-- <h2>{{ $category->name }} Cloth</h2> --}}
                                <span class="best"><a href="#">Best New Deals</a></span>
                                <span class="collection">New Collection</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Area End-->
    <!-- Latest Products Start -->
    <section class="latest-product-area padding-bottom">
        <div class="container">
            <div class="row product-btn d-flex justify-content-end align-items-end">
                <!-- Section Tittle -->
                <div class="col-xl-4 col-lg-5 col-md-5">
                    <div class="section-tittle mb-30">
                        <h2>Latest Products</h2>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 col-md-7">
                    <div class="properties__button f-right">
                    </div>
                </div>
            </div>
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <!-- card one -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        @if (!empty($products))
                        @foreach ($products as $product)
                        <div class="col-lg-3">
                            @foreach ($product->images as $item)
                            <div class="mySlides">
                                <div class="numbertext"></div>
                                    <img src="{{ \Storage::disk('s3')->url('product/'.$item->description) }}" style="width:100%; height:300px">
                            </div>
                            @endforeach
                            <!-- Next and previous buttons -->
                            <a class="prev" style="position: absolute; width: 15px; top: 125px" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" style="position: absolute; width: 15px; top: 125px" onclick="plusSlides(1)">&#10095;</a>
                        
                            
                            <!-- Thumbnail images -->
                            <div class="row">
                                @foreach ($product->images as $item)
                                <div class="column">
                                    <img class="demo cursor" src="{{ \Storage::disk('s3')->url('product/'.$item->description) }}" style="width:100%; height:40px" onclick="currentSlide({{ $item->id }})" alt="The Woods">
                                </div>
                                @endforeach
                            </div>
                            
                            <h4 style="margin-top:40px;"><a href="{{ route('product.product-detail', $product->id) }}" style="font-size:16px;">{{ $product->name }}</a></h4>
                        </div>
                        @endforeach
                        @endif
                        
                        
                    </div>
                </div>
            </div>
            <!-- End Nav Card -->
        </div>
    </section>
    <!-- Latest Products End -->
    <!-- Best Collection Start -->
    <div class="best-collection-area padding-bottom">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-end">
                <!-- Left content -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="best-left-cap">
                        <h2>Best Collection of This Month</h2>
                        <p>Designers who are interesten crea.</p>
                        <a href="#" class="btn shop1-btn">Shop Now</a>
                    </div>
                    <div class="best-left-img mb-30 d-none d-sm-block">
                        <img src="{{ asset('dynamic/assets/img/collection/collection1.png') }}" alt="">
                    </div>
                </div>
                <!-- Mid Img -->
                <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                    <div class="best-mid-img mb-30 ">
                        <img src="{{ asset('dynamic/assets/img/collection/collection2.png') }}" alt="">
                    </div>
                </div>
                <!-- Riht Caption -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="best-right-cap ">
                    <div class="best-single mb-30">
                        <div class="single-cap">
                            <h4>Menz Winter<br> Jacket</h4>
                        </div>
                        <div class="single-img">
                            <img src="{{ asset('dynamic/assets/img/collection/collection3.png') }}" alt="">
                        </div>
                    </div>
                    </div>
                    <div class="best-right-cap">
                    <div class="best-single mb-30">
                        <div class="single-cap active">
                            <h4>Menz Winter<br>Jacket</h4>
                        </div>
                        <div class="single-img">
                            <img src="{{ asset('dynamic/assets/img/collection/collection4.png') }}" alt="">
                        </div>
                    </div>
                    </div>
                    <div class="best-right-cap">
                    <div class="best-single mb-30">
                        <div class="single-cap">
                            <h4>Menz Winter<br> Jacket</h4>
                        </div>
                        <div class="single-img">
                            <img src="{{ asset('dynamic/assets/img/collection/collection5.png') }}" alt="">
                        </div>
                    </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- Best Collection End -->
    <!-- Gallery Start-->
    <div class="gallery-wrapper lf-padding">
        <div class="gallery-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="gallery-items">
                        <img src="{{ asset('dynamic/assets/img/gallery/gallery1.jpg') }}" alt="">
                    </div> 
                    <div class="gallery-items">
                        <img src="{{ asset('dynamic/assets/img/gallery/gallery2.jpg') }}" alt="">
                    </div>
                    <div class="gallery-items">
                        <img src="{{ asset('dynamic/assets/img/gallery/gallery3.jpg') }}" alt="">
                    </div>
                    <div class="gallery-items">
                        <img src="{{ asset('dynamic/assets/img/gallery/gallery4.jpg') }}" alt="">
                    </div>
                    <div class="gallery-items">
                        <img src="{{ asset('dynamic/assets/img/gallery/gallery5.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End-->

</main>
@endsection
@push('after-js')
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