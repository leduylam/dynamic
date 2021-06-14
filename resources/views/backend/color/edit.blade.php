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
                        <li><a href="{{ route('admin.color.index') }}">Products table</a></li>
                        <li class="active">Add New</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <form action="{{ route('admin.color.update', $color->id) }}" method="post">
                @csrf
                @method('PUT')
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
                        <div class="card">
                            <div class="card-header"><strong>Edit Size</strong></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="size" class=" form-control-label">Size</label>
                                            <input type="text" id="size" name="color" class="form-control" value="{{ !empty(old('color')) ? old('color') : $color->color }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class=" form-control-label">Description</label>
                                            <textarea name="description" id="description" cols="10" class="form-control"> {{ !empty(old('description')) ?  old('description') : $color->description }}</textarea>
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
