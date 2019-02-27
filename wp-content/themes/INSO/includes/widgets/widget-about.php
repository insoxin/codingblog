<?php
/*
关于本站小工具
*/

class SlongAbout extends WP_Widget {

/*  构造函数
/* ------------------------------------ */
	function __construct() {
		parent::__construct( false, __('insoxin-关于本站','insoxin'), array('description' => __('关于本站小工具','insoxin'), 'classname' => 'widget_insoxin_about') );;	
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
<section class="about">
    <img src="<?php echo $instance['about_img']; ?>" alt="<?php echo $instance['about_title']; ?>"width="366" height="206">
    <h3><?php echo $instance['about_title']; ?></h3>
    <span><?php echo $instance['about_desc']; ?></span>
    <div class="excerpt"><?php echo $instance['about_info']; ?></div>
    <?php global $insoxin;
        $post_count     = wp_count_posts('post')->publish;
        $gallery_count  = wp_count_posts('gallery')->publish;
        $video_count    = wp_count_posts('video')->publish;
        $product_count  = wp_count_posts('product')->publish;
        if($instance[ 'about_statistics']) { //显示统计 ?>
<ul class="layout_ul">
<div class="table-r">  
<table width="100%">  
    <tbody>  
        <tr>  
            <td style="text-align:center;" width="50%"><i class="iconfont icon-activity"></i>&nbsp文章总数：</td>  
            <td style="text-align:center;" width="50%"><?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</td>  
        </tr> 
        <tr>  
            <td style="text-align:center;" width="50%"><i class="iconfont icon-liuyan"></i>&nbsp留言数量：</td>  
            <td style="text-align:center;" width="50%"><?php global $wpdb; echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> 条</td>  
        </tr>     
        <tr>  
            <td style="text-align:center;" width="50%"><i class="iconfont icon-friendLink"></i>&nbsp友情链接：</td>  
            <td style="text-align:center;"width="50%"><?php global $wpdb; echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); ?> 个</td><tr>  
    <td style="text-align:center;" width="50%"><i class="iconfont icon-shouye"></i>网站运行：</td>  
    <td style="text-align:center;" width="50%"><?php echo floor((time()-strtotime("2012-11-11"))/86400); ?> 天</td>  
</tr>
<tr>  
            <td style="text-align:center;" width="50%"><i class="iconfont icon-bianji"></i>&nbsp浏览总量：</td>  
            <td style="text-align:center;" width="50%"><?php echo all_view(); ?> 次</td>  
        </tr>  
<tr>  
    <td style="text-align:center;" width="50%"><i class="iconfont icon-xinwen"></i>&nbsp最后更新：</td>  
    <td style="text-align:center;" width="50%"><?php global $wpdb; $last =$wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y年n月j日', strtotime($last[0]->MAX_m));echo $last; ?></td>  
</tr>  
        </tr>  
    </tbody>  
</table>  
</div>  
    </ul>
    <?php } ?>
</section>



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
		$instance['about_img'] = esc_url($new['about_img']);
		$instance['about_title'] = strip_tags($new['about_title']);
		$instance['about_desc'] = strip_tags($new['about_desc']);
		$instance['about_info'] = $new['about_info'];
		$instance['about_statistics'] = $new['about_statistics']?1:0;
		return $instance;
	}

/*  小工具表单
/* ------------------------------------ */
	public function form($instance) {
		// 默认设置
		$defaults = array(
			'title' 			=> __('关于本站','insoxin'),
			'about_img' 		=> get_template_directory_uri(). '//api.isoyu.com/bing_images.php',
			'about_title' 			=> __('姬长信','insoxin'),
			'about_desc' 			=> __('用意志战胜身体的惰性！','insoxin'),
			'about_info' 			=> __('<p>姬长信，主要iPhone开发,iOS开发,iPad开发,Mac开发.现致力为所有移动开发者提供资讯服务、问答服务、代码下载、工具库及服务。</p>','insoxin'),
			'about_statistics'	=> 1,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	<style>
	.widget .widget-inside .postform { width: 100%; }
	</style>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('小工具标题：','insoxin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("about_img"); ?>"><?php _e('图片：','insoxin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id("about_img"); ?>" name="<?php echo $this->get_field_name("about_img"); ?>" type="text" value="<?php echo esc_url($instance["about_img"]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("about_title"); ?>"><?php _e('标题：','insoxin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id("about_title"); ?>" name="<?php echo $this->get_field_name("about_title"); ?>" type="text" value="<?php echo $instance["about_title"]; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("about_desc"); ?>"><?php _e('描述：','insoxin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id("about_desc"); ?>" name="<?php echo $this->get_field_name("about_desc"); ?>" type="text" value="<?php echo $instance["about_desc"]; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("about_info"); ?>"><?php _e('说明：','insoxin'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('about_info'); ?>" name="<?php echo $this->get_field_name('about_info'); ?>"><?php echo $instance["about_info"]; ?></textarea>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('about_statistics'); ?>" name="<?php echo $this->get_field_name('about_statistics'); ?>" <?php checked( (bool) $instance["about_statistics"], true ); ?>>
			<label for="<?php echo $this->get_field_id('about_statistics'); ?>"><?php _e('显示统计','insoxin'); ?></label>
		</p>

<?php

}

}

/*  注册小工具
/* ------------------------------------ */
if ( ! function_exists( 'insoxin_register_widget_about' ) ) {

	function insoxin_register_widget_about() { 
		register_widget( 'SlongAbout' );
	}
	
}
add_action( 'widgets_init', 'insoxin_register_widget_about' );
