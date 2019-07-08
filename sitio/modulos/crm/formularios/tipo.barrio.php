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
$titulomodulo="Configuracion de Campo seleccion unica (Barrios)";
$tabla=$prefix."tbltiposformulariosxcampos";
$idx2=$_REQUEST['idx2'];

$papelera=2;
$pruta="formulario";
include("proceso.barrio.php");
include("../../incluidos_modulos/html.encabezado.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor,idtipoformulario from $tabla a where id>0 and idactivo<>9 and idcampo	=$idx ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.idpos asc ";
}
// modulo buscador
	// 1. por cual campo se lista cuando se usa letra
	$campoletra="dsm";
	// 2. los tipo de busqueda
	$paramb="dsm";
	$paramn="Nombre";
// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$rutamodulo="<a href='../formularios/formularios.campos.configurar.php?dstoken=$dstokenvalidador&idx=$idx2' class='textlink' title='Listado de los campos que componen el formulario'>Listado de los campos que componen el formulario</a>  / ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		include("tipo.tablabarrio.php");
	include("ingreso.tipobarrio.php");
include("../../incluidos_modulos/html.remate.php");?>
