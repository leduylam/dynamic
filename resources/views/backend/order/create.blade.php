@extends('backend.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                {{-- <h1>Add new Category</h1> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.product.index') }}">Products table</a></li>
                    <li class="active">Add New</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <form action="" method="post" enctype="multipart/form-data" id="create_order">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Add New Product</strong></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body card-block">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="customer_sku" class=" form-control-label">Mã khách
                                                    hàng</label>
                                                <input type="text" id="customer_sku" name="customer_sku"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="customer_name" class=" form-control-label">Tên khách
                                                    hàng</label>
                                                <input type="text" id="customer_name" name="customer_name"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="order_sku" class=" form-control-label">Mã đơn hàng</label>
                                                <input type="text" id="order_sku" name="order_sku" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class=" form-control-label">Địa chỉ</label>
                                        <input type="text" id="address" name="address" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="sku" class=" form-control-label">Diễn giải</label>
                                        <input type="text" id="sku" name="sku" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" style="justify-content: center">Danh sách Order</strong>
                            {{-- <a href="{{ route('admin.color.create') }}" class="btn btn-primary btn-sm"
                            style="float: right">Add new</a> --}}
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:150px;">Mã sản phẩm</th>
                                        <th style="width:300px;">Tên sản phẩm</th>
                                        <th style="width:80px">Size</th>
                                        <th style="width:80px">Color</th>
                                        <th style="width:80px">Qty</th>
                                        <th style="width:150px">Đơn giá</th>
                                        <th style="width:80px">(-%)</th>
                                        <th style="width:150px">Tổng tiền</th>
                                        <th style="text-align: center"><a href="#" class="btn btn-success addRow" data-index="0">+</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="appent-add">

                                    <tr>
                                        <td><input type="text" name="productSku[0]" class="form-control"></td>
                                        <td><input type="text" name="productName[0]" class="form-control"></td>
                                        <td><input type="text" name="size[0]" class="form-control"></td>
                                        <td><input type="text" name="color[0]" class="form-control"></td>
                                        <td><input type="text" name="quantity[0]" class="form-control"></td>
                                        <td><input type="text" name="price[0]" class="form-control"></td>
                                        <td><input type="text" name="discount[0]" class="form-control"></td>
                                        <td><input type="text" name="total[0]" class="form-control"></td>
                                        <td style="text-align: center"><a href="" class="btn btn-danger">-</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('after-scripts')
<script type="text/javascript">
    $(document).ready(function () {
            $('.addRow').on('click', function(){
                var i = $(this).attr('data-index');
                i++;
                addRow(i);
                $(this).attr('data-index', i);
            });
            function addRow(i){
                var tr = '  <tr data-index="'+ i +'">'+
                                '<td><input type="text" name="productSku['+ i +']" class="form-control"></td>'+
                                '<td><input type="text" name="productName['+ i +']" class="form-control"></td>'+
                                '<td><input type="text" name="size['+ i +']" class="form-control"></td>'+
                                '<td><input type="text" name="productQty['+ i +']" class="form-control"></td>'+
                                '<td><input type="text" name="price['+ i +']" class="form-control"></td>'+
                                '<td><input type="text" name="totalPrice['+ i +']" class="form-control"></td>'+
                                '<td><input type="text" name="discount['+ i +']" class="form-control"></td>'+
                                '<td style="text-align: center"><a class="btn btn-danger add-remove" data-index="' + i + '">-</a></td>'+
                            '</tr>';


                $('.appent-add').append(tr);
            };
            $('.appent-add').on('click', '.add-remove', function(){
                $(this).parent().parent().remove();
            });
        });
</script>
@endpush
