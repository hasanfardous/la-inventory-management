(function ($) {
    $(document).ready(function () {
        $(document).on('click', '#laim-submit-button', function (e) {
            e.preventDefault();
            confirmationMessageEl = $('.laim-stock-usage-confirmation-message');
            itemName = $('#laim-select-item-name').val();
            usageItems = $('#laim-usage-items').val();
            purpose = $('#laim-usage-purpose').val();
            comment = $('#laim-short-comment').val();
            var data = {
                action: 'laim_frontend_ajax_datas',
                nonce: laim_ajax_datas.nonce,
                item_name: itemName,
                usage_items: usageItems,
                purpose: purpose,
                comment: comment
            };
            console.log(data);
            $.ajax({
                dataType: 'json',
                type: 'post',
                url: laim_ajax_datas.ajax_url,
                data: data,
                beforeSend: function (response) {
                    console.log('before send');
                },
                complete: function (response) {
                    console.log('completed');
                },
                success: function (response) {
                    console.log(response);
                },
            });
        });
    });
})(jQuery);