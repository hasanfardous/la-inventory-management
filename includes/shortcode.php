<?php
// Initializing content shortcode
add_action( 'init', 'laim_content_shortcode_callback' );

// Shortcode function
function laim_content_shortcode_callback() {
    add_shortcode( 'la-stock-usage-entry-form', 'laim_content_shortcode' );
    add_shortcode( 'la-inventory-entry-form', 'laim_add_inventory_content_shortcode' );
}

// Usage Form Content
function laim_content_shortcode() {
    ob_start();
    global $wpdb;
    $stock_datas = $wpdb->get_results( "SELECT id, item_name FROM {$wpdb->base_prefix}stock_tbl", ARRAY_A );
    ?>
	<div class="laim-stock-usage-form-wrapper">
		<form method="post" class="laim-stock-usage-form">
            <div class="laim-stock-usage-form-inner">
                <div class="laim-single-entry">
                    <label for="laim-select-item-name">Select Name</label>
                    <select id="laim-select-item-name">
                        <?php
                            foreach ( $stock_datas as $single ) {
                                $item_id = $single['id'];
                                $item_name = $single['item_name'];
                                echo "<option value='{$item_id}'>{$item_name}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="laim-single-entry">
                    <label for="laim-usage-items">Usage Items</label>
                    <input type="text" id="laim-usage-items">
                </div>
                <div class="laim-single-entry">
                    <label for="laim-usage-purpose">Usage Purpose</label>
                    <input type="text" id="laim-usage-purpose">
                </div>
                <div class="laim-single-entry">
                    <label for="laim-short-comment">Comment</label>
                    <textarea type="text" id="laim-short-comment"></textarea>
                </div>
                <div class="laim-single-entry-submit-btn">
                    <input type="submit" id="laim-submit-button" value="Submit Entry">
                </div>
            </div>
            <div class="laim-stock-usage-confirmation-message"><p></p></div>
		</form>
	</div>
	<?php
	$form_html = ob_get_clean();
	return $form_html;
}

// Add Inventory Form Content
function laim_add_inventory_content_shortcode() {
    ob_start();
    global $wpdb;
    $stock_datas = $wpdb->get_results( "SELECT id, item_name FROM {$wpdb->base_prefix}stock_tbl", ARRAY_A );
    ?>
	<div class="laim-stock-usage-form-wrapper">
		<form method="post" class="laim-stock-usage-form">
            <div class="laim-stock-usage-form-inner">
                <div class="laim-single-entry">
                    <label for="laim-select-item-name">Select Name</label>
                    <select id="laim-select-item-name">
                        <?php
                            foreach ( $stock_datas as $single ) {
                                $item_id = $single['id'];
                                $item_name = $single['item_name'];
                                echo "<option value='{$item_id}'>{$item_name}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="laim-single-entry">
                    <label for="laim-usage-items">Add Items</label>
                    <input type="text" id="laim-usage-items">
                </div>
                <div class="laim-single-entry" style="display: none">
                    <label for="laim-inventory-category">Inventory Category</label>
                    <input type="text" id="laim-inventory-category">
                </div>
                <div class="laim-single-entry" style="display: none">
                    <label for="laim-inventory-category">Inventory Category</label>
                    <input type="text" id="laim-inventory-category">
                </div>
                <div class="laim-single-entry-submit-btn">
                    <input type="submit" id="laim-add-inventory-submit-button" value="Submit Entry">
                </div>
            </div>
            <div class="laim-stock-usage-confirmation-message"><p></p></div>
		</form>
	</div>
	<?php
	$form_html = ob_get_clean();
	return $form_html;
}