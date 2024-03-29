

@extends('admin.layouts.master')

@section('title')
    Sliders
@endsection

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Sliders </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/brand.home')}} </a>
                                </li>
                                <li class="breadcrumb-item active"> Sliders
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
                                    <h4 class="card-title">{{__('admin/brand.sub_main_title')}} </h4>
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
                                                <th>title</th>
                                                <th>sub title</th>
                                                <th> {{__('admin/brand.form_slug')}} </th>
                                                <th>{{__('admin/brand.form_status')}}</th>
                                                <th>{{__('admin/brand.form_image')}}</th>
                                                <th>{{__('admin/brand.form_actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($sliders)
                                                @foreach($sliders as $slider)
                                                    <tr>
                                                        <td>{{$slider -> title}}</td>
                                                        <td>{{$slider -> sub_title}}</td>
                                                        <td>{{$slider -> slug}}</td>
                                                        <td>{{$slider -> getActive()}}</td>
                                                        <td> <img style="width: 150px; height: 100px;" src="{{asset($slider->image)}}"></td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.slider.edit',$slider)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin/brand.form_edit')}}</a>


                                                                <a href="{{route('admin.slider.delete',$slider)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin/brand.form_delete')}}</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>

                                        </table>
                                        <div class="justify-content-center d-flex">
                                            {{ $sliders->links('pagination::bootstrap-4') }}
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
