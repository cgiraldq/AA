<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
// operaciones genericas de relaciones de muchos a muchos
*/
//$db->debug=true;
$sqlx="select dsimg from ecommerce_tblproductoximg where  dsimg='".$imgvec[0]."'";
$resultx = $db->Execute($sqlx);
if ($resultx->EOF) {

if($imgvec[0]<>""){
$sql="insert into ecommerce_tblproductoximg (idorigen,iddestino,dsimg) values($idx,$idx,'".$imgvec[0]."')";
if($db->Execute($sql)){
$mensajes="Imagen Actualizada con exito";
}
}
}else{
$mensajes=" La Imagen ".$imgvec[0]." Ya Se Encuentra Asociada a un producto Por favor renombre su imagen";
}
$resultx->Close();


?>
