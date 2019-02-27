<?php global $insoxin; ?>
<div id="comments" class="box<?php triangle();wow(); ?>">
    <?php if ( post_password_required() ) : ?>
    <p class="nopassword">
        <?php _e( '这篇文章是密码保护的，输入密码以查看任何评论。', 'insoxin' ); ?>
    </p>
</div>
<!-- #comments -->
<?php return; endif;?>

<?php if ( have_comments() ) : ?>
<section class="comment_title">
    <h2>
        <?php _e('评论：','insoxin'); ?>
    </h2>
    <?php if ( 'open'==$post->comment_status) {
        $my_email  = get_bloginfo ( 'admin_email' );
        $str       = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
        $count_t   = $post->comment_count;
        $count_v   = $wpdb->get_var("$str != '$my_email'");
        $count_h   = $wpdb->get_var("$str = '$my_email'");
    ?>
    <span class="hint">
        <?php echo sprintf( __( '%s 条评论，访客：%s 条，博主：%s 条' , 'insoxin' ), esc_attr($count_t), esc_attr($count_v), esc_attr($count_h) ); ?>
        <?php if($numPingBacks>0) { ?><?php printf( __( '，当前引用：%s 条' , 'insoxin' ), esc_attr($numPingBacks)); ?><?php } ?>
    </span>
    <?php }else{ ?>
    <p class="hint">
        <?php _e( '评论已关闭，往期评论：', 'insoxin' ); ?>
    </p>
    <?php } ?>
</section>
<!--评论列表-->
<ol class="commentlist">
    <?php wp_list_comments( array( 'callback' => 'insoxin_comment' ) ); ?>
</ol>
<!--评论分页-->
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<div class="pagination nav-links">
    <?php echo paginate_comments_links( 'echo=0'); ?>
</div>
<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() ) : ?>
<p class="nocomments">
    <?php _e( '评论已关闭！' , 'insoxin' ); ?>
</p>
<?php endif; ?>

<?php endif; ?>
<?php if ( 'open'==$post->comment_status) { ?>
<?php comment_form(
    array(
	    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( '', 'noun' ) . '</label><textarea id="comment" name="comment" placeholder="欢迎您在这里留下评论，评论需经人工审核，请您文明上网、理性发言并遵守相关规定" cols="45" rows="8" aria-required="true"></textarea></p>',
        'comment_notes_before' => '<p class="comment-notes">' . __( '' ) . ( $req ? $required_text : '' ) . '</p>',
		'id_submit' => 'submit',
		'fields' => array(
            'author' => '<p class="comment-form-author"><label for="author">称呼</label> <span class="required">[必填]</span><input type="text" value="游客" placeholder="请输入您的姓名" aria-required="true" size="30" value="' . esc_attr( $commenter['comment_author'] ) . '" name="author" id="author"></p>',
            'email' => '<p class="comment-form-email"><label for="email">邮箱</label> <span class="required">[必填]</span><input type="text" value="@qq.com" placeholder="请输入您的邮箱" aria-required="true" size="30" value="' . esc_attr( $commenter['comment_author_email'] ) . '" name="email" id="email"></p>',
            'url' => '<p class="comment-form-url"><label for="url">网站(选填)</label><input type="text" placeholder="https://" size="30" value="'.$comment_author_url.'" name="url" id="url"></p>'
            )
        )
 );
?>
<?php } ?>
</div>
