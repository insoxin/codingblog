<?php
/*
Template Name: 友情链接
*/ 
get_header();
global $insoxin;
$linkcatorderby=$insoxin[ 'link_category_orderby'];
$linkcatorder=$insoxin[ 'link_category_order'];
if($insoxin[ 'exclude_link_category']) {
    $linkcatexclude=implode( ',',$insoxin[ 'exclude_link_category']);
}
$linkorderby=$insoxin[ 'link_orderby'];
$linkorder=$insoxin[ 'link_order'];
$linkexclude=$insoxin[ 'exclude_link'];
?>
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
                    <section id="link-page">
                        <ul>
                            <?php wp_list_bookmarks( 'orderby=rand&show_images=1&category_orderby='.$linkcatorderby. '&category_order='.$linkcatorder. '&exclude_category='.$linkcatexclude. '&orderby='.$linkorderby. '&order='.$linkorder. '&exclude='.$linkexclude. ''); ?>
                        </ul>
                        <?php if($insoxin[ 'switch_link_icon']){ ?>
                        <script>
                            $("#link-page a").each(function(e) {
                                $(this).prepend("<img src=https://f.ydr.me/" + this.href.replace(/^(http:\/\/[^\/]+).*$/, '$1') + ">");
                            });
                        </script>
                        <?php } ?>
                    </section>
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