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
                                    <strong class="card-title">Chi tiết bán hàng theo khách hàng</strong>
                                </div>
                                <div class="col-8 ">
                                    <div class="sort" style="float: right">
                                        <form action="/action_page.php">
                                            <label for="birthday">Từ:</label>
                                            <input type="date" id="birthday" name="birthday">
                                            <label for="birthday" style="margin-left:10px;">Đến:</label>
                                            <input type="date" id="birthday" name="birthday">
                                            <input type="submit">
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr class="dsc-table">
                                    <th>Số chứng từ </th> {{--Mã đơn hàng--}}
                                    <th>Ngày chứng từ </th> {{--Ngày tạo đơn hàng--}}
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Giảm giá</th>
                                    <th>Doanh thu thực</th>
                                    <th>Nhóm VTHH</th>
                                </tr>
                                </thead>
                                <tfoot class="dsc-table">
                                    <tr>
                                        <th colspan="5">Tổng</th>
                                        <th>70</th>
                                        <th>29.541.145</th>
                                        <th></th>
                                        <th>28.541.145</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody class="dsc-table">
                                    <tr>
                                        <td>BG21-00129</td>
                                        <td>21/05/2021</td>
                                        <td>053537 01</td>{{--Mã sản phẩm nối với mã màu--}}
                                        <td>Thắt lưng Stroel belt</td>
                                        <td>Free size</td>
                                        <td>50</td>
                                        <td>20.000.000</td>
                                        <td>1.000.000</td>
                                        <td>19.000.000</td>
                                        <td>Thắt lưng Puma</td>
                                    </tr>
                                </tbody> 
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
