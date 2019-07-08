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
include("../../incluidos_modulos/globales.php");
$apagar=1;
$titulomodulo="Listado de registros de clientes activos para uso del sitio";
$tabla=$prefix."tbltiposformulariosxregistrosxregistro";
$papelera=1;
$exportar=1; // permite exportar la tabla
$pruta="formularios";
$pruta1="registrese.php";
include("registrese.proceso.php");
include("../../incluidos_modulos/html.encabezado.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo,a.dstelefono,a.dscorreocliente,a.dscontrasena,a.dsfecha,";//6
$sql.=" a.dsapellidos,a.dspais,a.dsdireccion,a.dsciudad,a.dstipo from $tabla a where id>0 and idactivo<>9";
//echo $sql;
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
		$paramb="dsm,dstelefono,dsapellidos,dsciudad,dspais";
		$paramn="Nombre,Telefono,Apellidos,Ciudad,Pais";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$rutamodulo="<a href='../core/core.principal.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

		include("registrese.tabla.php");
		include("../../incluidos_modulos/paginar.php");
	include("registrese.ingreso.php");
	include("../../incluidos_modulos/html.remate.php");?>
