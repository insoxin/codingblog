<?php 
/*
Plugin Name: WP-Baidu-Record
Plugin URI:  https://zhangge.net/4726.html
Description: <strong>WordPress百度已收录查询与显示插件</strong>，为WordPress博客增加一个百度是否收录的查询和显示功能，并将结果记录到文章自定义栏目，避免总是实时查询影响网站加载速度(0为未收录，1为已收录)。更详细说明请查看插件主页；
Version: 1.0.8
Author: 张戈
Author URI: https://zhangge.net/about.html
Copyright: 张戈博客原创插件，任何个人或团体不可擅自更改版权。
*/
class wp_baidu_record{
function __construct(){    
    function baidu_check($url, $post_id){
        $baidu_record  = get_post_meta($post_id,'baidu_record',true);
        if( $baidu_record != 1){
            $url='http://www.baidu.com/s?wd='.$url;
                $curl=curl_init();
                curl_setopt($curl,CURLOPT_URL,$url);
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
                $rs=curl_exec($curl);
                curl_close($curl);
		if(!preg_match_all('/提交网址/u',$rs,$match) && preg_match_all('/百度为您找到相关结果/u',$rs,$match)){
                   update_post_meta($post_id, 'baidu_record', 1) || add_post_meta($post_id, 'baidu_record', 1, true);
                   return 1;
                } else {  
                   return 0;
                }
        } else {
            return 1;
        }
}

add_filter('plugin_action_links', 'wp_baidu_record_plugin_action_links', 10, 3);
function wp_baidu_record_plugin_action_links($action_links, $plugin_file, $plugin_info) {
  $this_file = basename(__FILE__);
  if(substr($plugin_file, -strlen($this_file))==$this_file) {
    $new_action_links = array(
      "<a href='options-general.php?page=baidu_record'>设置</a>"
         );
    foreach($action_links as $action_link) {
      if (stripos($action_link, '>Edit<')===false) {
        if (stripos($action_link, '>Deactivate<')!==false) {
          $new_action_links[] = $action_link;
        } else {
          $new_action_links[] = $action_link;
        }
      }
    }
    return $new_action_links;
  }
  return $action_links;
}

function baidu_record() {
	global $wpdb;
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    if(get_option('baidu_open_set')=="is_open"){
        if(baidu_check(get_permalink($post_id), $post_id) == 1){
            return '<a target="_blank" title="点击查看" rel="external nofollow" href="http://www.baidu.com/s?wd='.get_the_title().'">百度已收录</a>';
        } else {
            return '<a style="color:red;" rel="external nofollow" title="点击提交，谢谢您！" target="_blank" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename='.get_permalink().'">百度未收录</a>';
        } 
    } else if (is_user_logged_in()) {
        if(baidu_check(get_permalink($post_id), $post_id) == 1){
            return '<a target="_blank" title="点击查看" rel="external nofollow" href="http://www.baidu.com/s?wd='.get_the_title().'">百度已收录</a>';
        } else {
            return '<a style="color:red;" rel="external nofollow" title="点击可以手动提交到百度" target="_blank" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename='.get_permalink().'">百度未收录</a>';
                }        
            }
        }
    }
}
new wp_baidu_record();
?>
<?php   
if( is_admin() ) {   
    add_action('admin_menu', 'display_baidu_record_menu');   
}   
function display_baidu_record_menu() {   
    add_options_page('百度收录查询插件设置', 'WP Baidu Record','administrator','baidu_record', 'display_baidu_record_page');
}   
function display_baidu_record_page() {   
?>   
<div style="width: 335px;"><h2>百度收录查询插件设置</h2>
<form method="post" action="options.php">   
<?php wp_nonce_field('update-options');
if (get_option('baidu_record')=="" || get_option('baidu_record')=="default"){
    $default='checked="checked"';
} else {
    $diy='checked="checked"';
}
if (get_option('baidu_open_set')=="" || get_option('baidu_open_set')=="is_open"){
    $is_open='checked="checked"';
} else {
    $not_open='checked="checked"';
}
?> 
<p>
<h3>一、显示位置：</h3>
    <input type="radio" name="baidu_record" id="default" value="default" <?php echo $default;?>/>
    <label for="default" style="cursor: pointer;"><b>默认文章最后输出结果</b></label>
    <br />
    <input type="radio" name="baidu_record" id="diy" value="diy" <?php echo $diy;?>/>
    <label for="diy" style="cursor: pointer;"><b>自行定义结果输出位置</b></label>
    <?php if(get_option('baidu_record')=="diy"){echo '<br /><br />您已选择自定义位置，请修改主题下的文章模板(一般是single.php)，在需要显示百度收录结果的地方添加以下函数:<br /><br />
    <span style="width:630px;background: #ffc; border: dashed 1px #f30; color: #080; padding: 5px;">
    &lt;?php echo baidu_record();?&gt;
    </span>
    ';}?>
</p> 
    <br />
<p> 
<h3>二、可见度：</h3>
    <input type="radio" name="baidu_open_set" id="is_open" value="is_open" <?php echo $is_open;?>/>
    <label for="is_open" style="cursor: pointer;"><b>所有人都可见</b></label>
    <br />
    <input type="radio" name="baidu_open_set" id="not_open" value="not_open" <?php echo $not_open;?>/>
    <label for="not_open" style="cursor: pointer;"><b>登录用户可见</b></label>
</p>
<p>   
    <input type="hidden" name="action" value="update" />   
    <input type="hidden" name="page_options" id="baidu_record" value="baidu_record,baidu_open_set" />
    <input type="submit" value="保存设置" class="button-primary" />
</p>   
</form>   
</div>   
<?php }
add_filter('the_content','default_baidu_record');   
function default_baidu_record($content) {
    if(is_single() && get_option('baidu_record') == "default"){
        $content=$content.'<div style="float:right;">'.baidu_record().'</div>';
    }
    return $content;
}?>
