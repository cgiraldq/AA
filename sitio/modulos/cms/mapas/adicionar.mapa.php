<?
// manejo de mapas
  $rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$delx=$_REQUEST['delx'];
$codigo=$_REQUEST['codigo'];
$coord=$_REQUEST['coord'];
$coord=ereg_replace("[(]","",$coord);
$coord=ereg_replace("[)]","",$coord);
$partir=explode(",",$coord);
$lat=$partir[0];
$lon=$partir[1];
$zoom=$_REQUEST['zoom'];
$tipo=$_REQUEST['tipo'];
if ($delx==1)  { // borrar
} else {
  // verificar y actualizar o insertar
  $sql="select id from cms_tblmapasxtienda where idtienda='$codigo' ";
  $result=$db->Execute($sql);
  if (!$result->EOF) {
  	$data="La tienda ya estaba previamente ingresada. Use 'Modificar' si desea ";
	$data.=" cambiarla de ubicacion";
  } else {
  	$sql="insert into cms_tblmapasxtienda";
	$sql.=" (idtienda,lat,lon,zoom,dsfecha,idfecha) ";
	$sql.=" values  ";
	$sql.=" ('$codigo','$lat','$lon','$zoom','$fechaBaseLarga',$fechaBaseNum) ";
  	if ($db->Execute($sql)) {
	$data="el mapa de La tienda ha sido cargado en el sistema.";
	} else {
	  	$data="Problemas al insertar en la base de datos";
	}
  }
  $result->Close();
}
echo $data;
//exit();
?>