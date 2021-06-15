<aside id="left-panel" class="left-panel bg-light">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('admin.index') }}"><img src="{{ asset('admin/images/logo.png') }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href=""><i class="fa fa-bars"></i></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse bg-light">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('admin.index') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>

                <h3 class="menu-title">Orders</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Order lists</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Orders Manager</a>
                        </li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Add new order</a></li>
                    </ul>
                </li>
                <li>
                    <a href="widgets.html"> <i class="menu-icon ti-email"></i>Totality </a>
                </li>
                <h3 class="menu-title">Managers</h3><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('admin.category.index') }}"> <i class="menu-icon fa fa-table"></i>Categories</a>
                </li>
                <li class="">
                    <a href="{{ route('admin.product.index') }}"> <i class="menu-icon fa fa-table"></i>Products</a>
                </li>
                <li class="">
                    <a href="{{ route('admin.size.index') }}"> <i class="menu-icon fa fa-table"></i>Sizes</a>
                </li>
                <li class="">
                    <a href="{{ route('admin.color.index') }}"> <i class="menu-icon fa fa-table"></i>Colors</a>
                </li>


                <h3 class="menu-title">Báo cáo</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Báo cáo phân tích</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.report.index') }}">Tổng hợp bán hàng</a>
                        </li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Báo cáo theo khách hàng</a></li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Báo cáo theo đơn hàng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="widgets.html"> <i class="menu-icon ti-email"></i>Totality </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
