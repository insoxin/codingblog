<?php
/*
Chinese Captcha
http://www.xuewp.com/chinese-captcha/
Wordpress中文验证码，汉字的魅力。
Author: Chao Wang
http://http://www.xuewp.com/
*/

if (isset($_POST['submit'])) {
      if ( function_exists('current_user_can') && !current_user_can('manage_options') )
            die(__('您没有访问权限', 'chinese_captcha'));
        check_admin_referer( 'chinese_captcha-options_update');
$chinese_captcha_update=array('chicha_comment' =>(isset( $_POST['chicha_comment'] ) ) ? 'true' : 'false',
         'chicha_ajax' =>(isset( $_POST['chicha_ajax'] ) ) ? 'true' : 'false',
         'no_chicha_level' =>(trim($_POST['no_chicha_level']) != '' ) ? trim($_POST['no_chicha_level']) : $chinese_captcha_option_defaults['no_chicha_level'],
		 'chicha_register' =>(isset( $_POST['chicha_register'] ) ) ? 'true' : 'false',
		 'chicha_login' =>(isset( $_POST['chicha_login'] ) ) ? 'true' : 'false',
		  'chicha_session_expired' =>(trim($_POST['chicha_session_expired']) != '' ) ? trim($_POST['chicha_session_expired']) : $chinese_captcha_option_defaults['chicha_session_expired'],
		 'chicha_lostpassword' =>(isset( $_POST['chicha_lostpassword'] ) ) ? 'true' : 'false');
		update_option('chinese_captcha', $chinese_captcha_update);
		$chinese_captcha_options=get_option('chinese_captcha');
		    if (function_exists('wp_cache_flush')) {
	     wp_cache_flush();
	}
}
?>
<?php if ( !empty($_POST ) ) : ?>
<div id="message" class="updated"><p><strong><?php _e('设置已更新。', 'chinese_captcha') ?></strong></p></div>
<?php endif; ?>

<form name="formoptions" action="" method="post">
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="form_type" value="upload_options" />
        <?php wp_nonce_field('chinese_captcha-options_update'); ?>
		
		<h3><?php _e('汉字验证码设置', 'chinese-captcha') ?></h3>
		当前版本：<?php _e(CHINESE_CAPTCHA_VERSION, 'chinese-captcha') ?> <a href="http://www.xuewp.com/chinese-captcha/" title="汉字验证码官方主页">xuewp</a>出品
<table width="100%" cellspacing="2" cellpadding="5" class="form-table">
  <tr valign="top">
          <th scope="row"><strong>设定在哪些页面使用验证码:</strong></th>
           <td></td>
          </tr>
  <tr valign="top"><th scope="row">
         <input name="chicha_comment" id="chicha_comment" type="checkbox" <?php if ( $chinese_captcha_options['chicha_comment'] == 'true' ) echo ' checked="checked" '; ?> />
    <label for="chicha_comment"><?php _e('在评论页面启用', 'chinese-captcha') ?></label></th>
  <td>若此项关闭，则下面一行的设定自动失效</td>
          </tr>
  <tr valign="top">
          <th scope="row">在评论页面等级高于       
           	<select name="no_chicha_level">
            <option value="read" <?php echo $chinese_captcha_options['no_chicha_level']=='read'?'selected':''; ?>>订阅者</option>
            <option value="edit_posts" <?php echo $chinese_captcha_options['no_chicha_level']=='edit_posts'?'selected':''; ?>>编辑</option>
            <option value="publish_posts" <?php echo $chinese_captcha_options['no_chicha_level']=='publish_posts'?'selected':''; ?>>作者</option>
			<option value="moderate_comments" <?php echo $chinese_captcha_options['no_chicha_level']=='moderate_comments'?'selected':''; ?>>评论管理</option>
			<option value="level_10" <?php echo $chinese_captcha_options['no_chicha_level']=='level_10'?'selected':''; ?>>管理员</option>
        </select></th><td>时关闭验证码（默认设置为订阅者，即所有注册用户登陆后验证码消失。如设置为管理员，则低于此等级用户评论时全部要输入验证码）</td>
          </tr>
		   <tr valign="top">
         <th scope="row">
         <input name="chicha_ajax" id="chicha_ajax" type="checkbox" <?php if ( $chinese_captcha_options['chicha_ajax'] == 'true' ) echo ' checked="checked" '; ?> />
    <label for="chicha_ajax"><?php _e('评论页面开启ajax', 'chinese-captcha') ?></label></th>
           <td>ajax评论功能，可能与部分插件和主题不兼容，如评论不自动显示，请将此项关闭。</td>
          </tr>
  <tr valign="top">
         <th scope="row">
         <input name="chicha_register" id="chicha_register" type="checkbox" <?php if ( $chinese_captcha_options['chicha_register'] == 'true' ) echo ' checked="checked" '; ?> />
    <label for="chicha_register"><?php _e('在注册页面启用', 'chinese-captcha') ?></label></th>
           <td></td>
          </tr>
  <tr valign="top">
        <th scope="row">
         <input name="chicha_lostpassword" id="chicha_lostpassword" type="checkbox" <?php if ( $chinese_captcha_options['chicha_lostpassword'] == 'true' ) echo ' checked="checked" '; ?> />
    <label for="chicha_lostpassword"><?php _e('在忘记密码页面启用', 'chinese-captcha') ?></label></th>
           <td></td>
          </tr>
  <tr valign="top">
          <th scope="row">
         <input name="chicha_login" id="chicha_login" type="checkbox" <?php if ( $chinese_captcha_options['chicha_login'] == 'true' ) echo ' checked="checked" '; ?> />
    <label for="chicha_login"><?php _e('在登陆页面启用（不推荐）', 'chinese-captcha') ?></label></th>
           <td></td>
          </tr>
		   <tr valign="top">
          <th scope="row">验证码有效时间       
           	<select name="chicha_session_expired">
            <option value="60" <?php echo $chinese_captcha_options['chicha_session_expired']=='60'?'selected':''; ?>>1分钟</option>
            <option value="180" <?php echo $chinese_captcha_options['chicha_session_expired']=='180'?'selected':''; ?>>3分钟</option>
            <option value="300" <?php echo $chinese_captcha_options['chicha_session_expired']=='300'?'selected':''; ?>>5分钟</option>
			<option value="600" <?php echo $chinese_captcha_options['chicha_session_expired']=='600'?'selected':''; ?>>10分钟</option>
			<option value="3600" <?php echo $chinese_captcha_options['chicha_session_expired']=='3600'?'selected':''; ?>>1小时</option>
        </select></th><td>默认设置为5分钟内有效</td>
          </tr>
</table>
        <p class="submit">
                <input type="submit" name="submit" value="<?php _e('更新设置', 'chinese-captcha') ?> &raquo;" />
        </p>
</form>
<p>其他xuewp.com出品的插件：<a href="http://www.xuewp.com/pinyin-seo/">包含20966个汉字的Wordpress 拼音SEO插件</a></p>