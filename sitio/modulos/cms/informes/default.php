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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Configuraci&oacute;n de informes estad&iacute;sticos";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla="tblinformes";
$orderby=$_REQUEST['orderby'];
// insercion
$papelera=1;
$pruta="tbllinksr";
$dsrutaPapelera="../papelera/papelera.php?dstabla=$tabla&titulomodulo=$titulomodulo&xruta=$pruta";//ruta de la papelera
// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
include("informes.proceso.php");?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	include($rutxx."../../incluidos_modulos/core.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo from $tabla a where id>0 and idactivo<>9";
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
		$paramb="dsm";
		$paramn="Nombre";
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

		include("informes.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	include("informes.ingreso.php");

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>