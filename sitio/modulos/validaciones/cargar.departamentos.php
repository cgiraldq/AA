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
$idpais=$_REQUEST['idpais'];
$idpais=trim($idpais);
$sql.="select a.id,a.dsm from tbldepartamentos a,tblpaisxdepartamento b ";
$sql.=" where a.idactivo=1 and b.iddestino=a.id and b.idorigen=$idpais";
$vermas_t=$db->Execute($sql);
if(!$vermas_t->EOF){
$data="<select  name='iddepartamento' id='iddepartamento'  onclick='ocultar(mensaje)'>";
$data.="<option value=''>-- Seleccione estado --</option>";
while (!$vermas_t->EOF) {
$iddepartamento=$vermas_t->fields[0];
$dsm=utf8_encode($vermas_t->fields[1]);
$data.="<option value='$iddepartamento'>$dsm</option>";
$vermas_t->MoveNext();
}
$data.="</select>";
}else{
$data="<option value=''>-- Seleccione estado --</option>";
}$vermas_t->Close();
include("../../incluidos_modulos/cerrarconexion.php");


echo $data;