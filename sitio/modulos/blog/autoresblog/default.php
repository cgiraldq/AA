<?
/*
| ----------------------------------------------------------------- |
CF-informer
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


$titulomodulo="Listado de autores del sitio";
$dsm=$_REQUEST['dsm'];
$dstit=$_REQUEST['dstit'];
$dstitin=$_REQUEST['dstitin'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla="blogtblautores";
// insercion
$papelera=1;
$pruta="autoresblog";
$dsrutaPapelera="../papelera/papelera.php?dstabla=$tabla&titulomodulo=$titulomodulo&xruta=$pruta";//ruta de la papelera
include("proceso.php");

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.dstit,a.idpos,a.idactivo from $tabla a where id>0 and idactivo not in(9) ";
//$db->debug=true;
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_SESSION['i_ididiomas']==1) $sql.=" and a.ididioma=0 and a.idcampo=0 ";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.dsm asc ";
	    $campoletra="dsm";
		$paramb="dsm,dstit";
		$paramn="Nombre,Titulo";
	    $rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	    $rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";

		include("tabla.php");
		include("ingreso.php");
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

      	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>