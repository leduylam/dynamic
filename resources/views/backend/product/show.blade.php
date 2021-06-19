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
                        <li><a href="{{ route('admin.product.index') }}">Product Detail</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add Attributes</strong>
                                <a href="{{ route('admin.product.create.attr', $product->id) }}" class="btn btn-primary btn-sm" style="float: right; margin-left:5px;">Add Attribute</a>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="name"
                                                   class=" form-control-label"><strong>Name:</strong></label>&nbsp;<span>{{ $product->name }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sku"
                                                   class=" form-control-label"><strong>SKU:</strong></label>&nbsp;<span>{{ $product->sku }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sku"
                                                   class=" form-control-label"><strong>Price:</strong></label>&nbsp;<span>{{ $product->price }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <img width="150px" src="{{ asset('admin/images/no-image.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
