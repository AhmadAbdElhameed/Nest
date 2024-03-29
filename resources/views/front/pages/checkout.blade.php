@extends('front.layouts.master')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Checkout</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are
                        <span style="color: red;font-weight: bold">{{Cart::content()->count()}}</span>
                        products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">

                <div class="row">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="mb-30">Billing Details</h4>
                    <form method="post" action="{{route('checkout.store')}}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" required="" name="name" placeholder="Full Name *">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="email" required="" name="email" placeholder="Email *">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select required name="city" class="form-control select-active">
                                        <option value="">Select Your City *</option>
                                        <option value="dubai">Dubai</option>
                                        <option value="abu_dhabi">Abu Dhabi</option>
                                        <option value="sharjah">Sharjah</option>
                                        <option value="ajman">Ajman</option>
                                        <option value="umm_al_quwain">Umm Al Quwain</option>
                                        <option value="ras_al_khaimah">Ras Al Khaimah</option>
                                        <option value="fujairah">Fujairah</option>
                                    </select>
                                </div>
                                @if ($errors->has('city'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6">
                                <input required="" type="text" name="phone" placeholder="Phone*">
                                @if ($errors->has('phone'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" required="" name="address" placeholder="Address *">
                                @if ($errors->has('address'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-30">
                            <textarea rows="5" name="notes" placeholder="Additional information"></textarea>
                            @if ($errors->has('notes'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                        </div>

                        <div class="payment ml-30">
                            <h4 class="mb-30">Payment</h4>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" value="cod" name="payment_method" id="exampleRadios4" checked="">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#cod" aria-controls="checkPayment">Cash on delivery</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" value="stripe" name="payment_method" id="exampleRadios5" checked="">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#stripe" aria-controls="paypal">Stripe</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" value="myfatoorah" name="payment_method" id="exampleRadios5" checked="">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#myfatoorah" aria-controls="paypal">MyFatoorah</label>
                                </div>
                                @if ($errors->has('payment_method'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('payment_method') }}
                                    </div>
                                @endif
                            </div>
                            <div class="payment-logo d-flex">
                                <img class="mr-15" src="{{asset('assets/front/imgs/theme/icons/payment-paypal.svg')}}" alt="">
                                <img class="mr-15" src="{{asset('assets/front/imgs/theme/icons/payment-visa.svg')}}" alt="">
                                <img class="mr-15" src="{{asset('assets/front/imgs/theme/icons/payment-master.svg')}}" alt="">
                                <img src="{{asset('assets/front/imgs/theme/icons/payment-zapper.svg')}}" alt="">
                            </div>
                            <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                        </div>

                    </form>
                </div>
            </div>


            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{asset('uploads/images/'.$item['image'])}}" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a href="{{route('product_details',\App\Models\Product::find($item['id']))}}" class="text-heading">{{ $item['name'] }}</a></h6></span>
                                            <div class="product-rate-cover">

                                                <strong>Color : </strong>
                                                <strong>Size : </strong>

                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{ $item['qty'] }}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">${{ $item['price'] }}</h4>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>




                        <table class="table no-border">
                            <tbody>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${{ $cartSubtotal }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Shipping Fee</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${{ $shippingFee}}</h4>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Grand Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${{ $total }}</h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>





                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

