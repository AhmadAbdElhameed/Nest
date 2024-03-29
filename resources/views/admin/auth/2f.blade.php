@extends('admin.layouts.login')
@section('title','تاكيد الدخول')
@section('content')
    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <div class="p-1">
                                <img src="{{asset('assets/front/images/logo.png')}}" alt="LOGO"/>

                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>check your inbox for OTP </span>
                        </h6>
                    </div>
                    @include('admin.includes.alerts.errors')
                    @include('admin.includes.alerts.success')
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" action="{{route('admin.2fa.verify')}}" method="post"
                                  novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="password" name="auth_2fa_secret" class="form-control form-control-lg input-lg"
                                           value="{{old('auth_2fa_secret')}}" id="auth_2fa_secret" placeholder="أدخل كلمة المرور المؤقته ">
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                    @error('auth_2fa_secret')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </fieldset>
                                <button type="submit" class="btn btn-info btn-lg btn-block mt-3"><i class="ft-unlock"></i>
                                    دخول
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
