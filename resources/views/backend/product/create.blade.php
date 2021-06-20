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
        <form action="" method="post" id="form_create_product" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Add New Product</strong></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div id="error_data"></div>
                                        </div>
                                    </div>
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
                                        <textarea class="form-control description" rows="5"
                                            name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_big" class="form-control-label">Category</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <select class="form-control" id="category_big" name="category_0">
                                                    <option value="">-- Select Category --</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" id="category_mid" name="category_1">
                                                    <option value="">-- Select Category --</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" id="category_small" name="category_2">
                                                    <option value="">-- Select Category --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_big" class="form-control-label">Image</label>
                                        <div class="mb-3 data_image">
                                            <input type="file" name="img_url[]" id="files"
                                                accept="image/jpeg,image/png,image/jpg"
                                                class="form-control inputfile data_content" data-content="0"
                                                multiple=""><input type="file" name="img_url[]"
                                                class="form-control inputfile data_content" multiple="" data-content="">
                                            <label class="btn btn-success img_data" for="files">商品画像登録</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <output id="result" class="row">
                                                </output>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="bootstrap-data-table-export" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th style="text-align: center"><a
                                                    class="btn btn-success addRow" data-index="0">+</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="appent-add">
                                        <tr>
                                            <td>
                                                <select name="size[0]" class="form-control">
                                                    <option value="">--size--</option>
                                                    @foreach($sizes as $size)
                                                        <option value="{{ $size->id }}"> {{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="color[0]" class="form-control">
                                                    <option value="">--color--</option>
                                                    @foreach($colors as $color)
                                                        <option value="{{ $color->id }}">{{ $color->color }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="brand[0]" class="form-control"></td>
                                            <td><input type="text" name="model[0]" class="form-control"></td>
                                            <td><input type="text" name="price_detail[0]" class="form-control"></td>
                                            <td><input type="text" name="quantity[0]" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-sm create_product">
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
<script type="text/javascript">
    $(document).ready(function () {
            $('.img_data').click(function (e) {
                e.preventDefault();
                $('.data_content').last().click();

                if (window.File && window.FileList && window.FileReader) {
                    $(".data_image .data_content").on("change", function (e) {
                         $(".inputfile").after("<input type=\"file\" name=\"img_url[]\" class=\"form-control inputfile data_content\" multiple data-content='' />");

                        var files = e.target.files,
                            filesLength = files.length;
                        for (var i = 0; i < filesLength; i++) {
                            var f = files[i];
                            var fileReader = new FileReader();
                            var name_file = f.name;
                            var idxDot = name_file.lastIndexOf(".") + 1;
                            var extFile = name_file.substr(idxDot, name_file.length).toLowerCase();
                            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                                fileReader.onload = (function(e) {
                                    var file = e.target;
                                    $("<span class=\"pip\">" +
                                        "<span class=\"remove\">&times;</span><br>" +
                                        "<input type=\"hidden\" name='\img_url[]\' value=\""+ e.target.result+"\">" +
                                        "<input type=\"hidden\" name='\img_url[]\' value=\""+ name_file +"\">" +
                                        "<img name=\"img_url[]\" class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + name_file + "\"/>" +
                                        "<br/><span>"+name_file+"</span>" +
                                        "</span>").insertAfter("#result");
                                    $(".remove").click(function(){
                                        $(this).parent(".pip").remove();
                                    });
                                    // Old code here
                                    /*$("<img></img>", {
                                      class: "imageThumb",
                                      src: e.target.result,
                                      title: file.name + " | Click to remove"
                                    }).insertAfter("#files").click(function(){$(this).remove();});*/

                                });
                                fileReader.readAsDataURL(f);
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
            });
            $('.create_product').click(function (e) {
                e.preventDefault();
                $('.alert-block').remove();
                var data = $('#form_create_product').serializeArray();
                // push data to object
                var object = {};
                $.each(data, function() {
                    if (object[this.name] !== undefined) {
                        if (!object[this.name].push) {
                            object[this.name] = [object[this.name]];
                        }
                        object[this.name].push(this.value || '');
                    } else {
                        object[this.name] = this.value || '';
                    }
                });

                object['_token'] = '{{ csrf_token() }}';
                url = "{{ route('admin.product.store') }}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: object,
                    success: function (data) {
                        if (data.statusCode == 1) {
                            alert('Product created success.');
                            window.location.href = "{{ route('admin.product.index') }}";
                        }else {
                            alert('Product created error.');
                        }
                    },
                    error: function (data) {
                        if (data.status == 422) {
                            var errors = JSON.parse(data.responseText);
                            $('#error_data').append('<div class="alert alert-danger alert-block">\n' +
                                '                        <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                                '                        <strong id="red"></strong>\n' +
                                '                    </div>');
                            $.each(errors.errors, function (key, value) {
                                $('#red').append('<div>' + value + '</div>');
                            });
                        }
                    }
                })
            });

            $('.addRow').on('click', function(){
                var i = $(this).attr('data-index');
                i++;
                addRow(i);
                $(this).attr('data-index', i);
            });
            function addRow(i){
                var sizes = <?php echo json_encode($sizes)?>;
                var option_size = '';
                sizes.forEach(function (val) {
                    option_size = option_size + '<option value="'+ val.id +'">'+ val.size +'</option>';
                });
                var colors = <?php echo json_encode($colors)?>;
                var option_color = '';
                colors.forEach(function (val) {
                    option_color = option_color + '<option value="'+ val.id +'">'+ val.color +'</option>';
                });
                var tr = '<tr data-index="'+ i +'">'+
                            '<td>'+
                                '<select name="size['+ i +']" id="" class="form-control">'+
                                    '<option value="">--size--</option>'+
                                    option_size +
                                '</select>'+
                            '</td>'+
                            '<td>'+
                                '<select name="color['+ i +']" id="" class="form-control">'+
                                    '<option value="">--color--</option>'+
                                    option_color +
                                '</select>'+
                            '</td>'+
                            '<td><input type="text" name="brand['+ i +']" class="form-control"></td>'+
                            '<td><input type="text" name="model['+ i +']" class="form-control"></td>'+
                            '<td><input type="text" name="price_detail['+ i +']" class="form-control"></td>'+
                            '<td><input type="text" name="quantity['+ i +']" class="form-control"></td>'+
                            '<td style="text-align: center"><a class="btn btn-danger add-remove" data-index="' + i + '">-</a></td>'+
                        '</tr>';

                $('.appent-add').append(tr);

                $('.add-remove').click(function () {
                    var index = $(this).attr('data-index');
                    $('tr[data-index="'+ index +'"]').remove();
                })
            };
        })
</script>
@endpush
