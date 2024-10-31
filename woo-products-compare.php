<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/noruzzamanrubel/
 * @since             1.0.0
 * @package           Woo_Products_Compare
 *
 * @wordpress-plugin
 * Plugin Name:       Products Compare
 * Plugin URI:        https://wordpress.org/plugins/products-compare
 * Description:       Effortlessly compare products in your WooCommerce store to find the best fit for your customers' needs.
 * Version:           1.0.0
 * Author:            Noruzzaman
 * Author URI:        https://github.com/noruzzamanrubel
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-products-compare
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_PRODUCTS_COMPARE_VERSION', '1.0.0' );
define( 'WOO_PRODUCTS_COMPARE_PATH', plugin_dir_path( __FILE__ ) );
define( 'WOO_PRODUCTS_COMPARE_URL', plugin_dir_url( __FILE__ ) );
define( 'WOO_PRODUCTS_COMPARE_SLUG', 'woo-products-compare' );
define( 'WOO_PRODUCTS_COMPARE_NAME', 'Products Compare' );
define( 'WOO_PRODUCTS_COMPARE_FULL_NAME', 'Products Compare' );
define( 'WOO_PRODUCTS_COMPARE_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-products-compare-activator.php
 */
function woopc_products_compare_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-products-compare-activator.php';
	Woo_Products_Compare_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-products-compare-deactivator.php
 */
function woopc_products_compare_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-products-compare-deactivator.php';
	Woo_Products_Compare_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'woopc_products_compare_activate' );
register_deactivation_hook( __FILE__, 'woopc_products_compare_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-products-compare.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_products_compare() {

	$plugin = new Woo_Products_Compare();
	$plugin->run();

}
run_woo_products_compare();
