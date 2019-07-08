<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2013
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// principal
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuracion de campa&ntilde;as en estrategias digitales";
$rutaImagen="../../../../contenidos/images/";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idtipo=$_REQUEST['idtipo'];

$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$idactivox=$_REQUEST['idactivox'];
$tabla="tblestrategias_campanas";
include("procesos.php");?>
<html>
<?include("../../../incluidos_modulos/head.php");?>
<body >
<? include("../../../incluidos_modulos/navegador.principal.php");?>
<?
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dsimg,a.idtipo,a.dsfechai,a.dsfechaf from $tabla a where id>0 and  idactivo not in (9) ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($idactivox<>"") $sql.=" and a.idactivo=$idactivox ";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
if ($orderby<>"") { 
	$sql.=" order by a.$orderby asc ";
} else { 
	$sql.=" order by a.dsm asc ";
}
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		$bannersx=1;
		include("../../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma&orderby=$orderby&idactivox=$idactivox";
	include("../../../incluidos_modulos/paginar.variables.php");
	
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutap="../estrategiasdigitales/campanas/default.php";
		$dsrutaPapelera="papelera.php";//ruta de la papelera
		include("../../../incluidos_modulos/modulos.subencabezado.php");
		include("tabla.php");
		include("../../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include("ingreso.php");
	
	include("../../../incluidos_modulos/navegador.principal.cerrar.php");
	include("../../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>