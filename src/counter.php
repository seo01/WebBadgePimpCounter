<?php
        header("Content-type: image/png");
 
        //Load the image
        $im = imagecreatefrompng('pimps.png');
 
        //has a URL been mentioned?
        if(isset($_REQUEST['url'])){
                
                $url = $_REQUEST['url'];
                $url = str_replace('/','_',$url); $url = str_replace('~','_',$url); $url = str_replace('?','_',$url);
                $url = str_replace('&','_',$url); $url = str_replace('.','_',$url); $url = str_replace('%','_',$url);
                $url = str_replace(':','_',$url);
                $filename = "urls/$url";
                $string = '';
 
                //Does the file exist?
                if (file_exists($filename)) {
                        $hits = file($filename);
                        $hits[0] ++;
                        $string = "$hits[0]";
                } else {
                        $string = "1";
                }
                $fp = fopen($filename , "w");
                fputs($fp , $string);
                fclose($fp);
 
                $white = imagecolorallocate($im, 255, 255, 255);
                imagestring ($im, 1, 40, 4, $string, $white);
        }
 
        imagepng($im);
        imagedestroy($im);
?>