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
                                    <strong class="card-title">Báo cáo chi tiết theo mặt hàng</strong>
                                </div>
                                <div class="col-8 ">
                                    <div class="sort" style="float: right">
                                        <form action="{{ route('admin.report.detailed-report.index') }}" method="GET">
                                            <label for="birthday">Từ:</label>
                                            <input type="date" id="birthday" name="date_start" value="{{ !empty($_GET['date_start']) ? $_GET['date_start'] : \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            <label for="birthday" style="margin-left:10px;">Đến:</label>
                                            <input type="date" id="birthday" name="date_end">
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
                                    <th>STT</th>
                                    <th>Mã hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size</th>
                                    <th>Màu</th>
                                    <th>Model</th>
                                    <th>Số lượng</th>
                                    <th>Doanh thu</th>
                                    <th>Giảm giá</th>
                                    <th>Doanh thu thực</th>
                                    <th>Thương hiệu</th>
                                </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="6">Tổng</th>
                                        <th>{{ $all_quantity }}</th>
                                        <th>{{ $all_amount }} VND</th>
                                        <th>{{ $all_amount - $all_total_amount }} VND</th>
                                        <th>{{ $all_total_amount }} VND</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($array as $index => $item)
                                        <tr>
                                            <td>{{ $index }}</td>
                                            <td>{{ $item['sku'] }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['size'] }}</td>
                                            <td>{{ $item['color'] }}</td>
                                            <td>{{ $item['model'] }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>{{ $item['amount'] }}VND</td>
                                            <td>{{ $item['amount'] - $item['total_amount'] }} VND</td>
                                            <td>{{ $item['total_amount'] }} VND</td>
                                            <td>{{ $item['brand'] }}</td>
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
