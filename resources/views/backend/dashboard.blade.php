@extends('backend.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                {{-- <h1>Dashboard</h1> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">

    {{-- <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div> --}}


    <div class="col-sm-6 col-lg-4">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body pb-0">
                <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" style="background: #20a8d8; border:none;" aria-labelledby="dropdownMenuButton1">
                        <div class="dropdown-menu-content">
                            <input type="date" name="" id="">
                        </div>
                    </div>
                </div>
                <h4 class="mb-0">
                    <span class="">120.212.109 VND</span>&nbsp;&nbsp;<i class="fa fa-long-arrow-down"></i>
                </h4>
                <p class="text-light">11/02/2021</p>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <canvas id="widgetChart1"></canvas>
                </div>

            </div>

        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-4">
        <div class="card text-white bg-flat-color-2">
            <div class="card-body pb-0">
                <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" style="background: #63c2de; border:none;" aria-labelledby="dropdownMenuButton2">
                        <div class="dropdown-menu-content">
                            <input type="month" name="" id="">
                        </div>
                    </div>
                </div>
                <h4 class="mb-0">
                    <span class="">10.009.903.329 VND</span>&nbsp;&nbsp;<i class="fa fa-long-arrow-up"></i>
                </h4>
                <p class="text-light">May - 2021</p>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <canvas id="widgetChart2"></canvas>
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-4">
        <div class="card text-white bg-flat-color-3">
            <div class="card-body pb-0">
                <div class="dropdown float-right">
                    <select name="" id="" style="background: #ffc107; color:#fff; border:none">
                        <option value="">2021</option>
                        <option value="">2022</option>
                        <option value="">2023</option>
                        <option value="">2024</option>
                        <option value="">2025</option>
                    </select>
                </div>
                <h4 class="mb-0">
                    <span class="">67.124.432.654 VND</span>&nbsp;&nbsp;<i class="fa fa-long-arrow-up"></i>
                </h4>
                <p class="text-light" style="float: left">01/01/2021 -</p>
                <p class="text-light" style="margin-left: 10px"> &nbsp;31/12/2021</p>
            </div>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart3"></canvas>
            </div>
        </div>
    </div>
    <!--/.col-->

    
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title mb-0"><a href="{{ route('admin.report.customer-report.index') }}">Doanh số theo khách hàng (Top 5)</a> </h4>
                        <div class="small text-muted">October 2021</div>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-8 hidden-sm-down">
                        <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="options" id="option2" checked=""> Month
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="options" id="option3"> Year
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->


                </div>
                <!--/.row-->
                <div class="chart-wrapper mt-4">
                    <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title mb-0"><a href="{{ route('admin.report.category-report.index') }}">Doanh số theo Category (Top 5)</a> </h4>
                        <div class="small text-muted">October 2021</div>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-8 hidden-sm-down">
                        <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="options" id="option2" checked=""> Month
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="options" id="option3"> Year
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->


                </div>
                <!--/.row-->
                <div class="chart-wrapper mt-4">
                    <canvas id="productChart" style="height:200px;" height="200"></canvas>
                </div>

            </div>
        </div>
    </div>
    

</div> <!-- .content -->
@endsection
@push('dashboard-scripts')
    <script src="{{ asset('admin/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin/assets/js/widgets.js') }}"></script>
@endpush
