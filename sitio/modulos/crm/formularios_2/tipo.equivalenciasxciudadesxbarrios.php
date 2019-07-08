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
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$apagar=1;
$idx=$_REQUEST['idx'];
$idx2=$_REQUEST['idx2'];
$idx3=$_REQUEST['idx3'];
$idx4=$_REQUEST['idx4'];


$dscampo=seldato("dsm","id","framecf_tbltiposformulariosxcampos",$idx3,2);
$titulomodulo="Configuraci&oacuten de equivalencias ( $dscampo )";
$tabla=" framecf_tbltiposformulariosxequivalenciasxciudadesxbarrios";


$papelera=5;
$pruta="formulario";
include("proceso.equivalenciasxciudadesxbarrios.php");
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor,idtipoformulario,idcampo,idcodigo,idwebservice ";
$sql.=" from $tabla a where id>0 and idactivo not in(9) and idcampo=$idx and idtipoformulario=$idx2 and idsubcampo=$idx3 and idbarrio=$idx4";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";

	$sql.=" order by a.id asc ";

//echo $sql;
// modulo buscador
	// 1. por cual campo se lista cuando se usa letra
	$campoletra="dsm";
	// 2. los tipo de busqueda
	$paramb="dsm";
	$paramn="Nombre";
// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$rutamodulo="<a href='../formularios/formularios.campos.configurar.php?idx=$idx2' class='textlink' title='Listado de los campos que componen el formulario'>Listado de los campos</a>  / ";

	$rutamodulo.="<a href='../formularios/tipo.ciudad.php?idx=$idx3&idx2=$idx2' class='textlink' title='Listado de los campos que componen el formulario'>Listado de los ciudades</a>  / ";

	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	include("tipo.equivalencia.tabla.php");
	include("ingreso.equivalencia.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>

</html>