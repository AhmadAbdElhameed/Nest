@extends('front.layouts.master')

@section('title')
    Nest | Login
@endsection

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Login
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
                                        <h1 class="mb-5">Login</h1>
                                        <p class="mb-30">Don't have an account? <a href="{{ route('register') }}">Create here</a></p>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{old('email')}}" required  placeholder="Username or Email *" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="form-group">
                                            <input required id="password"  type="password" name="password" placeholder="Your password *" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
{{--                                        <div class="login_footer form-group">--}}
{{--                                            <div class="chek-form">--}}
{{--                                                <input type="text" required="" name="email" placeholder="Security code *" />--}}
{{--                                            </div>--}}
{{--                                            <span class="security-code">--}}
{{--                                                    <b class="text-new">8</b>--}}
{{--                                                    <b class="text-hot">6</b>--}}
{{--                                                    <b class="text-sale">7</b>--}}
{{--                                                    <b class="text-best">5</b>--}}
{{--                                                </span>--}}
{{--                                        </div>--}}
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" value="" />
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
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
