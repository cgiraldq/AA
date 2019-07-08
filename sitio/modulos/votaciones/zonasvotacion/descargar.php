<?
$path=$_GET['path'];
$file=rawurldecode($_GET['file']);
if (is_file($path.$file)){
           header("Content-Type: application/force-download"); 
           header("Content-Type: application/octet-stream");
           header("Content-Disposition: attachment;filename=".rawurlencode($file)); 
           header("Content-Transfer-Encoding: binary"); 
           header("Content-Length: ".filesize($path.$file)); 
           readfile($path.$file);
}else { 
           die ("No se encuentra el archivo. <a href=herramientas.php>Regresar</a>");
}
?>
