<?php
// Edit Request
add_action('wp_ajax_laim_admin_actions', 'laim_admin_actions_callabck');
add_action('wp_ajax_nopriv_laim_admin_actions', 'laim_admin_actions_callabck');

function laim_admin_actions_callabck() {
	$response = [];
	// Table design
	$edit_id = isset($_POST['edit_id']) ? sanitize_text_field($_POST['edit_id']) : '';
	global $wpdb;
	$requested_item = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}stock_tbl WHERE id = {$edit_id}", ARRAY_A );
	$response = [
		'item_title' => 'Butterfly Needle gg',
		'item_category' => 'Cannulation gg',
		'item_quantity' => '100 Pcs gg'
	];

	echo wp_send_json( $requested_item );
	wp_die();
}

// Popup Request
add_action('wp_ajax_laim_admin_popup_actions', 'laim_admin_popup_actions_callabck');
add_action('wp_ajax_nopriv_laim_admin_popup_actions', 'laim_admin_popup_actions_callabck');

function laim_admin_popup_actions_callabck() {
	$response = [];
	// Table design
	// item_name
	// cat_name
	// stock_count
	// updated_at
	$item_id = isset($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : '';
	$item_name = isset($_POST['item_name']) ? sanitize_text_field($_POST['item_name']) : '';
	$cat_name = isset($_POST['cat_name']) ? sanitize_text_field($_POST['cat_name']) : '';
	$stock_count = isset($_POST['stock_count']) ? sanitize_text_field($_POST['stock_count']) : '';
	global $wpdb;
	$query_response = $wpdb->update(
		$wpdb->base_prefix.'stock_tbl',
		array(
			'item_name' => $item_name,	// string
			'cat_name' => $cat_name,	// integer (number)
			'stock_count' => $stock_count	// integer (number)
		),
		array( 'id' => $item_id ),
		array(
			'%s',	// value1
			'%s'	// value2
		),
		// array( '%d' )
	);
	// $requested_item = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}stock_tbl WHERE id = {$edit_id}", ARRAY_A );
	$response = [
		'item_title' => 'Butterfly Needle gg',
		'item_category' => 'Cannulation gg',
		'item_quantity' => '100 Pcs gg'
	];

	echo wp_send_json( $query_response );
	wp_die();
}
