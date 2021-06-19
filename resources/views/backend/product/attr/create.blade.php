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
                        <div class="card-header">
                            <strong class="card-title" style="justify-content: center">Name: </strong>
                            {{-- <a href="{{ route('admin.color.create') }}" class="btn btn-primary btn-sm"
                            style="float: right">Add new</a> --}}
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Màu</th>
                                        <th>Thương hiệu</th>
                                        <th>Year Model</th>
                                        <th style="text-align: center"><a href="#" class="btn btn-success addRow">+</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="appent-add">

                                    <tr>
                                        <td>
                                            <select name=""class="form-control tokenizationSize">
                                                <option value="">XS</option>
                                                <option value="">S</option>
                                                <option value="">M</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="color" id="color">
                                        </td>
                                        <td><input type="text" name="brand[]" id="brand" class="form-control"></td>
                                        <td><input type="text" name="model[]" class="form-control"></td>
                                        <td style="text-align: center"><a href="" class="btn btn-danger">-</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>

                </div>
            </div>
    </div>
    </form>
</div>
</div>
@endsection
@push('after-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#brand").tokenfield({
                autocomplete: ['Puma', 'Cobra', 'US Kid Golf', 'Ahead'],
                delay:100
            });
            showAutocompleteOnFocus: true
        })
</script>
@endpush