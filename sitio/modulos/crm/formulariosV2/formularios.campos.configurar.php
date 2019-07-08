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
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$db->debug=true;

$apagar=1;
$dsmform=seldato("dsm","id","framecf_tbltiposformularios",$idx,2);
$titulomodulo="Listado de los campos que componen el formulario. ( $dsmform )  ";
$tabla="framecf_tbltiposformulariosxcampo";
include("proceso.campos.php");
// modificacion rapida

$idx=$_REQUEST['idx'];
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.dsmensaje,a.idactivo,a.idtipo,a.idoblig,a.idposn,idminimo,dsdes,idtipoformulario,idpublicar,";
$sql.="idref,idselect,idbuscador,idpublicardetalle,idcodigo,idcaracteres from $tabla a where id>0 and idtipoformulario=$idx";
$sql.=" and idactivo not in (9)";

 if($idx==104)$sql.=" and a.dscampo!='dscampo2'";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.idposn asc ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
	// fin modulo buscador
		$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
		$rutamodulo="<a href='../formularios/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>/<a href='../formularios/default.php?dstoken=$dstokenvalidador' class='textlink'> Listado de formularios</a>  /  <span class='text1'>".$titulomodulo."</span>";



		include("campos.tabla.php");
		include("ingreso.campo.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>