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
include("../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Listado de Suscripciones al Boletín";
$letra=$_REQUEST['letra'];
$idtiendax=$_REQUEST['idtiendax'];
$tabla="tblcontacto";
// insercion
// eliminacion
$idx=$_REQUEST['idx'];
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  {
		$mensajes="<strong>".$men[3]."</strong>";
		$dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de $titulomodulo";
		$dsruta="../boletin/default.php";
		include("../../incluidos_modulos/logs.php");

	}
}
?>
<html>
<head>
	<?include("../../incluidos_modulos/head.php");?>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dscorreocliente,a.idtienda";
$sql.=" from $tabla a where id>0 and dstipo=3";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($idtiendax<>"") $sql.=" and a.idtienda='".$idtiendax."'";
$sql.=" order by a.id desc  ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dscorreocliente";
		// 2. los tipo de busqueda
		$paramb="dscorreocliente";
		$paramn="Email";
		$tienda=1;
		include("../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtiendax=".$_REQUEST['idtiendax'];
	include("../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$exportar=1; // permite exportar la tabla
	$parametros="?idtiendax=".$idtiendax;
	include("../../incluidos_modulos/modulos.subencabezado.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("correos.tabla.php");
		include("../../incluidos_modulos/paginar.php");
		echo "<br>";
	} // fin si
$result->Close();
	include("../../incluidos_modulos/navegador.principal.cerrar.php");

	include("../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>