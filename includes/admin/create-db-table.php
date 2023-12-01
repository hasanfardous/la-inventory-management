<?php

// Create the db table
if ( ! function_exists( 'laim_create_stock_db_table' ) ) {
	function laim_create_stock_db_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		// SQL Query
		$sql = "CREATE TABLE `{$wpdb->base_prefix}stock_tbl` (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		item_name tinytext NOT NULL,
		cat_name tinytext NOT NULL,
		stock_count tinytext NOT NULL,
		updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY (id)
		) $charset_collate;";

		// Another Table Query
		$sql .= "CREATE TABLE `{$wpdb->base_prefix}usage_tbl` (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		item_name tinytext NOT NULL,
		purpose tinytext NOT NULL,
		item_used tinytext NOT NULL,
		comments text NOT NULL,
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		
	}
}