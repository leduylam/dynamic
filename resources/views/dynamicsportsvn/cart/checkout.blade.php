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
                            <h2>Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <section class="checkout_area section_padding">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name">
                                <span class="placeholder" data-placeholder="Consignee's name"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="company" name="company"
                                    placeholder="Company name">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="number">
                                <span class="placeholder" data-placeholder="Consignee's Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="compemailany">
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="address" name="address">
                                <span class="placeholder" data-placeholder="Address"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <div class="nice-select country_select" tabindex="0"><span class="current">District</span>
                                    <ul class="list">
                                        <li data-value="1" class="option selected focus">District</li>
                                        <li data-value="2" class="option">District</li>
                                        <li data-value="4" class="option">District</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <div class="nice-select country_select" tabindex="0"><span class="current">Country</span>
                                    <ul class="list">
                                        <li data-value="1" class="option selected focus">Country</li>
                                        <li data-value="2" class="option">Ha Noi</li>
                                        <li data-value="4" class="option">Ho Chi Minh</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                </div>
                                <textarea class="form-control" name="message" id="message" rows="1"
                                    placeholder="Order Notes"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Product
                                        <span>Total</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Mens Shirts
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Mens Pants
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Accessories
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Subtotal
                                        <span>$2160.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Shipping
                                        <span>Flat rate: $50.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Total
                                        <span>$2210.00</span>
                                    </a>
                                </li>
                            </ul>
                            <a class="btn_3" href="#">Proceed to Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
