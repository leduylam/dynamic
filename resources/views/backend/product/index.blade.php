@extends('layouts.admin_layouts.app')

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
                    <li><a href="#">Product table</a></li>
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
                        <strong class="card-title">Product Manage</strong>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm" style="float: right">Add new</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Categories</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="images">
                                        <img src="{{ asset('admin/images/no-image.png') }}" alt="">
                                    </td>
                                    <td>57790102</td>
                                    <td><a href="{{ route('admin.product.product-detail.create') }}">PUMA LS Sun Crew</a></td>
                                    <td>1.422.000 VND</td>
                                    <td>
                                        <a href="" class="badge badge-success">Show</a>
                                        <a href="" class="badge badge-secondary">Hide</a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-warning">Update</a>
                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
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
