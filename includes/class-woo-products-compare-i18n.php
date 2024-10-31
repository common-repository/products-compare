<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/noruzzamanrubel/
 * @since      1.0.0
 *
 * @package    Woo_Products_Compare
 * @subpackage Woo_Products_Compare/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woo_Products_Compare
 * @subpackage Woo_Products_Compare/includes
 * @author     Noruzzaman <noruzzamanrubel@gmail.com>
 */
class Woo_Products_Compare_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woo-products-compare',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
