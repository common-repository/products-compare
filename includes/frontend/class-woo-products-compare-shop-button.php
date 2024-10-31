<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Woo_Products_Compare_Shop_Button {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
     * Returns the single instance of the class.
     *
     * @return Woo_Products_Compare_Shop_Button Singleton instance of the class.
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function __construct() {
        
        add_action( 'woocommerce_after_shop_loop_item', [ $this, 'add_woopc_compare_button' ], 11 );
        add_action( 'wp_footer', array( $this, 'output_product_details_modal' ) ); 

	}

    public function add_woopc_compare_button(){
        
        echo  $this->add_woopc_compare_button_html();

    }

	public function add_woopc_compare_button_html() {


		global $product;
        $label = esc_html('Compare');
        $product_id = esc_attr($product->get_id());


        if ($product && $product->get_type() !== 'external') {
            return '<button id="woopc_compare_btn" class="woopc_compare_btn button " data-product-id="'. $product_id .'">'. $label .'</button>';
		}
	}

    public function output_product_details_modal(){
        ?>

        <div class="modal_main_wrapper">
            <div class="overlay" id="overlay"></div>
            <div class="modal" id="modal">
                <button onclick="closeModal()">Close</button>
            </div>
        </div>
        <?php
    }

}

/** Initialize the class instance. */
Woo_Products_Compare_Shop_Button::get_instance();