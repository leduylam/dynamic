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
                                            <div class="col-md-12">
                                                <div id="error_data"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="customer_sku" class=" form-control-label">Mã khách
                                                        hàng</label>
                                                    <input type="text" id="customer_sku" name="customer_sku"
                                                           value="{{ $order->user->sku }}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="customer_name" class=" form-control-label">Tên khách
                                                        hàng</label>
                                                    <input type="text" id="customer_name" name="customer"
                                                           value="{{ $order->customer }}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="order_sku" class=" form-control-label">Mã đơn
                                                        hàng</label>
                                                    <input type="text" id="order_sku" name="sku"
                                                           class="form-control" value="{{ $order->sku }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class=" form-control-label">Địa chỉ</label>
                                            <input type="text" id="address" name="address" class="form-control"
                                                   value="{{ $order->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="memo" class=" form-control-label">Diễn giải</label>
                                            <input type="text" id="sku" name="memo" class="form-control"
                                                   value="{{ $order->memo }}">
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col col-md-2">
                                                    <label for="date" class="form-control-labrl">Thời gian giao hàng</label>
                                                </div>
                                                <div class="col col-md-4">
                                                    <input type="datetime-local" class="form-control" name="shipping_start_date" id="date" value="{{ \Carbon\Carbon::parse($order->shipping_start_date)->format('Y-m-d\TH:i:s') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col col-md-2">
                                                    <label for="order_status" class="form-control-labrl">Trạng thái đơn hàng</label>
                                                </div>
                                                <div class="col col-md-4">
                                                    <select name="status_code" id="order_status" class="form-control">
                                                        <option value="WAITING" {{ $order->status_code == 'WAITING' ? 'selected' : '' }}>WAITING</option>
                                                        <option value="BEFORE_SEND" {{ $order->status_code == 'BEFORE_SEND' ? 'selected' : '' }}>BEFORE_SEND</option>
                                                        <option value="SEND" {{ $order->status_code == 'SEND' ? 'selected' : '' }}>SEND</option>
                                                    </select>
                                                </div>
                                            </div>
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
                                        <th style="width:200px;">Mã sản phẩm</th>
                                        <th style="width:240px;">Tên sản phẩm</th>
                                        <th style="width:150px">Qty</th>
                                        <th style="width:180px">Đơn giá</th>
                                        <th style="width:100px">(-%)</th>
                                        <th style="width:180px">Tổng tiền</th>
                                        <th style="text-align: center"><a class="btn btn-success addRow"
                                                                          data-index="{{ count($order->orderItems) - 1 }}">+</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="appent-add">
                                    @if(!empty($order->orderItems->toArray()))
                                        @foreach($order->orderItems as $index => $item)
                                            <tr data-index="{{ $index }}" class="order_create">
                                                <td><input type="text" name="product_sku[{{ $index }}]"
                                                           class="form-control product_sku"
                                                           data-index="{{ $index }}"
                                                           value="{{ $item->sku }}"></td>
                                                <td>
                                                    <select name="product_name[{{ $index }}]" id="product_detail_id"
                                                            class="form-control product_detail_id"
                                                            data-index="{{ $index }}">
                                                        <option> -- product detail --</option>
                                                        @foreach($item->product_details as $value)
                                                            <option value="{{ $value['id'] }}" {{ $value['id'] == $item->product_detail_id ? 'selected' : '' }} data-stock="{{ $value['stock'] }}" data-price="{{ $value['price'] }}"> {{ $value['product_detail'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="quantity_product_detail[{{ $index }}]"
                                                           class="form-control quantity" data-index="{{ $index }}"
                                                           value="{{ $item->quantity }}"></td>
                                                <td><input type="text" name="price[{{ $index }}]" class="form-control"
                                                           value="{{ $item->price }}"
                                                           readonly></td>
                                                <td><input type="text" name="discount[{{ $index }}]"
                                                           value="{{ $item->discount }}"
                                                           class="form-control discount" data-index="{{ $index }}"></td>
                                                <td><input type="text" name="total_product_detail[{{ $index }}]"
                                                           class="form-control" value="{{ $item->price }}"
                                                           data-index="{{ $index }}"></td>
                                                @if($index > 0)
                                                    <td style="text-align: center"><a class="btn btn-danger add-remove"
                                                                                      data-index="{{ $index }}">-</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td><input type="text" name="product_sku[0]"
                                                       class="form-control product_sku"
                                                       data-index="0"></td>
                                            <td>
                                                <select name="product_name[0]" id="product_detail_id"
                                                        class="form-control product_detail_id" data-index="0">
                                                    <option> -- product detail --</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="quantity_product_detail[0]"
                                                       class="form-control quantity" data-index="0"></td>
                                            <td><input type="text" name="price[0]" class="form-control"
                                                       readonly></td>
                                            <td><input type="text" name="discount[0]"
                                                       class="form-control discount" data-index="0"></td>
                                            <td><input type="text" name="total_product_detail[0]" class="form-control"
                                                       data-index="0"></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col col-8"></div>
                                    <div class="col col-3">
                                        <input type="hidden" name="amount" class="sum">
                                        Tổng : <span class="amount"
                                                     style="margin: 0 10px 0 20px"> {{ $order->total_amount }}</span>
                                        VND
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm create_order">
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
            var sum = [];
            var product_details = <?php echo json_encode($order->orderItems);?>;
            product_details.forEach(function (val, index) {
                sum[index] = val.price;
            });

            $('.addRow').on('click', function () {
                var i = $(this).attr('data-index');
                i++;
                addRow(i);
                $(this).attr('data-index', i);
            });

            function addRow(i) {
                var tr = '  <tr data-index="' + i + '" class="order_create">' +
                    '<td><input type="text" name="product_sku[' + i + ']" class="form-control product_sku" data-index="' + i + '"></td>' +
                    '<td><select name="product_name[' + i + ']" class="form-control product_detail_id" data-index="' + i + '"><option>' + '-- product detail--' + '</option></select></td>' +
                    '<td><input type="text" name="quantity_product_detail[' + i + ']" data-index="' + i + '" class="form-control quantity"></td>' +
                    '<td><input type="text" name="price[' + i + ']" class="form-control" readonly></td>' +
                    '<td><input type="text" name="discount[' + i + ']" data-index="' + i + '" class="form-control discount"></td>' +
                    '<td><input type="text" name="total_product_detail[' + i + ']"  class="form-control"></td>' +
                    '<td style="text-align: center"><a class="btn btn-danger add-remove" data-index="' + i + '">-</a></td>' +
                    '</tr>';
                $('.appent-add').append(tr);

                $('.add-remove').on('click', function () {
                    var index = $(this).attr('data-index');
                    deleteProduct(index, sum);
                    $('tr[data-index="' + index + '"]').remove();
                });

                $('.product_sku').on('change', function (e) {
                    var total_amount = 0;
                    var index = $(this).attr('data-index');
                    $('input[name="price[' + index + ']]').val(' ');
                    var sku = $(this).val();
                    addProductDetail(index, sku);

                    $('.product_detail_id').change(function () {
                        var key = $(this).attr('data-index');
                        var price = $('option:selected', this).attr('data-price');
                        var discount = $('input[name="discount[' + index + ']"]').val();
                        $('input[name="price[' + key + ']"]').val(price);
                        var quantity = $('input[name="quantity_product_detail[' + key + ']"]').val();
                        if (quantity) {
                            total_amount = price * quantity;
                            if (discount) {
                                sum[key] = total_amount - (total_amount / 100 * discount);
                                findSum(sumAll(sum));
                                $('input[name="total_product_detail[' + key + ']"]').val(total_amount - (total_amount / 100 * discount));
                            } else {
                                sum[key] = total_amount;
                                findSum(sumAll(sum));
                                $('input[name="total_product_detail[' + key + ']"]').val(total_amount);
                            }
                        }
                    });

                    $('.quantity').on('keyup', function (e) {
                        $('.alert-block').remove();
                        var quantity = $(this).val();
                        var key = $(this).attr('data-index');
                        var price = $('input[name="price[' + key + ']"]').val();
                        var discount = $('input[name="discount[' + key + ']"]').val();
                        var stock = $('select[name="product_name[' + key + ']"]').find(':selected').attr('data-stock');
                        if (parseInt(stock) < parseInt(quantity) || isNaN(parseInt(quantity))) {
                            $('#error_data').append('<div class="alert alert-danger alert-block">\n' +
                                '                        <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                                '                        <strong id="red">San pham co so luong ' + stock + '</strong>\n' +
                                '                    </div>');
                            $('input[name="quantity_product_detail[' + index + ']"]').val(stock);
                        } else {
                            if (price && quantity) {
                                total_amount = price * quantity;
                                if (discount) {
                                    sum[key] = total_amount - (total_amount / 100 * discount);
                                    findSum(sumAll(sum));
                                    $('input[name="total_product_detail[' + key + ']"]').val(total_amount - (total_amount / 100 * discount));
                                } else {
                                    sum[key] = total_amount;
                                    findSum(sumAll(sum));
                                    $('input[name="total_product_detail[' + key + ']"]').val(total_amount);
                                }
                            } else {
                                $('input[name="total_product_detail[' + key + ']"]').val(' ');
                            }
                        }
                    });

                    $('.discount').on('keyup', function () {
                        var key = $(this).attr('data-index');
                        var discount = $('input[name="discount[' + key + ']"]').val();
                        if (total_amount) {
                            discount = $(this).val();
                            sum[key] = total_amount - (total_amount / 100 * discount);
                            findSum(sumAll(sum));
                            $('input[name="total_product_detail[' + key + ']"]').val(total_amount - (total_amount / 100 * discount));
                        }
                    })
                });
            }

            $("#customer_sku").on('keyup', function (e) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.order.customer') }}",
                    data: {sku: $(this).val()},
                    success: function (result) {
                        if (result.statusCode == 1) {
                            if (result.data) {
                                $('#customer_name').val(result.data.name);
                                $('#address').val(result.data.address);
                            }
                        }
                    }
                })
            });

            $('.product_sku').on('change', function (e) {
                var key = $(this).attr('data-index');
                $('input[name="price[' + key + ']"]').val(' ');
                var sku = $(this).val();
                addProductDetail(key, sku);
            });

            $('.product_detail_id').change(function () {
                var total_amount = 0;
                var index = $(this).attr('data-index');
                var stock = $('option:selected', this).attr('data-stock');
                var price = $('option:selected', this).attr('data-price');
                var discount = $('input[name="discount[' + index + ']"]').val();
                $('input[name="price[' + index + ']"]').val(price);
                var quantity = $('input[name="quantity_product_detail[' + index + ']"]').val();
                if (parseInt(quantity) <= parseInt(stock)) {
                    total_amount = price * quantity;
                    if (discount) {
                        sum[index] = total_amount - (total_amount / 100 * discount);
                        findSum(sumAll(sum));
                        $('input[name="total_product_detail[' + index + ']"]').val(total_amount - (total_amount / 100 * discount));
                    } else {
                        sum[index] = total_amount;
                        $('.amount').text(sumAll(sum));
                        $('input[name="total_product_detail[' + index + ']"]').val(total_amount);
                    }
                }
            });

            $('.quantity').on('keyup', function (e) {
                var total_amount = 0;
                $('.alert-block').remove();
                var index = $(this).attr('data-index');
                var price = $('input[name="price[' + index + ']"]').val();
                var discount = $('input[name="discount[' + index + ']"]').val();
                var stock = $('select[name="product_name[' + index + ']"]').find(':selected').attr('data-stock');
                if (parseInt(stock) < parseInt($(this).val()) || isNaN(parseInt($(this).val()))) {
                    $('#error_data').append('<div class="alert alert-danger alert-block">\n' +
                        '                        <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                        '                        <strong id="red">San pham co so luong ' + stock + '</strong>\n' +
                        '                    </div>');
                    $('input[name="quantity_product_detail[' + index + ']"]').val(stock);
                } else {
                    if (price && $(this).val()) {
                        total_amount = price * $(this).val();
                        if (discount) {
                            sum[index] = total_amount - (total_amount / 100 * discount);
                            findSum(sumAll(sum));
                            $('input[name="total_product_detail[' + index + ']"]').val(total_amount - (total_amount / 100 * discount));
                        } else {
                            sum[index] = total_amount;
                            findSum(sumAll(sum));
                            $('input[name="total_product_detail[' + index + ']"]').val(total_amount);
                        }
                    } else {
                        $('input[name="total_product_detail[' + index + ']"]').val(' ');
                    }
                }
            });

            $('.discount').on('keyup', function () {
                var total_amount = 0;
                var index = $(this).attr('data-index');
                var price = $('input[name="price[' + index + ']"]').val();
                var quantity = $('input[name="quantity_product_detail[' + index + ']"]').val();
                total_amount = price * quantity;
                var discount = $('input[name="discount[' + index + ']"]').val();
                if (total_amount) {
                    discount = $(this).val();
                    sum[index] = total_amount - (total_amount / 100 * discount);
                    findSum(sumAll(sum));
                    $('input[name="total_product_detail[' + index + ']').val(total_amount - (total_amount / 100 * discount));
                }
            });

            $('.add-remove').on('click', function () {
                var index = $(this).attr('data-index');
                deleteProduct(index, sum);
                $('tr[data-index="' + index + '"]').remove();
            });

            $('.create_order').off('click').on('click', function (e) {
                e.preventDefault();
                $('.alert-block').remove();
                var data = $('#create_order').serializeArray();
                // push data to object
                var object = {};
                $.each(data, function () {
                    if (object[this.name] !== undefined) {
                        if (!object[this.name].push) {
                            object[this.name] = [object[this.name]];
                        }
                        object[this.name].push(this.value || '');
                    } else {
                        object[this.name] = this.value || '';
                    }
                });

                object['_token'] = '{{ csrf_token() }}';
                object['_method'] = 'PUT';
                var id = <?php echo json_encode($order)?>;
                var url = "{{ url('admin/order/') }}" + '/' + id.id;
                $.ajax({
                    type: "POST",
                    url: url,
                    data: object,
                    success: function (data) {
                        if (data.statusCode == 1) {
                            alert('Order update success.');
                            window.location.href = "{{ route('admin.order.index') }}";
                        } else {
                            alert('Product update error.');
                        }
                    },
                    error: function (data) {
                        if (data.status == 422) {
                            var errors = JSON.parse(data.responseText);
                            $('#error_data').append('<div class="alert alert-danger alert-block">\n' +
                                '                        <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                                '                        <strong id="red"></strong>\n' +
                                '                    </div>');
                            $.each(errors.errors, function (key, value) {
                                $('#red').append('<div>' + value + '</div>');
                            });
                        }
                    }
                })
            })
        });

        function addProductDetail(index, sku) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.order.product') }}",
                data: {sku: sku},
                success: function (result) {
                    $('select[name="product_name[' + index + ']"] option').remove();
                    var pro = '<option>' + '--product detail--' + '</option>';
                    if (result.statusCode == 1) {
                        if (result.data.details) {
                            result.data.details.forEach(function (val) {
                                pro = pro + '<option value="' + val.id + '" data-price="' + val.price + '" data-stock="' + val.quantity + '">' + val.detail + '</option>';
                            });
                        }
                    }

                    $('select[name="product_name[' + index + ']"]').append(pro);
                }
            })
        }

        function sumAll(data) {
            var sum = 0;
            data.forEach(function (val) {
                if (val) {
                    sum += val;
                }
            });

            return sum;
        }

        function findSum(data) {
            $('.sum').val(data);
            $('.amount').text(data);
        }

        function deleteProduct(index, sum) {
            for(var i = 0; i<sum.length; i++) {
                if (i == index ) {
                    sum.splice(i,1);
                }
            }
            findSum(sumAll(sum));

            return sum;
        }
    </script>
@endpush
