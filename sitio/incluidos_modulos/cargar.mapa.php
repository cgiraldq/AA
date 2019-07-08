<?
// Carga x
$ruta=3;
include("sessiones.php");
include("version.php");
include("comunes.php");
include("varconexion.php");
include("sql.injection.php");


///

$tipo=$_REQUEST['tipo'];
$ap=$_REQUEST['ap'];
$campo=$_REQUEST['campo'];
if ($tipo=="") { // insertar
   // verificar y actualizar o insertar
  $sql="select a.id,a.lat,a.lon,a.zoom,b.dsm,b.dsd,b.dsruta";
  $sql.=" from cms_tblmapasxtienda a,cms_tbltiendas b where 1 ";
  $sql.=" and a.idtienda=b.id order by b.dsm asc ";
  //echo $sql;
  $result=$db->Execute($sql);
  if (!$result->EOF) {
	if ($ap=="") $data.="<br>" ;
	$data.="Puntos disponibles en el sistema:";
	if ($ap=="") $data.="<br>" ;
	$data.="<select name='paramubicar'>";
	$data.="<option value='0'>Seleccione</option>";
	while(!$result->EOF){

		$cadena=reemplazar($result->fields[4])."|".$result->fields[1]."|".$result->fields[2]."|".$result->fields[3]."|";
		$cadena.=reemplazar($result->fields[5])."|";
		$cadena.=reemplazar($result->fields[0]);

		if ($result->fields[0]==$id){
			$data.="<option value='".$cadena."' selected>".reemplazar($result->fields[4])."</option>";
		} else {
			$data.="<option value='".$cadena."'>".reemplazar($result->fields[4])."</option>";
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
 	$id=$_REQUEST['id'];
 	$sql=" delete from cms_tblmapasxtienda where id='$id'";
	if ($db->Execute($sql)){
		$data="Ubicacion id $id borrada del sistema";
	} else {
		$data="Problemas con la base de datos";
	}
 }elseif ($tipo==2) {  // modificar

 } else {  // no carga datos
 } // fin si tipo

echo $data;
?>