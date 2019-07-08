<?
$idc=$_GET['idc'];
$tipo=$_GET['tipo'];
if ($tipo==1) $path="../../contenidos/images/productos/";
$file=rawurldecode($_GET['file']);
$partir=explode(".",$file);
if (is_file($path.$file)) {
           header("Content-Type: application/force-download"); 
           header("Content-Type: application/octet-stream");
           header("Content-Disposition: attachment;filename=".rawurlencode($file)); 
           header("Content-Transfer-Encoding: binary"); 
           header("Content-Length: ".filesize($path.$file)); 
           readfile($path.$file);
}else { 
           //die ("No se encuentra el archivo. <a href=../modulos/revista/revista.documentos.php?idc=$idc>Regresar</a>");
}
?>
