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
                            <h2>Product Category</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- Latest Products Start -->
<section class="latest-product-area latest-padding">
    <div class="container">
        <div class="row product-btn d-flex justify-content-between">
                <div class="select-this d-flex">
                    <div class="featured">
                        <span></span>
                    </div>
                    <form name="sortByBrand" id="sortByBrand" action="">
                        <div class="select-itms">
                            <select name="sort" id="sort">
                                <option value="">Thương hiệu</option>
                                <option value="">Greg Norman</option>
                                <option value="">Fenix</option>
                                <option value="">Ahead</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="select-this d-flex">
                    <div class="featured">
                        <span></span>
                    </div>
                    <form action="#">
                        <div class="select-itms">
                            <select name="select" id="select1">
                                <option value="">Size</option>
                                @foreach ($sizes as $item => $size)
                                <option value="">{{ $size->size }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="select-this d-flex">
                    <div class="featured">
                        <span>Giá sản phẩm: </span>
                    </div>
                    <form action="#">
                        <div class="select-itms">
                            <select name="select" id="select1">
                                <option value="">Featured</option>
                                <option value="">Featured A</option>
                                <option value="">Featured B</option>
                                <option value="">Featured C</option>
                            </select>
                        </div>
                    </form>
                </div>
        </div>
        <section class="cart_area product_table section_padding" style="padding: 0">
            <div class="container">
                <div class="cart_inner product_inner">
                    <div class="table_responsite">
                        <form action="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th >Image</th>
                                        <th >SKU</th>
                                        <th >Name</th>
                                        <th >Size</th>
                                        <th >Stock</th>
                                        <th >W.S Price</th>
                                        <th >Quantity</th>
                                        <th >Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item => $product)
                                    <tr>
                                        <td class="images">
                                            <img src="{{ \Storage::disk('s3')->url('product/'.$product->image) }}" style="width:80px;" alt="">
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <a href="" style="color:#506172">{{ $product->sku }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <a href="" style="color:#506172">{{ $product->name }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <form action="" method="post">
                                            <td>
                                                <div class="media select-itms">
                                                    <select class="media-body nice-select" name="size_id">
                                                        @if ($product->sizes)
                                                        <option class="current">Size</option>
                                                        <ul class="list">
                                                            
                                                            @foreach ($product->sizes as $item => $size)
                                                            <option class="option" value="{{ $size->id }}">{{ $size->size }}</option>
                                                            @endforeach
                                                           
                                                        </ul>
                                                        @endif
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <p>3</p>
                                                    </div>
                                                </div>  
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <p>{{ number_format($product->price) }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product_count">
                                                    <span class="input-number-decrement"> <i class="ti-minus"></i></span>
                                                    <input class="input-number" name="quantity" type="text" value="1" min="0" max="100">
                                                    <span class="input-number-increment"> <i class="ti-plus"></i></span>
                                                  </div>
                                            </td>
                                            <td>
                                                <?php $total = $product->price * 3 ?>
                                                {{ $total }}
                                            </td>
                                            <td>
                                                <button type="submit" style="font-size: 14px; padding:20px;" href="" class="btn btn-primary">add</button>
                                            </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </form>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!-- Latest Products End -->
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
    <script>
        $(document).ready(function(){
            $("#sort").on('change', function(){
                this.form.submit();
            });
        });
    </script>
@endpush