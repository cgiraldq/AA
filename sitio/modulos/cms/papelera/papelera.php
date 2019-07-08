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
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$apagar=1;
$titulomodulo="Datos eliminados del sistema";
$titulomodulo2=$_REQUEST['titulomodulo'];
$dsrutap=$_REQUEST['dsrutap'];
$dstabla=$_REQUEST['dstabla'];

$idy=$_REQUEST['idy'];
$idg=$_REQUEST['idg'];

$tabla=$dstabla;
$dsruta=$dsrutap;//ruta para los logs
include($rutxx."../../incluidos_modulos/modulos.eliminacion.php");
include($rutxx."../../incluidos_modulos/modulos.restaurar.php");
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idactivo from $tabla a where idactivo=9 ";
if ($idcampox<>"") $sql.=" and idcampo=$idcampox";
$sql.=" order by a.idpos asc ";
//echo $sql;
$rutaPaginacion="idreg=".$_REQUEST['idreg']."&dstabla=".$_REQUEST['dstabla']."&titulomodulo=".$_REQUEST['titulomodulo']."&xruta=".$_REQUEST['xruta'];
include($rutxx."../../incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="<a href='$rutxx$dsrutap?idy=$idy&idg=$idg' class='textlink' title='$titulomodulo2'>$titulomodulo2</a>  /  ";
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
//echo $dsrutap;
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
if (!$result->EOF) {
	include("tabla.php");
	include($rutxx."../../incluidos_modulos/paginar.php");
} // fin si
$result->Close();
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>