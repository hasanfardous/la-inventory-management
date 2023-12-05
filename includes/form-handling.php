<?php
// Edit Request
add_action('wp_ajax_laim_admin_actions', 'laim_admin_actions_callabck');

function laim_admin_actions_callabck() {
	$response = [];
	// Table design
	$edit_id = isset($_POST['edit_id']) ? sanitize_text_field($_POST['edit_id']) : '';
	global $wpdb;
	$requested_item = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}stock_tbl WHERE id = {$edit_id}", ARRAY_A );

	echo wp_send_json( $requested_item );
	wp_die();
}

// Popup Request
add_action('wp_ajax_laim_admin_popup_actions', 'laim_admin_popup_actions_callabck');

function laim_admin_popup_actions_callabck() {
	$response = [];
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

	echo wp_send_json( $query_response );
	wp_die();
}

// Popup Request
add_action('wp_ajax_laim_frontend_ajax_datas', 'laim_frontend_ajax_datas_callabck');

function laim_frontend_ajax_datas_callabck() {
	$nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
	$item_id = isset($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : '';
	$item_name = isset($_POST['item_name']) ? sanitize_text_field($_POST['item_name']) : '';
	$usage_items = isset($_POST['usage_items']) ? sanitize_text_field($_POST['usage_items']) : '';
	$purpose = isset($_POST['purpose']) ? sanitize_text_field($_POST['purpose']) : '';
	$comment = isset($_POST['comment']) ? sanitize_text_field($_POST['comment']) : '';
	// Verify the nonce
	// if ( ! wp_verify_nonce( $nonce, 'laim-stock-usage-form-nonce' ) ) {
	// 	die('Not Authorized!');
	// }	
	$response = [];
	global $wpdb;
	$query_response = $wpdb->insert(
		$wpdb->base_prefix.'usage_tbl',
		array(
			'item_name' => $item_name,
			'purpose' => $purpose,
			'item_used' => $usage_items,
			'comments' => $comment,
			'created_at' => current_time('mysql', 1),
		),
		array(
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
		)
	);

	// Update Stock Table
	$deduction_used_items = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}stock_tbl WHERE id = {$item_id}", ARRAY_A );
	$deduction_amount = (int) $deduction_used_items['stock_count'] - (int) $usage_items;
	$updated_query_response = $wpdb->update(
		$wpdb->base_prefix.'stock_tbl',
		array(
			'item_name' 	=> $item_name,	// string
			'stock_count' 	=> $deduction_amount,	// integer (number)
			'updated_at' 	=> current_time('mysql', 1)	// integer (number)
		),
		array( 'id' => $item_id ),
		array(
			'%s',	// value1
			'%s',	// value2
			'%s'	// value2
		),
	);

	if ( $query_response == 1 && $updated_query_response == 1 ) {
		$response['status'] = 'success';
		$response['message'] = 'Usage Entry Added Successfully!';
	} else {
		$response['status'] = 'error';
		$response['message'] = 'Sorry, Something went wrong!';
	}

	echo wp_send_json( $response );
	wp_die();
}

// Delete Request
add_action('wp_ajax_laim_delete_ajax_datas', 'laim_delete_ajax_datas_callabck');

function laim_delete_ajax_datas_callabck() {
	$item_id = isset($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : '';
	$tbl_name = isset($_POST['tbl_name']) ? sanitize_text_field($_POST['tbl_name']) : '';
	global $wpdb;
	$action_tbl = $wpdb->base_prefix.$tbl_name;
	$query_response = $wpdb->delete(
		$action_tbl,
		array(
			'id' => $item_id
		),
		array(
			'%s'
		)
	);

	echo wp_send_json( $query_response );
	wp_die();
}

// Add Inventory Item Request
add_action('wp_ajax_laim_add_popup_admin_actions', 'laim_add_popup_admin_actions_callabck');

function laim_add_popup_admin_actions_callabck() {
	$item_name 			= isset($_POST['item_name']) ? sanitize_text_field($_POST['item_name']) : '';
	$item_cat_name 		= isset($_POST['item_cat_name']) ? sanitize_text_field($_POST['item_cat_name']) : '';
	$item_stock_count 	= isset($_POST['item_stock_count']) ? sanitize_text_field($_POST['item_stock_count']) : '';
	global $wpdb;
	$query_response = $wpdb->insert(
		$wpdb->base_prefix.'stock_tbl',
		array(
			'item_name' => $item_name,
			'cat_name' => $item_cat_name,
			'stock_count' => $item_stock_count,
			'updated_at' => current_time('mysql', 1)
		),
		array(
			'%s',
			'%s',
			'%s',
			'%s'
		)
	);

	echo wp_send_json( $query_response );
	wp_die();
}

// Add Inventory Item Request
add_action('wp_ajax_laim_frontend_add_inventory_ajax_datas', 'laim_frontend_add_inventory_ajax_callabck');

function laim_frontend_add_inventory_ajax_callabck() {
	$item_id	= isset($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : '';
	$item_name	= isset($_POST['item_name']) ? sanitize_text_field($_POST['item_name']) : '';
	$cat_name 	= isset($_POST['cat_name']) ? sanitize_text_field($_POST['cat_name']) : '';
	$usage_items= isset($_POST['usage_items']) ? sanitize_text_field($_POST['usage_items']) : '';
	$response = [];
	global $wpdb;
	$query_response = $wpdb->insert(
		$wpdb->base_prefix.'inventory_tbl',
		array(
			'stock_tbl_id' => $item_id,
			'item_added' => $usage_items,
			'created_at' => current_time('mysql', 1)
		),
		array(
			'%s',
			'%s',
			'%s',
		)
	);

	// Update Stock Table
	$stock_tbl_data = $wpdb->get_row( "SELECT * FROM {$wpdb->base_prefix}stock_tbl WHERE id = {$item_id}", ARRAY_A );
	$added_amount = (int) $stock_tbl_data['stock_count'] + (int) $usage_items;
	$updated_query_response = $wpdb->update(
		$wpdb->base_prefix.'stock_tbl',
		array(
			'stock_count'	=> $added_amount,	// integer (number)
			'updated_at'	=> current_time('mysql', 1)	// integer (number)
		),
		array( 'id' 		=> $item_id ),
		array(
			'%s',	// value1
			'%s'	// value2
		),
		// array( '%d' )
	);

	if ( $query_response == 1 && $updated_query_response == 1 ) {
		$response['status'] = 'success';
		$response['message'] = 'Inventory Added Successfully!';
	} else {
		$response['status'] = 'error';
		$response['message'] = 'Sorry, Something went wrong!';
	}

	echo wp_send_json( $response );
	wp_die();
}
