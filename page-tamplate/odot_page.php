<?php
/*
Template Name:Odot Page

*/
?>
<?php
get_header();
?>
    <div class="height-header"></div>
    <h1 class="title-odot">אודות</h1>
<div class="odot_field">

    <?php if( have_rows('odot_field' ) ): ?>

        <?php while ( have_rows('odot_field') ) :
            the_row();
            ?>
<!--        --><?php //if($title) {?>
          <h2 class="title"><?php the_sub_field('title'); ?></h2>
<!--        --><?php //} ?>
<!--        --><?php //if($text) { ?>
            <p class="text"><?php the_sub_field('text'); ?></p>
<!--        --><?php //} ?>
<!--        --><?php //if($img) { ?>
            <img src="<?php echo the_sub_field('image'); ?>">
<!--        --><?php //} ?>
        <?php endwhile; ?>

    <?php endif; ?>
</div>
<?php
get_footer();
?>