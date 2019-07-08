<?
/*
| ----------------------------------------------------------------- |
 Archivo que permite descargar la foto forzando el proceso
*/
$r=$_REQUEST['r'];
$file=$_REQUEST['nombre'];
$url=$r.$file;
//echo $url;
//exit();
if (is_file($url)){
	// captutar la extension
	header ("Content-Type: application/force-download"); 
	header ("Content-Disposition: attachment;filename=$file"); 
	header ("Content-Transfer-Encoding: binary"); 
	header ("Content-Length: ".filesize($url)); 
	readfile($url);
}	
?>