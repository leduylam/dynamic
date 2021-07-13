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
                @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title" style="justify-content: center">Banner table</strong>
                        <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-sm" style="float: right">Add new</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Alt</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($banners))
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td> {{ $banner->id }} </td>
                                            <td> <img src="{{ \Storage::disk('s3')->url('banner/'.$banner->image) }}" alt=""> </td>
                                            <td> {{ $banner->title }} </td>
                                            <td> {{ $banner->link }} </td>
                                            <td> {{ $banner->alt }} </td>
                                            <td> {{ $banner->status }} </td>
                                            <td> Sửa Xóa </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
