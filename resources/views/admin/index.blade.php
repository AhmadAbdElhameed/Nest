@extends('admin.layouts.master')

@section('title')
    {{__('admin/dashboard.page_title')}}
@endsection

@section('content')
    <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div id="crypto-stats-3" class="row">
                        <div class="col-xl-3 col-12">
                            <div class="card crypto-card-3 pull-up">
                                <div class="card-content">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-8 pl-2">
                                                <h4>{{__('admin/dashboard.total_revenue')}}</h4>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h4>$9,9</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12">
                            <div class="card crypto-card-3 pull-up">
                                <div class="card-content">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-8 pl-2">
                                                <h4>{{__('admin/dashboard.total_orders')}}</h4>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h4>694</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12">
                            <div class="card crypto-card-3 pull-up">
                                <div class="card-content">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-8 pl-2">
                                                <h4>{{__('admin/dashboard.total_products')}}</h4>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h4>$1.2</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-12">
                            <div class="card crypto-card-3 pull-up">
                                <div class="card-content">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-8 pl-2">
                                                <h4>{{__('admin/dashboard.total_customers')}}</h4>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h4>$1.2</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Candlestick Multi Level Control Chart -->

                    <!-- Sell Orders & Buy Order -->
                    <div class="row match-height">
                        <div class="col-12 col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">أحدث الطلبات</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-de mb-0">
                                            <thead>
                                            <tr>
                                                <th>رقم الطلب</th>
                                                <th>العميل</th>
                                                <th>السعر</th>
                                                <th>حالة الطلب</th>
                                                <th>الإجمالي</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-success bg-lighten-5">
                                                <td>101</td>
                                                <td>احمد عبد الحميد</td>
                                                <td>$ 450</td>
                                                <td>مكتمل</td>
                                                <td>$ 450</td>
                                            </tr>
                                            {{-- <tr>
                                                <td>10583.5</td>
                                                <td><i class="cc BTC-alt"></i> 0.04000000</td>
                                                <td>$ 423.34</td>
                                            </tr>
                                            <tr>
                                                <td>10583.7</td>
                                                <td><i class="cc BTC-alt"></i> 0.25100000</td>
                                                <td>$ 2656.51</td>
                                            </tr>
                                            <tr>
                                                <td>10583.8</td>
                                                <td><i class="cc BTC-alt"></i> 0.35000000</td>
                                                <td>$ 3704.33</td>
                                            </tr>
                                            <tr>
                                                <td>10595.7</td>
                                                <td><i class="cc BTC-alt"></i> 0.30000000</td>
                                                <td>$ 3178.71</td>
                                            </tr>
                                            <tr class="bg-danger bg-lighten-5">
                                                <td>10599.5</td>
                                                <td><i class="cc BTC-alt"></i> 0.02000000</td>
                                                <td>$ 211.99</td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">أخر التقييمات</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        {{-- <p class="text-muted">Total USD available: 9065930.43</p> --}}
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-de mb-0">
                                            <thead>
                                            <tr>
                                                <th>العميل</th>
                                                <th>المنتج</th>
                                                <th>التقييم</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-danger bg-lighten-5">
                                                <td>93</td>
                                                <td><i class="cc BTC-alt"></i> ساعة يد</td>
                                                <td>5</td>
                                            </tr>
                                            {{-- <tr>
                                                <td>10583.5</td>
                                                <td><i class="cc BTC-alt"></i> 0.04000000</td>
                                                <td>$ 423.34</td>
                                            </tr>
                                            <tr>
                                                <td>10583.8</td>
                                                <td><i class="cc BTC-alt"></i> 0.35000000</td>
                                                <td>$ 3704.33</td>
                                            </tr>
                                            <tr>
                                                <td>10595.7</td>
                                                <td><i class="cc BTC-alt"></i> 0.30000000</td>
                                                <td>$ 3178.71</td>
                                            </tr>
                                            <tr class="bg-danger bg-lighten-5">
                                                <td>10583.7</td>
                                                <td><i class="cc BTC-alt"></i> 0.25100000</td>
                                                <td>$ 2656.51</td>
                                            </tr>
                                            <tr>
                                                <td>10595.8</td>
                                                <td><i class="cc BTC-alt"></i> 0.29697926</td>
                                                <td>$ 3146.74</td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Sell Orders & Buy Order -->







                </div>
            </div>
</div>
@endsection
