<?php
/*
Plugin Name: Chinese Captcha(中文验证码)
Plugin URI: http://www.xuewp.com/chinese-captcha/
Description: 中文验证码，汉字的魅力。Chinese Captcha,the charming characters of the Orient.
Author: Chao Wang<webmaster@xuewp.com>
Version: 1.1
Author URI: http://www.xuewp.com/
*/
/*Copyright 2012 Chao Wang (email: webmaster@xuewp.com )

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License along
  with this program; if not, write to the Free Software Foundation, Inc.,
  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
session_cache_limiter('private,must-revalidate');
session_start();
define('CHINESE_CAPTCHA_VERSION', '1.0');
if ( ! defined( 'WP_CONTENT_URL' ) )
       define( 'WP_CONTENT_URL', WP_SITEURL . '/wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
       define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );

$chinese_captcha_option_defaults=array('chicha_comment'=>'true','no_chicha_level'=>'read','chicha_register'=>'true','chicha_login'=>'false','chicha_lostpassword'=>'true','chicha_ajax'=>'true','chicha_session_expired'=>'300');
if (!get_option('chinese_captcha')){
add_option('chinese_captcha', $chinese_captcha_option_defaults, '', 'yes');
}
$chinese_captcha_options=get_option('chinese_captcha');

add_action('admin_menu', 'chinese_captcha_menu');
function chinese_captcha_menu(){
add_options_page('汉字验证码','汉字验证码', 'manage_options', 'Chinese_Captcha', 'chinese_captcha_options_page');
}

if ($chinese_captcha_options['chicha_ajax']=='true'){
add_action('wp_enqueue_scripts', 'chinese_captcha_ajax');}
function chinese_captcha_ajax(){
   if(is_single()||is_page()){
      wp_enqueue_script('chinese_captcha_js', WP_PLUGIN_URL.'/chinese-captcha/ajax/ajax.js',array('jquery'),'',true);
      wp_enqueue_style('chinese_captcha_css', WP_PLUGIN_URL.'/chinese-captcha/ajax/ajax.css');
      wp_localize_script('chinese_captcha_js','chichaSettings',array(
            'gifUrl'=>WP_PLUGIN_URL.'/chinese-captcha/ajax/ajax.gif',
			'chichaUrl'=>WP_PLUGIN_URL.'/chinese-captcha/chicha.php?'
      ));
   }
}

function chinese_captcha_options_page(){
global $chinese_captcha_options,$chinese_captcha_option_defaults;
 require_once('chinese-captcha-admin.php');
}

if ($chinese_captcha_options['chicha_comment']=='true'){
if( version_compare($wp_version,'3','>=')){
add_action('comment_form_after_fields','chinese_captcha_chicha_comment', 1);//未登陆评论页
add_action('comment_form_logged_in_after','chinese_captcha_chicha_comment', 1);//登陆后评论页
}
add_action('comment_form','chinese_captcha_comment_form', 1);//兼容旧版本和某些自定义评论模板
add_filter('preprocess_comment','chinese_captcha_comment_check', 1);//发表评论时验证
}

if ($chinese_captcha_options['chicha_register']=='true'){
add_action('login_head','chinese_captcha_login_head');
add_action('register_form','chinese_captcha_chicha', 10);//注册页面
add_filter('registration_errors','chinese_captcha_register_check', 10);//注册时验证
}

if ($chinese_captcha_options['chicha_login']=='true'){
add_action('login_head','chinese_captcha_login_head');
add_action('login_form','chinese_captcha_chicha');//登录页面
add_filter('authenticate','chinese_captcha_login_check',9,3);//登录时验证
}

if ($chinese_captcha_options['chicha_lostpassword']=='true'){
add_action('login_head','chinese_captcha_login_head');
add_action('lostpassword_form','chinese_captcha_chicha', 10);//忘记密码页面
add_action('lostpassword_post', 'chinese_captcha_lostpassword_check', 10);//忘记密码时验证
}

function chinese_captcha_chicha_comment() {
global $chinese_captcha_options;
if (is_user_logged_in() && current_user_can($chinese_captcha_options['no_chicha_level'])) {
           return $comment;//跳过
}
echo '<!-- 中文验证码chinese captcha 1.0 --><label for="chinese_captcha">请输入</label>
<input id="chicha" type="text" name="chicha" value="" size="4" maxlength="3"/>
<img id="chinesecaptcha" src="" title="请输入图中两个独立的汉字"/> <a rel="nofollow" href="javascript:ReChicha();" title="刷新验证码">看不清？</a>';
echo '<script language="javascript" type="text/javascript">
document.getElementById("chinesecaptcha").src ="'.WP_PLUGIN_URL.'/chinese-captcha/chicha.php?" + Math.random();
function ReChicha(){
  document.getElementById("chinesecaptcha").src ="'.WP_PLUGIN_URL.'/chinese-captcha/chicha.php?" + Math.random();
}</script><!-- 中文验证码chinese captcha 1.0 -->';
remove_action('comment_form', 'chinese_captcha_comment_form', 1);
	return true;
}

function chinese_captcha_comment_form() {
global $chinese_captcha_options;
if (is_user_logged_in() && current_user_can($chinese_captcha_options['no_chicha_level'])) {
           return $comment;//跳过
}
echo '<!-- 中文验证码chinese captcha 1.0 --><div id="chicha_position"><label for="chinese_captcha">请输入</label>
<input id="chicha" type="text" name="chicha" value="" size="4" maxlength="3"/>
<img id="chinesecaptcha" src="" title="请输入图中两个独立的汉字"/> <a rel="nofollow" href="javascript:ReChicha();" title="刷新验证码">看不清？</a></div>';
echo '<script language="javascript" type="text/javascript">
document.getElementById("chinesecaptcha").src ="'.WP_PLUGIN_URL.'/chinese-captcha/chicha.php?" + Math.random();
function ReChicha(){
  document.getElementById("chinesecaptcha").src ="'.WP_PLUGIN_URL.'/chinese-captcha/chicha.php?" + Math.random();
}</script>';
echo'<script type="text/javascript">
          var ComInput= document.getElementById("comment");
                  var DivParent = ComInput.parentNode;
          var ComReplace = document.getElementById("chicha_position");
                  DivParent.appendChild(ComReplace, ComInput);
      </script><!-- 中文验证码chinese captcha 1.0 -->';
	return true;
}

function chinese_captcha_chicha() {
echo '<!-- 中文验证码chinese captcha 1.0 --><label for="chinese_captcha">请输入</label>
<input id="chicha" type="text" name="chicha" value="" size="4" maxlength="3"/>
<img id="chinesecaptcha" src="" title="请输入图中两个独立的汉字"/> <a rel="nofollow" href="javascript:ReChicha();" title="刷新验证码">看不清？</a>';
echo '<script language="javascript" type="text/javascript">
document.getElementById("chinesecaptcha").src ="'.WP_PLUGIN_URL.'/chinese-captcha/chicha.php?" + Math.random();
function ReChicha(){
  document.getElementById("chinesecaptcha").src ="'.WP_PLUGIN_URL.'/chinese-captcha/chicha.php?" + Math.random();
}</script><!-- 中文验证码chinese captcha 1.0 -->';
	return true;
}

function chinese_captcha_comment_check($comment) {
global $chinese_captcha_options;
if (is_user_logged_in() && current_user_can($chinese_captcha_options['no_chicha_level'])) {
           return $comment;//跳过
}
    if ( isset($_POST['action']) && $_POST['action'] == 'replyto-comment' &&
    ( check_ajax_referer( 'replyto-comment', '_ajax_nonce', false ) || check_ajax_referer( 'replyto-comment', '_ajax_nonce-replyto-comment', false )) ) {
          //跳过
          return $comment;
    }

    if ( $comment['comment_type'] != '' && $comment['comment_type'] != 'comment' ) {
               //跳过trackback或pingback
          return $comment;
    }

if (!isset($_SESSION['chicha']) || empty($_SESSION['chicha'])) {
          wp_die( __('<strong>错误</strong>：不能读取验证码cookie，请确认您的浏览器没有禁止cookie。或者与其他插件有冲突，请您换个浏览器再试。'));
    }else{
       if (empty($_POST['chicha']) || $_POST["chicha"] == '') {
           wp_die( __('<strong>错误</strong>：验证码不能为空，请重新输入。'));
       }
     if (!empty($_SESSION['chicha']) && ($_POST['chicha'] == $_SESSION['chicha']) && time()-$chinese_captcha_options['chicha_session_expired'] <= $_SESSION['cctime']) {
           // 验证正确
           return($comment);
       } else {
           wp_die( __('<strong>错误</strong>：验证码错误或超时，请重新输入。'));
       }
    }
} 

function chinese_captcha_register_check($errors) {
global $chinese_captcha_options;
if (!isset($_SESSION['chicha']) || empty($_SESSION['chicha'])) {
          $errors->add('captcha_error', __('<strong>错误</strong>：不能读取验证码cookie，请确认您的浏览器没有禁止cookie。或者与其他插件有冲突，请您换个浏览器再试。'));
		  return $errors;
    }else{
       if (empty($_POST['chicha']) || $_POST['chicha'] == '') {
           $errors->add('empty_captcha', __('<strong>错误</strong>：验证码不能为空，请重新输入。'));
		   return $errors;
       }
     if (!empty($_SESSION['chicha']) && ($_POST['chicha'] == $_SESSION['chicha']) && time()-$chinese_captcha_options['chicha_session_expired'] <= $_SESSION['cctime']) {
           // 验证正确
       } else {
           $errors->add('invalid_captcha', __('<strong>错误</strong>：验证码错误或超时，请重新输入。'));
		   return $errors;
       }
    }return ($errors);
}

function chinese_captcha_login_check($user, $username, $password) {
global $chinese_captcha_options;
remove_filter('authenticate', 'wp_authenticate_username_password', 20, 3);
        if ( is_a($user, 'WP_User') ) { return $user; }

		if ( empty($username) || empty($password) || isset($_POST['chicha']) && empty($_POST['chicha'])) {
		    $error = new WP_Error();

			if ( empty($username) ) {
				$error->add('empty_username', __('<strong>错误</strong>：用户名不能为空。'));
            }
			
			if ( empty($password) ) {
				$error->add('empty_password', __('<strong>错误</strong>：密码不能为空。'));
            }
			
            if (isset($_POST['chicha']) && empty($_POST['chicha'])) {
                $error->add('empty_captcha', __('<strong>错误</strong>：验证码不能为空，请重新输入。'));
            }
			return $error;
		}
		
		if (!isset($_SESSION['chicha']) || empty($_SESSION['chicha'])) {
          $errors->add('captcha_error', __('<strong>错误</strong>：不能读取验证码cookie，请确认您的浏览器没有禁止cookie。或者与其他插件有冲突，请您换个浏览器再试。'));
		  return $errors;
        }
		
	    if (!empty($_SESSION['chicha']) && ($_POST['chicha'] == $_SESSION['chicha']) && time()-$chinese_captcha_options['chicha_session_expired'] <= $_SESSION['cctime']) {
	      // 验证正确
	    }
		
	    else{
            return new WP_Error('invalid_captcha', __('<strong>错误</strong>：验证码错误或超时，请重新输入。'));
        }
	    $userdata = get_user_by('login', $username);

		if ( !$userdata ) {
			return new WP_Error('invalid_username', sprintf(__('<strong>错误</strong>：用户名无效。 <a href="%s" title="找回您的密码">忘记密码了</a>？'), site_url('wp-login.php?action=lostpassword', 'login')));
		}
		$userdata = apply_filters('wp_authenticate_user', $userdata, $password);
		
		if ( is_wp_error($userdata) ) {
			return $userdata;
		}
		
		if ( !wp_check_password($password, $userdata->user_pass, $userdata->ID) ) {
			return new WP_Error('incorrect_password', sprintf(__('<strong>错误</strong>：密码不正确。<a href="%s" title="找回您的密码">忘记密码了</a>？'), site_url('wp-login.php?action=lostpassword', 'login')));
		}
		
		$user =  new WP_User($userdata->ID);
		return $user;
}

function chinese_captcha_lostpassword_check() {
global $chinese_captcha_options;
if (!isset($_SESSION['chicha']) || empty($_SESSION['chicha'])) {
          wp_die( __('<strong>错误</strong>：不能读取验证码cookie，请确认您的浏览器没有禁止cookie。或者与其他插件有冲突，请您换个浏览器再试。'));
    }else{
       if (empty($_POST['chicha']) || $_POST['chicha'] == '') {
           wp_die( __('<strong>错误</strong>：验证码不能为空，请重新输入。'));
       }
     if (!empty($_SESSION['chicha']) && ($_POST['chicha'] == $_SESSION['chicha']) && time()-$chinese_captcha_options['chicha_session_expired'] <= $_SESSION['cctime']) {
           // 验证正确
           return;
       } else {
           wp_die( __('<strong>错误</strong>：验证码错误或超时，请重新输入。'));
       }
    }
}

function chinese_captcha_login_head(){
echo '<!-- 中文验证码1.0 -->
<style type="text/css">
#chicha{font-size:24px;width:30%;padding:3px;margin-top:2px;margin-right:6px;margin-bottom:16px;border:1px solid #e5e5e5;background: #fbfbfb}
#chinesecaptcha {vertical-align:middle}
</style><!-- 中文验证码1.0 -->';
}

function delete_chinese_captcha_options() {
      delete_option('chinese_captcha');
}
register_deactivation_hook(__FILE__, 'delete_chinese_captcha_options');
?>