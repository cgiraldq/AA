<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
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
 construye el combo de datos de nuevo 
 
*/
include ("../sessiones.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
$tabla="tblclientes";
$idclientex=$_REQUEST['idclientex'];
$sql="Select a.id,a.dsnombre,a.dscomercial,a.dsnit ";
$sql.=" from tblclientes a  where  ";
$sql.=" a.idactivo=1 ";
$sql.=" and a.dslogin<>'CSA' or dslogin is null ";
$sql.=" order by a.dsnombre ASC";



$vermas=mysql_db_query($dbase,$sql,$db);
if (mysql_num_rows($vermas)>0) { 
	$data="<select name='idcliente' class='link_negro1' onChange='CargarVariables();'>";
	$data.="<option value=''>...</option>";
	while($fila=mysql_fetch_object($vermas)) {
		// traer los datos adicionales
		if ($idclientex==$fila->id){
			$data.="<option value=".$fila->id." selected>".$fila->dsnombre." ".$fila->dsnit."</option>";
		} else{
			$data.="<option value=".$fila->id.">".$fila->dsnombre." ".$fila->dsnit."</option>";
		}
	}
	$data.="</select>";
} else { 
	$data="<select name='idcliente' class='link_negro1' onChange='CargarVariables();'>";
	$data.="<option value=''>No hay datos que listar</option>";
	$data.="</select>";
}
mysql_free_result($vermas);	
echo $data;
include ("../../incluidos/cerrarconexion.php");
?>