<?php

/**
 * Plugin Name:       LA Inventory Mangement
 * Plugin URI:        https://lead-academy.org
 * Description:       LA Inventory Mangement is made for managing the inventory system.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Hasanfardous
 * Author URI:        https://lead-academy.org/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       la-inventory-management
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
define( 'LA_INVENTORY_MANAGEMENT_VERSION', '1.0.0' );

function laim_load_textdomain() {
	load_plugin_textdomain( 'la-inventory-management', false, dirname( __FILE__ ) . "/languages" );
}

add_action( "plugins_loaded", "laim_load_textdomain" );

// Enqueue Front-end scripts
add_action( 'wp_enqueue_scripts', 'laim_enqueue_scripts', 99 );
function laim_enqueue_scripts() {
	// Load CSS
	wp_enqueue_style( 'laim-bootstrap-css', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ) );
	wp_enqueue_style( 'laim-dataTables-css', plugins_url( 'assets/css/jquery.dataTables.min.css', __FILE__ ) );
	wp_enqueue_style( 'laim-styles', plugins_url( 'assets/css/styles.css', __FILE__ ), '', time() );
	
	// Load JS
	wp_enqueue_script( 'laim-popper-js', plugins_url( 'assets/js/popper.min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'laim-bootstrap-js', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'laim-datatables-js', plugins_url( 'assets/js/jquery.dataTables.min.js', __FILE__ ), array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'laim-script-js', plugins_url( 'assets/js/script.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_localize_script(
		'laim-script-js', 
		'laim_ajax_datas', 
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		) 
	);
}

// Enqueue back-end scripts
add_action( 'admin_enqueue_scripts', 'laim_admin_enqueue_scripts', 99 );
function laim_admin_enqueue_scripts() {
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script('laim-chartjs', 'https://cdn.jsdelivr.net/npm/chart.js');
	wp_enqueue_style( 'laim-jquery-ui-styles', plugins_url( 'includes/admin/assets/css/jquery-ui.css', __FILE__ ), array(), '1.13.1' );
	wp_enqueue_style( 'laim-admin-styles', plugins_url( 'includes/admin/assets/css/styles.css', __FILE__ ) );
	wp_enqueue_script( 'laim-custom-script', plugins_url( 'includes/admin/assets/js/script.js', __FILE__ ), array(), false, true );
	wp_localize_script(
		'laim-custom-script', 
		'laim_admin_datas', 
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		) 
	);
}

/**
 * Including plugin files
 */
require plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';
require plugin_dir_path( __FILE__ ) . 'includes/form-handling.php';
require plugin_dir_path( __FILE__ ) . 'includes/admin/admin-menu-page.php';
require plugin_dir_path( __FILE__ ) . 'includes/admin/create-db-table.php';

/**
 * The code that runs during plugin activation.
 */
register_activation_hook( __FILE__, 'laim_plugin_activation_func' );
if ( ! function_exists( 'laim_plugin_activation_func' ) ) {
	function laim_plugin_activation_func() {
		// Saving our plugin current version
		add_option( "laim_table_version", LA_INVENTORY_MANAGEMENT_VERSION );

		// Set default table options
		laim_create_stock_db_table();
	}
}

?>