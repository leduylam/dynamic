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
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Add Color</strong></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="color" class=" form-control-label">Size</label>
                                        <input type="text" id="color" name="color" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="sku" class=" form-control-label">Color SKU</label>
                                        <!-- Mã màu thường được hiển thị bằng số hoặc chữ VD: màu trắng -> SKU 02 hoặc WHT -->
                                        <input type="text" id="sku" name="sku" class="form-control">
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