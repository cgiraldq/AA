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
// principal
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");

$titulomodulo="Papelera de ayuda";
$titulomodulo2="Configuracion de ayudas";
$letra=$_REQUEST['letra'];
$tabla="tblayudas";
$orderby=$_REQUEST['orderby'];
$dsruta="../ayuda/default.php";//ruta para los logs

include("../../incluidos_modulos/modulos.eliminacion.php");
include("../../incluidos_modulos/modulos.restaurar.php");
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo from $tabla a where idactivo=9 ";
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
		include("../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="idreg=".$_REQUEST['idreg']."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];

	include("../../incluidos_modulos/paginar.variables.php");
	
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='default.php' class='textlink' title='Principal'>$titulomodulo2</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	include("../../incluidos_modulos/modulos.subencabezado.php");
		
	if (!$result->EOF) {
		include("../../incluidos_modulos/papelera.php");
		include("../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	//include("novedades.ingreso.php");
	include("../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>