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
                            <h2>My Account</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <div class="section-top-border">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
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

                    <form action="{{ route('user.detail') }}" method="post">
                        @csrf
                        <h3 class="mb-30">Information</h3>
                        <div class="mt-10">
                            <input type="text" name="name" placeholder="Name" value="{{ !empty(old('name')) ? old('name') : auth()->user()->name }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'"
                                required="" class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="email" name="email" placeholder="Email address" value="{{ !empty(old('email')) ? old('email') : auth()->user()->email }}" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Email address'" class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="number" name="phone" placeholder="Phone number" value="{{ !empty(old('phone')) ? old('phone') : auth()->user()->phone }}" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Phone number'" class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="address" placeholder="Address" onfocus="this.placeholder = ''"
                                   value="{{ !empty(old('address')) ? old('address') : auth()->user()->address }}"
                                onblur="this.placeholder = 'Address'" required="" class="single-input">
                        </div>
                        <div class="d-flex mt-10 align-items-center justify-content-end">
                            <button type="submit" class="btn_1" style="padding: 10px 20px;">Submit</button>
                        </div>
                    </form>
                </div>


                <div class="col-lg-5 col-md-5 mt-sm-30">
                    <form action="{{ route('user.change-password') }}" method="post">
                        @csrf
                        <h3 class="mb-30">Change Password</h3>
                        <div class="mt-10">
                            <input type="password" name="password" placeholder="Current Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Current Password'" required=""
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="password" name="password_confirmation" placeholder="New Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" required=""
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="password" name="password_new" placeholder="Comfirm New Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Comfirm New Password'"
                                required="" class="single-input">
                        </div>
                        <div class="d-flex mt-10 align-items-center justify-content-end">
                            <button type="submit" class="btn_1" style="padding: 10px 20px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
