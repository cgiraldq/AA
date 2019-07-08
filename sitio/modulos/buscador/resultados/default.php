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
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Resultados de busqueda";
?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
		include($rutxx."../../incluidos_modulos/core.mensajes.php");


// generacion del encabezado de acuerdo a los resultados encontrados
	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id,a.idactivo ";
	$sql.=" from tblmodulos a ";
	$sql.=" where 1  ";
	if ($_REQUEST['param']<>"") $sql.=" and (a.dsm like '%".$_REQUEST['param']."%' or a.dsd like '%".$_REQUEST['param']."%') ";

	$sql.=" order by a.dsm ASC ";

//echo $sql;

	// fin modulo buscador

	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma&orderby=$orderby&idactivox=$idactivox";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$dsrutaPapelera="papelera.php";//ruta de la papelera
		$bloqueor=1;
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("resultado.busqueda.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	$result->Close();
	?>

	<?
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>