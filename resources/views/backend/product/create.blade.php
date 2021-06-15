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
                                            <label for="category_big" class="form-control-label">Category</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <select class="form-control" id="category_big" name="category_id[]">
                                                        <option value="">-- Select Category --</option>
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <select class="form-control" id="category_mid" name="category_id[]">
                                                        <option value="">-- Select Category --</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <select class="form-control" id="category_small"
                                                            name="category_id[]">
                                                        <option value="">-- Select Category --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content" class=" form-control-label">Description</label>
                                            <textarea name="content" id="content" class="form-control"
                                                      cols="10"></textarea>
                                        </div>
                                        <div class="row form-group data_image">
                                            <input type="file" name="img_url[]" id="files"
                                                   accept="image/jpeg,image/png,image/jpg"
                                                   class="form-control inputfile data_content" data-content='' multiple>
                                            <label class="btn btn-success img_data" for="files">商品画像登録</label>
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
@push('after-scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.img_data').click(function (e) {
                e.preventDefault();
                $('.data_content').last().click();

                if (window.File && window.FileList && window.FileReader) {
                    $(".data_image .data_content").on("change", function (e) {
                        var check = $('.remove').length;
                        $('input').find("[data-content='" + +"']");
                        // if (check < 5) {
                        $(".inputfile").after("<input type=\"file\" name=\"img_url[]\" class=\"form-control inputfile data_content\" multiple data-content='' />");
                        // }

                        var files = e.target.files,
                            filesLength = files.length;

                        for (var i = 0; i < filesLength; i++) {
                            var f = files[i];
                            var fileReader = new FileReader();
                            var name_file = f.name;

                            var idxDot = name_file.lastIndexOf(".") + 1;
                            var extFile = name_file.substr(idxDot, name_file.length).toLowerCase();
                            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                                // check image exist
                                checkImage(name_file, fileReader, f, check, name_file)
                            } else {
                                alert("jpg / jpegファイルとpngファイルのみが許可されています！");
                            }

                        }
                    });
                } else {
                    alert("Your browser doesn't support to File API")
                }
            });
            var images = [];
            $('.img_name').click(function () {
                setTimeout(function () {
                    $("img[name='img_url[]']").map(function (key) {
                        var array_i = [$(this).attr('alt'), $(this).attr('data-id')];
                        images.push(array_i);
                    });

                    $.each(images, function (key, value) {
                        $(".inputfile").before("<input type='hidden' name=\"images[]\" value='" + value[0] + "' class=\"form-control images_content\" alt='" + value[1] + "' multiple />");
                    });
                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                    });
                }, 1000);
            });

            $('#category_big').change(function () {
                var id = $(this).val();
                var option = '';
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.category.list.mid') }}",
                    data: {category_id: id},
                    success: function (data) {
                        $('#category_mid option').remove();
                        option += `<option value="">-- Select Category --</option>`;
                        data.forEach(function (val) {
                            option += `<option value="${val.id}">${val.name}</option>`;
                        });

                        $('#category_mid').append(option);

                        $('#category_mid').change(function () {
                            var category_mid = $(this).val();
                            var option_small = '';
                            $.ajax({
                                type: "GET",
                                url: "{{ route('admin.category.list.small') }}",
                                data: {category_id_1: id, category_id_2: category_mid},
                                success: function (result) {
                                    $('#category_small option').remove();
                                    option_small += `<option value="">-- Select Category --</option>`;
                                    result.forEach(function (value) {
                                        option_small += `<option value="${value.id}">${value.name}</option>`;
                                    });

                                    $('#category_small').append(option_small);
                                }
                            })
                        })
                    }
                })
            })
        })
    </script>
@endpush
