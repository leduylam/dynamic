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
                        <li><a href="{{ route('admin.category.index') }}">Categories table</a></li>
                        <li class="active">Add New</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header"><strong>Edit Category</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Category name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ !empty(old('name')) ? old('name') : $category->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Category Description</label>
                                    <textarea name="description" id="description" cols="10" class="form-control"> {{ !empty(old('description')) ? old('description') : $category->description }}</textarea>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">File
                                            input</label></div>
                                    <div class="col-12 col-md-9">
                                        <img style="width: 70px;height: 70px; margin-bottom: 10px" src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                        <input type="file" id="file-input" name="image"
                                                                        class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
