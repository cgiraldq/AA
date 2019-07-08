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
 Validar si la referencia existe en el sistema y traer descripcion, valor unitario por presentacion
*/
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
 //$db->debug=true;
$tabla="tblproductos";
$dsref=$_REQUEST['dsref'];
$dsun=$_REQUEST['dsun'];
$idlista=$_REQUEST['idlista'];
$idprecio=$_REQUEST['idprecio'];
$sql=" select a.id,a.dsm,a.dsunidad,a.precio1,a.precio2,a.precio3,a.precio4,a.precio5,a.iva,a.dsflete";
if($dsun<>"")$sql.=",b.dsprecio1,b.dsprecio2,b.dsprecio3,b.dsprecio4,b.dsprecio5";
$sql.=" from $tabla a";
if($dsun<>"")$sql.=", tbltallasxtblproducto b";
$sql.=" where a.dsreferencia='$dsref'";
if($dsun<>"")$sql.=" and a.id=b.idorigen";
if($dsun<>"")$sql.=" and b.iddestino=".$dsun;
	$vermas=$db->Execute($sql);
	if (!$vermas->EOF) {	
	$dsdesc=$vermas->fields[1];
	if($idprecio==1||$idprecio==0){
	$dsvalor=$vermas->fields[3];			// Valor Para Producto Sin Tallas	
	if($dsun<>"")$dsvalor=$vermas->fields[10];//// Valor Para Producto Con  Tallas	
	}elseif ($idprecio==2) {
	$dsvalor=$vermas->fields[4];// Valor Para Producto Sin Tallas	
	if($dsun<>"")$dsvalor=$vermas->fields[11];// Valor Para Producto Con  Tallas	
	}elseif($idprecio==3){
	$dsvalor=$vermas->fields[5];// Valor Para Producto Sin Tallas	
	if($dsun<>"")$dsvalor=$vermas->fields[12];// Valor Para Producto Con  Tallas		
	}elseif($idprecio==4){
	$dsvalor=$vermas->fields[6];// Valor Para Producto Sin Tallas	
	if($dsun<>"")$dsvalor=$vermas->fields[13];// Valor Para Producto Con  Tallas	
	}elseif($idprecio==5){
	$dsvalor=$vermas->fields[7];// Valor Para Producto Sin Tallas		
	if($dsun<>"")$dsvalor=$vermas->fields[14];// Valor Para Producto Con  Tallas	
	}
	if($dsvalor=="")$dsvalor=$vermas->fields[3];
	$dsflete=$vermas->fields[9];
	if($dsflete=="")$dsflete=0;
	$dsiva=$vermas->fields[8];
	$data=$dsdesc."|".$dsvalor."|".$dsiva."|".$dsdesc."|".$dsflete;
} else { 
	$data="-1";
}
$vermas->Close();	
echo $data;

include ($rutxx."../../incluidos_modulos/cerrarconexion.php");
?>