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
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title" style="justify-content: center">Categories table</strong>
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm" style="float: right">Add new</a>
                    </div>
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
                                <tr>
                                    <td>1</td>
                                    <td class="category_image">
                                        <img src="{{ asset('admin/images/no-image.png') }}" alt="">
                                    </td>
                                    <td>Systdaaaaaaem Architect</td>
                                    <td>
                                        <a href="" class="badge badge-success">Show</a>
                                        <a href="" class="badge badge-secondary">Hide</a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-outline-secondary">Update</a>
                                        <a href="" class="btn btn-sm btn-outline-danger">Delete</a>
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
@endsection
