
<div id="tabs-2">
    <h2 class="title"><?php _e('Our Stock', 'la-inventory-management')?></h2>

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
                    <?php _e('Category', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Stock (Pcs)', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Action', 'la-inventory-management')?>
                </th>
            </tr>
            <?php
            $all_stocks = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}stock_tbl", ARRAY_A );
            // item_name
            // cat_name
            // stock_count
            // updated_at
            $counter = 1;
            foreach ( $all_stocks as $item ) {
                ?>
                <tr>
                    <td><?php echo $counter++?></td>
                    <td><?php echo $item['item_name']?></td>
                    <td><?php echo $item['cat_name']?></td>
                    <td><?php echo $item['stock_count']?></td>
                    <td>
                        <a href="#" class="lim-trigger-popup-box" data-title="<?php echo $item['item_name']?>" data-edit-id="<?php echo $item['id']?>">Edit</a>
                        <a href="#Tlim-delete-popup-box" name="Delete - Butterfly Needle" class="thickbox">Delete</a>
                    </td>
                </tr>
                <?php
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