(function ($) {
    $(document).ready(function () {
        $(document).on('click', '#laim-submit-button', function (e) {
            e.preventDefault();
            confirmationMessageEl = $('.laim-stock-usage-confirmation-message');
            itemName = $('#laim-select-item-name').val();
            usageItems = $('#laim-usage-items').val();
            purpose = $('#laim-usage-purpose').val();
            comment = $('#laim-short-comment').val();
            console.log(itemName, usageItems, purpose, comment)
            var data = {
                action: 'laim_frontend_ajax_datas',
                product_id: product_id,
                product_sku: '',
                quantity: product_qty,
                variation_id: variation_id,
            };
            // $.ajax({
            //     dataType: 'json',
            //     type: 'post',
            //     url: laim_ajax_datas.ajax_url,
            //     data: data,
            //     beforeSend: function (response) {
            //         $('.woocommerce-product-table').addClass('adding-to-cart');
            //         console.log('before send');
            //     },
            //     complete: function (response) {
            //         $('.woocommerce-product-table').removeClass('adding-to-cart');
            //         console.log('completed');
            //     },
            //     success: function (response) {
            //         console.log(response);
            //         $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
            //     },
            // });
        });
    });
})(jQuery);