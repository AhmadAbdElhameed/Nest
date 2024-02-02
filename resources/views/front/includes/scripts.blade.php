
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

