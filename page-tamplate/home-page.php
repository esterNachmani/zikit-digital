<?php
/*
Template Name:Home Page

*/
?>
<?php
get_header();
?>
<?php

$bunner=get_field('banner_group');
$image=$bunner['image']['url'];
$title=$bunner['title'];
$sub_title=$bunner['sub_title'];
if (!empty($bunner['button']['url'])) {
    $link_url = $bunner['button']['url'];
    $link_title = $bunner['button']['title'];
    $link_target = $bunner['button']['target'] ? $bunner['button']['target'] : '_self';
}
?>
<div class="height-header"></div>
<div class="bunner-homepage">

        <?php if($image && $link_url){?>
           <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><img src='<?php echo esc_url( $bunner['image']['url']) ?>' alt="Snow"></a>
        <?php } ?>
<!--        --><?php //if($title){ ?>
<!--            <a href="--><?php //echo esc_url( $link_url ); ?><!--" target="--><?php //echo esc_attr( $link_target ); ?><!--"><h1 class="title">--><?php //echo $title;?><!--</h1></a>-->
<!--        --><?php //} ?>
<!--        --><?php //if($sub_title){ ?>
<!--            <a href="--><?php //echo esc_url( $link_url ); ?><!--" target="--><?php //echo esc_attr( $link_target ); ?><!--"><h2 class="sub_title"><span>--><?php //echo $sub_title ?><!--</span></h2></a>-->
<!--        --><?php //} ?>

<!--        --><?php //if($link_url){?>
<!--           <a class="button" href="--><?php //echo esc_url( $link_url ); ?><!--" target="--><?php //echo esc_attr( $link_target ); ?><!--">--><?php //echo esc_html( $link_title ); ?><!--</a>-->
<!--        --><?php //} ?>
</div>

<div class="button-under-bunner">
    <?php
    $button_under_bunner = get_field('button_under_bunner');
    if (!empty($button_under_bunner['url'])) {
        $link_url_under = $button_under_bunner['url'];
        $link_title_under = $button_under_bunner['title'];
        $link_target_under = $button_under_bunner['target'] ? $button_under_bunner['target'] : '_self';
    ?>
<!--        <a class="button_under" href="--><?php //echo esc_url( $link_url_under ); ?><!--" target="--><?php //echo esc_attr( $link_target_under ); ?><!--">--><?php //echo esc_html( $link_title_under ); ?><!--</a>-->
        <a class="button_under" href="<?php echo esc_url( $link_url_under ); ?>" target="<?php echo esc_attr( $link_target_under ); ?>"><?php echo esc_html( $link_title_under ); ?></a>
    <?php } ?>
</div>
    <h2 class="title-catalog">
        <div></div>
        <?php $text_catalogs= get_field('text_catalogs');
        if($text_catalogs) {
            echo $text_catalogs = get_field('text_catalogs');
        }
        ?>

    </h2>

<div class="link-catalogs">

        <?php if( have_rows('catalogs') ): ?>
            <?php while ( have_rows('catalogs') ) : the_row();
           // $linkCatalog = the_sub_field('link-catalog');
//            if(the_sub_field('link-catalog')['url'] != null){
            ?>
                <a href='<?php echo the_sub_field('link-catalog') ?>' target="_blank">
                    <img src='<?php the_sub_field('image') ?>' alt="Snow">
                </a>
<!--                --><?php //} ?>
            <?php endwhile; ?>
        <?php endif; ?>

</div>
<?php
$bunnerSale=get_field('bunner_sale');
//$image=$bunnerSale['img']['url'];
if (!empty($bunnerSale['link']['url'])) {
    $link_url_s = $bunnerSale['link']['url'];
    $link_title_s = $bunnerSale['link']['title'];
    $link_target_s = $bunnerSale['link']['target'] ? $bunnerSale['link']['target'] : '_self';
}
?>
<div class="bunner_sales">
    <a href="<?php echo esc_url( $link_url_s ); ?>" target="<?php echo esc_attr( $link_target_s ); ?>">
        <img src="<?php echo esc_url( $bunnerSale['img']['url']) ?>">
    </a>

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
?>