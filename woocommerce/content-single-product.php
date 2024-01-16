<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div id="product-id">
<?php
global $product;
$video = get_field('video', the_ID());
?>
</div>
<div id="myvideo" data-video="<?php echo $video; ?>"></div>

<?php
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );


	?>

	<div class="summary entry-summary">

		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
        woocommerce_template_single_price();
        $_product = wc_get_product($product->get_id());
        //$_product = wc_get_product( 68);

        if ($_product != 0 && $_product->is_type( 'simple' ) ){
		?>

        <div class="parameters">
            <div class="quantity_box">

            <?php
            $quantity_box= get_field('quantity_box',$product->get_id());
            if($quantity_box){
                echo 'כמות בקרטון ';
                echo $quantity_box;
            }
            ?>
            </div>

              <?php
              $minimum_to_order = get_field('minimum_to_order',$product->get_id());
              ?>
            <div class="minimum_to_order" id="minimum_to_order" data-set="<?php echo $minimum_to_order; ?>">
                  <?php
                  echo 'כמות מינימום להזמנה ';
                  echo $minimum_to_order;
              ?>
            </div>
            <div class="volume">
                <?php
                $volume = get_field('volume',$product->get_id());
                if($volume){
                    echo 'משקל נפחי ';
                    echo $volume;
                }

                ?>
            </div>
            <?php
            $weight = get_field('weight',$product->get_id());
            ?>
            <div class="weight" data-set="<?php echo $weight; ?>">
                <?php
                    echo ' משקל מוצר למשלוח ';
                    echo $weight;
                echo ' ק"ג ';
                ?>
            </div>
            <?php
            $param8 = get_field('param8',$product->get_id());
            ?>
            <div class="param8" data-set="<?php echo $param8; ?>">
                <?php
                if($param8) echo $param8;
                ?>
            </div>
            <?php
            $param9 = get_field('param9',$product->get_id());
            ?>
            <div class="param9" data-set="<?php echo $param9; ?>">
                <?php
                if($param9) echo $param9;
                ?>
            </div>
            <?php
            $param10 = get_field('param10',$product->get_id());
            ?>
            <div class="param10" data-set="<?php echo $param10; ?>">
                <?php
                if($param10) echo $param10;
                ?>
            </div>
            <?php
            $param11 = get_field('param11',$product->get_id());
            ?>
            <div class="param11" data-set="<?php echo $param11; ?>">
                <?php
                if($param11) echo $param11;
                ?>
            </div>
        </div>
        <?php } ?>
<!--        <div class="variation-meta-data"></div>-->
        <div class="go-to-shop">
            <a  href="<?php echo  get_permalink( wc_get_page_id( 'shop' ) ); ?>">חזרה לחנות</a>
        </div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
   ?>
</div>
<!--מוצרים שנרכשו לאחרונה ע"י המשתמש-->
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
        'orderby'   => array(
            'date' =>'DESC',
            'menu_order'=>'ASC',
            /*Other params*/
        )
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
    <?php
    $myProductNum = njengah_get_customer_purchase_history();
    //print_r($myProductNum);
    if($myProductNum!=null){
    $result = array_unique($myProductNum);
   // var_dump($result);
    if(!empty($result)){ ?>
    <h2>מוצרים שרכשתי לאחרונה</h2>
    <?php
    woocommerce_product_loop_start();
    foreach ($result as $myProduct){
    $post_object = get_post($myProduct);
    setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
    wc_get_template_part( 'content', 'product' );
    }
    woocommerce_product_loop_end();
    }
    }
    ?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
