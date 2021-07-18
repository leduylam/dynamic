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
        <form action="{{ route('cart.store') }}" method="post">
            @csrf
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Billing Details</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="first" name="name" placeholder="Consignee's name"
                                           value="{{ !empty(old('name')) ? old('name') : (!empty(auth()->user()) ? auth()->user()->name : '')}}">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="number" name="phone" placeholder="Consignee's Phone number"
                                           value="{{ !empty(old('phone')) ? old('phone') : (!empty(auth()->user()) ? auth()->user()->phone : '') }}" >
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address"
                                           value="{{ !empty(old('email')) ? old('email') : (!empty(auth()->user()) ? auth()->user()->email : '') }}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                                           value="{{ !empty(old('address')) ? old('address') : (!empty(auth()->user()) ? auth()->user()->address : '')  }}">
                                </div>

                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <h3>Shipping Details</h3>
                                    </div>
                                    <textarea class="form-control" name="memo" id="message" rows="1" style="height: 100px !important;"
                                              placeholder="Order Notes">
                                    {{ !empty(old('memo')) ? old('memo') : (!empty(auth()->user()) ? auth()->user()->memo : '') }}
                                </textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li>
                                        <a>Product
                                            <span>Total</span>
                                        </a>
                                    </li>
                                    @foreach($cart as $item)
                                        <li>
                                            <a href="{{ route('product.product-detail', $item->id) }}">{{ $item->options['name'] }}
                                                <span class="middle">x {{ $item->qty }}</span>
                                                <span class="last">{{ $item->qty * $item->price }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a>Total
                                            <span>{{ $total_amount }}</span>
                                            <input type="hidden" name="total_amount" value="{{ !empty($total_amount) ? $total_amount : 0 }}">
                                        </a>
                                    </li>
                                </ul>
                                <button class="btn_3" type="submit">Proceed to Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
