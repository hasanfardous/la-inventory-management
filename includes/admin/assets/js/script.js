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
    });
})(jQuery);