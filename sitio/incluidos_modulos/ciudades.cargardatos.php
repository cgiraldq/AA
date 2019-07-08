<?
/*
| ----------------------------------------------------------------- |

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- | 
 Traer los datos de retenciones y descuento del cliente
 
*/
$ruta=3;
include("version.php");
include("comunes.php");
include("varconexion.php");
include("sql.injection.php");
//include("sessiones.php");


$id=$_REQUEST['id'];
$sql=" select id,dsm from tblciudades where idpais='$id'";
//echo $sql;
$result=$db->Execute($sql);
$data="<select name='idciudad'>";
if(!$result->EOF){
	
	while(!$result->EOF){
		$data.="<option value=".$result->fields[0].">".$result->fields[1]."</option>";
		$result->MoveNext();
	}
}else{
	$data.="<option value=''></option>";
}
$data.="<select>";

echo $data;
include("cerrarconexion.php");
?>