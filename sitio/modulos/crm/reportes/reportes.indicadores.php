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

$idxx=$_REQUEST['idxx'];
$titulomodulo="Reporte de ".$_REQUEST['reporte'];
$letra=$_REQUEST['letra'];
$idgaleria=$_REQUEST['idgaleria'];
$tabla=$prefix."tblregistro_formularios";
$tablax=$prefix."tbltiposformulariosxcampo";
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

<?
$fechas=1;
 include($rutxx."../../incluidos_modulos/navegador.principal.php");
$dsmform="tblusuarios";
$sql="select a.id,a.dsm,a.idrol";
$sql.=" from $dsmform a";

$sql.="  where  a.id>0";

if ($_SESSION['i_idactivo']<>"1" && $_SESSION['i_idrol_admon']<>1) $sql.=" and a.idusuario=".$_SESSION['i_idusuario'];
$sql.=" and a.idactivo not in (2,9) ";
$sql.=" order by a.dsm asc  ";
	$rutaPaginacion="param=".$_REQUEST['param']."&idactivox=".$_REQUEST['idactivox']."&clasgratisx=".$_REQUEST['clasgratisx']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutamodulo="<a href='$rutxx../../modulos/core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<a href='../reportes/default.php' class='textlink' title='Listado de reportes'> Listado de reportes del CRM </a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	$parametros="?parametros=".$idxx."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo'];
	if($_SESSION['i_idperfil']==1)$exportar=0; $importar=2;// permite exportar la tabla
	include("reportes.indicadores.tabla.php");


include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>



</body>
</html>