<?
// Carga x

include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
///
$val=$_REQUEST['val'];
$tipo=$_REQUEST['tipo'];
$ap=$_REQUEST['ap'];
$campo=$_REQUEST['campo'];
if ($tipo=="1") { // puntos de interes
   // verificar y actualizar o insertar
	// 1. cargar los sitio de interes
		$sql="select a.id,a.dsm,a.dslatitud,a.dslongitud,a.dszoom";
		$sql.=" from tblmunicipios  a ";
		$sql.=" where a.idactivo not in (2)  and a.dslatitud<>'' and a.dslongitud<>'' and a.dszoom<>'' ";
		$sql.=" order by a.dsnombre asc  ";
	 //  echo $sql;
	  // exit();
	  $result=$db->Execute($sql);
	  $data="Empresas cargadas en el sistema:<br>";
	  if (!$result->EOF) { 
		$data.="<select name='paramubicar'>";
		$data.="<option value='0'>Seleccione</option>";	
		while(!$result->EOF) {
			$cadena=$result->fields[0]."|".reemplazar($result->fields[1])."|".$result->fields[2]."|".$result->fields[3]."|".$result->fields[4];
			$cadena.="|0|".reemplazar($result->fields[5]);
			if ($result->fields[0]==$codigo){ 
				$data.="<option value='".$cadena."' selected>".reemplazar($result->fields[1])."</option>";	
			} else { 
				$data.="<option value='".$cadena."'>".reemplazar($result->fields[1])."</option>";	
			}
			$result->MoveNext();
		} // fin while
	} // fin si 	
	 
	  $data.="</select>";
	$data.="<br>" ;
	$data.="<input type=button name=enviar value='Ver en Mapa' onclick='ubicar(1);'> ";
	$data.="<input type=button name=enviar value='Eliminar' onclick='ubicar(3);'>";
	$result->Close();
}elseif ($tipo==3)  {  // eliminar
 	$codigo=$_REQUEST['codigo'];
 	$sql=" update tblmunicipios set dslatatitud='',dslongitud='',dszoom='' where id='$codigo'";
	if ($db->Execute($sql)){
		$data="Ubicacion de la empresa $codigo limpiada del sistema";
	} else { 

	}
 }elseif ($tipo==2) {  // modificar
 	
 } else {  // no carga datos
 } // fin si tipo

echo $data; 
//
exit();
?>