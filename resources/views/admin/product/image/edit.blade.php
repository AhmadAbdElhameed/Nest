@extends('admin.layouts.master')

@section('style')

@endsection
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
{{--                                        <form class="form"--}}
{{--                                              action="{{route('admin.product.image.update',$product)}}"--}}
{{--                                              method="POST"--}}
{{--                                              enctype="multipart/form-data">--}}
{{--                                            @csrf--}}
{{--                                            <div class="form-body">--}}

{{--                                                <h4 class="form-section"><i class="ft-home"></i> صور المنتج </h4>--}}
{{--                                                <div class="form-group">--}}

{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                            <div class="form-actions">--}}
{{--                                                <button type="button" class="btn btn-warning mr-1"--}}
{{--                                                        onclick="history.back();">--}}
{{--                                                    <i class="ft-x"></i> تراجع--}}
{{--                                                </button>--}}
{{--                                                <button type="submit" class="btn btn-primary">--}}
{{--                                                    <i class="la la-check-square-o"></i> تحديث--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
                                        <form id="image-upload-form" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="images[]" id="image-upload" multiple>
                                            <button type="submit">Upload</button>
                                        </form>

                                        <table id="images-table">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Existing images will be listed here -->
                                            </tbody>
                                        </table>

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
                    url: "{{ route('admin.product.image.update',$product) }}",
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        // Update the table with the new image
                        data.uploadedImages.forEach(function(imageUrl) {
                            $('#images-table tbody').append('<tr><td><img src="' + imageUrl + '" style="width: 100px; height: auto;"></td><td><button type="button" class="remove-image" data-url="' + imageUrl + '">Remove</button></td></tr>');
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $(document).on('click', '.remove-image', function() {
                var imageUrl = $(this).data('url');
                var row = $(this).closest('tr');

                // AJAX request to remove the image
                $.ajax({
                    url: "{{ route('admin.product.image.destroy') }}",
                    type: 'POST',
                    data: { url: imageUrl },
                    success: function(data) {
                        // Remove the row from the table
                        row.remove();
                    }
                });
            });
        });
    </script>

@stop
