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
manejo de variables otro paginador en misma pantalla
*/
$result = $db->Execute($sql);
if (!$result->EOF) {
$maxregistros=$maxregistrosx; 
if ($_REQUEST['maxregistros']<>"") $maxregistros=$_REQUEST['maxregistros'];
$totalregistrosx=$result->RecordCount();
/////////////////////////////////// paginacion /////////////////////////////////
// datos de paginacion
if ($_REQUEST['paginax']== ""){
	$pagina_actualx = 1;
} else { 
	$pagina_actualx = $_REQUEST['paginax'];
}
$cant_paginasx=ceil($totalregistrosx/$maxregistros);
if ($pagina_actualx > $cant_paginasx) $pagina_actualx = $cant_paginasx;
if ($pagina_actualx < 1) $pagina_actualx=1;
/////////////////////////////////// paginacion /////////////////////////////////
}
$result->Close();

?>