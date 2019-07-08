<?php
//error_reporting(0);
include('functions.php');
//include('../configure.php');
$ruta=$_GET['ruta'];
$filename = $_GET['src'];
$angle2rotate = $_GET['x'];

$new_name = get_next_name($filename,$ruta);
// File and rotation
$degrees = $_GET['x'];
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
// Rotate
$rotate = imagerotate($source, $degrees, 0);
// Output
//ImageJPEG($rotate,$ruta .$new_name); 
if(substr($filename,-3)=="jpg" || substr($filename,-3)=="JPG"){
// Save the image
ImageJPEG($rotate,$ruta.$new_name,$calidad);
}
set_dpi($ruta.$new_name);
/*if(substr($filename,-3)=="png" || substr($filename,-3)=="PNG"){
// Save the image
ImagePNG($rotate,$ruta .$new_name);
}
if(substr($filename,-3)=="gif" || substr($filename,-3)=="GIF"){
// Save the image
ImageGIF($rotate,$ruta .$new_name);
}*/
 

echo $new_name;

?>