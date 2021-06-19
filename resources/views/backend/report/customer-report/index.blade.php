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
                            <strong class="card-title" style="justify-content: center">Doanh số bán hàng theo khách hàng</strong>
                            {{-- <a href="{{ route('admin.color.create') }}" class="btn btn-primary btn-sm" style="float: right">Add new</a> --}}
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
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @if(!empty($colors))
                                        @foreach($colors as $color)
                                            <tr>
                                                <td>{{ $color->id }}</td>
                                                <td>{{ $color->color }}</td>
                                                <td>{{ $color->description }}</td>
                                                <td>
                                                    <form action="{{ route('admin.color.destroy', $color->id) }}" method="POST">
                                                        <a href="{{ route('admin.color.edit', $color->id) }}" class="btn btn-sm btn-outline-secondary">Update</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif --}}
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
