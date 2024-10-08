<?php
/**
 * Plugin Name: WooCommerce Continue Shopping
 * Plugin URI: http://www.happykite.co.uk
 * Description: Provides the ability to choose where the 'Continue Shopping' button on the WooCommerce Checkout takes you.
 * Author: HappyKite
 * Author URI: http://www.happykite.co.uk/
 * Version: 1.6.1
 * Text Domain: continue-shopping-for-woocommerce
 * Domain Path: /languages
 * WC requires at least: 2.4
 * WC tested up to: 9.3.3
 **/

/*
 * This file is part of WooCommerce Continue Shopping.
 * WooCommerce Continue Shopping is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * WooCommerce Continue Shopping is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with WooCommerce Continue Shopping.  If not, see <http://www.gnu.org/licenses/>.
 */

/***************************
 * global variables
 ***************************/

// Retrieve settings from Admin Options table
$hpy_cs_options = get_option( 'hpy_cs_settings' );


/****************************
 * Declare HPOS Compatibility
 */

add_action(
	'before_woocommerce_init',
	function () {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}
);

/***************************
 * includes
 */

add_action( 'plugins_loaded', 'hpy_cs_initiate_plugin' );

function hpy_cs_initiate_plugin() {
	include_once 'classes/class-admin-options.php';
	include_once 'classes/class-continue-shopping.php';
}

/***************************
 * Adding Plugin Settings Link
 ***************************/

function hpy_cs_settings_link( $links ) {
	$settings_link = '<a href="admin.php?page=wc-settings&tab=products&section=hpy_cs">Settings</a>';
	array_unshift( $links, $settings_link );
	return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'hpy_cs_settings_link' );

/**
 * Load plugin textdomain.
 */
function hpy_cs_load_textdomain() {
	load_plugin_textdomain( 'continue-shopping-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'hpy_cs_load_textdomain' );
