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
                    <form action="">
                        <h3 class="mb-30">Information</h3>

                        <div class="mt-10">
                            <input type="text" name="" placeholder="Company Name"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Company Name'"
                                required="" class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="last_name" placeholder="Tax code" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Tax code'" required="" class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Email address'" class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="address" placeholder="Address" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Address'" required="" class="single-input">
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mt-10">
                                    <input type="text" name="address" placeholder="Ward" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Ward'" required="" class="single-input">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mt-10">
                                    <input type="text" name="address" placeholder="District" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'District" required="" class="single-input">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mt-10">
                                    <input type="text" name="address" placeholder="City" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'City'" required="" class="single-input">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-10 align-items-center justify-content-end">
                            <button type="submit" class="btn_1" style="padding: 10px 20px;">Submit</button>
                        </div>
                    </form>
                </div>


                <div class="col-lg-5 col-md-5 mt-sm-30">
                    <form action="">
                        <h3 class="mb-30">Change Password</h3>
                        <div class="mt-10">
                            <input type="password" name="password" placeholder="Current Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Current Password'" required=""
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="password" name="password" placeholder="New Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" required=""
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="password" name="password" placeholder="Comfirm New Password"
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
