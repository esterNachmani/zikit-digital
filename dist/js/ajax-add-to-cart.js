
jQuery(document).ready(function($) {
    $('.single_add_to_cart_button').on('click', function(e) {
        if($('.single_add_to_cart_button').hasClass('disabled')){
            return;
        }
        e.preventDefault();
        $thisbutton = $(this),
            $form = $thisbutton.closest('form.cart'),
            id = $thisbutton.val(),
            product_qty = $form.find('input[name=quantity]').val() || 1,
            product_id = $form.find('input[name=product_id]').val() || id,
            variation_id = $form.find('input[name=variation_id]').val() || 0,
            metaData = $form.find('textarea[name=add-custom-text]').val();
         entry = document.querySelector('.summary.entry-summary');

         //מחיר של מוצר וריאציה
         price_var = entry.querySelector('.woocommerce-variation-price');
         entry1=0;
         priceSpan=0;
         if(price_var){
             entry1 = price_var;
         }
         if(entry1) {
             priceSpan = entry1.querySelector('.woocommerce-Price-amount');
         }
         if (!priceSpan){
             ins = entry.querySelector('ins');
             if (ins) {
                priceSpan = ins.querySelector('.woocommerce-Price-amount');
             }            
         }
         if(!priceSpan) {
             priceSpan = entry.querySelector('.woocommerce-Price-amount');
         }
             priceSpanBdi = priceSpan.querySelector('bdi');
        var custom_price = priceSpanBdi.textContent;
        // Replace the price in the text with the new price
        var newText = custom_price.replace("₪", "");
        custom_price = parseFloat(newText);
        priceSpanBdi.textContent = newText;
         //$('.input-text.qty.text').trigger('change');
       // min_qty = $('input[name=variation_id]')[0].min;
        min_qty = $('#minimum_to_order')[0].dataset;
        var div = product_qty/min_qty['set'];
        console.log(div);
        var remainder = div - Math.floor(div);
        console.log(remainder);
        if(min_qty['set']!="") {
            if ( remainder > 0) {
                //alert(' יש לשים כמות במכפלות של ' + min_qty['set']);
                var errorMessage = $('input[name=quantity]').prop('validationMessage');
                alert(' ערך הכמות אינו תקין. '+ errorMessage);
                //$('input[name=quantity]').parent().children('lable').text(errorMessage);
                //$form.find('input[name=quantity]').validationMessage = ' יש לשים כמות במכפלות של ' + min_qty['set'];
               // $form.find('input[name=quantity]').reportValidity();
               // document.getElementById("email").setCustomValidity("This email is already used");
                return;
            }
        }


        //$('#error-message').text(errorMessage);


        if (metaData == "") {
            var data = {
                action: 'ql_woocommerce_ajax_add_to_cart',
                product_id: product_id,
                product_sku: '',
                quantity: product_qty,
                price: custom_price,
                variation_id: variation_id,
            };
        }

        else {
            var data = {
                action: 'ql_woocommerce_ajax_add_to_cart',
                product_id: product_id,
                product_sku: '',
                quantity: product_qty,
                price: custom_price,
                variation_id: variation_id,
                meta: metaData,
            };
        }
        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {

                if (response.error) {
                    window.location = response.product_url;
                    return;
                }
                else

                {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                    //$( document.body ).trigger( 'wc_fragments_refreshed' );
                    $('.widget_shopping_cart_content').html(response.fragments['div.widget_shopping_cart_content']);
                   // $('.cart-popup').addClass('active');
                    //$button.removeClass('loading');
                    console.log('response fregments = ' + JSON.stringify(response.fragments));
                  // $('.woocommerce-products-header').html(response.fragments['div.widget_shopping_cart_content']);
                    $('.widget_shopping_cart_content').html(response.fragments['div.widget_shopping_cart_content']);
                    console.log(response);

                    // Open minicart.
                    openminicart();
                    $(".minicart1").addClass('open-cart');

                    //scroll up minicart
                    var scrollheight = $('.allproduct').prop('scrollHeight');
                    $('.allproduct').scrollTop(-scrollheight);
                }
            },
        });


    });

});




