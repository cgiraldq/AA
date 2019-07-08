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
// Eliminacion Generica de datos
include("../../incluidos_modulos/modulos.globales.php");
$apagar=1;
$titulomodulo="Datos eliminados del sistema";
$titulomodulo2=$_REQUEST['titulomodulo'];
$dsrutap=$_REQUEST['dsrutap'];
$dstabla=$_REQUEST['dstabla'];
$tabla=$dstabla;
$dsruta=$dsrutap;//ruta para los logs
include("../../incluidos_modulos/modulos.eliminacion.php");
include("../../incluidos_modulos/modulos.restaurar.php");
?>
<html>
		<?include("../../incluidos_modulos/head.php");?>
<body>

	<? include("../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo from $tabla a where idactivo=9 ";
if ($idcampox<>"") $sql.=" and idcampo=$idcampox";
$sql.=" order by a.idpos asc ";
//echo $sql;
$rutaPaginacion="idreg=".$_REQUEST['idreg']."&dstabla=".$_REQUEST['dstabla']."&titulomodulo=".$_REQUEST['titulomodulo']."&xruta=".$_REQUEST['xruta'];
include("../../incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
$rutamodulo="<a href='../core/core.principal.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="<a href='$dsrutap?dstoken=$dstokenvalidador' class='textlink' title='Principal $titulomodulo2 '>$titulomodulo2</a>  /  ";
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
if (!$result->EOF) {
	include("tabla.php");
	include("../../incluidos_modulos/paginar.php");
} // fin si 
$result->Close();
		include("../../incluidos_modulos/navegador.principal.cerrar.php");

	include("../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>