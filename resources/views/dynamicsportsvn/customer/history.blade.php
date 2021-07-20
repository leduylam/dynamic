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
                            <h2>History Order</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <div class="whole-wrap">
		<div class="container box_1170">
			<div class="section-top-border">
				<h3 class="mb-30">Table</h3>
				<div class="progress-table-wrap">
					<div class="progress-table">
						<div class="table-head">
							<div class="serial">#</div>
							<div class="country">Order Code</div>
							<div class="visit">Total</div>
							<div class="percentage">Date</div>
						</div>
                        @foreach($orders as $index => $order)
						    <div class="table-row">
							<div class="serial">{{ $index + 1 }}</div>
							<div class="country"><a href=" {{ route('user.history-detail', $order->id) }} "> {{ $order->sku }}</a></div>
							<div class="visit">{{ $order->total_amount }} VND</div>
							<div class="percentage">{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</div>
						</div>
                        @endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
