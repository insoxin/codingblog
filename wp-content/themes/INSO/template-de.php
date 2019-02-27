<?php
/*
Template Name: 默认啊
*/ 
get_header();
global $insoxin; ?>
<article class="crumbs_page">
    <h2><?php the_title(); ?></h2>
    <div class="bg"></div>
</article>
<section class="container">
    <section class="wrapper<?php if(!wp_is_mobile()) { echo ' content_left'; } ?>">
        <section class="content-wrap">
            <article class="box<?php triangle();wow(); ?>">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="content-post">
                    <?php the_content(); ?>
                    
                </div>
                <!-- 文章end -->
                <?php endwhile; endif; ?>
            </article>
            <?php comments_template(); ?>
        </section>
        <!-- 博客边栏 -->
        <?php get_sidebar(); ?>
        <!-- 博客边栏end -->
    </section>
</section>
<?php get_footer(); ?>