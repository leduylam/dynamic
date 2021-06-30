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
                                    <th>Sku</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="images">
                                        <img src="{{ \Storage::disk('s3')->url('product/'.$product->image) }}" alt="">
                                    </td>
                                    <td>{{ $product->sku }}</td>
                                    <td><a href="{{ route('admin.product.show', $product->id) }}">{{ $product->name }}</a></td>
                                    <td>{{ $product->price }}VND</td>
                                    <td>
                                        @if($product->status == 1)
                                            <a href="#" class="badge badge-success">Show</a>
                                        @else
                                            <a href="#" class="badge badge-secondary">Hide</a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-warning">Update</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
