<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zikitdigital
 */

?>

	<footer id="colophon" class="site-footer">
        <?php
        $imgMap=get_field('map','option');
        $textMap=get_field('text_map','option');
        ?>
<!--        <div class="map-area">-->
<!--            <div class="map-image">-->
<!--                <img src="--><?php //echo $imgMap; ?><!--">-->
<!--            </div>-->
<!--            <div class="text-map">-->
<!--                <h2>כתובת משרדים, אולם תצוגה ומחסן ראשי</h2>-->
<!--                <p>-->
<!--                    --><?php //echo $textMap; ?>
<!--                </p>-->
<!--                --><?php
//                $iconwaze= get_field('icon_waze','option');
//                ?>
<!--                <span>נסיעה אלינו בוויז</span>-->
<!--                <a href="https://ul.waze.com/ul?preview_venue_id=22872385.228658314.252010&navigate=yes&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location" target="_blank">-->
<!--                   <img src="--><?php //echo $iconwaze; ?><!--">-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
		<div class="site-info">
            <div class="right-footer">
            <div class="emails">
            <?php if( have_rows('emails', 'option') ): ?>

                    <?php while ( have_rows('emails','option') ) : the_row(); ?>
                        <a href="mailto: <?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a>

                    <?php endwhile; ?>

            <?php endif; ?>
            </div>
            <div class="phones">
                    <?php if( have_rows('phones', 'option') ): ?>

                            <?php while ( have_rows('phones','option') ) : the_row(); ?>
                                <p><?php the_sub_field('phone'); ?></p>
                            <?php endwhile; ?>

                    <?php endif; ?>
            </div>
            <div class="address">
                <?php
                $address1=get_field('address1','option');
                $street=$address1['street'];
                $city=$address1['city'];
                if($street){ ?>
                    <p><?php echo $street; ?></p>
                <?php } ?>
                <?php if($city){ ?>
                <p><?php echo $city; ?></p>
                <?php } ?>

            </div>
                <div class="odot-link">
                    <a href="<?php echo get_site_url(); ?>/about/">
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/icons8-bookmark.svg" aria-hidden="false" alt="">
                        <span>אודותינו</span>
                    </a>
                </div>
                <div class="contact-link">
                    <a href="<?php echo get_site_url(); ?>/contact/">
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/icons8-speech-bubble.svg" aria-hidden="false" alt="">
                        <span>צור קשר</span>
                    </a>
                </div>

            </div>
            <div class="left-footer">
               <?php $text = get_field('text','option');
               if($text){ ?>
                   <p><?php echo $text; ?></p>
               <?php } ?>
                <div class="emails">
                    <?php if( have_rows('emails', 'option') ): ?>

                        <?php while ( have_rows('emails','option') ) : the_row(); ?>
                            <a href="mailto: <?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a>

                        <?php endwhile; ?>

                    <?php endif; ?>
                </div>
            </div>

		</div><!-- .site-info -->
        <h5>@ Developed by <a href="https://simplyct.co.il/" target="_blank">simplyct</a></h5>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
