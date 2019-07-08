<?
$rutx=1;
$rutxx="../";


if ($_REQUEST['enviar']=="Exportar") {
header("Content-type: application/octet-stream");
$nombre="votaciongeneral_".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
}

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
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Informes Votaciones Zonas electorales";
$zona=$_REQUEST['zona'];
$tabla="tblvotacionzonaselectorales";
if ($_REQUEST['enviar']<>"Exportar") {

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	   include($rutxx."../../incluidos_modulos/core.mensajes.php");
}
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo,a.votos,a.ganadores,a.centroatencion,a.zona from $tabla a where idactivo<>999 ";


if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.zona asc ";
}
//echo $sql;

	// fin modulo buscador
	//$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	//$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <a href='default.php' class='textlink'>Administrador de votaciones</a>  /";

	if ($_REQUEST['enviar']<>"Exportar") include("tipovotacion.buscador.votaciones.php");
if ($_REQUEST['idtv']<>"") {
	$idtv=$_REQUEST['idtv'];
	$papelera=2;
	$exportardatos=1;
	$cambiarcampos="";
	if ($_REQUEST['enviar']<>"Exportar") include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		if ($_REQUEST['enviar']=="Exportar") {
			include("informes.tabla.exportar.php");
		} else {
			include("informes.tabla.php");
		}
		if ($_REQUEST['enviar']<>"Exportar") include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
}
	if ($_REQUEST['enviar']<>"Exportar") {

	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>

</body>
</html>
<? } ?>