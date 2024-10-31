<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woo_Products_Compare_Ajax {

    protected static $instance;

    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct() {
        // Change action hooks to use 'woo_products_compare_table' instead of 'woo_products_compare_modal'
        add_action( 'wp_ajax_woopc_compare_table', [$this, 'woopc_compare_table'] );
        add_action( 'wp_ajax_nopriv_woopc_compare_table', [$this, 'woopc_compare_table'] );

    }

	public function woopc_compare_table() {
		
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';
	
		if ( ! wp_verify_nonce( $nonce, 'woopc_compare_table_nonce' ) ) {
			die( 'Nonce not verified!' );
		}
	
		$product_ids = isset( $_POST['product_ids'] ) ? absint( $_POST['product_ids'] ) : array();
		
	
		// Validate product IDs
		if ( empty( $product_ids ) || ! is_array( $product_ids ) ) {
			die( 'Invalid product IDs!' );
		}
	
		?>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Label</th>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<th scope="col">
							<span class="remove_btn">Remove</span>
						</th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Image</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo wp_kses_post( $product->get_image() ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Title</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo esc_html( $product->get_name() ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Price</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo wp_kses_post( $product->get_price_html() ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Add to Cart</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<td>
							<?php woocommerce_template_loop_add_to_cart(); ?>
						</td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Description</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo esc_html( $product->get_description() ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>SKU</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo esc_html( $product->get_sku() ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Availability</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo esc_html( $product->is_in_stock() ? 'In Stock' : 'Out of Stock' ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Weight</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<td>
							<?php
							$weight = $product->get_weight();
							echo ! empty( $weight ) ? esc_html( $weight ) . ' ' . esc_html( get_option( 'woocommerce_weight_unit' ) ) : 'N/A';
							?>
						</td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Dimensions</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo esc_html( $product->get_dimensions() ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Color</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo esc_html( $product->get_attribute( 'color' ) ); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<td>Size</td>
					<?php foreach ( $product_ids as $product_id ) : ?>
						<?php $product = wc_get_product( $product_id ); ?>
						<td><?php echo esc_html( $product->get_attribute( 'size' ) ); ?></td>
					<?php endforeach; ?>
				</tr>
			</tbody>
		</table>


		<script>
			jQuery('.remove_btn').on('click', function() {
				var columnIndex = jQuery(this).closest('th').index() + 1; // Get the column index (1-based)
				// Remove corresponding headers and cells
				jQuery('table th:nth-child('+ columnIndex +')').remove();
				jQuery('table td:nth-child('+ columnIndex +')').remove();
				
			});
		</script>
	
		<?php
		wp_die();
	}
	
}

// Initialize the class instance.
Woo_Products_Compare_Ajax::get_instance();
