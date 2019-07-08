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
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/modulos.funciones.php");
$iddepartamento=$_REQUEST['iddepartamento'];
$iddepartamento=trim($iddepartamento);
$sql.="select a.id,a.dsm from tblciudades a,tbldepartamentosxciudad b ";
$sql.=" where a.idactivo=1 and b.iddestino=a.id and b.idorigen=$iddepartamento";
$vermas_t=$db->Execute($sql);
if(!$vermas_t->EOF){
$data="<select  name='idciudad' id='idciudad'  onclick='ocultar(mensaje)'>";
$data.="<option value=''>--Seleccione--</option>";
while (!$vermas_t->EOF) {
$idciudad=$vermas_t->fields[0];
$dsm=utf8_encode($vermas_t->fields[1]);
$data.="<option value='$idciudad' >$dsm</option>";
$vermas_t->MoveNext();
}
$data.="</select>";
}else{
$data="-1";
}$vermas_t->Close();
include("../../incluidos_modulos/cerrarconexion.php");


echo $data;