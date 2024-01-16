<?php
/**
 * zikitdigital functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zikitdigital
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */



function zikitdigital_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on zikitdigital, use a find and replace
		* to change 'zikitdigital' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'zikitdigital', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'zikitdigital' ),
           'menu-2' => esc_html__( 'sidenav-menu', 'zikitdigital' ),

		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'zikitdigital_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'zikitdigital_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zikitdigital_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zikitdigital_content_width', 640 );
}
add_action( 'after_setup_theme', 'zikitdigital_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zikitdigital_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'zikitdigital' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'zikitdigital' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
    register_sidebar( array(
        'name'          => 'shop search widget',
        'id'            => 'shop-search',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => 'minicart widget',
        'id'            => 'minicart',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'zikitdigital_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zikitdigital_scripts() {

	wp_enqueue_style( 'zikitdigital-style', get_template_directory_uri() . '/sass/style.css');
    wp_enqueue_style( 'zikitdigital-style1', get_template_directory_uri() . '/newstyle.css');
	//wp_style_add_data( 'zikitdigital-style', 'rtl', 'replace' );
    wp_enqueue_script('jquery-js', get_template_directory_uri() . '/dist/js/jquery-3.6.1.min.js', array( 'jquery' ), '1.12.4',true);
    wp_enqueue_script( 'zikitdigital-scripts', get_template_directory_uri() . '/dist/js/script.js', array(), '1.0',true );
	wp_enqueue_script( 'zikitdigital-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_localize_script( 'my_custom_script', 'ajax_obj', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zikitdigital_scripts' );

function ql_woocommerce_ajax_add_to_cart_js() {
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('custom_script', get_template_directory_uri() . '/dist/js/ajax-add-to-cart.js', array(),'1.0',true );
    }
}
add_action('wp_enqueue_scripts', 'ql_woocommerce_ajax_add_to_cart_js');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('הגדרות אתר', 'zikitdigital'),
            'menu_title'  => __('הגדרות אתר', 'zikitdigital'),
            'menu_slug' => 'acf-options-theme-settings',
            'redirect'    => false,
        ));
    }
}


//מסדר את טעינת הדפים של ווקומרס. שיורדפרס יטען את עמוד חנות archive product
add_theme_support('woocommerce');
//include('/themes/zikitdigital/woocommerce/cart/cart.php');

//add text area to product page
function add_custom_text_field() {
    echo '<table class="variations" cellspacing="0">
      <tbody>
          <tr>
          <td class="value">
              <textarea type="text" class="add-textarea" name="add-custom-text" value="" placeholder="הוספת הערה להזמנה"></textarea>
          </td>
      </tr>
      </tbody>
  </table>';
}
add_action( 'woocommerce_before_add_to_cart_button', 'add_custom_text_field' );

//code will do the validation for custom field
function textarea_name_validation() {
    if ( empty( $_REQUEST['meta'] ) ) {
        wc_add_notice( __( 'Please enter a Name for Printing&hellip;', 'woocommerce' ), 'error' );
        return false;
    }
    return true;
}
add_action( 'woocommerce_add_to_cart_validation', 'textarea_name_validation', 10, 3 );

//store the custom fields ( for the product that is being added to cart ) into cart item data
function save_name_on_textarea_field( $cart_item_data, $product_id ) {
    if( isset( $_REQUEST['meta'] ) ) {
        $cart_item_data[ 'add-custom-text' ] = $_REQUEST['meta'];
        /* below statement make sure every add to cart action as unique line item */
        //$cart_item_data['unique_key'] = md5( microtime().rand() );
    }
    return $cart_item_data;
}
add_action( 'woocommerce_add_cart_item_data', 'save_name_on_textarea_field', 10, 2 );

//code will render the custom data in your cart and checkout page.
function render_meta_on_cart_and_checkout( $cart_data, $cart_item = null ){
    $custom_items = array();
    /* Woo 2.4.2 updates */
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['add-custom-text'] ) ) {
        $custom_items[] = array( "name" => 'הערה למוצר', "value" => $cart_item['add-custom-text'] );
    }
    return $custom_items;
}
add_filter( 'woocommerce_get_item_data', 'render_meta_on_cart_and_checkout', 10, 2 );

// add text area to order.
function textarea_order_meta_handler( $item_id, $values, $cart_item_key ) {
    if( isset( $values['add-custom-text'] ) ) {
        wc_add_order_item_meta( $item_id, "add-custom-text", $values['add-custom-text'] );
    }
}
add_action( 'woocommerce_add_order_item_meta', 'textarea_order_meta_handler', 1, 3 );




add_action( 'after_setup_theme', 'my_setup' );

function my_setup() {
    //add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}


function rf_product_thumbnail_size( $size ) {
    global $product;

    $size = 'full';
    return $size;
}
add_filter( 'single_product_archive_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'subcategory_archive_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'woocommerce_gallery_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'woocommerce_gallery_image_size', 'rf_product_thumbnail_size' );



//הוספת משתנה תאריך לוריאציה
// Add custom field to product variations of type date
add_action( 'woocommerce_variation_options_pricing', 'add_custom_date_field_to_variations', 10, 3 );
function add_custom_date_field_to_variations( $loop, $variation_data, $variation ) {
    woocommerce_wp_text_input( array(
        'id' => 'custom_date_field['.$loop.']',
        'name' => 'custom_date_field['.$loop.']',
        'label' => __( 'Custom Date Field', 'woocommerce' ),
        'value' => get_post_meta( $variation->ID, 'custom_date_field', true ),
        'type' => 'date',
    ) );
}

// Save custom field value for product variations of type date
add_action( 'woocommerce_save_product_variation', 'save_custom_date_field_for_variations', 10, 2 );
function save_custom_date_field_for_variations( $variation_id, $i ) {
    $custom_date_field = $_POST['custom_date_field'][$i];
    if ( isset( $custom_date_field ) ) {
        update_post_meta( $variation_id, 'custom_date_field', esc_attr( $custom_date_field ) );
    }
}

// אם החשבון ריק אז מציג הודעה החשבון שלך נעול

//add_filter( 'authenticate', function ( $user, $username, $password ) {
// Fail to authenticate administrator users unless via Google in Authorizer.
//    if (empty( $user->roles ))
//    {
//        $user = new WP_Error( 'authentication_failed', __( 'החשבון שלך נעול!' ) );
//    }
//
//    return $user;
//} , PHP_INT_MAX, 3 );

//stap of quanttity
add_filter('woocommerce_quantity_input_args', 'jk_woocommerce_quantity_input_args', 10, 2); // Simple products
function jk_woocommerce_quantity_input_args($args, $product)
{
    if($product->is_type( 'simple' )){
    $args['min_value'] = get_field('minimum_to_order', $product->id);
    }
    $args['step'] = get_field('minimum_to_order',$product->id);
    $args['max_value'] = 1000000; // Max quantity (default = -1)
    $packs = get_post_meta($product->get_id(), 'pri_packs', false);
    if(empty($packs)){
        return $args;
    }
}
add_filter( 'woocommerce_available_variation', 'jk_woocommerce_available_variation',10,2 ); // Variations
function jk_woocommerce_available_variation( $args, $variation ) {
    $args['min_qty']=get_post_meta($variation->id , 'minimum_to_order', true );
    $args['min_value'] = get_post_meta($variation->id , 'minimum_to_order', true );
    $args['step']= get_post_meta($variation->id , 'minimum_to_order', true );
    $args['input_value'] = get_post_meta($variation->id , 'minimum_to_order', true );

    return $args;
}


// לא להציג מוצרים בעמוד בראשי של החנות
add_filter( 'posts_clauses', 'custom_posts_clauses', 10, 2 );

function custom_posts_clauses( $clauses, $query ) {
    global $wpdb;
    $path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
    if( str_contains($path, 'shop' )){
        $clauses['where'] .= " AND {$wpdb->posts}.ID NOT IN (SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product')";
    }
    return $clauses;
}


//
//function custom_variation_message( $html, $product ) {
//    // Check if the variation is in stock
//    if ( $product->get_stock_quantity() <= 0 ) {
//
//        return '<p>Sorry, this variation is out of stock</p>' . $html;
//    }
//    return $html;
//}
//add_filter( 'woocommerce_single_variation', 'custom_variation_message', 10, 2 );

/**
 * Code snippet to change WooCommerce In Stock text and Out of Stock Text
 */

add_filter( 'woocommerce_get_availability', 'njengah_custom_stock_text', 1, 2);

function njengah_custom_stock_text( $availability, $_product )
{

    // Change In Stock Text
//    if ($_product->is_in_stock()) {
//        $availability['availability'] = __('Product Available on Request', 'woocommerce');
//    }
   //
// Change Out of Stock Text
    if (!$_product->is_in_stock()) {
        // simple product
        $date_stock = get_post_meta($_product->get_id(), 'custom_date_field',true);
        if($_product->is_type('simple')){
            $date_stock = get_field('date_inventory',$_product->id);
        }
        //variation product
        $formatted_date = date( 'd/m/Y', strtotime( $date_stock ) );

        //Checking if the date has passed
        $current_date = new DateTime();
        $today_date = $current_date->format('Y-m-d');

        $expiration_date = new DateTime($date_stock);
        $back_stock_date = $expiration_date->format('Y-m-d');

        if($date_stock) {
            if ($today_date < $back_stock_date) {
                //$new_date = implode(" ", $date_stock);
                $availability['availability'] = ' לא במלאי. תאריך צפוי לחזרה למלאי '. $formatted_date;
            } else {
                $availability['availability'] = ' לא במלאי ';
            }
        }
    }
    else{
        $availability['availability'] =' זמין במלאי ';
    }
    return $availability;
}

//code of roi  - login


add_filter('woocommerce_login_redirect', 'wc_login_redirect');
function wc_login_redirect( $redirect_to ) {
    $my_page = '/openpage';
    $redirect_to = get_site_url().$my_page;
    return $redirect_to;
}


add_filter('login_redirect','wc_login_redirect');


add_action( 'template_redirect', 'my_redirect_if_user_not_logged_in' );
function my_redirect_if_user_not_logged_in() {
    $my_page = 'my-account';
    if ( !is_user_logged_in() && !is_page($my_page) ) {
        wp_redirect( get_site_url().'/'.$my_page);
        exit;
    }
}


/*** hide payment method according to destination and shipping class ***/
add_filter( 'woocommerce_available_payment_gateways', 'hide_payment_method' );
function hide_payment_method( $available_gateways ) {
//  תמצאי את המשתמש הנוכחי
    $user=wp_get_current_user();
// תמשכי את הערך בשדה customer_paydes
    $customer_paydes = get_the_author_meta('customer_paydes', $user->ID);
// אם השדה ריק, תסירי את אמצעי התשלום מהמערך
    if(!$customer_paydes) {
        unset($available_gateways['cheque']);
    }
    else{
        unset($available_gateways['creditguard']);
    }
    return $available_gateways;
}
//add_filter( 'woocommerce_email_headers', 'add_new_recipient_for_specific_payment', 10, 2 );

function add_new_recipient_for_specific_payment( $headers, $object ) {
    if ( 'new_order' === $object->id ) {
        $order = $object->get_order();
        $payment_method = $order->get_payment_method();

        // Change "cod" to the desired payment method
        if ( 'creditguard' === $payment_method ) {
            $new_recipient = 'ester309637@gmail.com';
            $headers .= 'Bcc: ' . $new_recipient . "\r\n";
        }
    }
    return $headers;
}
add_action( 'woocommerce_email_recipient_new_order', 'change_new_order_email_recipient', 10, 2 );
function change_new_order_email_recipient( $recipient, $order ) {
    $orderPayment = wc_get_payment_gateway_by_order($order);
    if($orderPayment->id =='creditguard'){
        $recipient = 'ccpayzikit@gmail.com';
    }
    return $recipient;
}
//add_filter( 'woocommerce_email_recipient_customer_completed_order', 'change_email_recipient', 10, 2 );
function change_email_recipient( $recipient, $order ) {
    $payment_method = $order->get_payment_method();
    if ($payment_method === 'creditguard') {
        $recipient = "ester309637@gmail.com";
    }
    return $recipient;
}
add_filter('simply_sync_receipt_true','payment_not_card');
function payment_not_card($order_id){
    $payment_method = get_post_meta( $order_id, '_payment_method', true );
    if($payment_method!='creditguard'){
        return false;
    }
    return true;
}
add_filter( 'woocommerce_product_weight', 'my_custom_product_weight', 10, 2 );

function my_custom_product_weight( $weight, $product ) {
    // Modify the weight here
    $weight2 = get_field('weight',$product->get_id()); // Double the weight
    if($weight2) $weight = $weight2;
    return $weight;
}

add_action( 'woocommerce_cart_calculate_fees', 'change_fee_name', 10, 1 );
function change_fee_name( $cart ) {
    foreach ( $cart->get_fees() as $fee ) {
        $fee->name = ' הסכם לקוח ' ;
    }
}
add_filter('simply_request_data', 'simply_func1');
function simply_func1($data){
    unset($data['CDES']);
    return $data;
}
add_filter( 'wc_add_to_cart_params', 'my_custom_add_to_cart_params' );

function my_custom_add_to_cart_params( $params ) {
    $params['locale'] = 'he_IL';
    return $params;
}


// 1. Add custom field input @ Product Data > Variations > Single Variation

add_action( 'woocommerce_variation_options_pricing', 'bbloomer_add_custom_field_to_variations', 10, 3 );

function bbloomer_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
    woocommerce_wp_text_input( array(
        'id' => 'quantity_box[' . $loop . ']',
        'class' => 'short',
        'label' => __( 'quantity_box', 'woocommerce' ),
        'value' => get_post_meta( $variation->ID, 'quantity_box', true )
    ) );
    woocommerce_wp_text_input( array(
        'id' => 'minimum_to_order[' . $loop . ']',
        'class' => 'short',
        'label' => __( 'minimum_to_order', 'woocommerce' ),
        'value' => get_post_meta( $variation->ID, 'minimum_to_order', true )
    ) );
    woocommerce_wp_text_input( array(
        'id' => 'volume[' . $loop . ']',
        'class' => 'short',
        'label' => __( 'volume', 'woocommerce' ),
        'value' => get_post_meta( $variation->ID, 'volume', true )
    ) );
    woocommerce_wp_text_input( array(
        'id' => 'weight1[' . $loop . ']',
        'class' => 'short',
        'label' => __( 'weight1', 'woocommerce' ),
        'value' => get_post_meta( $variation->ID, 'weight1', true )
    ) );
    woocommerce_wp_text_input( array(
        'id' => 'param8[' . $loop . ']',
        'class' => 'short',
        'label' => __( 'param8', 'woocommerce' ),
        'value' => get_post_meta( $variation->ID, 'param8', true )
    ) );

}

// -----------------------------------------
// 2. Save custom field on product variation save

add_action( 'woocommerce_save_product_variation', 'bbloomer_save_custom_field_variations', 10, 2 );

function bbloomer_save_custom_field_variations( $variation_id, $i ) {
    $quantity_box = $_POST['quantity_box'][$i];
    if ( isset( $quantity_box ) ) update_post_meta( $variation_id, 'quantity_box', esc_attr( $quantity_box ) );

    $minimum_to_order = $_POST['minimum_to_order'][$i];
    if ( isset( $minimum_to_order ) ) update_post_meta( $variation_id, 'minimum_to_order', esc_attr( $minimum_to_order ) );

    $volume = $_POST['volume'][$i];
    if ( isset( $volume ) ) update_post_meta( $variation_id, 'volume', esc_attr( $volume ) );

    $weight = $_POST['weight1'][$i];
    if ( isset( $weight ) ) update_post_meta( $variation_id, 'weight', esc_attr( $weight ) );

    $param8 = $_POST['param8'][$i];
    if ( isset( $param8 ) ) update_post_meta( $variation_id, 'param8', esc_attr( $param8 ) );


}

// -----------------------------------------
// 3. Store custom field value into variation data

add_filter( 'woocommerce_available_variation', 'bbloomer_add_custom_field_variation_data' );

function bbloomer_add_custom_field_variation_data( $variations ) {
    $quantity_box = get_post_meta( $variations[ 'variation_id' ], 'quantity_box', true );
    if($quantity_box) {
        $variations['quantity_box'] = '<div class="woocommerce_custom_field">כמות בקרטון: <span>' . get_post_meta($variations['variation_id'], 'quantity_box', true) . '</span></div>';
    }
    $minimum_to_order = get_post_meta( $variations[ 'variation_id' ], 'minimum_to_order', true );
    if($minimum_to_order) {
    $variations['minimum_to_order'] = '<div class="woocommerce_custom_field minimum_to_order" id="minimum_to_order" data-set='.  $minimum_to_order .'>כמות מינימום להזמנה: <span>' . get_post_meta( $variations[ 'variation_id' ], 'minimum_to_order', true ) . '</span></div>';
    }
    else{
        $minimum_to_order=1;
        $variations['minimum_to_order'] = '<div class="woocommerce_custom_field minimum_to_order" id="minimum_to_order" data-set='.  $minimum_to_order .'>כמות מינימום להזמנה: <span>' . $minimum_to_order . '</span></div>';

    }
    $volume = get_post_meta( $variations[ 'variation_id' ], 'volume', true );
    if($volume) {
    $variations['volume'] = '<div class="woocommerce_custom_field">משקל ניפחי: <span>' . get_post_meta( $variations[ 'variation_id' ], 'volume', true ) . '</span></div>';
    }
    $weight = get_post_meta( $variations[ 'variation_id' ], 'weight1', true );
    if($weight) {
    $variations['weight1'] = '<div class="woocommerce_custom_field"> משקל מוצר למשלוח: <span>' . get_post_meta( $variations[ 'variation_id' ], 'weight1', true ) . '</span>ק"ג</div>';
    }
    $param8 = get_post_meta( $variations[ 'variation_id' ], 'param8', true );
    if($param8) {
    $variations['param8'] = '<div class="woocommerce_custom_field"><span>' . get_post_meta( $variations[ 'variation_id' ], 'param8', true ) . '</span></div>';
    }
    $param9 = get_post_meta( $variations[ 'variation_id' ], 'param9', true );
    if($param9) {
    $variations['param9'] = '<div class="woocommerce_custom_field"><span>' . get_post_meta( $variations[ 'variation_id' ], 'param9', true ) . '</span></div>';
    }
    $param10 = get_post_meta( $variations[ 'variation_id' ], 'param10', true );
    if($param10) {
    $variations['param10'] = '<div class="woocommerce_custom_field"><span>' . get_post_meta( $variations[ 'variation_id' ], 'param10', true ) . '</span></div>';
    }
    $param11 = get_post_meta( $variations[ 'variation_id' ], 'param11', true );
    if($param11) {
    $variations['param11'] = '<div class="woocommerce_custom_field"><span>' . get_post_meta( $variations[ 'variation_id' ], 'param11', true ) . '</span></div>';
    }

    return $variations;
}

function WooCommerce_mini_cart() {
    if( WC()->cart->get_cart_contents_count() != 0 ){
       ?> <div id="allproduct" class="allproduct">
<?php
$subtotal=0;
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
        $quantity = $cart_item['quantity'];
        $total_price = $cart_item['line_subtotal'];
//            +$cart_item['line_subtotal_tax'];

        $unit_price = $total_price / $quantity;

        if (isset($cart_item['custom_pricelist'])){
            $unit_price = $cart_item['custom_pricelist'];
            $total_price = $quantity * $unit_price;
            $subtotal+=$total_price;
        }

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
?></div>

        <?php
    }
    else{ ?>
        <h3>לא נמצאו מוצרים בעגלה</h3>
    <?php }
//$subtotal=WC()->cart->get_cart_contents_total();

                           ?>
   <div class="subtotal-cart">
         <h3>סה"כ</h3>
         <h3>₪<?php echo $subtotal;?></h3>

   </div>
<?php
}

//add_action('init','WooCommerce_mini_cart',999);


function custom_available_variation($data, $product, $variation) {
    $step = get_post_meta($variation->get_id(), 'minimum_to_order', true);
    if (!empty($step)) {
        $data['step'] = intval($step);
    }
    return $data;
}
add_filter('woocommerce_available_variation', 'custom_available_variation', 10, 3);

add_filter( 'woocommerce_available_variation', 'my_variation_custom_attribute', 10, 3 );
function my_variation_custom_attribute( $variation_data, $product, $variation ) {
    $step = get_post_meta($variation->get_id(), 'minimum_to_order', true);
    $variation_data['min_qty'] = $step;
    return $variation_data;
}


//add_filter( 'woocommerce_email_order_items_table', 'custom_email_order_items_table', 10, 4 );
//
//function custom_email_order_items_table( $order_items_table, $order) {
//    // Modify the HTML table as needed
//    ob_start();
//    $new_order_items_table = '';
//    $new_order_items_table .= '<table style="border:1px solid black;">
//    <tr><th>מוצר</th><th>כמות</th><th>מחיר</th></tr>';
//
//    foreach( $order->get_items() as $item_id => $item ) {
//        $new_order_items_table .= '<tr>
//            <td>' . $item->get_name() . '</td>
//            <td>' . $item->get_quantity() . '</td>
//            <td>' . $order->get_formatted_line_subtotal( $item ) . '</td>
//        </tr>';
//    }
//
//    $new_order_items_table .= '</table>';
//    ob_get_clean();
//    return $new_order_items_table;
//}


function cw_edit_order_item_name( $name ) {
    return '<br>'. $name . '<br/>';
}
add_filter( 'woocommerce_order_item_name', 'cw_edit_order_item_name' );


// Edit order items table template defaults
function sww_add_wc_order_email_images( $table, $order ) {
    ob_start();
    $template = $plain_text ? 'emails/plain/email-order-items.php' : 'emails/email-order-items.php';
    wc_get_template( $template, array(
        'order' => $order,
        'items' => $order->get_items(),
        'show_sku' => true,
        'show_image' => true,
        'image_size' => array( 150, 150 )
    ) );
    return ob_get_clean();
}
add_filter( 'woocommerce_email_order_items_table', 'sww_add_wc_order_email_images', 10, 2 );


//require get_theme_file_path() . '/ajax-functions.php';
//add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'woocommerce_mini_cart', 10 );

function my_custom_scripts() {
    wp_enqueue_script( 'wc-add-to-cart', plugins_url() . '/woocommerce/assets/js/frontend/add-to-cart.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'my-ajax-add-to-cart', get_stylesheet_directory_uri() . '/js/ajax-add-to-cart.js', array( 'jquery' ), false, true );
    wp_localize_script( 'my-ajax-add-to-cart', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );


add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');

function ql_woocommerce_ajax_add_to_cart() {
    $product_id = $_POST['product_id'];
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
   // $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    //$cart_item_data=[];
    $cart_item_data['custom_pricelist'] = $_POST['price'];
    if($_POST['meta'])
        $cart_item_data['add-custom-text'] = $_POST['meta'];
    /* below statement make sure every add to cart action as unique line item */
    $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);

    $cart_item_data['unique_key'] = md5(microtime() . rand());
    $product_status = get_post_status($product_id);
    $product = wc_get_product($product_id);

// Perform a validation check on the product
//    if (!$product->is_purchasable()) {
//        $error_message = $product->get_add_to_cart_error();
//        $data = array(
//            'error' => $error_message,
//            'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
//        echo wp_send_json($data);
//        //echo 'Error: ' . $error_message;
//        exit;
//    }
//    if($passed_validation) {
//        if (WC()->cart->get_cart_contents_count() > 0) {
//            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
//                if ($cart_item['product_id'] == $product_id) {
//
//                    $cart_item_quantity = isset( $cart_item['quantity'] ) ? $cart_item['quantity'] : 0;
//                    $new_quantity = $_POST['quantity'];
//
//                    // Add the new quantity to the current quantity
//                    $quantity = $cart_item_quantity + $new_quantity;
//
////                    // Update the cart item data with the new quantity
////                    $cart_item_data['quantity'] = $quantity;
//
//                    // Remove the product from the cart
//                    WC()->cart->remove_cart_item($cart_item_key);
//                    break; // Exit the loop after removing the product
//                }
//            }
//        }
//    }



    if ( $passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id,$cart_item_data ) && 'publish' === $product_status) {
        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        WC_AJAX::get_refreshed_fragments();
        //do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
//        if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) {
//            wc_add_to_cart_message(array($product_id => $quantity), true);
//        }

    }
    else{
        //$error_message = $product->get_add_to_cart_error();
        //$error_message=1;
        //wc_print_notices(true);

        $data = array(
            'error' => true,
            'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
        echo wp_send_json($data);
    }
    wp_die();
}


 //Add custom price to cart item data

/*add_filter( 'woocommerce_add_cart_item_data', 'add_custom_price_to_cart_item_data', 10, 2 );
function add_custom_price_to_cart_item_data( $cart_item_data, $product_id ) {
//    $random_number = rand(1000, 10000) / 100; // Generates a random number between 10 and 100 with 2 decimal places
//    $random_number_formatted = number_format($random_number, 2); // Formats the random number to 2 decimal places
   if($product_id == $_POST['product_id']) {
       $custom_price = $_POST['price'];
       $cart_item_data['custom_pricelist'] = $custom_price;

       $cart_item_quantity = isset( $cart_item_data['quantity'] ) ? $cart_item_data['quantity'] : 0;
       $quantity = $_POST['quantity'];

       // Add the new quantity to the current quantity
       $new_quantity = $cart_item_quantity + $quantity;

       // Update the cart item data with the new quantity
       $cart_item_data['quantity'] = $new_quantity;

   }
    return $cart_item_data;

}*/


// Add custom price to cart item
add_action( 'woocommerce_before_calculate_totals', 'add_custom_price_to_cart_item', 10, 999999 );
function add_custom_price_to_cart_item( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    // Loop through each cart item
    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        // Check if the cart item has a custom price set
        if ( isset( $cart_item['custom_pricelist'] ) ) {
            $custom_price = (float) $cart_item['custom_pricelist'];

            // Set the new price for the cart item
            $cart_item['data']->set_price( $custom_price );

        }
    }
}


//add_filter('woocommerce_add_to_cart_validation', 'delete_product_from_cart_before_adding', 10, 3);
function delete_product_from_cart_before_adding($passed, $product_id, $quantity) {
    // Check if the product is already in the cart
    if (WC()->cart->get_cart_contents_count() > 0) {
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                // Remove the product from the cart
                WC()->cart->remove_cart_item($cart_item_key);
                break; // Exit the loop after removing the product
            }
        }
    }
    return $passed;
}


add_filter( 'woocommerce_add_to_cart_fragments', 'add_custom_price_to_cart_fragments', 10,1,999999999999999999999999 );
function add_custom_price_to_cart_fragments( $fragments ) {
    $cart = WC()->cart;

    // Loop through each cart item
    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        // Check if the cart item has a custom price set
        if ( isset( $cart_item['custom_pricelist'] ) ) {
            $product_id = $cart_item['product_id'];
            $subtotal = $cart_item['quantity'] * $cart_item['custom_pricelist'];

            // Add a new fragment for the cart item subtotal, which includes the custom price
            $fragments['.cart_item_subtotal[data-product_id="' . $product_id . '"]'] = '<strong class="cart_item_subtotal" data-product_id="' . $product_id . '"><span class="woocommerce-Price-amount amount">' . wc_price( $subtotal ) . '</span></strong>';
        }
    }

    return $fragments;
}





add_filter('woocommerce_calculated_total', 'round_cart_total', 9999, 2);
function round_cart_total($total, $cart) {
    // Round the total to the nearest whole number
    $rounded_total = round($total);
    //$rounded_total = round(854.5);

    // Return the rounded total
    return $rounded_total;
}

//קוד של תוסף הנחות לצורך כך שמחיר העגלה יהיה מעוגל.

add_action("woocommerce_after_calculate_totals", function ($wcCart) {
    $wcNoFilterWorker = new \ADP\BaseVersion\Includes\WC\WcNoFilterWorker();
    $wcNoFilterWorker->calculateTotals($wcCart, $wcNoFilterWorker::FLAG_ALLOW_TOTALS_HOOKS);
}, PHP_INT_MAX, 1);
add_filter('wdp_calculate_totals_hook_priority', function($priority){return PHP_INT_MAX - 1;});



add_filter('adp_is_to_compensate_trd_party_adj_for_fixed_price', '__return_false');

