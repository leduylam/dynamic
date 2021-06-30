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
                                        <th>15</th>
                                        <th>1.740.375 VND</th>
                                        <th>187,018 VND</th>
                                        <th>1,553,357 VND</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>599434</td>
                                        <td>MATTR VOLITION FLANKED GOLF POLO</td>
                                        <td>XS</td>
                                        <td>01</td>
                                        <td>2021</td>
                                        <td>15</td>
                                        <td>1.740.375 VND</td>
                                        <td>187,018 VND</td>
                                        <td>1,553,357 VND</td>
                                        <td>PUMA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
