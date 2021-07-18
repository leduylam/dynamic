@extends('dynamicsportsvn.layouts.app')

<style type="text/css">
        /* Hide the images by default */

        img {
            vertical-align: middle;
        }

        .mySlides {
            display: none;
        }

        /* Add a pointer when hovering over the thumbnail images */
        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 40%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: #274085;
            color: #fff;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* Container for image text */
        .caption-container {
            text-align: center;
            background-color: #274085;
            padding: 2px 16px;
            color: #fff;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Six columns side by side */
        .column {
            float: left;
            width: 16.66%;
        }

        /* Add a transparency effect for thumnbail images */
        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }

        a.disabled {
            pointer-events: none;
            color: #ccc;
        }

    </style>
@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center"
            data-background="{{ asset('dynamic/assets/img/hero/category.jpg') }}">
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
                    <!-- Full-width images with number text -->
                    @if (!empty($product->images))
                    @foreach ($product->images as $image)
                      <div class="mySlides">
                        <div class="numbertext">1 / 6</div>
                        <img src="{{ \Storage::disk('s3')->url('product/'.$image->description) }}" style="width:100%">
                    </div>
                    @endforeach

                    @endif
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                    <!-- Image text -->
                    <div class="caption-container">

                    </div>

                    <!-- Thumbnail images -->
                    <div class="row">

                      @foreach ($product->images as $image)
                      <div class="column">
                        <img class="demo cursor" src="{{ \Storage::disk('s3')->url('product/'.$image->description) }}"
                            style="width:100%" onclick="currentSlide({{ $image->id }})" alt="">
                    </div>
                      @endforeach


                    </div>
                </div>
                <div class="col-lg-6" style="padding-bottom: 50px">
                    <div class="single_product_text" style="margin: 0;">
                        <h3>{{ $product->name }}</h3>
                        <p style="font-size: 24px">{{ $product->price }} VND</p>
                        <div style="border:1px solid #eee;"></div>
                        <p>
                            {{ $product->description }}
                        </p>
                        <p>SKU: {{ $product->sku }}</p>

                        <p style="font-size: 18px; font-weight:500">Thương hiệu: {{ $product->details['brand'] }} <span
                                style="color:red; font-weight:300"></span> </p>
                        <form action="{{ url('product/add-to-card') }}" method="post"> @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-lg-4 col-pd-4">
                                    <h4>Size:</h4>
                                    <div class="media select-itms">
                                        <select class="media-body nice-select size_id" name="size_id">
                                            @if (!empty($sizes->toArray()))
                                                <option class="current">-- Size --</option>
                                                <ul class="list size_id">
                                                    @foreach ($sizes as $item => $size)
                                                        <option class="option" value="{{ $size->id }}">
                                                            {{ $size->size }}</option>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-pd-4">
                                    <h4>Color:</h4>
                                    <div class="media select-itms">
                                        <select class="media-body nice-select color_id" name="color_id">
                                            @if (!empty($colors->toArray()))
                                                <option class="current">-- Color --</option>
                                                <ul class="list">
                                                    @foreach ($colors as $item => $color)
                                                        <option class="option" value="{{ $color->id }}">
                                                            {{ $color->color }}</option>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="dsc-product">
                                <div class="dsc-product-count">
                                    <p class="product-qty-text">Quantity</p>
                                    <div class="product_count d-inline-block">
                                        <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                        <input class="product_count_item input-number dsc_input_number" type="text"
                                            value="1" min="1" max="100" name="quantity">
                                        <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                    </div>
                                    {{-- <p>{{ $product->details['stock'] }}</p> --}}
                                </div>
                                <div class="d-flex mt-1 align-items-center">
                                    <a class="add-to-card btn_3 @if(!auth()->user()) disabled @endif" data-stock="" style="padding: 14px 80px;">add to cart</a>
                                </div>

                            </div>
                        </form>

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
            <p class="sample-text">Style #: </p>
        </div>
    </section>
@endsection
@push('after-js')
    <script>
        var color_id = '';
        var size_id = '';
        var product = <?php echo json_encode($product->id)?>;
        $('.color_id').change(function () {
             color_id = $(this).val();
             if (size_id) {
                 getProductDetail(product, color_id, size_id);
             }
        });

        $('.size_id').change(function () {
            size_id = $(this).val();
            if (color_id) {
                getProductDetail(product, color_id, size_id);
            }
        });

        $('.add-to-card').click(function () {
            var quantity = $('.dsc_input_number').val();
            var max_stock = $(this).attr('data-stock');
            if (parseInt(max_stock)) {
                if (parseInt(quantity) > parseInt(max_stock)) {
                    alert('Số lượng tối đa bạn có thể đặt : ' + max_stock);
                }else {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/product/add-to-card/') }}",
                        data: {product: product, stock : quantity, size_id: size_id, color_id: color_id},
                        success : function (result) {
                            if (result.statusCode == 1) {
                                $('.shopping-card').attr('title', result.data);
                                alert('Bạn đã thêm sản phẩm thành công!');
                            }
                        }
                    });
                }
            }else {
                alert('Bạn chưa chọn size hoặc color');
            }
        });

        function getProductDetail(product, color_id, size_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('/product/item/') }}" + '/' + product,
                data: {product: product, color_id : color_id, size_id : size_id},
                success : function (result) {
                    if (result.statusCode == 1) {
                        $('.add-to-card').attr('data-stock', result.data);
                    }
                }
            });
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            // captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
@endpush
