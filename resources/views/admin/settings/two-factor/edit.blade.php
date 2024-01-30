@extends('admin.layouts.master')

@section('title')
    2 Factor Auth Setting
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/sidebar.home')}}</a>
                                </li>

                                <li class="breadcrumb-item active">2 Factor Status
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
                                    <h4 class="card-title" id="basic-layout-form">Update 2 Factor Status</h4>
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
                                        <form class="form" action="{{route('admin.settings.update.2fa',$admin)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="projectinput1">2 Factor Status
                                                    </label>
                                                    <select name="is_2fa_enabled" class="select2 form-control">
                                                        <optgroup label="choose">
                                                            <option {{$admin->is_2fa_enabled == 1 ? 'selected' : ''}} value="1">Enabled</option>
                                                            <option {{$admin->is_2fa_enabled == 0 ? 'selected' : ''}} value="0">Disabled</option>
                                                        </optgroup>
                                                    </select>
                                                    @error('is_2fa_enabled')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{__('admin/sidebar.shipping_back')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{__('admin/sidebar.shipping_save')}}
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

@endsection
