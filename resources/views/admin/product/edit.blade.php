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
                                        المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active"> أضافه منتج
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
                                    <h4 class="card-title" id="basic-layout-form"> أضافة منتج جديد </h4>
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
                                        <form class="form"
                                              action="{{route('admin.product.update',$product)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method("PUT")


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> البيانات الاساسية للمنتج   </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم  المنتج
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$product->name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم بالرابط
                                                            </label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$product->slug}}"
                                                                   name="slug">
                                                            @error("slug")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> وصف المنتج
                                                            </label>
                                                            <textarea  name="description" id="description"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                            >{{$product->description}}</textarea>

                                                            @error("description")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الوصف المختصر
                                                            </label>
                                                            <textarea  name="short_description" id="short-description"
                                                                       class="form-control"
                                                                       placeholder=""
                                                            >{{$product->short_description}}</textarea>

                                                            @error("short_description")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">سعر المنتج
                                                            </label>
                                                            <input  name="price" id="price"
                                                                       class="form-control"
                                                                       placeholder="" value="{{$product->price}}">

                                                            @error("price")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row" >
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر القسم
                                                            </label>
                                                            <select name="categories[]" class="select2 form-control" multiple>
                                                                <optgroup label="من فضلك أختر القسم ">
                                                                    @if($categories && $categories->count() > 0)
                                                                        @foreach($categories as $category)
                                                                            <option value="{{ $category->id }}" {{ $product->categories->contains('id', $category->id) ? 'selected' : '' }}>
                                                                                {{ $category->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('categories.0')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر ألعلامات الدلالية
                                                            </label>
                                                            <select name="tags[]" class="select2 form-control" multiple>
                                                                <optgroup label=" اختر ألعلامات الدلالية ">
                                                                    @if($tags && $tags -> count() > 0)
                                                                        @foreach($tags as $tag)
                                                                            <option
                                                                                value="{{$tag -> id }}" {{ $product->tags->contains('id', $tag->id) ? 'selected' : '' }} >{{$tag -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('tags')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر ألماركة
                                                            </label>
                                                            <select name="brand_id" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر الماركة ">
                                                                    @if($brands && $brands -> count() > 0)
                                                                        @foreach($brands as $brand)
                                                                            <option
                                                                                value="{{$brand -> id }}" {{ (old('brand_id', $product->brand_id) == $brand->id) ? 'selected' : '' }}>{{$brand -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('brand_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="status"
                                                                   id="switcheryColorStatus"
                                                                   class="switchery" data-color="success"
                                                                   @if(old('status', $product->status)) checked @endif/>
                                                            <label for="switcheryColorStatus"
                                                                   class="card-title ml-1">الحالة </label>
                                                            @error("status")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="manage_stock"
                                                                   id="switcheryColorManageStock"
                                                                   class="switchery" data-color="success"
                                                                   @if(old('manage_stock', $product->manage_stock)) checked @endif/>
                                                            <label for="switcheryColorManageStock"
                                                                   class="card-title ml-1">إدارة المخزون </label>
                                                            @error("manage_stock")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="in_stock"
                                                                   id="switcheryColorInStock"
                                                                   class="switchery" data-color="success"
                                                                   @if(old('in_stock', $product->in_stock)) checked @endif/>
                                                            <label for="switcheryColorInStock"
                                                                   class="card-title ml-1">متواجد في المخزن </label>
                                                            @error("in_stock")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>

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
        $('input:radio[name="type"]').change(
            function(){
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');

                }else{
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
@stop
