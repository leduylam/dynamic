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
                    <a href="{{ route('admin.index') }}"> <i class="menu-icon fa fa-dashboard"></i>{{__('auth.dashboard')}} </a>
                </li>

                <h3 class="menu-title">{{__('sidebar.order')}}</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('sidebar.order-manage')}}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.order.index') }}">{{__('sidebar.order-list')}}</a>
                        </li>
                        <li><a href="{{ route('admin.order.create') }}">{{__('sidebar.order-add')}}</a></li>
                    </ul>
                </li>


                <h3 class="menu-title">{{__('sidebar.report')}}</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('sidebar.report-analysis') }}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.report.detailed-report.index') }}">{{__('sidebar.report-item') }} </a></li>
                        <li><a href="{{ route('admin.report.category-report.index') }}">{{__('sidebar.report-category') }}</a></li>
                        <li><a href="{{ route('admin.report.customer-report.index') }}">{{__('sidebar.report-customer') }}</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">{{__('sidebar.manager')}}</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('sidebar.cate-product')}}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.category.index') }}">{{__('sidebar.category')}}</a>
                        <li><a href="{{ route('admin.product.index') }}">{{__('sidebar.product')}}</a>
                        </li>
                        <li><a href="{{ route('admin.size.index') }}">{{__('sidebar.size')}}</a></li>
                        <li><a href="{{ route('admin.color.index') }}">{{__('sidebar.color')}}</a></li>
                        <li><a href="{{ route('admin.stock.index') }}">{{__('sidebar.stock')}}</a></li>
                        <li><a href="{{ route('admin.banner.index') }}">{{__('sidebar.banner')}}</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('sidebar.account') }}</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('admin.list') }}">Admins</a>
                        </li>
                        <li><a href="{{ route('admin.user.index') }}">{{ __('sidebar.customer') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
