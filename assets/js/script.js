(function ($) {
    $(document).ready(function () {
        $(document).on('click', '#laim-submit-button', function (e) {
            e.preventDefault();
            formEl = $('form.laim-stock-usage-form');
            confirmationMessageEl = $('.laim-stock-usage-confirmation-message p');
            itemId = $('#laim-select-item-name').find(':selected').val();
            itemName = $('#laim-select-item-name').find(':selected').text();
            usageItems = $('#laim-usage-items').val();
            purpose = $('#laim-usage-purpose').val();
            comment = $('#laim-short-comment').val();

            if (usageItems == '' || purpose == '') {
                confirmationMessageEl.css('opacity', 1);
                confirmationMessageEl.text('Sorry, Empty field not allowed!');
                return;
            }
            var data = {
                action: 'laim_frontend_ajax_datas',
                nonce: laim_ajax_datas.nonce,
                item_id: itemId,
                item_name: itemName,
                usage_items: usageItems,
                purpose: purpose,
                comment: comment
            };
            // console.log(data);
            $.ajax({
                dataType: 'json',
                type: 'post',
                url: laim_ajax_datas.ajax_url,
                data: data,
                beforeSend: function (response) {
                    console.log('before send');
                },
                success: function (response) {
                    console.log(response);
                    if (response.status = 'success') {
                        confirmationMessageEl.addClass('success');
                        confirmationMessageEl.css('opacity', 1);
                        confirmationMessageEl.text(response.message);
                        formEl.trigger('reset');
                    } else {
                        confirmationMessageEl.text(response.message);
                    }
                    formEl.trigger('reset');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        // Add Inventory
        $(document).on('click', 'input#laim-add-inventory-submit-button', function (e) {
            e.preventDefault();
            formEl = $('form.laim-stock-usage-form');
            confirmationMessageEl = $('.laim-stock-usage-confirmation-message p');
            itemId = $('#laim-select-item-name').find(':selected').val();
            itemName = $('#laim-select-item-name').find(':selected').text();
            usageItems = $('#laim-usage-items').val();
            if (usageItems == '') {
                confirmationMessageEl.css('opacity', 1);
                confirmationMessageEl.text('Sorry, Empty field not allowed!');
                return;
            }
            inventoryCat = $('#laim-inventory-category').val();
            var addInventoryData = {
                action: 'laim_frontend_add_inventory_ajax_datas',
                nonce: laim_ajax_datas.nonce,
                item_id: itemId,
                item_name: itemName,
                cat_name: inventoryCat,
                usage_items: usageItems
            };
            console.log(addInventoryData);
            $.ajax({
                dataType: 'json',
                type: 'post',
                url: laim_ajax_datas.ajax_url,
                data: addInventoryData,
                beforeSend: function (response) {
                    console.log('before send');
                },
                success: function (response) {
                    console.log(response);
                    if (response.status = 'success') {
                        confirmationMessageEl.addClass('success');
                        confirmationMessageEl.css('opacity', 1);
                        confirmationMessageEl.text(response.message);
                        formEl.trigger('reset');
                    } else {
                        confirmationMessageEl.text(response.message);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
})(jQuery);