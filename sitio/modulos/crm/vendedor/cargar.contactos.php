<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- 
Cargar contactos delcliente seleccionado

*/
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
// mensajes de recuperacion de claves
$idcliente=$_REQUEST['idcliente'];
$idcontacto=$_REQUEST['idcontacto'];
$sql="Select a.id,a.dsnit,b.dsciudad";
$sql.=" from tblclientes a left join  tblciudades b on a.idciudad=b.idciudad where  ";
$sql.=" a.id=$idcliente";
//$sql.=" order by a.dsnombre ASC";
// si se cambia la fecha, se cambia el dida
// echo $sql;
// exit();
$vermas=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($vermas)>0){
		$fila=mysql_fetch_object($vermas);
		$data=$fila->dsnit."|".$fila->dsciudad;
		/*$data="<select name='idcontacto' class=textnegro2 >";
		$data.="<option value='0'>Ninguno</option>";
		while($fila=mysql_fetch_object($vermas)) {
			if ($idcontacto==$fila->id){
			$data.="<option value='".$fila->id."' selected>".reemplazar($fila->nombre)." </option>";
			} else { 
			$data.="<option value='".$fila->id."'>".reemplazar($fila->nombre)." </option>";
			}
		}
		$data.="</select>";*/
	}	 else { 
	
		/*$data="<select name='idcontacto' class=textnegro2 >";
		$data.="<option value='0'>Ninguno</option>";
		$data.="</select>";*/
	}
echo $data;	
mysql_free_result($vermas);	
include ("../../incluidos/cerrarconexion.php"); 
?>
