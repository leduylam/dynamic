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
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Report Data</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-4">
                                    <strong class="card-title">Doanh số bán hàng theo khách hàng</strong>
                                </div>
                                <div class="col-8 ">
                                    <div class="sort" style="float: right">
                                        <form action="{{ route('admin.report.customer-report.index') }}" method="GET">
                                            <label for="birthday">Từ:</label>
                                            <input type="date" id="birthday" name="date_start" value="{{ !empty($_GET['date_start']) ? $_GET['date_start'] : \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            <label for="birthday" style="margin-left:10px;">Đến:</label>
                                            <input type="date" id="birthday" name="date_end" value="{{ !empty($_GET['date_end']) ? $_GET['date_end'] : \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            <input type="submit">
                                          </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số lượng bán</th>
                                    <th>Doanh số bán</th>
                                    <th>Địa chỉ</th>
                                    <th>Xem chi tiết</th>
                                </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Tổng</th>
                                        <th>{{ $all_quantity }}</th>
                                        <th>{{ $all_amount }} $</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.report.customer-report.show', $item['id']) }}">{{ $item['sku'] }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.report.customer-report.show',$item['id']) }}">{{ $item['name'] }}</a>
                                            </td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>{{ $item['total_amount'] }} $</td>
                                            <td>{{ $item['address'] }}</td>
                                            <td style="text-align:center"><a href="{{ route('admin.report.customer-report.show', $item['id']) }}"><i class="fa fa-eye" style="font-size:33px;"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
