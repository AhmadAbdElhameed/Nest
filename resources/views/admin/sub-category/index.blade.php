

@extends('admin.layouts.master')

@section('title')
    {{__('admin/sub_category.index_page_title')}}
@endsection

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> {{__('admin/sub_category.main_title')}} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/sub_category.home')}} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{__('admin/sub_category.main_title')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('admin/sub_category.sub_main_title')}} </h4>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>{{__('admin/sub_category.form_name')}} </th>
                                                <th> {{__('admin/sub_category.form_slug')}} </th>
                                                <th>{{__('admin/sub_category.form_status')}}</th>
                                                <th>{{__('admin/sub_category.form_image')}}</th>
                                                <th>{{__('admin/sub_category.form_actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($subCategories)
                                                @foreach($subCategories as $subCategory)
                                                    <tr>
                                                        <td>{{$subCategory -> name}}</td>
                                                        <td>{{$subCategory -> slug}}</td>
                                                        <td>{{$subCategory -> getActive()}}</td>
                                                        <td> <img style="width: 150px; height: 100px;" src="{{asset($subCategory->image)}}"></td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.sub-category.edit',$subCategory)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin/sub_category.form_edit')}}</a>


                                                                <a href="{{route('admin.sub-category.delete',$subCategory)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin/sub_category.form_delete')}}</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">
                                            {{ $subCategories->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop
