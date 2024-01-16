<?php
function minicart_html(){
    $response="";
    // Initialize empty response string
    if( WC()->cart->get_cart_contents_count() != 0 ){
        $response .= '<div class="ajaxminicart">';
        ob_start(); // Start the buffer
        //woocommerce_mini_cart();
        ?>
        <ul class="allproduct">
<!--            <div class="my-shortcode-cart">-->
<!---->
<!--<!--                wc_get_template( 'cart/cart.php' );-->-->
<!--                <div class="widget_shopping_cart_content">--><?php //woocommerce_mini_cart(); ?><!--</div>-->
<!--<!--                echo do_shortcode('[woocommerce_cart]'); ?>-->-->
<!--            </div>-->
            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $product = $cart_item['data'];
                $product_id = $cart_item['product_id'];
                $quantity = $cart_item['quantity'];
                //$price = WC()->cart->get_product_price( $product );
                //echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $pricetotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                $title = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                //$title = $product->get_title();
                $link = $product->get_permalink($cart_item);

                //Get the original product data
                $original_product_data = $product->get_data();

                //Get the product data in the cart
                $cart_product_data = $cart_item['data']->get_data();

                //Compare the product data to detect parameter changes
                $parameter_changes = array_diff_assoc($cart_product_data, $original_product_data);

                ?>
                <li class="product1">
                    <img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>">
                    <div class="product-content">
                        <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
                        <div class="product-price">
                            <h3 class="price"><?php echo $price; ?> </h3>
                            <h3> &times; </h3>
                            <h3 class="quantity"> <?php echo $quantity; ?> </h3>

                            <h3 class="subtotal-product">סה"כ:</h3>
                            <h3 class="pricetotal"><?php echo $pricetotal; ?>   </h3>
                        </div>

                    </div>

                </li>

                <?php
            }
            ?>
        </ul>

        <?php
        $subtotal=WC()->cart->get_cart_subtotal();

        ?>
        <div class="subtotal-cart">
            <h3>סה"כ</h3>
            <h3><?php echo $subtotal;?></h3>
        </div>

        <?php
        $response .= ob_get_clean(); // Add the buffer contents to $response
        $response .= '</div>';
        //ob_end_clean(); // Clear the buffer
    } else {
        $response = "לא נמצאו מוצרים בעגלה";

    }
    return $response;
}

add_action('wp_ajax_get_my_cart', 'get_my_cart');
add_action('wp_ajax_nopriv_get_my_cart', 'get_my_cart');


function get_my_cart(){
    $response = "";
    $response = minicart_html();
    echo json_encode($response); // Echo the response
    wp_reset_postdata();
    exit; // this is required to terminate immediately and return a proper response

    wp_die();
}


add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');

function ql_woocommerce_ajax_add_to_cart() {
    $product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    //$cart_item_data=[];
    if($_POST['meta'])
    $cart_item_data['add-custom-text'] = $_POST['meta'];
    /* below statement make sure every add to cart action as unique line item */
    $cart_item_data['unique_key'] = md5(microtime() . rand());
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id,$cart_item_data ) && 'publish' === $product_status) {
        do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
      // WC_AJAX :: get_refreshed_fragments();
echo 'success!';

//        $response = "";
//        $response = minicart_html();
//        echo json_encode($response); // Echo the response
//        wp_reset_postdata();
//        exit; // this is required to terminate immediately and return a proper response

    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
        echo wp_send_json($data);
    }
    wp_die();
}



function WooCommerce_mini_cart() {
    if( WC()->cart->get_cart_contents_count() != 0 ){
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
            $quantity = $cart_item['quantity'];
            $total_price = $cart_item['line_subtotal']+$cart_item['line_subtotal_tax'];
            $unit_price = $total_price / $quantity;
            $title = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
            //$title = $product->get_title();
            $link = $_product->get_permalink($cart_item);
            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
            ?>
            <div class="product1">
                <?php echo $thumbnail; ?>
                <div class="product-content">

                    <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
                    <div class="product-price">
                        <h3 class="price"><?php echo $unit_price; ?> ₪ </h3>
                        <h3> &times; </h3>
                        <h3 class="quantity"> <?php echo $quantity; ?> </h3>
                        <h3 class="subtotal-product">סה"כ:</h3>
                        <h3 class="pricetotal"><?php echo $total_price; ?>   </h3>
                    </div>

                </div>

            </div>
            <?php
        }
    }
    else{ ?>
        <h3>לא נמצאו מוצרים בעגלה</h3>
    <?php }
    $subtotal=WC()->cart->get_cart_subtotal();

    ?>
    <div class="subtotal-cart">
        <h3>סה"כ</h3>
        <h3><?php echo $subtotal;?></h3>
    </div>
    <?php
}