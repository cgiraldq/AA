<?php
//error_reporting(0);
include('functions.php');
//include('../configure.php');
$ruta=$_GET['ruta'];
$filename = $_GET['src'];
$br = $_GET['br'];
$new_name = get_next_name($filename,$ruta);
// File and rotation
// Load
if(substr($filename,-3)=="jpg" || substr($filename,-3)=="JPG"){
$source = imagecreatefromjpeg($ruta .$filename);
}
/*if(substr($filename,-3)=="png" || substr($filename,-3)=="PNG"){
$source = imagecreatefrompng($ruta .$filename);
}
if(substr($filename,-3)=="gif" || substr($filename,-3)=="GIF"){
$source = imagecreatefromgif($ruta .$filename);
}*/

imagefilter($source , IMG_FILTER_GRAYSCALE);
imagefilter($source , IMG_FILTER_COLORIZE, 0, 255, 0);
// Output
$size=getimagesize($ruta .$filename);

$crop = imagecreatetruecolor($size[0],$size[1]);
imagecopy($crop, $source, 0, 0, 0, 0, $size[0], $size[0]);

//ImageJPEG($rotate,$ruta .$new_name); 
if(substr($filename,-3)=="jpg" || substr($filename,-3)=="JPG"){
// Save the image
ImageJPEG($source ,$ruta .$new_name,$calidad);
}
set_dpi($ruta.$new_name);
/*if(substr($filename,-3)=="png" || substr($filename,-3)=="PNG"){
// Save the image
ImagePNG($source ,$ruta .$new_name);
}
if(substr($filename,-3)=="gif" || substr($filename,-3)=="GIF"){
// Save the image
ImageGIF($source ,$ruta .$new_name);
}*/
 
echo $new_name;

?>