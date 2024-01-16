<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">

    <div class="flex-title">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif;

    //woocommerce_breadcrumb
    do_action( 'woocommerce_before_main_content' );
    ?>


    </div>
	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>

<?php //if ( is_active_sidebar( 'shop-search') ) :?>
<!--    <div id="shop-search-widget" class="primary-sidebar widget-area" role="complementary">-->
<!--        --><?php //dynamic_sidebar( 'shop-search' ); ?>
<!--    </div> #primary-sidebar -->
<?php //endif; ?>
<?php echo do_shortcode('[fibosearch]'); ?>
<div class="bunner-category">
   <?php
        $categories=get_field('choose_category','option');
       if($categories) {

            foreach ($categories as $cat){
                // print the category's image
                $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
                ?>
                    <div class="category_item">
                        <a href="<?php echo get_site_url();?>/product-category/<?php echo $cat->slug; ?>">
                            <?php if($image){ ?>
                                <img src="<?php echo $image; ?>">
                            <?php } ?>
                        </a>
                    </div>

                <?php }

       }
    ?>
</div>
<div class="flex-shop">
    <div class="left-shop">
        <?php if ( woocommerce_product_loop() ) {

            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
           do_action( 'woocommerce_before_shop_loop' );

           woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end();

          // echo do_shortcode('[products limit="9" columns="3" ]');
//            /**
//             * Hook: woocommerce_after_shop_loop.
//             *
//             * @hooked woocommerce_pagination - 10
//             */
          do_action( 'woocommerce_after_shop_loop' );
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action( 'woocommerce_no_products_found' );
        }

        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
//        do_action( 'woocommerce_after_main_content' );
        ?>
    </div>
    <div class="sidbar-category">
        <?php
        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
         if ( is_active_sidebar( 'sidebar-1') ) :?>
        <div id="sidebar-widget" class="primary-sidebar widget-area" role="complementary">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div><!-- #primary-sidebar -->
        <?php endif;
        //do_action( 'woocommerce_sidebar' );
        ?>
    </div>

</div>
<?php

function njengah_get_customer_purchase_history(){

    // Get the current user Object
    $current_user = wp_get_current_user();

    // Check if the user is valid
    if ( 0 == $current_user->ID ) return;

    //Create $args array
    $args = array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'meta_value' => $current_user->ID,
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys( wc_get_is_paid_statuses() ),
    );


    // Pass the $args to get_posts() function
    $customer_orders = get_posts( $args);
    //var_dump($customer_orders);
    // loop through the orders and return the IDs
    if ( ! $customer_orders ) return;
    $product_ids = array();
    foreach ( $customer_orders as $customer_order ) {
        $order = wc_get_order( $customer_order->ID );
        $items = $order->get_items();

        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;
//            $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
//            ?>
<!--            <img src="--><?php //echo $image[0];?><!--">-->

            <?php
        }
    }

    return $product_ids;

}
?>
<div class="myProductOrder">
<h2>מוצרים שרכשתי לאחרונה</h2>
<?php
$myProductNum = njengah_get_customer_purchase_history();
$myProductNum = array_unique($myProductNum);
// remove the subcategories from the product loop
remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

 woocommerce_product_loop_start();
    foreach ($myProductNum as $myProduct){
        $post_object = get_post($myProduct);
        setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
        wc_get_template_part( 'content', 'product' );
    }
woocommerce_product_loop_end();
?></div>

<?php
get_footer( 'shop' );
