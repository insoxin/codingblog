<?php global $insoxin; ?>

<section class="slogan<?php wow(); ?>" style="background-image: url(<?php echo $insoxin['slogan_bg']['url']; ?>)">
    <h3><?php echo $insoxin['slogan_title']; ?></h3>
    <p>
        <?php echo $insoxin[ 'slogan_text']; ?>
    </p>
    <a href="<?php $slogan_link = $insoxin['slogan_link']; ?><?php echo get_page_link($slogan_link); ?>">
        <?php _e( '联系我们', 'insoxin' ); ?>
    </a>
    <div class="bg"></div>
</section>