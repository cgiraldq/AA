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
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");$apagar=1;
$titulomodulo="Configuracion de Campo seleccion unica";
$tabla="framecf_tbltiposformulariosxcampos";
$idx2=$_REQUEST['idx2'];
$idx=$_REQUEST['idx'];

$papelera=2;
$pruta="formulario";
include("proceso.tipopaises.php");
//include($rutxx."../../incluidos_modulos/html.encabezado.php");
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select id,dsm,idactivo,idcampo,dsvalor from $tabla a where idcampo='$idx' and idactivo='1'";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";

if ($_REQUEST['param']<>"") $sql.=" and LOWER(a.".$_REQUEST['campo'].") like LOWER('".$_REQUEST['param']."%')";

if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";

} else {
	$sql.=" order by a.dsm asc";

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
	$rutamodulo="<a href='../formularios/formularios.campos.configurar.php?dstoken=$dstokenvalidador&idx=$idx2' class='textlink' title='Listado de los campos que componen el formulario pedido'>Listado de los campos que componen el formulario pedido</a>  / ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		include("tipo.tablapaises.php");
	include("ingreso.tipopaises.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>