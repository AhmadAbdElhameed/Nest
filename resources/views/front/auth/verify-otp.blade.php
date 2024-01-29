@extends('front.layouts.master')

@section('title')
    Nest | Verify OTP
@endsection

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Login | Verify OTP
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="{{asset('assets/front/imgs/page/login-1.png')}}" alt="" />
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Verify OTP</h1>
                                    </div>
                                    <form method="POST" action="{{ route('user.verify.otp') }}">
                                        @csrf
                                        <input type="hidden" name="email" value="{{$email}}">
                                        <div class="form-group">
                                            <input type="text" class="@error('otp') is-invalid  @enderror" name="otp" value="{{old('otp')}}" required  placeholder="Your OTP *" />
                                            @error('otp')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Verify</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
