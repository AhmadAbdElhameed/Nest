
    <script>
        // Function to update the wishlist counter
        function updateWishlistCounter() {
        // Make sure this only runs if there is a logged-in user
        @if(auth()->check())
        $.ajax({
            type: 'GET',
            url: "{{ route('wishlist.count') }}", // Make sure this route returns the current count of wishlist items
            success: function(response) {
                $('#wishlist-counter').text(response.wishlistCount);
                $('#wishlist-product-count').text(response.wishlistCount);

            },
            error: function(xhr) {
                console.error("Error fetching wishlist count:", xhr.responseText);
            }
        });
        @endif
    }

        // Document ready function to update the counter when the page loads
        $(document).ready(function() {
            updateWishlistCounter(); // Initial update on page load
        });

        // Assuming you have event handlers to add or remove wishlist items
        // You would call updateWishlistCounter() within the success callback of those AJAX calls
    </script>


    <script>
        $(document).ready(function() {
            // AJAX setup for CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Add to Cart event
            $('.add_to_cart').on('click', function(e) {
                e.preventDefault();
                let productId = $(this).data('product-id');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart.add') }}", // URL corrected
                    data: {
                        productId: productId, // Sending productId in data
                    },
                    success: function(response) {
                        // Update cart counter and possibly show success message
                        updateCartCounter();
                    },
                    error: function(xhr) {
                        console.error('Error adding product to cart:', xhr.responseText);
                    }
                });
            });

            // Update Cart Counter
            function updateCartCounter() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('cart.count') }}",
                    success: function(response) {
                        $('#cart-counter').text(response.cartCount);
                    },
                    error: function(xhr) {
                        console.error('Error fetching cart count:', xhr.responseText);
                    }
                });
            }

            // Initialize the cart counter on page load
            updateCartCounter();
        });
    </script>
