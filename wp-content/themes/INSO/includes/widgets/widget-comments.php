<?php
/*
聚合文章小工具
*/

class SlongComments extends WP_Widget {

/*  构造函数
/* ------------------------------------ */
	function __construct() {
		parent::__construct( false, __('insoxin-最新评论','insoxin'), array('description' => __('最新评论小工具','insoxin'), 'classname' => 'widget_insoxin_comments') );;	
	}
	
/*  小工具
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$instance['title']?NULL:$instance['title']='';
		$title = apply_filters('widget_title',$instance['title']);
		$output = $before_widget."\n";
		if($title)
			$output .= $before_title.$title.$after_title;
		ob_start();
	
?>
<ul>
    <?php global $wpdb,$comment,$insoxin;
        $limit_num = $instance['comments_num'];
        $rc_comms = $wpdb->get_results("SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,user_id,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author_email != '' ORDER BY comment_date_gmt DESC LIMIT $limit_num ");
        $rc_comments = '';
        foreach ($rc_comms as $comment) { ?>
            <li><section class="recent-comments"><?php $user_id = $comment->user_id; $user_name = $comment->comment_author; echo insoxin_get_avatar($user_id,$user_name); ?><h4><?php echo $comment->comment_author; ?></h4><a href="<?php echo get_permalink($comment->ID);?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php printf( __( '在 %s 发表的评论' , 'insoxin' ), esc_html( $comment->post_title ) ); ?>"<?php echo new_open_link(); ?>><?php echo wp_trim_words(strip_tags($comment->comment_content),20);?></a></section></li>
    <?php } ?>
</ul>
<?php
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
/*  更新小工具
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = strip_tags($new['title']);
		$instance['comments_num'] = strip_tags($new['comments_num']);
		return $instance;
	}

/*  小工具表单
/* ------------------------------------ */
	public function form($instance) {
		// 默认设置
		$defaults = array(
			'title' 			=> __('最新评论','insoxin'),
			'comments_num' 		=> '4',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	<style>
	.widget .widget-inside .postform { width: 100%; }
	</style>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','insoxin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>

		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("comments_num"); ?>"><?php _e('数量：','insoxin'); ?></label>
			<input style="width:100%;" id="<?php echo $this->get_field_id("comments_num"); ?>" name="<?php echo $this->get_field_name("comments_num"); ?>" type="number" value="<?php echo absint($instance["comments_num"]); ?>" size='3' />
		</p>

<?php

}

}

/*  注册小工具
/* ------------------------------------ */
if ( ! function_exists( 'insoxin_register_widget_Comments' ) ) {

	function insoxin_register_widget_comments() { 
		register_widget( 'SlongComments' );
	}
	
}
add_action( 'widgets_init', 'insoxin_register_widget_Comments' );
