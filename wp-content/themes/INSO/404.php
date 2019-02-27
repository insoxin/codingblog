<?php get_header(); ?>
<?php global $insoxin; ?>
<section class="container wrapper box">
    <article class="page404">
        <h2><?php echo $insoxin['404_title']; ?></h2>
        <p><?php echo $insoxin['404_desc']; ?>
<iframe src="https://api.isoyu.com/gy/" frameborder="0" scrolling="no" width="300" height="300"></iframe>
        <?php if($insoxin['switch_404_search']) { ?>
        <article class="search">
            <h3><i class="icon-search-1"></i><?php _e( '按文章类型进行搜索', 'insoxin' ); ?></h3>
            <form method="get" class="search_form" action="<?php echo get_home_url(); ?>">
                <select name="post_type" class="search_type">
                    <option value="post">
                        <?php _e( '文章', 'insoxin' ); ?>
                    </option>
                    <?php if (in_array( 'gallery', $insoxin[ 'switch_post_type'])) { ?>
                    <option value="gallery">
                        <?php _e( ' 图片', 'insoxin' ); ?>
                    </option>
                    <?php } if (in_array( 'video', $insoxin[ 'switch_post_type'])) { ?>
                    <option value="video">
                        <?php _e( '评论', 'insoxin' ); ?>
                    </option>
                    <?php } if (class_exists( 'woocommerce' )){ ?>
                    <option value="product">
                        <?php _e( '产品', 'insoxin' ); ?>
                    </option>
                    <?php } ?>
                </select>
                <input class="text_input" type="text" placeholder="<?php _e( '输入关键字…', 'insoxin' ); ?>" name="s" id="s" />
                <input type="submit" class="search_btn" id="searchsubmit" value="<?php _e( '搜索', 'insoxin' ); ?>" />
            </form>
        </article>
        <?php } ?>
    </article>
</section>
<?php get_footer(); ?>