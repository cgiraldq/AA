<?
/*
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
 Validacion de datos al ingresar y manejo de perfiles
*/
$rutx=1;
include("../../../incluidos_modulos/comunes.php");
include("../../../incluidos_modulos/varconexion.php");
//$db->debug=true;
$idtalla=$_REQUEST['idtalla'];
$idproducto=$_REQUEST['idproducto'];
$idcolor=$_REQUEST['idcolor'];
$dsunidad=$_REQUEST['dsunidad'];
$dsprecio_1=$_REQUEST['dsprecio_1'];
$dsprecio_2=$_REQUEST['dsprecio_2'];
$dsprecio_3=$_REQUEST['dsprecio_3'];
$dsprecio_4=$_REQUEST['dsprecio_4'];
$dsprecio_5=$_REQUEST['dsprecio_5'];
if($dsprecio_1=="")$dsprecio_1=0;
if($dsprecio_2=="")$dsprecio_2=0;
if($dsprecio_3=="")$dsprecio_3=0;
if($dsprecio_4=="")$dsprecio_4=0;
if($dsprecio_5=="")$dsprecio_5=0;
$data=0;
$sql="delete from ecommerce_tbltallasxtblproductos where idorigen=$idproducto and iddestino=$idtalla and idcolor=$idcolor";
$db->Execute($sql);
$sql_="insert into ecommerce_tbltallasxtblproductos(idorigen,iddestino,idcolor,dsprecio1,dsprecio2,dsprecio3,dsprecio4,dsprecio5,dsunidad)";
$sql_.="VALUES (";
$sql_.="'$idproducto','$idtalla','$idcolor','$dsprecio_1','$dsprecio_2','$dsprecio_3','$dsprecio_4','$dsprecio_5','$dsunidad')";
if($db->Execute($sql_))$data=1;
include("../../../incluidos_modulos/cerrarconexion.php");
echo $data;