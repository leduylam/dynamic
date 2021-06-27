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
                            <h2>Product Catagori</h2>
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
                        <span>Thương hiệu: </span>
                    </div>
                    <form action="#">
                        <div class="select-itms">
                            <select name="select" id="select1">
                                <option value="">Puma</option>
                                <option value="">Greg Norman</option>
                                <option value="">Fenix</option>
                                <option value="">Ahead</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="select-this d-flex">
                    <div class="featured">
                        <span>Size: </span>
                    </div>
                    <form action="#">
                        <div class="select-itms">
                            <select name="select" id="select1">
                                <option value="">XS</option>
                                <option value="">S</option>
                                <option value="">M</option>
                                <option value="">L</option>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="" alt="">
                                                    <img src="" alt="">
                                                    <img src="" alt="">
                                                    <img src="" alt="">
                                                    <img src="" alt="">
                                                    <img src="" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <a href="" style="color:#506172">09287326</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <a href="{{ route('product.product-detail') }}" style="color:#506172">Áo Puma golf</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media select-itms">
                                                <div class="media-body nice-select">
                                                    <span class="current">XS</span>
                                                    <ul class="list">
                                                        <li class="option">XS</li>
                                                        <li class="option">S</li>
                                                        <li class="option">M</li>
                                                        <li class="option">L</li>
                                                        <li class="option">XL</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>1.287.326 đ</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>1.287.326 VND</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <!-- <input type="text" value="1" min="0" max="10" title="Quantity:"
                                                  class="input-text qty input-number" />
                                                <button
                                                  class="increase input-number-increment items-count" type="button">
                                                  <i class="ti-angle-up"></i>
                                                </button>
                                                <button
                                                  class="reduced input-number-decrement items-count" type="button">
                                                  <i class="ti-angle-down"></i>
                                                </button> -->
                                                <span class="input-number-decrement"> <i class="ti-minus"></i></span>
                                                <input class="input-number" type="text" value="1" min="0" max="10">
                                                <span class="input-number-increment"> <i class="ti-plus"></i></span>
                                              </div>
                                        </td>
                                        <td>
                                            <a style="font-size: 14px; padding:20px;" href="" class="btn btn-primary">add</a>
                                        </td>
                                    </tr>
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