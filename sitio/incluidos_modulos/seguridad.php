<?
/*
| ----------------------------------------------------------------- |
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

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
 Archivo Generico de carga de todos los permisos que se pueden montar en un modulo
*/
if ($_SESSION['i_idperfil']==0 ){
	$ida=1; //acceso
	$idinn=1; // ingresar
	$idmod=1; // modificar
	$iddel=1; // eliminar
	$idpp=1; // pedidos
	$idc=1; // compras
} elseif ($_SESSION['i_idperfil']=="-1") { 
	$ida=1; //acceso
	$idinn=1; // ingresar
	$idmod=1; // modificar
	$iddel=1; // eliminar
	$idpp=1; // pedidos
	$idc=1; // compras
} else { 
	$sql="select a.* from ";
	$sql.="tblmseguridad a,tblmodulos b ";
	$sql.=" where a.idu=".$_SESSION['i_idusuario'];
	$sql.=" and a.idm=b.idmodulo";
	$sql.=" and b.dsm='".$dsm."'";
//	echo $sql;
	$ssql=mysql_db_query($dbase,$sql,$db);
	if (mysql_num_rows($ssql) == 1) {
		$fila=mysql_fetch_object($ssql);
		$ida=$fila->ida; //acceso
		$idinn=$fila->idinn; // ingresar
		$idmod=$fila->idmod; // modificar
		$iddel=$fila->iddel; // eliminar
		$idpp=$fila->idpp; // pedidos
		$idc=$fila->idc; // compras
	} 
	mysql_free_result($ssql); 
		// validar por el segundo
		if ($ida==0){
			$sql="select a.* from ";
			$sql.="tblmseguridad a,tblmodulos b ";
			$sql.=" where a.idu=".$_SESSION['i_idusuario'];
			$sql.=" and a.idm=b.idmodulo";
			$sql.=" and b.dsm='".$dsm1."'";
			//	echo $sql;
			$ssql1=mysql_db_query($dbase,$sql,$db);
			if (@mysql_num_rows($ssql1) == 1) {
				$fila1=mysql_fetch_object($ssql1);
				$ida=$fila1->ida; //acceso
				$idinn=$fila1->idinn; // ingresar
				$idmod=$fila1->idmod; // modificar
				$iddel=$fila1->iddel; // eliminar
				$idpp=$fila1->idpp; // pedidos
				$idc=$fila1->idc; // compras
			}
			mysql_free_result($ssql1);		
		}
	
}
?>