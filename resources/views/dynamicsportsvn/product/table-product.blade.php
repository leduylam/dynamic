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
                                        <th >Hình ảnh</th>
                                        <th >SKU</th>
                                        <th >Tên</th>
                                        <th >Size</th>
                                        <th >Màu</th>
                                        <th >Giá W.S</th>
                                        <th >Giá bán lẻ</th>
                                        <th >Số lượng</th>
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
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="media select-itms">
                                                <div class="media-body nice-select">
                                                    <span class="current">Color</span>
                                                    <ul class="list">
                                                        @if ($product->colors)
                                                        @foreach ($product->colors as $item => $color)
                                                        <li class="option">{{ $color->color }}</li>
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>{{ $product->price }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>
                                                        <?php $retail = $product->price * 1.6 ?>
                                                        {{ $retail }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <span class="input-number-decrement"> <i class="ti-minus"></i></span>
                                                <input class="input-number" name=" " type="text" value="1" min="0" max="10">
                                                <span class="input-number-increment"> <i class="ti-plus"></i></span>
                                              </div>
                                        </td>
                                        <td>
                                            <?php $total = $product->price * 3 ?>
                                            {{ $total }}
                                        </td>
                                        <td>
                                            <a style="font-size: 14px; padding:20px;" href="" class="btn btn-primary">add</a>
                                        </td>
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