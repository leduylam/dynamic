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

                    @if ($message = \Illuminate\Support\Facades\Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" style="justify-content: center">Danh sách Order</strong>
                            {{-- <a href="{{ route('admin.color.create') }}" class="btn btn-primary btn-sm" style="float: right">Add new</a> --}}
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Tổng tiền hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo đơn</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($orders))
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $order->sku }}</td>
                                                <td>{{ $order->user->sku }}</td>
                                                <td>{{ $order->customer }}</td>
                                                <td>{{ $order->total_amount }}</td>
                                                <td>{{ $order->status_code }}</td>
                                                <td>{{ $order->order_date }}</td>
                                                <td>
                                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST">
                                                        <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-sm btn-outline-secondary">Update</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
