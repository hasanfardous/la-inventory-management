<?php

// Admin menu page
add_action( 'admin_menu', 'laim_adding_admin_menu_page' );
if ( ! function_exists( 'laim_adding_admin_menu_page' ) ) {
	function laim_adding_admin_menu_page() {
		add_menu_page(
			__( 'Inv. Management', 'la-inventory-management' ),
			__( 'Inv. Management', 'la-inventory-management' ),
			'manage_options',
			'view-stock',
			'laim_view_stock_callback',
			plugins_url('./assets/images/menu-icon.png', __FILE__),
			6
		);
	}
}

// Admin notice function
if ( ! function_exists( 'laim_show_admin_notice' ) ) {
	function laim_show_admin_notice( $message, $type )  {
		echo "
			<div class='laim_show_admin_notice notice notice-{$type} is-dismissible'>
				<p>{$message}</p>
			</div>
		";
	}
}

// Settings page callback function
if ( ! function_exists( 'laim_view_stock_callback' ) ) {
	function laim_view_stock_callback() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		global $wpdb;
		?>
		<div class="wrap laim-admin-wrapper">
			<h1><?php echo esc_html( get_admin_page_title() ); ?> <span class="laim-add-inventory-item">Add Stock Item</span></h1>

			<div class="laim-add-product-feature-requests-wrapper">
				<div class="laim-section-content">
					<form method="post" class="laim-feature-request-form">
						<div class="tab-content">
							<div id="tabs">
								<ul>
									<li><a href="#tabs-1"><?php _e('Stock Chart', 'la-inventory-management')?></a></li>
									<li><a href="#tabs-2"><?php _e('Stock Table', 'la-inventory-management')?></a></li>
									<li><a href="#tabs-3"><?php _e('Inventory Table', 'la-inventory-management')?></a></li>
									<li><a href="#tabs-4"><?php _e('Usages Table', 'la-inventory-management')?></a></li>
								</ul>
								<?php
									require_once plugin_dir_path( __FILE__ ) . './tab1-content.php';
									require_once plugin_dir_path( __FILE__ ) . './tab2-content.php';
									require_once plugin_dir_path( __FILE__ ) . './tab3-content.php';
									require_once plugin_dir_path( __FILE__ ) . './tab4-content.php';
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
}