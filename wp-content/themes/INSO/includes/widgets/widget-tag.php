<?php
/*
聚合文章小工具
*/

class SlongTags extends WP_Widget {

/*  构造函数
/* ------------------------------------ */
	function __construct() {
		parent::__construct( false, __('insoxin-标签聚合','insoxin'), array('description' => __('标签聚合小工具','insoxin'), 'classname' => 'widget_insoxin_tags') );;	
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
 <div class="sltags">
     <?php $args = array(
        'order'         => 'DESC',
        'orderby'       => $instance['tag_orderby'],
        'taxonomy'       => $instance['tag_type'],
        'number'        => $instance['tag_num'],        
    );
        if($instance['tag_type']=='post_tag'){
            $post_type_name=__('文章','insoxin');
        } else if($instance['tag_type']=='gallery-tag'){
            $post_type_name=__('画廊','insoxin');
        } else if($instance['tag_type']=='video-tag'){
            $post_type_name=__('视频','insoxin');
        } else if($instance['tag_type']=='product_tag'){
            $post_type_name=__('产品','insoxin');
        }
        $tags_list = get_terms($args);
        global $insoxin;
        if ($tags_list) {
            foreach($tags_list as $tag) { ?>
               <a href="<?php echo get_tag_link($tag); ?>" title="<?php printf( __( '标签 %s 下有 %s 个%s' , 'insoxin' ), esc_attr($tag->name), esc_attr($tag->count),esc_attr($post_type_name) ); ?>"<?php echo new_open_link(); ?>><?php echo $tag->name; ?><span><?php echo $tag->count; ?></span></a>
            <?php }
        }
     ?>
</div>

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
		$instance['tag_type'] = strip_tags($new['tag_type']);
		$instance['tag_num'] = strip_tags($new['tag_num']);
		$instance['tag_orderby'] = strip_tags($new['tag_orderby']);
		return $instance;
	}

/*  小工具表单
/* ------------------------------------ */
	public function form($instance) {
		// 默认设置
		$defaults = array(
			'title' 			=> __('标签聚合','insoxin'),
			'tag_type' 		=> 'post',
			'tag_num' 		=> '16',
			'tag_orderby' 	=> 'count',
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
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("tag_num"); ?>"><?php _e('数量：','insoxin'); ?></label>
			<input style="width:100%;" id="<?php echo $this->get_field_id("tag_num"); ?>" name="<?php echo $this->get_field_name("tag_num"); ?>" type="number" value="<?php echo absint($instance["tag_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("tag_type"); ?>"><?php _e('类型：','insoxin'); ?></label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("tag_type"); ?>" name="<?php echo $this->get_field_name("tag_type"); ?>">
			  <option value="post_tag"<?php selected( $instance["tag_type"], "post_tag" ); ?>><?php _e('文章','insoxin'); ?></option>
			  <option value="gallery-tag"<?php selected( $instance["tag_type"], "gallery-tag" ); ?>><?php _e('画廊','insoxin'); ?></option>
			  <option value="video-tag"<?php selected( $instance["tag_type"], "video-tag" ); ?>><?php _e('视频','insoxin'); ?></option>
			  <option value="product_tag"<?php selected( $instance["tag_type"], "product_tag" ); ?>><?php _e('产品','insoxin'); ?></option>
			</select>	
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("tag_orderby"); ?>"><?php _e('排序：','insoxin'); ?></label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("tag_orderby"); ?>" name="<?php echo $this->get_field_name("tag_orderby"); ?>">
			  <option value="name"<?php selected( $instance["tag_orderby"], "name" ); ?>><?php _e('标题','insoxin'); ?></option>
			  <option value="count"<?php selected( $instance["tag_orderby"], "count" ); ?>><?php _e('文章数量','insoxin'); ?></option>
			</select>	
		</p>

<?php

}

}

/*  注册小工具
/* ------------------------------------ */
if ( ! function_exists( 'insoxin_register_widget_tags' ) ) {

	function insoxin_register_widget_tags() { 
		register_widget( 'SlongTags' );
	}
	
}
add_action( 'widgets_init', 'insoxin_register_widget_tags' );
