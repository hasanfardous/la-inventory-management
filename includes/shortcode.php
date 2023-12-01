<?php
// Initializing content shortcode
add_action( 'init', 'laim_content_shortcode_callback' );

// Shortcode function
function laim_content_shortcode_callback() {
    add_shortcode( 'la-stock-usage-entry-form', 'laim_content_shortcode' );
}
function laim_content_shortcode() {
    ob_start();
    ?>
	<div class="laim-stock-usage-form-wrapper">
		<div class="laim-stock-usage-confirmation-message"></div>
		<form method="post" class="laim-stock-usage-form">
            <div class="laim-stock-usage-form-inner">
                <div class="laim-single-entry">
                    <label for="laim-select-item-name">Select Name</label>
                    <select id="laim-select-item-name">
                        <option value="Butterfly Needle">Butterfly Needle</option>
                        <option value="Gauze">Gauze</option>
                        <option value="Glove">Glove</option>
                        <option value="Tape">Tape</option>
                        <option value="Tube">Tube</option>
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
		</form>
	</div>
	<?php
	$form_html = ob_get_clean();
	return $form_html;
}