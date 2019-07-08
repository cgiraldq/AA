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
$titulomodulo="Configuraci&oacute;n Codigo Promocionales";
$tabla="ecommerce_tblcodigosprom";
include("operaciones.php");?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
include($rutxx."../../incluidos_modulos/core.mensajes.php");
	$sql="select count(*) as total, a.iddistribuidor,a.dsdescuento,a.dsfechag,a.dsdescuentov,a.dsfechai,a.dsfechaf,a.idactivo,b.dsm,a.id ";
	$sql.=" from ecommerce_tblpatrocinadores b,ecommerce_tblcodigosprom a where a.iddistribuidor=b.id ";	
	$sql.=" group by a.iddistribuidor,a.dsdescuento,a.dsfechag,a.dsdescuentov,a.dsfechai,a.dsfechaf order by a.dsfechag DESC ";
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
	include("tabla.php");
	include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	$result->Close();
	include("ingreso.php");
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>