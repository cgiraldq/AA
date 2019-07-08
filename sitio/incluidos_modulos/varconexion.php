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
*/
// Variables de conexion a la base de datos x y con validacion de existena
$rrx="../../";
if ($ruta==1) $rrx="";
if ($ruta==2) $rrx="../$rutaInclude/";
if ($ruta==3) $rrx="../";
if ($ruta==4) $rrx="../../$rutaInclude/";
if ($rutx==1) $rrx="../../../";

include($rrx."incluidos_modulos/adodb/adodb.inc.php");
include_once($rrx."incluidos_modulos/adodb/adodb-pager.inc.php");
$tipo="mysql";
$database="admin_adriana";
$usuario="root";
$clave="";
$servidor="localhost";
$conector=2;
$keyx=""; // clave del google maps
if ($conector==2) {
	$database="c46aarango";
	$usuario="c46aarango";  //"admin_adriana";
	$clave="Ax#mQQpLzw1Jq";   // "@4dr14n42014";
	$servidor="localhost";
	//$keyx="ABQIAAAAYSUBCvpmAPfJfWFPj_gZ1BTd1C6ljYS_6pRKcLUbahhbnM0TCxTg3UqCKykRLgNIDHAYkzpIklMWQA"; // clave del google maps
	$keyx="ABQIAAAAiNWcqsemoxXLCROQfpBXtBTxXgEmXPn9ZduSVUR69xLWnnpO3xSEkN7rKskabH95e-vRP6KQMMJqBw";
}
$db = NewADOConnection($tipo);
$db->Connect($servidor, $usuario, $clave, $database);
//$db->debug=true;
?>
