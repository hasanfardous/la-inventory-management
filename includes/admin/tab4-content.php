
<div id="tabs-4">
    <h2 class="title"><?php _e('Usages', 'la-inventory-management')?></h2>

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
                    <?php _e('Item Used', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Purpose', 'la-inventory-management')?>
                </th>
                <th>
                    <?php _e('Date', 'la-inventory-management')?>
                </th>
            </tr>
            <?php
            $all_stocks = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}usage_tbl ORDER BY id DESC", ARRAY_A );
            $counter = 1;
            foreach ( $all_stocks as $item ) {
                $select_date_only = explode(' ', $item['created_at'])[0];
                ?>
                <tr>
                    <td><?php echo $counter++?></td>
                    <td><?php echo $item['item_name']?></td>
                    <td><?php echo $item['item_used']?></td>
                    <td><?php echo $item['purpose']?></td>
                    <td><?php echo $select_date_only?></td>
                    <td style="display: none">
                        <a href="#" class="lim-trigger-popup-box" data-title="<?php echo $item['item_name']?>" data-edit-id="<?php echo $item['id']?>">Edit</a>
                        <a href="#" class="laim-delete-usage-item-conf" data-delete-id="<?php echo $item['id']?>">Delete</a>
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