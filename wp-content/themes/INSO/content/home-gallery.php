<?php global $insoxin; ?>
<?php if($insoxin[ 'gallery_cat']) { ?>
<section class="<?php if($insoxin['switch_gallery_width']){echo 'home_gallery';}else{echo 'home_gallery_w wrapper';} if($insoxin['switch_gallery_content']){echo ' gallery_content';} ?> box<?php triangle();wow(); ?>">
    <!--标题-->
    <section class="home_title">
        <h3 class="left"><i class="<?php echo $insoxin['gallery_icon']; ?>"></i><?php echo $insoxin['gallery_title']; ?></h3>
        <?php if($insoxin[ 'gallery_tag']) { ?>
        <section class="title-tag right">
            <ul>
                <?php $hometagsorderby=$insoxin[ 'home_tag_orderby']; $hometagsorder=$insoxin[ 'home_tag_order']; $hometags=implode( ',',$insoxin[ 'gallery_tag']); $args=array( 'include'=> $hometags,'orderby'=>$hometagsorderby, 'order'=>$hometagsorder,'taxonomy'=>'gallery-tag');$tags = get_terms($args);foreach ($tags as $tag) { ?>
                <li>
                    <a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php _e( '查看', 'insoxin'); ?> <?php echo $tag->name;?> <?php _e( '标签下的画廊', 'insoxin'); ?>">
                        <?php echo $tag->name; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <a href="<?php $gallery_link = $insoxin['gallery_link']; ?><?php echo get_page_link($gallery_link); ?>" class="home_button" title="<?php _e( '查看更多', 'insoxin' ); ?>"><i class="icon-plus-circled"></i></a>
        </section>
        <?php } ?>
    </section>
    <!--标题end-->
    <section class="gallery_list">
        <ul class="layout_ul">
            <?php $gallerycount=$insoxin[ 'gallery_count']; $args=array( 'post_type'=> 'gallery','posts_per_page' => $gallerycount,'ignore_sticky_posts' => 1,'tax_query' => array(array('taxonomy' => 'gallery-cat','field'=>'id','terms'=> $insoxin[ 'gallery_cat']),),); $wp_query = new WP_Query( $args );if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <li class="layout_li">
                <?php get_template_part( 'content/list', 'gallery'); ?>
            </li>
            <?php endwhile;endif; ?>
            <?php wp_reset_query(); ?>
        </ul>
    </section>
</section>
<?php } ?>