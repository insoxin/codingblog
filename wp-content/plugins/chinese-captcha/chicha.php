<?php
session_start();
$font=getcwd().'/font/song.ttf';//字体
$str='一二三四五六七八九姬';
$chinese='';
for($i=0;$i<2;$i++) {
 $cc=mt_rand(0,(strlen($str)/3-1));
 $chinese.=substr($str,$cc*3,3);
}

$w=60;
$h=30;
$_SESSION['chicha'] = $chinese;
$_SESSION['cctime'] = time();
if (!empty($im)) {
            imagedestroy($im);
        }
$im = imagecreatetruecolor($w,$h);
$bgclor = imagecolorallocate($im,mt_rand(100,255),mt_rand(100,255),mt_rand(100,255));
$color=imagecolorallocate($im,mt_rand(0,99),mt_rand(0,99),mt_rand(0,99));
imagefill($im,0,0,$bgclor);
$posx=10;
    for($i=0;$i<2;$i++){
	$degree= rand(4,6);
	imagettftext($im, 11+$degree, $degree, $posx, 24, $color, $font,substr($chinese,$i*3,3));
    $posx+=23-$degree;
    }
	imageline($im,mt_rand(0,15), 1, mt_rand(45,60), 29, $bgclor);
        $k = rand(25, 75);
        for ($i = 0; $i <$w; $i++) {
        imagecopy($im, $im, $i-1, sin($k+$i/8)*2.5, $i, 0, 1, $h);
        }
        $k = rand(25, 75);
        for ($i = 0; $i < $h; $i++) {
        imagecopy($im, $im,sin($k+$i/9)*7, $i-1, 0, $i, $w, 1);	
	    }
header("Content-type: image/png");
imagepng($im);
imagedestroy($im);
exit;
?>