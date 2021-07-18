@extends('dynamicsportsvn.layouts.app')
@section('content')
<style>
    .img-w {
        width: 200px !important;
        height: 200px;
    }
</style>
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
        @if ($message = \Illuminate\Support\Facades\Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = \Illuminate\Support\Facades\Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row product-btn d-flex justify-content-between">
                <div class="properties__button">
                    <!--Nav Button  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New</a>
                        </div>
                    </nav>
                    <!--End Nav Button  -->
                </div>
                <div class="select-this d-flex">
                    <div class="featured">
                        <span>Short by: </span>
                    </div>
                    <form action="{{ route('product.index') }}" method="get" class="myForm">
                        <div class="select-itms" id="select-action">
                            <select name="order_by" id="select1" class="order_by">
                                <option value="">Order by</option>
                                <option value="desc" {{ (!empty($_GET['order_by']) && $_GET['order_by']) ? ($_GET['order_by'] == 'desc' ? 'selected' : '') : '' }} >A-z</option>
                                <option value="asc" {{ (!empty($_GET['order_by']) && $_GET['order_by']) ? ($_GET['order_by'] == 'asc' ? 'selected' : '') : '' }}>Z-a</option>
                            </select>
                        </div>
{{--                        <button type="submit">submit</button>--}}
                    </form>
                </div>
        </div>
        <!-- Nav Card -->
        <div class="tab-content" id="nav-tabContent">
            <!-- card one -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-xl-3 col-lg-3 col-md-6">

                        <div class="single-product mb-60">
                            <div class="product-img">
                                <img class="img-w" src="{{ \Storage::disk('s3')->url('product/'.$product->image) }}" alt="">
                                <div class="new-product">
                                    <span>New</span>
                                </div>
                            </div>
                            <div class="product-caption">
                                <h4><a href="{{ route('product.product-detail', $product->id) }}">{{ $product->name }}</a></h4>
                                <div class="price">
                                    <ul>
                                        <li>{{ $product->price }}</li>
                                        {{--                                            <li class="discount">{{ $product->price }}</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Card two -->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    @foreach($product_news as $product)
                        <div class="col-xl-3 col-lg-3 col-md-6">

                            <div class="single-product mb-60">
                                <div class="product-img">
                                    <img class="img-w" src="{{ \Storage::disk('s3')->url('product/'.$product->image) }}" alt="">
                                    <div class="new-product">
                                        <span>New</span>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <h4><a href="{{ route('product.product-detail', $product->id) }}">{{ $product->name }}</a></h4>
                                    <div class="price">
                                        <ul>
                                            <li>{{ $product->price }}</li>
{{--                                            <li class="discount">{{ $product->price }}</li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Nav Card -->
    </div>
</section>
<!-- Latest Products End -->
@endsection
@push('after-js')
    <script>
        $('.order_by').change(function () {
           var param = $(this).val();
           if (param) {
               $('.myForm').submit();
           }
        });
    </script>
@endpush
