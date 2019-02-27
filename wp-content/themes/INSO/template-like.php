<?php
/*
Template Name: 最赞的文章
*/ 
get_header(); ?>
<?php global $insoxin; ?>
<section class="container wrapper">
    <?php get_template_part( 'content/content', 'crumbs'); ?>
    <section class="content<?php if(!wp_is_mobile()) { echo ' content_left'; } ?>">
        <section class="content-wrap ajaxposts">
            <?php blog_ad(); $paged=( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;$args=array( 'post_type'=> 'post','ignore_sticky_posts' => 1,'paged' => $paged,'meta_key'=>'votes_count','orderby'=>'meta_value_num' );$wp_query = new WP_Query( $args );if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
            <article class="ajaxpost box<?php triangle();wow(); ?>">
                <?php get_template_part( 'content/list', 'post'); ?>
            </article>
            <?php endwhile; else: ?>
            <p class="box<?php triangle();wow(); ?>">
                <?php _e( '非常抱歉，没有相关文章。', 'insoxin'); ?>
            </p>
            <?php endif; ?>
            <!-- 分页 -->
            <?php posts_pagination(); ?>
        </section>
        <!-- 博客边栏 -->
        <?php get_sidebar(); ?>
        <!-- 博客边栏end -->
    </section>
</section>
<?php get_footer(); ?>