@extends('front.layouts.master')

@section('title')
    Cart
@endsection

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">3</span> products in your cart</h6>
                    <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                <label class="form-check-label" for="exampleCheckbox11"></label>
                            </th>
                            <th scope="col" colspan="2">Product</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                        </thead>
                        <tbody>

                            @forelse($cartProducts as $product)
                                <tr class="pt-30">
                                <td class="custome-checkbox pl-30">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"></label>
                                </td>
                                <td class="image product-thumbnail pt-40"><img src="{{asset('uploads/images/'.$product['product']->images[0]->image)}}" alt="#"></td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="{{route('product_details',$product['product'])}}">{{$product['product']->name}}</a></h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:90%">
                                            </div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-body">${{$product['price']}} </h4>
                                </td>
                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down" data-row-id="{{ $product['rowId'] }}"><i class="fi-rs-angle-small-down"></i></a>
                                            <input type="text" name="quantity" class="qty-val" value="{{ $product['qty'] }}" min="1">
                                            <a href="#" class="qty-up" data-row-id="{{ $product['rowId'] }}"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">$ {{$product['price'] * $product['qty']}} </h4>
                                </td>
                                <td class="action text-center" data-title="Remove"><a href="#" class="text-body remove-from-cart" data-row-id="{{ $product['rowId'] }}"><i class="fi-rs-trash"></i></a></td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>


                <div class="row mt-50">

                    <div class="col-lg-5">
                        <div class="p-40">
                            <h4 class="mb-10">Apply Coupon</h4>
                            <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</span></p>
                            <form action="#">
                                <div class="d-flex justify-content-between">
                                    <input class="font-medium mr-15 coupon" name="Coupon" placeholder="Enter Your Coupon">
                                    <button class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="col-lg-7">
                        <div class="divider-2 mb-30"></div>



                        <div class="border p-md-4 cart-totals ml-30">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{$total}}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-heading text-end">Free</h4></td> </tr> <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Estimate for</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-heading text-end">United Kingdom</h4></td> </tr> <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">$12.31</h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="#" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>

@endsection


@push('scripts')

    <script>
        $(document).on('click', '.qty-up, .qty-down', function(e) {
            e.preventDefault();
            let rowId = $(this).data('row-id');
            let qtyInput = $(this).siblings('.qty-val');
            let newQty = $(this).hasClass('qty-up') ? parseInt(qtyInput.val()) + 1 : parseInt(qtyInput.val()) - 1;
            qtyInput.val(newQty);

            // Send AJAX request to update the cart quantity
            $.ajax({
                type: 'POST',
                url: "{{ route('cart.update') }}",
                data: { rowId: rowId, qty: newQty },
                success: function(response) {
                    // Update the total price and cart count, show success message
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        });

        $(document).on('click', '.remove-from-cart', function(e) {
            e.preventDefault();
            let rowId = $(this).data('row-id');
            let productRow = $(this).closest('tr');

            // Send AJAX request to remove the item from the cart
            $.ajax({
                type: 'DELETE',
                url: "{{ route('cart.remove') }}",
                data: { rowId: rowId },
                success: function(response) {
                    // Remove the product row from the table, update the total price and cart count, show success message
                    productRow.remove();
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        });
    </script>
@endpush
