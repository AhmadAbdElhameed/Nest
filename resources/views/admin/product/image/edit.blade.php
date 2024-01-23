@extends('admin.layouts.master')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="">
                                        الصور </a>
                                </li>
                                <li class="breadcrumb-item active"> أضافه صورة منتج
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> أضافة صور جديدة </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form id="image-upload-form" method="POST" enctype="multipart/form-data">
                                            <div class="card-body">

                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Upload Product Images</label>
                                                    <input class="form-control" type="file" name="images[]" id="image-upload" multiple>
                                                    <button class="btn btn-primary mt-2" type="submit">Upload</button>
                                                    <div class="mt-2" id="validation-errors"></div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="table-responsive mt-1">
                                            <table class="table" id="images-table">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($product->images as $image)
                                                    <tr>
                                                        <td><img src="{{ url('uploads/images/' . $image->image) }}" style="width: 100px; height: auto;"></td>
                                                        <td>
                                                            <button type="button" class="remove-image btn btn-danger" data-id="{{ $image->id }}">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>



@stop

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#image-upload-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.product.image.update', $product) }}",
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        // Clear the file input by resetting its value
                        $('#image-upload').val('');
                        data.uploadedImages.forEach(function(image) {
                            $('#images-table tbody').append('<tr><td><img src="' + image.url + '" style="width: 100px; height: auto;"></td><td><button type="button" class="remove-image btn btn-danger" data-id="' + image.id + '">Remove</button></td></tr>');

                            Swal.fire({
                                title: 'Success!',
                                text: 'Image uploaded successfully',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        });
                    },
                    error: function(xhr) {
                        // Clear the file input by resetting its value
                        $('#image-upload').val('');
                        $('#validation-errors').empty(); // Clear any existing errors

                        // Check if there are validation errors (status code 422)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    // Append each error to the validation-errors div
                                    errors[key].forEach(function(error) {
                                        $('#validation-errors').append('<div class="alert alert-danger">' + error + '</div>');
                                    });
                                }
                            }
                        } else {
                            // For non-validation errors, you can add a generic error message
                            $('#validation-errors').append('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                        }
                    },

                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $(document).on('click', '.remove-image', function() {
                var imageId = $(this).data('id'); // Get the image ID
                var row = $(this).closest('tr');

                // Construct the URL for the AJAX request
                var url = "{{ url('admin/product/images/delete') }}/" + imageId;

                // AJAX request to remove the image
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _method: 'DELETE', _token: "{{ csrf_token() }}" },
                    success: function(data) {
                        // Remove the row from the table
                        row.remove();
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    }
                });
            });
        });
    </script>
@stop

