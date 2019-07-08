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
  Juan Fernando Fern&aacute;ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S&aacute;nchez <graficoweb@comprandofacil.com> - Dise&ntilde;o
  Jos&eacute; Fernando Pe&ntilde;a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
paginacion generica
manejo de variables
*/
//echo $sql;
$result = $db->Execute($sql);


if (!$result->EOF) {
if ($maxregistros=="") $maxregistros=50; // maximo de registros por pantalla
if ($_REQUEST['maxregistros']<>"") $maxregistros=$_REQUEST['maxregistros'];
$totalregistros=$result->RecordCount();
//exit;
/////////////////////////////////// paginacion /////////////////////////////////
// datos de paginacion
if ($_REQUEST['page']==""){
	$pagina_actual = 1;
} else { 
	$pagina_actual = $_REQUEST['page'];
}
$cant_paginas=ceil($totalregistros/$maxregistros);
if ($pagina_actual > $cant_paginas) $pagina_actual = $cant_paginas;
if ($pagina_actual < 1) $pagina_actual=1;
/////////////////////////////////// paginacion /////////////////////////////////
}
$result->Close();

?>