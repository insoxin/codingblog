<?php global $insoxin;?>

<?php if ($insoxin[ 'gallery_metas'] !=0 ) { ?>
<aside class="custompost_info">
    <h3><?php echo $insoxin['gallery_info_title']; ?></h3>
    <?php if (in_array( 'author', $insoxin[ 'gallery_metas'])) { ?>
    <!--作者-->
    <span class="author"><?php _e( '作者：','insoxin'); ?><?php if(get_post_meta($post->ID, "author", true)){ $author = get_post_custom_values( "author"); echo $author[0]; } else { ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php the_author_nickname(); ?>"><?php the_author_nickname(); ?></a><?php } ?></span>
    <?php } if (in_array( 'category', $insoxin[ 'gallery_metas'])) { ?>
    <!--分类-->
    <span class="category"><?php _e( '分类：','insoxin'); ?><?php the_terms( $post->ID, 'gallery-cat','' );?></span>
    <?php } if (in_array( 'tag', $insoxin[ 'gallery_metas'])) { ?>
    <!--评论-->
    <span class="tag"><?php _e( '标签：','insoxin'); ?><?php echo get_the_term_list( $post->ID,'gallery-tag','',', ',''); ?></span>
    <?php } if (in_array( 'date', $insoxin[ 'gallery_metas'])) { ?>
    <!--时间-->
    <span class="date"><?php _e( '日期：','insoxin'); ?><?php the_time('Y-m-d'); ?></span>
    <?php } if (in_array( 'view', $insoxin[ 'gallery_metas'])) { ?>
    <!--浏览量-->
    <span class="view"><?php _e( '浏览：','insoxin'); ?><?php setPostViews(get_the_ID()); ?><?php echo getPostViews(get_the_ID()); ?></span>
    <?php } if (in_array( 'comment', $insoxin[ 'gallery_metas'])) { ?>
    <!--评论-->
    <span class="comment"><?php _e( '评论：','insoxin'); ?><?php comments_popup_link('0', '1', '%'); ?></span>
    <?php } if (in_array( 'like', $insoxin[ 'gallery_metas'])) { ?>
    <!--点赞-->
    <?php echo getPostLikeLinkList(get_the_ID());?>
    <?php } ?>
</aside>
<?php } ?>