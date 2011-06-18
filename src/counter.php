<?php
	header("Content-type: image/png");

	//Load the image
	$im = imagecreatefrompng('pimps.png');

	//What's the url?
	$url = 'unknown';
	if(isset($_REQUEST['url']))
		$url = $_REQUEST['url'];
	elseif(isset($_SERVER['HTTP_REFERER']))
		$url = $_SERVER['HTTP_REFERER'];
	$replace_chars = array('/','~','?','&','.','%','&',':');
	$url = str_replace($replace_chars,'_',$url);
	$filename = "urls/$url.txt";

	//Impression Count
	$string = "1";
	//Does the file exist?
	if (file_exists($filename)) {
		$hits = file($filename);
		$hits[0] ++;
		$string = "$hits[0]";
	}
	if(!is_dir("urls"))
		mkdir("urls", 0700);
	$fp = fopen($filename , "w");
	fputs($fp , $string);
	fclose($fp);

	//Output the image
	$white = imagecolorallocate($im, 255, 255, 255);
	imagestring ($im, 1, 40, 4, $string, $white);

	imagepng($im);
	imagedestroy($im);
?>