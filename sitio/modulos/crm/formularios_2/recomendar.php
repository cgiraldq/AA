<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores: 
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
include("../../incluidos_modulos/globales.php");
$apagar=1;

$titulomodulo="Listado de registros desde el recomendar del sitio";
$letra=$_REQUEST['letra'];
$tabla=$prefix."tbltiposformulariosxregistrosxrecomendar";
// eliminacion
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	$dstitulo="Eliminacion $titulomodulo";
	$dsdesc=" El usuario ".$i_dsnombre." elimino registro de $titulomodulo numero $idx ";
	$dsruta="../formularios/default.php";
	$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,1);

	
}
include("../../incluidos_modulos/html.encabezado.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.nombredesde,a.desdecorreo";
$sql.=",a.nombrehacia,a.haciacorreo,a.dscom,a.dsrecomendar,a.dsfecha";
$sql.=" from $tabla a where id>0 ";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.id desc  ";
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="nombredesde";
		// 2. los tipo de busqueda
		$paramb="nombredesde,desdecorreo";
		$paramn="Nombre desde,Email desde";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutamodulo="<a href='../core/core.principal.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='../formularios/default.php?dstoken=$dstokenvalidador' class='textlink' title='Listado de formularios activos para uso del sitio '>Listado de formularios activos para uso del sitio </a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	include("recomendar.tabla.php");
	include("../../incluidos_modulos/html.remate.php");?>
