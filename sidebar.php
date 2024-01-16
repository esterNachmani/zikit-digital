<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zikitdigital
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
<?php if ( is_active_sidebar( 'shop-search') ) : ?>
    <div id="shop-search-widget" class="primary-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'shop-search' ); ?>
    </div><!-- #primary-sidebar -->
<?php endif; ?>