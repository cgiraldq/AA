<?
// manejo de mapas
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
$delx=$_REQUEST['delx'];
$codigo=$_REQUEST['codigo'];
$coord=$_REQUEST['coord'];
$coord=ereg_replace("[(]","",$coord);
$coord=ereg_replace("[)]","",$coord);
$partir=explode(",",$coord);
$lat=$partir[0];
$lon=$partir[1];
$zoom=$_REQUEST['zoom'];
$dsicono=$_REQUEST['dsicono'];
$idpuntointeres=$_REQUEST['codigo'];
if ($idpuntointeres<>"") { 
	$tablax="tblmunicipios ";
	$sql=" update ".$tablax." set dslatitud='$lat',dslongitud='$lon',dszoom='$zoom' ";
	$sql.=" where id=".$idpuntointeres;
	if ($db->Execute($sql)) { 	
		$data="Empresa actualizada con exito.";
	} else { 

	}
}
echo $data;

exit();
?>