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

                <div class="col-md-12">
                    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.category.create.small', $category->id) }}" class="btn btn-primary btn-sm" style="float: right">Add new</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td class="category_image">
                                        <a href="{{ route('admin.category.show.mid', $category->id) }}">
                                            <img class="img" src="{{ \Storage::disk('s3')->url('categories/mid/'.$category->image) }}" alt="">
                                        </a>
                                    </td>
                                    <td><a href="{{ route('admin.category.show.mid', $category->id) }}">{{ $category->name }}</a></td>
                                    <td>
                                        @if($category->status == 1)
                                            <a href="#" class="badge badge-success">Show</a>
                                        @else
                                            <a href="#" class="badge badge-secondary">Hide</a>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Category parent</div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category_small as $mid)
                                    <tr>
                                        <td>{{ $mid->id }}</td>
                                        <td class="category_image">
                                            <a href="{{ route('admin.category.show.small', $mid->id) }}">
                                                <img class="img" src="{{ \Storage::disk('s3')->url('categories/small/'.$mid->image) }}" alt="">
                                            </a>
                                        </td>
                                        <td><a href="{{ route('admin.category.show.small', $mid->id) }}">{{ $mid->name }}</a></td>
                                        <td>
                                            @if($mid->status == 1)
                                                <a href="#" class="badge badge-success">Show</a>
                                            @else
                                                <a href="#" class="badge badge-secondary">Hide</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.category.destroy', $mid->id) }}" method="POST">
                                                <a href="{{ route('admin.category.edit.small', $mid->id) }}" class="btn btn-sm btn-outline-secondary">Update</a>
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
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
