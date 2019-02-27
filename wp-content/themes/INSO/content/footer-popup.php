<?php global $insoxin; ?>
<section class="footer-popup">
    <?php if ($insoxin[ 'switch_side_metas'] ) { ?>
    <?php if (wp_is_mobile()) { ?>
    <!--移动设备上按钮-->
    <a class="side_btn show"><i class="icon-lock"></i></a>
    <?php } ?>
    <?php if (in_array( 'search', $insoxin[ 'side_metas'])) { ?>
    <!--搜索-->
    <a class="side_btn search" href="#search" title="<?php _e( '点击按钮进行搜索', 'insoxin' ); ?>"><i class="icon-search-1"></i></a>
    <?php } if (in_array( 'wechat', $insoxin[ 'side_metas'])) { ?>
    <!--微信公众号-->
    <a class="side_btn wechat" href="#wechat" title="<?php _e( '关注', 'insoxin' ); ?><?php bloginfo( 'name' ); ?><?php _e( '微信公众号', 'insoxin' ); ?>"><i class="icon-wechat"></i></a>
    <?php } if (in_array( 'line', $insoxin[ 'side_metas'])) { ?>
    <!--QQ与微信二维码-->
    <a class="side_btn line" href="#line" title="<?php _e( '点击扫描QQ或微信二维码联系我们', 'insoxin' ); ?>"><i class="icon-qq"></i></a>
    <?php } if (in_array( 'weibo', $insoxin[ 'side_metas'])) { ?>
    <!--微博-->
    <a class="side_btn weibo" href="<?php echo $insoxin['weibo_link']; ?>" title="<?php _e( '新浪微博', 'insoxin' ); ?>" target="_blank"><i class="icon-weibo"></i></a>
    <?php } if (in_array( 'share', $insoxin[ 'side_metas'])) { ?>
    <!--分享-->
    <a class="side_btn share" href="#share" title="<?php _e( '百度分享', 'insoxin' ); ?>"><i class="icon-share"></i></a>
    <?php } if (in_array( 'gb2big5', $insoxin[ 'side_metas'])) { ?>
    <!--简繁切换-->
    <a name="gb2big5" id="gb2big5" class="side_btn gb2big5" title="<?php _e('简繁切换','insoxin'); ?>">
        <?php _e( '简', 'insoxin'); ?>
    </a>
    <?php } if (in_array( 'comment', $insoxin[ 'side_metas']) && 'open'==$post->comment_status) { ?>
    <!--去评论-->
    <?php if (is_page_template( 'template-link.php') || is_page_template( 'template-message.php')) { ?>
    <a class="side_btn comment" id="back-to-comment" href="#respond"><i class="icon-chat"></i></a>
    <?php } if (is_singular( 'post') && in_array( 'comment', $insoxin[ 'blog_metas'])) { ?>
    <a class="side_btn comment" id="back-to-comment" href="#respond"><i class="icon-chat"></i></a>
    <?php } if (is_singular( 'gallery') && in_array( 'comment', $insoxin[ 'gallery_metas'])) { ?>
    <a class="side_btn comment" id="back-to-comment" href="#respond"><i class="icon-chat"></i></a>
    <?php } if (is_singular( 'video') && in_array( 'comment', $insoxin[ 'video_metas'])) { ?>
    <a class="side_btn comment" id="back-to-comment" href="#respond"><i class="icon-chat"></i></a>
    <?php } ?>
    <?php } if (in_array( 'top', $insoxin[ 'side_metas'])) { ?>
    <!--回顶部-->
    <a class="side_btn top" id="back-to-top" href="#top" title="<?php _e( '返回顶部', 'insoxin' ); ?>"><i class="icon-flight"></i></a>
    <?php } if (in_array( 'line', $insoxin[ 'side_metas'])) { ?>
    <!--二维码弹窗-->
    <a href="#nl" class="overlay" id="line"></a>
    <article class="line popup">
        <h3>
            <?php echo $insoxin['line_title']; ?>
        </h3>
        <p>
            <?php echo $insoxin['line_desc']; ?>
        </p>
        <?php if( $insoxin[ 'qqqr'][ 'url']){ ?><span><img src="<?php echo $insoxin[ 'qqqr']['url']; ?>" alt="姬长信的QQ二维码"><i class="icon-qq">QQ二维码</i></span>
        <?php } ?>
        <?php if( $insoxin[ 'weixinqr'][ 'url']){ ?><span><img src="<?php echo $insoxin[ 'weixinqr']['url']; ?>" alt="姬长信的微信二维码"><i class="icon-wechat">微信二维码</i></span>
        <?php } ?>
    </article>
    <!--二维码弹窗end-->
    <?php } ?>

    <?php if (in_array( 'wechat', $insoxin[ 'side_metas'])) { ?>
    <!-- 微信公众号 -->
    <a id="wechat" class="overlay" href="#nl"></a>
    <article class="wechat popup">
        <h3>
            <?php _e( '关注', 'insoxin' ); ?>
            <?php bloginfo( 'name' ); ?>
            <?php _e( '微信公众号', 'insoxin' ); ?>
        </h3>
        <img src="<?php echo $insoxin['wechat']['url']; ?>" alt="<?php bloginfo( 'name' ); ?><?php _e( '微信公众号', 'insoxin' ); ?>" />
    </article>
    <?php } ?>

    <?php if (in_array( 'search', $insoxin[ 'side_metas']) || $insoxin['switch_search_menu']) { ?>
    <!-- 搜索 -->
    <a id="search" class="overlay" href="#nl"></a>
    <article class="search popup">
        <h3><i class="icon-search-1"></i>
            <?php _e( '按文章类型进行搜索', 'insoxin' ); ?>
        </h3>
        <form method="get" class="search_form" action="<?php echo get_home_url(); ?>">
            <select name="post_type" class="search_type">
                <option value="post">
                    <?php _e( '文章', 'insoxin' ); ?>
                </option>
                <?php if (in_array( 'gallery', $insoxin[ 'switch_post_type'])) { ?>
                <option value="gallery">
                    <?php _e( '画廊', 'insoxin' ); ?>
                </option>
                <?php } if (in_array( 'video', $insoxin[ 'switch_post_type'])) { ?>
                <option value="video">
                    <?php _e( '视频', 'insoxin' ); ?>
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
    <?php } } if(!wp_is_mobile()){ ?>
    <!-- 文章微信二维码 -->
    <a id="weixin_qr" class="overlay" href="#nl"></a>
    <article class="weixin_qr popup">
        <h3>
            <?php _e( '二维码分享', 'insoxin' ); ?>
        </h3>
        <img src="https://api.isoyu.com/qr/?m=0&e=L&p=10&url=<?php the_permalink(); ?>" alt="<?php the_title(); ?>" />
        <p>
            <?php _e( '<br>分享二维码和朋友共享此文<br>1.右键保存二维码直接发送给朋友<br>2.使用移动设备(如:微信)“扫一扫”后再<font color="#ff0000">发送给朋友</font>或<font color="#ff0000">分享到朋友圈</font>。', 'insoxin' ); ?>
        </p>
    </article>
    <?php } ?>
    <!--打赏-->
    <a href="#thanks" class="overlay" id="pay"></a>
    <article class="pay popup">
        <h3>
            <?php printf( __( '觉得%s有用可以给小姬姬打赏哦！' , 'insoxin' ), esc_attr(post_name())); ?>
        </h3>
        <?php if( $insoxin[ 'alipay'][ 'url']){ ?><span><img src="<?php echo $insoxin[ 'alipay']['url']; ?>" alt="支付宝收款二维码"><i>支付宝扫一扫打赏</i></span>
        <?php } ?>
        <?php if( $insoxin[ 'weixinpay'][ 'url']){ ?><span><img src="<?php echo $insoxin[ 'weixinpay']['url']; ?>" alt="微信收款二维码"><i>微信扫一扫打赏</i></span>
        <?php } ?>
    </article>
    <!--打赏-->
    <a href="#thanks" class="overlay" id="pay"></a>
    <article class="pay popup">
        <h3>
            <?php printf( __( '觉得%s有用可以给小姬姬打赏哦！' , 'insoxin' ), esc_attr(post_name())); ?>
        </h3>
        <?php if( $insoxin[ 'alipay'][ 'url']){ ?><span><img src="<?php echo $insoxin[ 'alipay']['url']; ?>" alt="支付宝收款二维码"><i>支付宝扫一扫打赏</i></span>
        <?php } ?>
        <?php if( $insoxin[ 'weixinpay'][ 'url']){ ?><span><img src="<?php echo $insoxin[ 'weixinpay']['url']; ?>" alt="微信收款二维码"><i>微信扫一扫打赏</i></span>
        <?php } ?>
    </article>
</section>
