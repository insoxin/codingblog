<?php
define('WP_CACHE', true); // Added by WP Rocket
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', '');

/** MySQL数据库用户名 */
define('DB_USER', '');

/** MySQL数据库密码 */
define('DB_PASSWORD', '');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'e*V{(9^jSFf3>t}q9Nul7dGU(CT:a)N_B,l%$qLa]JF|w0*?$3d>|iWK2>]hKp8^');
define('SECURE_AUTH_KEY',  '|@i<Sf )[%I PFkG5e9mh1T4)sAMC6ae)RF02^w;kfrS%Rp/WYv*L%#3`}unVdgV');
define('LOGGED_IN_KEY',    '(Y@WY/4j6MneWZW%b|~[sn*V#waSpHl2,LWmG}1)*w;dS[.3i  q{KlS5SRC4 G`');
define('NONCE_KEY',        'v&1|}b<36x#e6>zLt}XMrUIJmoV&g<3$#1dwe7S|rJgO;ujOv3WMT:k^R{}F8SoB');
define('AUTH_SALT',        'X*93ujb)qiZbJ|3 %$n3q3N9DblIAB=gr;Rk:L=s?e;(ngE.#n4rvx(_d#I893vO');
define('SECURE_AUTH_SALT', 'm!Y>-~4C,>;*q-phY~C~t}~=zc<kbmhK8PC%jUJ[qc?=53BP))JWI}Njv%Unze[G');
define('LOGGED_IN_SALT',   'qk8mXvh&m-pFJ!EN}:n<8Rm,er,>SH{xGyw.9-9M,>S6N3W74r3cw8KgVe NZD!0');
define('NONCE_SALT',       ':S6-0PZh<wl;)*PntxNCL9w<:^8 F5Lt<zip<OGFvMY@1L@ZNoOg%l~ry;).ar}J');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);


/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */
$_SERVER['HTTPS'] = 'on';
define('FORCE_SSL_LOGIN', true); 
define('FORCE_SSL_ADMIN', true);
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $list = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
    $_SERVER['REMOTE_ADDR'] = $list[0];
}
/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');