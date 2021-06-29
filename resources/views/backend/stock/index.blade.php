@extends('backend.layouts.app')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">Data table</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Categories</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($stocks as $index => $stock)
                                <tr>
                                    <td>{{ $stock->name }}</td>
                                    <td>
                                        <input type="text" name="quantity[{{ $stock->id }}]" data-quantity="{{ $stock->quantity }}" data-index="{{ $stock->id }}" class="update_stock" value="{{ $stock->quantity }}">
                                    </td>
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
@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.update_stock').change(function () {
                var id = $(this).attr('data-index');
                var quantity = $(this).val();
                var stock = $(this).attr('data-quantity');
                var object = {};
                object['quantity'] = quantity;
                object['_token'] = '{{ csrf_token() }}';
                object['_method'] = 'PUT';
                var url = "{{ url('admin/stock/') }}" + '/' + id;
                $.ajax({
                    type: "POST",
                    url: url,
                    data: object,
                    success: function (data) {
                        if (data.statusCode == 1) {
                            alert('Stock updated success.');
                            window.location.href = "{{ route('admin.stock.index') }}";
                        } else {
                            alert('Stock updated error.');
                        }
                    },
                    error: function (data) {
                        if (data.status == 422) {
                            var errors = JSON.parse(data.responseText);
                            var error = '';
                            $.each(errors.errors, function (key, value) {
                                error += value;
                            });

                            $('input[name="quantity['+ id +']"]').val(stock);
                            alert(error);
                        }
                    }
                })
            });
        })
    </script>
@endpush
