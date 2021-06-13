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
                            <a href="{{ route('admin.product.color.create') }}" class="btn btn-primary btn-sm" style="float: right; margin:0 10px;">Add Color</a>
                            <a href="{{ route('admin.product.size.create') }}" class="btn btn-primary btn-sm" style="float: right; margin-left:5px;">Add Size</a>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="name"
                                            class=" form-control-label"><strong>Name:</strong></label>&nbsp;<span>PUMA LS Sun
                                            Crew</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sku"
                                            class=" form-control-label"><strong>SKU:</strong></label>&nbsp;<span>57790102</span>
                                    </div>
                                    <div class="field_wrapper">
                                        <div>
                                            <select name="size[]" id="size" style="width: 150px;">
                                                <option value="">-- select --</option>
                                                <option value="">XS</option>
                                                <option value="">S</option>
                                                <option value="">M</option>
                                                <option value="">L</option>
                                                <option value="">XL</option>
                                            </select>
                                            <select name="color[]" id="color" style="width: 150px;">
                                                <option value="">-- select --</option>
                                                <option value="">White</option>
                                                <option value="">Black</option>
                                                <option value="">Pink</option>
                                                <option value="">Green</option>
                                                <option value="">Yellow</option>
                                            </select>
                                            {{-- <input style="width: 150px;" type="text" name="size[]" id="size" placeholder="Size" value=""/> --}}
                                            {{-- <input style="width: 150px;" type="text" name="color[]" id="color" placeholder="Color" value=""/> --}}
                                            <input style="width: 150px;" type="text" name="brand[]" id="brand" placeholder="Brand" value=""/>
                                            <input style="width: 150px;" type="text" name="model[]" id="model" placeholder="Year Model" value=""/>
                                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                        </div>
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
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection