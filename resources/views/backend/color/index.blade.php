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

<<<<<<< HEAD
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Color Manage</strong>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm" style="float: right">Add new</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Color</th>
                                    <th>SKU</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Puma Black</td>
                                    <td>BLK</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-warning">Update</a>
                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
=======
                <div class="col-md-12">
                    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" style="justify-content: center">Colors table</strong>
                            <a href="{{ route('admin.color.create') }}" class="btn btn-primary btn-sm" style="float: right">Add new</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Color</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                        </div>
>>>>>>> main
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
