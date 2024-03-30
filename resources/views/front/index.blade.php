@extends('front.layouts.master')

@section('title')
    Nest
@endsection

@section('content')
    @include('front.includes.slider')
    <!--End hero slider-->
    @include('front.includes.category_slider')
    <!--End category slider-->
    @include('front.includes.banners')
    <!--End banners-->
    @include('front.includes.new_products')
    <!--Products Tabs-->
    @include('front.includes.featured_products')
    <!--End Best Sales-->

    <!-- TV Category -->
    @include('front.includes.tv_category')
    <!--End TV Category -->

    <!-- Tshirt Category -->
    @include('front.includes.tv_category')
    <!--End Tshirt Category -->

    <!-- Computer Category -->
    @include('front.includes.computer_category')
    <!--End Computer Category -->

    @include('front.includes.hot_deals')
    <!--End 4 columns-->

    <!--Vendor List -->
    @include('front.includes.vendors')
    <!--End Vendor List -->
@endsection
