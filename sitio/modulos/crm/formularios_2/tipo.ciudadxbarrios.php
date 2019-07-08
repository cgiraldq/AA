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
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$apagar=1;
$titulomodulo="Configuraci&oacute;n de Ciudades";
$tabla="framecf_tbltiposformulariosxcamposxsubcampos";
 $idxx=$_REQUEST['idxx'];
 $idy=$_REQUEST['idxy'];
$idx2=$_REQUEST['idxy'];
$dsm1=$_REQUEST['dsm1'];
$idzona=$_REQUEST['idzona'];


$papelera=22;
$pruta="formulario";
include("proceso.tipociudadxbarrio.php");
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select id,dsm,idactivo,idcampo,idtipoformulario,idcodigo from $tabla where idcampo=$idxyz";
if($idzona<>"") $sql.=" and idzona=$idzona";
if ($letra<>"") $sql.=" and ".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and ".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by $orderby asc ";
} else {
	$sql.=" order by dsm asc ";
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
	$rutamodulo="<a href='../formularios/formularios.campos.configurar.php?dstoken=$dstokenvalidador&idx=$idxyy' class='textlink' title='Listado de los campos que componen el formulario'>Listado de los campos </a>  / ";

	if($_REQUEST['idzona']==""){
	$rutamodulo.="<a href='../formularios/tipo.ciudad.php?idx=$idxx&idx2=$idxyy' class='textlink' title='$titulomodulo'> ".$titulomodulo." </a>";
}else{
	$rutamodulo.="<a href='../formularios/tipo.ciudad.php?idx=$idxyz&idx2=$idxyy' class='textlink' title='$titulomodulo'> ".$titulomodulo." </a>";

}
	$dsmbarrio=seldato("dsm","id","framecf_tbltiposformulariosxcampos",$idxyz,2);
	$rutamodulo.=" / Listado de barrios ( $dsmbarrio )";

		include("tipo.tablaciudadxbarrio.php");
	include("ingreso.tipociudadxbarrio.php");

include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>


</body>
</html>

