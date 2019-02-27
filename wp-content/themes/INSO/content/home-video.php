<?php global $insoxin; ?>
<?php if($insoxin[ 'video_cat']) { ?>
<section class="<?php if($insoxin['switch_video_width']){echo 'home_video';}else{echo 'home_video_w wrapper';} ?> box<?php triangle();wow(); ?>">
    <!--标题-->
    <section class="home_title">
        <h3 class="left"><i class="<?php echo $insoxin['video_icon']; ?>"></i><?php echo $insoxin['video_title']; ?></h3>
        <?php if($insoxin[ 'video_tag']) { ?>
        <section class="title-tag right">
            <ul>
                <?php $hometagsorderby=$insoxin[ 'home_tag_orderby']; $hometagsorder=$insoxin[ 'home_tag_order'];$hometags=implode( ',',$insoxin[ 'video_tag']); $args=array( 'include'=> $hometags,'orderby'=>$hometagsorderby, 'order'=>$hometagsorder,'taxonomy'=>'video-tag');$tags = get_terms($args);foreach ($tags as $tag) { ?>
                <li>
                    <a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php _e( '查看', 'insoxin'); ?> <?php echo $tag->name;?> <?php _e( '标签下的视频', 'insoxin'); ?>">
                        <?php echo $tag->name; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <a href="<?php $video_link = $insoxin['video_link']; ?><?php echo get_page_link($video_link); ?>" class="home_button" title="<?php _e( '查看更多', 'insoxin' ); ?>"><i class="icon-plus-circled"></i></a>
        </section>
        <?php } ?>
    </section>
    <!--标题end-->
    <section class="video_list">
        <ul class="layout_ul">
            <?php $videocount=$insoxin[ 'video_count']; $args=array( 'post_type'=> 'video','posts_per_page' => $videocount,'ignore_sticky_posts' => 1,'tax_query' => array(array('taxonomy' => 'video-cat','field'=>'id','terms'=> $insoxin[ 'video_cat']),),); $wp_query = new WP_Query( $args );if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <li class="layout_li">
                <?php get_template_part( 'content/list', 'video'); ?>
            </li>
            <?php endwhile;endif; ?>
            <?php wp_reset_query(); ?>
        </ul>
    </section>
</section>
<?php } ?>