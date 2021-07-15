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
						<div class="table-row">
							<div class="serial">01</div>
							<div class="country"><a href=" {{ route('history-detail') }} "> DSC/00001</a></div>
							<div class="visit">12.328.928 VND</div>
							<div class="percentage">14/02/2021</div>
						</div>
                        <div class="table-row">
							<div class="serial">02</div>
							<div class="country"><a href=""> DSC/00022</a></div>
							<div class="visit">12.328.928 VND</div>
							<div class="percentage">20/02/2021</div>
						</div>
                        <div class="table-row">
							<div class="serial">03</div>
							<div class="country"><a href=""> DSC/00124</a></div>
							<div class="visit">12.328.928 VND</div>
							<div class="percentage">05/03/2021</div>
						</div>
                        <div class="table-row">
							<div class="serial">04</div>
							<div class="country"><a href=""> DSC/00344</a></div>
							<div class="visit">12.328.928 VND</div>
							<div class="percentage">12/04/2021</div>
						</div>
                        <div class="table-row">
							<div class="serial">05</div>
							<div class="country"><a href=""> DSC/00435</a></div>
							<div class="visit">12.328.928 VND</div>
							<div class="percentage">01/05/2021</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
