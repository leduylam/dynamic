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
        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Add New Product</strong></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="name" class=" form-control-label">Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="sku" class=" form-control-label">SKU</label>
                                        <input type="text" id="sku" name="sku" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="price" class=" form-control-label">W/S Price</label>
                                        <input type="text" id="price" name="price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class=" form-control-label">Description</label>
                                        <textarea name="description" id="description" class="form-control"
                                            cols="10">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id" class="form-control-label">Category</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <select class="form-control" id="category_id" name="category_id">
                                                    <option value="">-- Select Category --</option>
                                                        <option>Dallas Cowboys</option>
                                                        <option>New York Giants</option>
                                                        <option>Philadelphia Eagles</option>
                                                        <option>Washington Redskins</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" id="category_id" name="category_id">
                                                    <option value="">-- Select Category --</option>
                                                        <option>Chicago Bears</option>
                                                        <option>Detroit Lions</option>
                                                        <option>Green Bay Packers</option>
                                                        <option>Minnesota Vikings</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" id="category_id" name="category_id">
                                                    <option value="">-- Select Category --</option>
                                                        <option>Chicago Bears</option>
                                                        <option>Detroit Lions</option>
                                                        <option>Green Bay Packers</option>
                                                        <option>Minnesota Vikings</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class=" form-control-label">Description</label>
                                        <textarea name="content" id="content" class="form-control"
                                                  cols="10"></textarea>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input"
                                                                         class=" form-control-label">File
                                                input</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="file-input"
                                                                            name="file-input" class="form-control-file"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
