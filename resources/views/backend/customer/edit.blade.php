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
                        <li><a href="{{ route('admin.list') }}">Admins table</a></li>
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

                    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header"><strong>Edit Admin</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ !empty(old('name')) ? old('name') : $admin->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="email" class=" form-control-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ !empty(old('email')) ? old('email') : $admin->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="address" class=" form-control-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" value="{{ !empty(old('address')) ? old('address') : $admin->address }}">
                                </div>

                                <div class="form-group">
                                    <label for="phone" class=" form-control-label">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ !empty(old('phone')) ? old('phone') : $admin->phone }}">
                                </div>

                                <div class="form-group">
                                    <label for="password" class=" form-control-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirm" class=" form-control-label">Password confirm</label>
                                    <input type="password" id="password_confirm" name="password_confirmation" class="form-control" value="">
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
