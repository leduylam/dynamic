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
                            <h2>Card List</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!--================Cart Area =================-->
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
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
                            @foreach($array as $index => $item)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ \Storage::disk('s3')->url('product/'.$item['image']) }}" alt="" />
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $item['name'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ $item['size'] }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $item['color'] }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $item['price'] }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <span class="input-number-decrement"> <i class="ti-minus"></i></span>
                                            <input class="input-number change_qty" name="quantity[{{ $index }}]" data-id="{{ $index }}" data-product="{{ $item['product_detail_id'] }}" data-price="{{ $item['price'] }}" type="text" value="{{ $item['qty'] }}" min="0" max="10">
                                            <span class="input-number-increment"> <i class="ti-plus"></i></span>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="amount_{{ $index }}">{{ $item['total'] }}</h5>
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
                                            <li class="total_amount">
                                                {{ $total_amount }}
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="checkout_btn_inner float-right">
                            <a class="btn_1" href="{{ route('product.index') }}">Continue Shopping</a>
                            <button class="btn_1 checkout_btn_1" type="submit">Proceed to checkout</button>
                        </div>
                    </div>
                </div>
        </section>
    </form>
    <!--================End Cart Area =================-->
@endsection
@push('after-js')
    <script>
        $(document).ready(function () {
            var cart = <?php echo json_encode($cart)?>;
            $('.change_qty').change(function () {
                var qty = $(this).val();
                var product_detail_id = $(this).attr('data-product');
                var id = $(this).attr('data-id');
                var price = $(this).attr('data-price');
                $.ajax({
                    type: "GET",
                    url: "{{ url('product/check-stock') }}",
                    data: {product: product_detail_id, quantity : qty},
                    success : function (result) {
                        if (result.statusCode == 1) {
                            if (parseInt(qty) > parseInt(result.data)) {
                                alert('Bạn có thể order : ' + result.data);
                            }else {
                                var amount = parseInt(qty) * parseInt(price);
                                var total_amount = 0;
                                $('.amount_' + id).text(amount);
                                $.each(cart, function (index, val) {
                                    if (index == id){
                                        total_amount += amount;
                                    }else {
                                        total_amount += val.price * val.qty;
                                    }
                                });

                                $('.total_amount').text(total_amount);
                            }
                        }
                    }
                });
            })
        })
    </script>
@endpush
