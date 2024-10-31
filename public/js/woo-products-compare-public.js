(function($) {
    'use strict';

    $(document).ready(function() {
        // Array to store selected product IDs
        var selectedProductIds = [];

        // Function to open the modal
        function openModal(response) {
            // Display overlay and modal with the response content
            $('#overlay').show();
            $('#modal').html(response).show();
        }

        // Function to close the modal
        function closeModal() {
            $('#overlay').hide();
            $('#modal').hide();
        }

        // Click event for the product compare button
        $('.woopc_compare_btn').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id'); // Get the product ID from the button

            // Check if the product is already selected
            if ($.inArray(productId, selectedProductIds) === -1) {
                selectedProductIds.push(productId); // Add product ID to the array
            }

            // Simulate AJAX request
            $.ajax({
                url: woopc_compare_table.ajax_url,
                type: 'POST',
                data: {
                    action: 'woopc_compare_table',
                    nonce: woopc_compare_table.nonce,
                    product_ids: selectedProductIds // Pass the array of selected product IDs
                },
                success: function(response) {
                    openModal(response);
                },
                error: function() {
                    console.log('Error retrieving product details.');
                }
            });
        });

        // Click event for overlay to close the modal
        $('#overlay').on('click', function() {
            closeModal();
        });

        // Click event for modal to prevent closing when clicking inside it
        $('#modal').on('click', function(event) {
            event.stopPropagation();
        });


    });
})(jQuery);
