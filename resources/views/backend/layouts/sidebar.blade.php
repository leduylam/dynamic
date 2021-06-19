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
                        <li><a href="{{ route('admin.order.index') }}">Orders Manager</a>
                        </li>
                        <li><a href="{{ route('admin.order.create') }}">Add new order</a></li>
                    </ul>
                </li>
                <li>
                    <a href="widgets.html"> <i class="menu-icon ti-email"></i>Totality </a>
                </li>
                

                <h3 class="menu-title">Report</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Báo cáo phân tích</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.report.detailed-report.index') }}">Báo cáo chi tiết </a></li>
                        <li><a href="{{ route('admin.report.order-report.index') }}">Báo cáo theo đơn hàng</a></li>
                        
                        <li><a href="{{ route('admin.report.customer-report.index') }}">Báo cáo theo khách hàng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="widgets.html"> <i class="menu-icon ti-email"></i>Tổng quan</a>
                </li>

                <h3 class="menu-title">Managers</h3><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('admin.category.index') }}"> <i class="menu-icon fa fa-table"></i>Categories</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Products Manager</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.product.index') }}">Products</a>
                        </li>
                        <li><a href="{{ route('admin.size.index') }}">Sizes</a></li>
                        <li></i><a href="{{ route('admin.color.index') }}">Color</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Quan ly tai khoan</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.list') }}">Admins</a>
                        </li>
                        <li><a href="">Customers</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
