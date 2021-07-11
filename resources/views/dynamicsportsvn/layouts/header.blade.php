
<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-top top-bg d-none d-lg-block">
                <div class="container-fluid">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-end align-items-center">
                            <div class="header-info-left d-flex">
                                <div class="flag">
                                    <img src="{{ asset('dynamic/assets/img/icon/header_icon.png') }}" alt="">
                                </div>
                                <div class="select-this">
                                    <form action="#">
                                        <div class="select-itms">
                                            <select name="select" id="select1">
                                                <option value="">VN</option>
                                                <option value="">USA</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="header-info-right">
                                <ul>
                                    <li><a href="login.html">My Account </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                            <div class="logo">
                                <a href=""><img src="{{ asset('dynamic/assets/img/logo/logo.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        @if (!empty($categories))
                                            @foreach($categories as $category)
                                            @if(!empty($category['parent_id_1'] == 0))
                                            <li class="category_big"><a href="#">{{ $category['name'] }}</a>
                                                
                                                <ul class="submenu dsc-submenu">
                                                @foreach($categories as $mid)
                                                @if($mid['parent_id_1'] == $category['id'] && !$mid['parent_id_2'] == $category['id'])
                                                <li><a href="{{ route('product.product-table') }}"> {{ $mid['name'] }}</a>
                                                    
                                                    <ul class="submenu dsc-submenu" style="left: 100%">
                                                        @foreach($categories as $small)
                                                            @if($small['parent_id_2'] == $mid['id'])
                                                            <li><a href="Catagori.html">{{ $small['name'] }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endif
                                                @endforeach
                                                </ul>
                                            </li>
                                            @endif
                                        @endforeach
                                        @endif
                                        
                                        <li><a href="index.html">Clubs</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                            <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                <li class="d-none d-xl-block">
                                    <div class="form-box f-right ">
                                        <input type="text" name="Search" placeholder="Search products">
                                        <div class="search-icon">
                                            <i class="fas fa-search special-tag"></i>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="shopping-card">
                                        <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </li>
                                <li class="d-none d-lg-block"> <a href="{{ route('customer.login') }}" class="btn header-btn">Sign in</a></li>
                            </ul>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>


