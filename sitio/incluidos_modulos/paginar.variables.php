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
paginacion generica
manejo de variables
*/
$result = $db->Execute($sql);
if (!$result->EOF) {
if ($maxregistros=="") $maxregistros=$maxregistrosx; 
if ($maxregistros=="") $maxregistros=50; // maximo de registros por pantalla
if ($_REQUEST['maxregistros']<>"") $maxregistros=$_REQUEST['maxregistros'];
$totalregistros=$result->RecordCount();
/////////////////////////////////// paginacion /////////////////////////////////
// datos de paginacion
if ($_REQUEST['pagina']== ""){
	$pagina_actual = 1;
} else { 
	$pagina_actual = $_REQUEST['pagina'];
}
$cant_paginas=ceil($totalregistros/$maxregistros);
if ($pagina_actual > $cant_paginas) $pagina_actual = $cant_paginas;
if ($pagina_actual < 1) $pagina_actual=1;
/////////////////////////////////// paginacion /////////////////////////////////
}
$result->Close();

?>