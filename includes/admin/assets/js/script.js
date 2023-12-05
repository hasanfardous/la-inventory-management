(function ($) {
    $(document).ready(function () {
        // Initializing Tabs
        $('#tabs').tabs();

        // Popup
        $('.lim-trigger-popup-box').click(function (e) {
            e.preventDefault();
            let editId = $(this).data('edit-id');
            let datas = { action: 'laim_admin_actions', edit_id: editId };
            $.ajax({
                dataType: 'json',
                type: 'post',
                url: laim_admin_datas.ajax_url,
                data: datas,
                beforeSend: function (response) {
                    console.log('before send');
                },
                complete: function (response) {
                    console.log('done');
                },
                success: function (response) {
                    console.log(response);
                    tb_show('Edit - ' + response.item_name, '#TB_inline?width=600&height=320&inlineId=lim-edit-popup-box');
                    $('#TB_ajaxContent').html(
                        `
                        <table class="form-table laim-edit-popup-box">
                            <tbody>
                                <tr>
                                    <td>Item Name:</td>
                                    <td><input type="text" id="laim-edit-stock-item-name" value="${response.item_name}"></td>
                                </tr>
                                <tr>
                                    <td>Category:</td>
                                    <td><input type="text" id="laim-edit-stock-cat-name" value="${response.cat_name}"></td>
                                </tr>
                                <tr>
                                    <td>Quantity (Pcs):</td>
                                    <td><input type="text" id="laim-edit-stock-count" value="${response.stock_count}"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <p class="submit"><input type="submit" id="laim-update-popup-box" data-laim-edit-id="${response.id}" class="button button-primary" value="Update"></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        `
                    );
                },
            });

        });

        // Add Item - Popup
        $('.laim-admin-wrapper span.laim-add-inventory-item').click(function (e) {
            e.preventDefault();
            // Showing Popup Content
            tb_show('Add Item', '#TB_inline?width=600&height=320&inlineId=lim-add-popup-box');
            $('#TB_ajaxContent').html(
                `
                <table class="form-table laim-add-popup-box">
                    <tbody>
                        <tr>
                            <td>Item Name:</td>
                            <td><input type="text" id="laim-add-stock-item-name"></td>
                        </tr>
                        <tr>
                            <td>Category:</td>
                            <td><input type="text" id="laim-add-stock-cat-name"></td>
                        </tr>
                        <tr>
                            <td>Quantity (Pcs):</td>
                            <td><input type="text" id="laim-add-stock-count"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <p class="submit"><input type="submit" id="laim-add-popup-box-btn" class="button button-primary" value="Save"></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                `
            );
        });


        // Add Item Ajax - Popup
        $(document).on('click', 'table.laim-add-popup-box #laim-add-popup-box-btn', function (e) {
            e.preventDefault();
            let tableEl = $('table.laim-add-popup-box');
            let addItemName = tableEl.find('#laim-add-stock-item-name').val();
            let addItemCatName = tableEl.find('#laim-add-stock-cat-name').val();
            let addItemStock = tableEl.find('#laim-add-stock-count').val();
            let addPopupDatas = {
                action: 'laim_add_popup_admin_actions',
                item_name: addItemName,
                item_cat_name: addItemCatName,
                item_stock_count: addItemStock,
            };
            console.log(addPopupDatas);
            $.ajax({
                dataType: 'json',
                type: 'post',
                url: laim_admin_datas.ajax_url,
                data: addPopupDatas,
                beforeSend: function (response) {
                    console.log('before send');
                },
                complete: function (response) {
                    console.log('done');
                },
                success: function (response) {
                    console.log(response);
                    if (response == 1) {
                        window.location.href = laim_admin_datas.la_site_url + '/wp-admin/admin.php?page=view-stock'
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });

        });

        // Update popup entry
        $(document).on('click', 'table.laim-edit-popup-box #laim-update-popup-box', function (e) {
            e.preventDefault();
            let itemId = $(this).data('laim-edit-id');
            let itemName = $('table.laim-edit-popup-box #laim-edit-stock-item-name').val();
            let catName = $('table.laim-edit-popup-box #laim-edit-stock-cat-name').val();
            let stockCount = $('table.laim-edit-popup-box #laim-edit-stock-count').val();
            let popupDatas = {
                action: 'laim_admin_popup_actions',
                item_id: itemId,
                item_name: itemName,
                cat_name: catName,
                stock_count: stockCount
            };
            console.log(itemName, catName, stockCount, popupDatas);

            $.ajax({
                dataType: 'json',
                type: 'post',
                url: laim_admin_datas.ajax_url,
                data: popupDatas,
                beforeSend: function (response) {
                    console.log('Sending popup data');
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        // Delete action
        $(document).on('click', 'a.laim-delete-item-conf, a.laim-delete-usage-item-conf', function (e) {
            e.preventDefault();
            if (confirm('Do you really want to delete record?')) {
                let itemId = $(this).data('delete-id');
                let whichTbl = this.className == 'laim-delete-item-conf' ? 'stock_tbl' : 'usage_tbl';
                let deleteDatas = {
                    action: 'laim_delete_ajax_datas',
                    item_id: itemId,
                    tbl_name: whichTbl
                };
                console.log(deleteDatas);
                $.ajax({
                    dataType: 'json',
                    type: 'post',
                    url: laim_admin_datas.ajax_url,
                    data: deleteDatas,
                    beforeSend: function (response) {
                        console.log('Deleting..');
                    },
                    success: function (response) {
                        console.log(response);
                        if (response == 1) {
                            window.location.href = laim_admin_datas.la_site_url + '/wp-admin/admin.php?page=view-stock'
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });
    });
})(jQuery);