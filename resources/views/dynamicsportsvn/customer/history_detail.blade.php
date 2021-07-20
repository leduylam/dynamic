@extends('dynamicsportsvn.layouts.app')
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
                            <h2>History Order Detail    </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!--================Cart Area =================-->
    <section class="cart_area section_padding">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tfoot>

                        </tfoot>
                        <tbody>
                        @foreach($order_items as $item)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img style="height: 200px !important;" src="{{ \Storage::disk('s3')->url('product/'.$item['image']) }}" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $item->productDetail->product->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{ $item->productDetail->size->size }}</h5>
                                </td>
                                <td>
                                    <h5>{{ $item->productDetail->color->color }}</h5>
                                </td>
                                <td>
                                    <h5>{{ $item->productDetail->product->price }}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <h5>{{ $item->quantity }}</h5>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{ $item->price }}</h5>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="3">
                                    <h5>Grand Total</h5>
                                </td>
                                <td>
                                    <div class="shipping_box">
                                        <ul class="list">
                                            <li>
                                                {{ $order->total_amount }}
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1" href="{{ route('product.index') }}">Go to Shopping</a>
                    </div>
                </div>
            </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
