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
//$db->debug=true;
$codigo=$_REQUEST['codigo'];
$dsfechag=$_REQUEST['dsfechag'];
$iddistribuidor=$_REQUEST['iddistribuidor'];
$titulomodulo="Configuraci&oacute;n Codigo Promocionales";
$rutaImagen="../../../../contenidos/images/ecommerce_patrocinadores/";
$tabla="ecommerce_tblcodigosprom";


?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body style="background: #fff">
<? //include($rutxx."../../incluidos_modulos/navegador.principal.php");
//include($rutxx."../../incluidos_modulos/core.mensajes.php");
	$sql="select a.*";
	$sql.=" from $tabla a where 1";
	if ($iddistribuidor<>"") $sql.=" and a.iddistribuidor=$iddistribuidor and dsfechag='$dsfechag'";
	if($codigo<>"")$sql.=" and a.codigo='$codigo' ";	
	$area1.=" order by id desc ";
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutaPapelera="papelera.php";//ruta de la papelera

		//include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		include("tabla.imprimir.php");
		//include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();

	//		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	//include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>
<script language="javascript">
<!--
<? if ($no==""){?>
function imprimir(){
	document.getElementById('capa_impresion').style.display='none';
	window.print();
}
<? } ?>
//-->
</script>