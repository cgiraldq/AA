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
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
//include($rutxx."../../incluidos_modulos/bloqueo.ip.php");

$titulomodulo="Listado de resultados";
$letra=$_REQUEST['letra'];
$dsm=$_REQUEST['dsm'];
$tabla="tblencuestaxip";
$tipo=$_REQUEST['tipo'];
// insercion
// eliminacion
$idx=$_REQUEST['idx'];
$idc=$_REQUEST['idc'];
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  {
		$mensajes="<strong>".$men[3]."</strong>";
		$dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de $titulomodulo de $dsm";
		$dsruta="../cms/encuesta/default.php";
		include($rutxx."../../incluidos_modulos/logs.php");

	}
}

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>


<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select b.dsm,count(*) as total  ";
$sql.=" from $tabla a inner join tblencuestarespuesta b on a.idrespuesta=b.id";
$sql.=" where a.idencuesta=$idc";
//	echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" group by b.id order by total desc  ";
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
		/*$paramb="dsnombre,dsapellido,dsmail";
		$paramn="Nombre,Apellido,Email";*/
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	//$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion="dsm=".$_REQUEST['dsm'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='$ruxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.="<a href='default.php' class='textlink' title=''>Configuracion de encuesta</a>  /  <span class='text1'>".$titulomodulo."</span>";
		$exportar=1; // permite exportar la tabla
		$parametros="?idc=".$idc;
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("encuesta.resultado.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
		echo "<br>";
	} // fin si
$result->Close();
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>