<?php
/*
Template Name:Contact Page

*/
?>
<?php
get_header();
?>
    <div class="height-header"></div>
<h1 class="title-contact">יצירת קשר</h1>
<div class="contact-flex">
    <div class="myfield">
        <h2>הפרטים שלנו</h2>
            <div class="emails">
                <?php if( have_rows('emails', 'option') ): ?>

                    <?php while ( have_rows('emails','option') ) : the_row(); ?>
                        <p><?php the_sub_field('email'); ?></p>
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
        </br>
            <div class="hours">
                <?php $hours = get_field('hours','option'); ?>
                <p><?php echo $hours; ?></p>
            </div>
    </div>

    <div class="yourfield">
        <h2>כתוב לנו</h2>
        <div>
            <?php
                echo do_shortcode('[contact-form-7 id="130" title="טופס יצירת קשר 1"]');
            ?>
        </div>
    </div>
</div>
    <div class="map-area">
        <?php
        $imgMap=get_field('map','option');
        $textMap=get_field('text_map','option');
        ?>
        <div class="map-image">
            <img src="<?php echo $imgMap; ?>">
        </div>
        <div class="text-map">
            <h2>כתובת משרדים, אולם תצוגה ומחסן ראשי</h2>
            <p>
                <?php echo $textMap; ?>
            </p>
            <?php
            $iconwaze= get_field('icon_waze','option');
            ?>
            <span>נסיעה אלינו בוויז</span>
            <a href="https://ul.waze.com/ul?preview_venue_id=22872385.228658314.252010&navigate=yes&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location" target="_blank">
                <img src="<?php echo $iconwaze; ?>">
            </a>
        </div>
    </div>
<?php
get_footer();

