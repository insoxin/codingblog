<?php get_header(); ?>
<?php global $insoxin; ?>
<section class="container wrapper">
    <?php get_template_part( 'content/content', 'crumbs'); ?>
    <section class="gallery gallery_list">
        <ul class="layout_ul ajaxposts">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <li class="layout_li ajaxpost">
                <?php get_template_part( 'content/list', 'gallery'); ?>
            </li>
            <?php endwhile; else: ?>
            <p class="box<?php triangle();wow(); ?>">
                <?php _e( '非常抱歉，没有相关画廊。', 'insoxin'); ?>
            </p>
            <?php endif; ?>
            <!-- 分页 -->
            <?php posts_pagination(); ?>
        </ul>
    </section>
</section>
<?php get_footer(); ?>