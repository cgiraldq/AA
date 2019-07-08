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
$db->debug=true;
$data=-1;
$idtalla=$_REQUEST['idtalla'];
$idproducto=$_REQUEST['idproducto'];
$idcolor=$_REQUEST['idcolor'];
$dsunidad=$_REQUEST['dsunidad'];
$dsprecio_1=$_REQUEST['dsprecio_1'];
$dsprecio_2=$_REQUEST['dsprecio_2'];
$dsprecio_3=$_REQUEST['dsprecio_3'];
$dsprecio_4=$_REQUEST['dsprecio_4'];
$dsprecio_5=$_REQUEST['dsprecio_5'];
$dsunidad=$_REQUEST['dsunidad'];
if($dsprecio_1=="")$dsprecio_1=0;
if($dsprecio_2=="")$dsprecio_2=0;
if($dsprecio_3=="")$dsprecio_3=0;
if($dsprecio_4=="")$dsprecio_4=0;
if($dsprecio_5=="")$dsprecio_5=0;
if($dsunidad=="")$dsunidad=0;
$sql_="update ecommerce_tbltallasxtblproductos set ";
$sql_.=" dsprecio1=".$dsprecio_1;
$sql_.=",dsprecio2=".$dsprecio_2;
$sql_.=",dsprecio3=".$dsprecio_3;
$sql_.=",dsprecio4=".$dsprecio_4;
$sql_.=",dsprecio5=".$dsprecio_5;
$sql_.=",dsunidad=".$dsunidad;
$sql_.=" where id=".$idtalla;
if($db->Execute($sql_))$data=1;

include("../../../incluidos_modulos/cerrarconexion.php");
echo $data;