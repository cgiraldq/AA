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
// exportar
header("Content-type: application/octet-stream");
$nombre="exportar-".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varmensajes.php");
$titulomodulo="Inventarios - Salida y entrada de productos";
$tabla="ecommerce_tblinventarios";
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsproducto,a.dsfechalarga,a.dscom,a.idcant,a.dsusuario,a.idfactura,a.idordenpedido from $tabla a where a.id>0 ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
if ($_REQUEST['idproducto']<>"") $sql.=" and a.idproducto=".$_REQUEST['idproducto'];

$sql.=" order by a.id desc ";
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
	// fin modulo buscador
	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		$maxregistros=9999999; // maximo de registros
		include("historicos.tabla.php");
		echo "<br>";
	} // fin si
$result->Close();
?>