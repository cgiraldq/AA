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
//$db->debug=true;
$apagar=1;
$idx=$_REQUEST['idx'];
$dsmcampo=seldato("dsm","id","framecf_tbltiposformulariosxcampo",$idx,2);
$titulomodulo="Configuraci&oacuten de Campo selecci&oacute;n unica ( $dsmcampo )";
$tabla="framecf_tbltiposformulariosxcampos";

$idx2=$_REQUEST['idx2'];

$papelera=2;
$pruta="formulario";
include("proceso.tipo.externo.php");
//$db->debug=true;
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor,idtipoformulario,idcampo,idcodigo  ";
$sql.=" from $tabla a where id>0 and idcampo=$idx and idtipoformulario=$idx2";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.idpos asc ";
}

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
	$rutamodulo="<a href='../formularios/formularios.campos.configurar.php?dstoken=$dstokenvalidador&idx=$idx2' class='textlink' title='Listado de los campos que componen el formulario'>Listado de los campos</a>  / ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		include("tipo.externo.tabla.php");
		include("tipo.externo.ingreso.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>

</html>