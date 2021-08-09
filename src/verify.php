<?php
	function randColor() {
		return(rand(100, 225));
	}
	$img = imagecreatetruecolor(50, 15);
	$bg = imagecolorallocate($img, randColor(), randColor(), randColor());
	$lncolor = imagecolorallocate($img, randColor(), randColor(), randColor());
	$txtcolor = imagecolorallocate($img, 0x30, 0x30, 0x30);
	imagefill($img, 0, 0, $bg);
	for($i=0; $i < 4; $i++) {
		imagesetthickness($img, rand(1,3));
		imageline($img, 0, rand(0,15), 50, rand(0,15), $lncolor);
	}
  session_start();
	$code = substr(md5(random_bytes(64)), 0, 6);
	$_SESSION['code'] = $code;
	imagestring($img, 2, 7, 1, $code, $txtcolor);
	header('Content-type: image/png');
	imagepng($img);
	imagedestroy($img);
?>
