<?
// Carga x
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");


///
$tipo=$_REQUEST['tipo'];
$ap=$_REQUEST['ap'];
$campo=$_REQUEST['campo'];
if ($tipo=="") { // insertar
   // verificar y actualizar o insertar
  $sql="select a.codigo,a.lat,a.lon,a.zoom,b.campo5,b.campo7,b.campo12,b.campo15,b.campo23,b.id";
  $sql.=" from ".$prefix."tblmapas a,".$prefix."tblvallas b where 1 ";
  $sql.=" and a.codigo=b.codigo order by a.codigo asc ";
  //echo $sql;
  $result=$db->Execute($sql);
  if (!$result->EOF) {
	if ($ap=="") $data.="<br>" ;
	$data.="Sitios disponibles en el sistema:";
	if ($ap=="") $data.="<br>" ;
	$data.="<select name='paramubicar'>";
	$data.="<option value='0'>Seleccione</option>";
	while(!$result->EOF){
		$direccion=reemplazar($result->fields[4]);
		$direccion=ereg_replace("'","",$direccion);
		$direccion=ereg_replace("[#]","No. ",$direccion);
		if ($result->fields[7]=="") {
			$campo7="N/A";
		} else {
			$campo7=$result->fields[5];
		}
		$cadena=$result->fields[0]."|".$result->fields[1]."|".$result->fields[2]."|".$result->fields[3];
		$cadena.="|".reemplazar($direccion)."|".reemplazar($campo7)."|".reemplazar($result->fields[6])."|".$result->fields[7]."|".$result->fields[9];
		$cadena.="|".reemplazar($result->fields[8]);
		if ($result->fields[0]==$codigo){
			$data.="<option value='".$cadena."' selected>".$result->fields[0]."</option>";
		} else {
			$data.="<option value='".$cadena."'>".$result->fields[0]."</option>";
		}
		$result->MoveNext();
	} // fin while
	$data.="</select>";
	if ($ap=="") $data.="<br>" ;
	$data.="<input type=button name=enviar value='Ver en Mapa' onclick='ubicar(1);'><br>";
	if ($ap=="" && $campo=="") {
	//$data.="<input type=button name=enviar value='Modificar' onclick='ubicar(2);'><br>";
	$data.="<input type=button name=enviar value='Eliminar' onclick='ubicar(3);'>";
	}
  } else {
	  	$data="";
  }
  $result->Close();
 }elseif ($tipo==1)  {  // eliminar
 	$codigo=$_REQUEST['codigo'];
 	$sql=" delete from ".$prefix."tblmapas where codigo='$codigo'";
	if (!$result->EOf){
		$data="Ubicacion codigo $codigo borrada del sistema";
	} else {
		$data="Problemas con la base de datos";
	}
 }elseif ($tipo==2) {  // modificar

 } else {  // no carga datos
 } // fin si tipo

echo $data;
?>