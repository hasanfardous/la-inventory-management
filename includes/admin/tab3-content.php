
<div id="tabs-3">
    <h2 class="title"><?php _e('Inventory', 'la-inventory-management')?></h2>

    <table class="form-table">
        <tbody>
            <tr>
                <th>
                    <?php _e('S.L', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Item Name', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Cat Name', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Item Added', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Date', 'la-inventory-management')?>
                </th>
            </tr>
            <?php
            $all_inventories = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}inventory_tbl ORDER BY id DESC", ARRAY_A );
            if ( count( $all_inventories ) > 0 ) {
                $counter = 1;
                foreach ( $all_inventories as $item ) {
                    $item_id = $item['id'];
                    $stock_tbl_id = $item['stock_tbl_id'];
                    $stock_tbl_data = $wpdb->get_row( "SELECT item_name, cat_name FROM {$wpdb->base_prefix}stock_tbl WHERE id = {$stock_tbl_id}", ARRAY_A );
                    $item_name = isset( $stock_tbl_data['item_name'] ) ? $stock_tbl_data['item_name'] : 'We couldn\'t find the id: '. $item_id;
                    $cat_name = isset( $stock_tbl_data['cat_name'] ) ? $stock_tbl_data['cat_name'] : 'We couldn\'t find the id: '. $item_id;
                    $select_date_only = explode(' ', $item['created_at'])[0];
                    ?>
                    <tr>
                        <td><?php echo $counter++?></td>
                        <td><?php echo $item_name?></td>
                        <td><?php echo $cat_name?></td>
                        <td><?php echo $item['item_added']?></td>
                        <td><?php echo $select_date_only?></td>
                        <td style="display: none">
                            <a href="#" class="lim-trigger-popup-box" data-title="" data-edit-id="<?php echo $item['id']?>">Edit</a>
                            <a href="#" class="laim-delete-usage-item-conf" data-delete-id="<?php echo $item['id']?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="5" style="text-align: center;font-size: 20px;color: #cd4242;">Sorry, No items found!</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <?php add_thickbox(); ?>
    <div id="lim-edit-popup-box" style="display:none;">
        <h3>The Requested Table</h3>

        <table class="form-table">
            
        </table>
    </div>
    <div id="lim-delete-popup-box" style="display:none;">
        <h3>Are you sure you want to delete this?</h3>
    </div>

</div>