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
                    <li class="active">{{__('message.welcome')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="col-sm-6 col-lg-4">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body pb-0">
                <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" style="background: #20a8d8; border:none;" aria-labelledby="dropdownMenuButton1">
                        <div class="dropdown-menu-content">
                            <input type="date" class="date_now" name="date" value="{{ !empty($_GET['date']) ? $_GET['date'] : '' }}">
                        </div>
                    </div>
                </div>
                <h4 class="mb-0">
                    <span class="data-day">{{ $total_order_date }} VND</span>@if($is_check_day == true) &nbsp;&nbsp;<i class="fa fa-long-arrow-up"></i> @else &nbsp;&nbsp;<i class="fa fa-long-arrow-down"></i> @endif
                </h4>
                <p class="text-light text-time-day">{{ !empty($_GET['date']) ? $_GET['date'] : \Carbon\Carbon::now()->format('Y/m/d') }}</p>

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
                            <input type="month" name="month" id="date-month">
                        </div>
                    </div>
                </div>
                <h4 class="mb-0">
                    <span class="text-time-month">{{ $total_order_month }} VND</span>&nbsp;@if($is_check_month == true) &nbsp;&nbsp;<i class="fa fa-long-arrow-up"></i> @else &nbsp;&nbsp;<i class="fa fa-long-arrow-down"></i> @endif
                </h4>
                <p class="text-light date-time-month">{{ \Carbon\Carbon::now()->format('Y-m') }}</p>

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
                    <select name="year" id="date-year" style="background: #ffc107; color:#fff; border:none">
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                    </select>
                </div>
                <h4 class="mb-0">
                    <span class="total_order_year">{{ $total_order_year }} VND</span>&nbsp;&nbsp;@if($is_check_year == true) &nbsp;&nbsp;<i class="fa fa-long-arrow-up"></i> @else &nbsp;&nbsp;<i class="fa fa-long-arrow-down"></i> @endif
                </h4>
                <p class="text-light text-time-start-year" style="float: left">{{ \Carbon\Carbon::now()->startOfYear()->format('Y-m-d') }} -</p>
                <p class="text-light text-time-end-year" style="margin-left: 10px"> &nbsp;{{ \Carbon\Carbon::now()->endOfYear()->format('Y-m-d') }}</p>
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
                        <h4 class="card-title mb-0"><a href="{{ route('admin.report.customer-report.index') }}">{{__('message.top_customer')}}</a> </h4>
                        <div class="small text-muted">{{ \Carbon\Carbon::now()->format('Y/m') }}</div>
                        <div></div>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-8 hidden-sm-down">
                        <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                <label class="btn btn-outline-secondary active customer-month">
                                    <input type="radio" name="options" id="option2" checked="" value="0"> Month
                                </label>
                                <label class="btn btn-outline-secondary customer-month">
                                    <input type="radio" name="options" id="option3" value="1"> Year
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->


                </div>
                <!--/.row-->
                <div class="chart-wrapper mt-4 traffic-month">
                    <canvas id="trafficChartMonth" style="height:200px;" height="200"></canvas>
                </div>

                <div class="chart-wrapper mt-4 traffic-year" style="display: none">
                    <canvas id="trafficChartYear" style="height:200px;" height="200"></canvas>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title mb-0"><a href="{{ route('admin.report.category-report.index') }}">{{__('message.top_category')}}</a> </h4>
                        <div class="small text-muted">{{ \Carbon\Carbon::now()->format('Y/m') }}</div>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-8 hidden-sm-down">
                        <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                <label class="btn btn-outline-secondary active category_order">
                                    <input type="radio" name="option_category" id="option2" value="0" checked=""> Month
                                </label>
                                <label class="btn btn-outline-secondary category_order">
                                    <input type="radio" name="option_category" value="1" id="option3"> Year
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->


                </div>
                <!--/.row-->
                <div class="chart-wrapper mt-4 category_month">
                    <canvas style="height:200px;" id="productChart_month" height="200"></canvas>
                </div>
                <div class="chart-wrapper mt-4 category_year " style="display: none">
                    <canvas style="height:200px;" id="productChart_year"  height="200"></canvas>
                </div>

            </div>
        </div>
    </div>


</div> <!-- .content -->
@endsection
@push('dashboard-scripts')
    <script src="{{ asset('admin/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/widgets.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var ctx = document.getElementById("trafficChartMonth").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($total_amount_by_month_name as $item)
                        "{{ $item }}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [
                            @foreach($total_amount_by_month_amount as $item)
                                {{ $item }},
                            @endforeach
                        ]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: ''
                }
            }
        });

        var ctx = document.getElementById("trafficChartYear").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($total_amount_by_year_name as $item)
                        "{{ $item }}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [
                            @foreach($total_amount_by_year_amount as $item)
                                {{ $item }},
                            @endforeach
                        ]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: ''
                }
            }
        });

        var ctx = document.getElementById("productChart_month").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($order_category_month_name as $item)
                        "{{ $item }}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [
                            @foreach($order_category_month_total as $item)
                                {{ $item }},
                            @endforeach
                        ]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: ''
                }
            }
        });

        var ctx = document.getElementById("productChart_year").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($order_category_year_name as $item)
                        "{{ $item }}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: [
                            @foreach($order_category_year_total as $item)
                                {{ $item }},
                            @endforeach
                        ]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: ''
                }
            }
        });

        $(document).ready(function () {
            $('.date_now').change(function () {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.day') }}",
                    data: {date: $(this).val()},
                    success: function (result) {
                       if (result.status == 1) {
                           $('.data-day').text(result.data[0] + ' VND');
                           $('.text-time-day').text(result.data[1]);
                       }
                    }
                })
            });

            $('#date-year').change(function () {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.year') }}",
                    data: {date: $(this).val()},
                    success: function (result) {
                       if (result.status == 1) {
                           $('.total_order_year').text(result.data[0] + ' VND');
                           $('.text-time-start-year').text(result.data[1]);
                           $('.text-time-end-year').text(' - ' + result.data[2]);
                       }
                    }
                })
            });

            $('#date-month').change(function () {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.month') }}",
                    data: {date: $(this).val()},
                    success: function (result) {
                       if (result.status == 1) {
                           $('.text-time-month').text(result.data[0] + ' VND');
                           $('.date-time-month').text(result.data[1]);
                       }
                    }
                })
            });

            $('.customer-month').click(function () {
                var is_check = $(this).children('input').eq(0).val();
                if (is_check == 0) {
                    $('.traffic-month').show();
                    $('.traffic-year').hide();
                }else {
                    $('.traffic-month').hide();
                    $('.traffic-year').show();
                }
            });

            $('.category_order').click(function () {
                var is_check = $(this).children('input').eq(0).val();
                if (is_check == 0) {
                    $('.category_month').show();
                    $('.category_year').hide();
                }else {
                    $('.category_month').hide();
                    $('.category_year').show();
                }
            })
        })
    </script>
@endpush
