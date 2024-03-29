@extends('front.layouts.master')

@section('title')
    Wishlist
@endsection

@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop <span></span> Wishlist
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="mb-50">
                    <h1 class="heading-2 mb-10">Your Wishlist</h1>
                    <h6 class="text-body">There are <span class="text-brand" id="wishlist-product-count">{{ count(auth()->user()->products) }}</span> products in this list</h6>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="" />
                                <label class="form-check-label" for="exampleCheckbox11"></label>
                            </th>
                            <th scope="col" colspan="2">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock Status</th>
                            <th scope="col">Action</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="{{asset('uploads/images/'.$product->images[0]->image)}}" alt="{{$product->name}}" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="{{route('product_details',$product)}}">{{$product->name}}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h3 class="text-brand">${{$product->special_price ?? $product->price}}</h3>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <span class="stock-status in-stock mb-0"> In Stock </span>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <button  class="btn btn-sm cart_btn_action_test">Add to cart</button>
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a href="#" class="delete-wishlist-item text-body" data-product-id="{{ $product->id }}">
                                            <i class="fi-rs-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center"><h5>Your wishlist is empty</h5></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    $(document).ready(function() {
        $('.delete-wishlist-item').on('click', function(e) {
            e.preventDefault();
            let productId = $(this).data('product-id');
            // Cache the clicked element
            let _this = $(this);

            $.ajax({
                url: "{{ route('wishlist.destroy', '') }}/" + productId,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    // Use the cached element to remove its closest 'tr' ancestor
                    _this.closest('tr').remove();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: 'success',
                        title: 'Product removed successfully'
                    });
                    updateWishlistCounter();

                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    // Trigger an error toast notification
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: 'error',
                        title: 'Failed to remove product'
                    });

                }
            });
        });
    });
</script>


@endpush
