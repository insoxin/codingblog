<?php
global $insoxin;
global $post;
$author_url = get_author_posts_url(get_the_author_meta('ID'));
$blog_name = get_bloginfo('name');
$from_name = get_post_custom_values( "from_name");
if ($insoxin['switch_link_go']) {
    $from_link = external_link(get_post_meta($post->ID, 'from_link', true));
} else {
    $from_link0 = get_post_custom_values( "from_link");
    $from_link = $from_link0[0];
}
?>
<section class="post_declare">
   <?php if($insoxin[ 'switch_copyright']) { ?>
    <p>
       <?php if(get_post_meta($post->ID, "from_name", true) && get_post_meta($post->ID, "from_link", true)){ ?>
        <?php printf( __( '本文由来源 <a href="%s" target="_blank" rel="external nofollow">%s</a>，由 %s 整理编辑！', 'insoxin' ), esc_attr($from_link), esc_attr($from_name[0]), esc_attr(get_the_author_meta('display_name')) ); ?>
       <?php } else if(get_post_meta($post->ID, "from_name", true)){ ?>
        <?php printf( __( '本文由来源 %s，由 %s 整理编辑！', 'insoxin' ), esc_attr($from_name[0]), esc_attr(get_the_author_meta('display_name')) ); ?>
        <?php } else if ( user_can( $post->post_author, 'administrator' ) || user_can( $post->post_author, 'editor' ) || user_can( $post->post_author, 'author' ) ) { ?>
        <?php printf( __( '本文由', 'insoxin' ), esc_attr($blog_name), esc_attr($author_url), esc_attr(get_the_author_meta('display_name')) ); ?> <a href="<?php bloginfo(‘url’); ?>"><?php the_author(); ?></a> 创作，文章地址：<a href="<?php echo get_permalink();?>"><?php echo get_permalink();?></a><br>采用<a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" rel="external nofollow">知识共享署名4.0</a> 国际许可协议进行许可。除注明转载/出处外，均为本站原创或翻译，转载前请务必署名。最后编辑时间为:<?php the_modified_time('M j, Y \\a\t h:i a'); ?>
        <?php } ?>
    </p>
    <?php } ?>
    <!-- 关键词 -->
    <div class="tags">
        <?php the_tags(__( '关键词：', 'insoxin'), ', ', ''); ?>
    </div>
</section>