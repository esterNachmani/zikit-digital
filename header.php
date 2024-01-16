<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zikitdigital
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open();



?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zikitdigital' ); ?></a>

	<header id="masthead" class="site-header">
<!--		<div class="site-branding">-->
<!--			--><?php
//			the_custom_logo();
//			if ( is_front_page() && is_home() ) :
//				?>
<!--				<h1 class="site-title"><a href="--><?php //echo esc_url( home_url( '/' ) ); ?><!--" rel="home">--><?php //bloginfo( 'name' ); ?><!--</a></h1>-->
<!--				--><?php
//			else :
//				?>
<!--				<p class="site-title"><a href="--><?php //echo esc_url( home_url( '/' ) ); ?><!--" rel="home">--><?php //bloginfo( 'name' ); ?><!--</a></p>-->
<!--				--><?php
//			endif;
//			$zikitdigital_description = get_bloginfo( 'description', 'display' );
//			if ( $zikitdigital_description || is_customize_preview() ) :
//				?>
<!--				<p class="site-description">--><?php //echo $zikitdigital_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><!--</p>-->
<!--			--><?php //endif; ?>
<!--		</div> .site-branding -->



        <div class="menu-flex">

            <?php
            if(get_field('logo','option')){
                $logo = get_field('logo','option');
            }
            ?>
            <div class="div-logo">
                <a class="logo" href="<?php echo get_site_url(); ?>/shop/">
                    <img src="<?= $logo; ?>">
                </a>
            </div>
        <div>
            <a href=# onclick="openNav()" class="menu">
                <span id="btnmenu">תפריט</span>
                <img id="btnmenu" src="<?php echo get_template_directory_uri();?>/dist/images/list.svg" aria-hidden="false" alt="">

            </a >
        </div>

        <div>
            <a href="https://www.zikitdigital.com/pages/page-36" target="_blank">
                <span>תוכנות להורדה</span>
                <img src="<?php echo get_template_directory_uri();?>/dist/images/down.svg" aria-hidden="false" alt="">
            </a>
        </div>
        <div>
            <a href="https://www.youtube.com/channel/UCngexOB7Z_gMmcagzLKGBgA" target="_blank">
                <span>סרטוני הדרכה</span>
                <img src="<?php echo get_template_directory_uri();?>/dist/images/red-youtube.svg" aria-hidden="false" alt="">
            </a>
        </div>
        <div>
            <?php if (is_user_logged_in()):
                $uzer1=wp_get_current_user();
                $firstname=$uzer1->user_firstname;

                ?>

                <div class="dropdown has-dropdown">

                    <a href="<?php echo get_site_url(); ?>/my-account/" class="my-account dropbtn has-dropdown">
                        <span> היי <?php echo $firstname?></span>
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/person-lines-fill.svg" aria-hidden="false" alt="">
                    </a>
                    <div class="dropdown-content">
                        <a href="<?php echo get_site_url(); ?>/my-account/">אזור אישי</a>
<!--                        <a href="--><?php //echo get_site_url(); ?><!--/my-account/orders/">הזמנות</a>-->
                        <a href="<?php echo wp_logout_url( get_permalink());?>" class="logout_btn">התנתקות</a>
                    </div>

                </div>
            <?php else: ?>
                <a href="<?php echo get_site_url(); ?>/my-account/" class="my-account">
                    <span>התחברות/הרשמה</span>
                    <img src="<?php echo get_template_directory_uri();?>/dist/images/person-lines-fill.svg" aria-hidden="false" alt="">
                </a>

            <?php endif; ?>
<!--            <a href="--><?php //echo get_site_url(); ?><!--/my-account/">-->
<!--                <span>החשבון שלי</span>-->
<!--                <img src="--><?php //echo get_template_directory_uri();?><!--/dist/images/person-lines-fill.svg" aria-hidden="false" alt="">-->
<!--            </a>-->
        </div>

            <div class="button-header">
                <?php
                $button_under_bunner = get_field('button_under_bunner');
                if (!empty($button_under_bunner['url'])) {
                    $link_url_under = $button_under_bunner['url'];
                    $link_title_under = $button_under_bunner['title'];
                    $link_target_under = $button_under_bunner['target'] ? $button_under_bunner['target'] : '_self';
                    ?>
                    <a class="button_under" href="<?php echo esc_url( $link_url_under ); ?>" target="<?php echo esc_attr( $link_target_under ); ?>"><?php echo esc_html( $link_title_under ); ?></a>

                <?php } ?>
            </div>
<!--        <div>-->
<!--            <a id="srcCart" href="--><?php //echo get_site_url(); ?><!--/cart/" target="_blank">-->
<!--                <span>עגלת קניות</span>-->
<!--                <img src="--><?php //echo get_template_directory_uri();?><!--/dist/images/cart-check.svg" aria-hidden="false" alt="">-->
<!--            </a>-->
<!--        </div>-->


<!--            --><?php //if ( is_active_sidebar( 'shop-search') ) :?>
<!--                <div id="minicart-widget" class="primary-sidebar widget-area" role="complementary">-->
<!--                    --><?php //dynamic_sidebar( 'minicart' ); ?>
<!--                </div> #primary-sidebar -->
<!--            --><?php //endif; ?>

                <div class="icon-cart">
                    <div id="openMinicartClick" onclick="openminicart()">
                         <img src="<?php echo get_template_directory_uri();?>/dist/images/cart.svg" aria-hidden="false" alt="">
                    </div>
                    <div id="myMinicart1" class="minicart1">
                        <div class="tite-cart">
                            <a href="<?php echo get_site_url(); ?>/cart"><h3>עגלת הקניות שלך</h3></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="closeminicart()"> &times;</a>

                            <!--                            <button class="close-minicart">&times;</button>-->
                            <!--            <div class="b"></div>-->
                        </div>

                        <div id="mini-cart" class="mini-cart-content"></div>

                        <a class="btn-link" target="_blank" href="<?php echo get_site_url(); ?>/cart" onclick="openminicart()"><h3>מעבר לעגלת קניות</h3></a>
                        <a class="btn-link" target="_blank" href="<?php echo get_site_url(); ?>/checkout" onclick="openminicart()"><h3>לסיום רכישה</h3></a>

                    </div>

                </div>

                <div class="icon-phone">
                    <a href="<?php echo get_site_url(); ?>/contact/">
                    <img src="<?php echo get_template_directory_uri();?>/dist/images/telephone-fill.svg" aria-hidden="false" alt="">
                    </a>
                </div>
        </div>

		<nav id="site-navigation" class="main-navigation">

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"> &times;</a>
        <?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'sidenav-menu',
				)
			);
        ?>
    </div>