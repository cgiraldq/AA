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
$idcate=$_REQUEST['idcate'];
$idcate=trim($idcate);
            $data="<select  name='idsubt' id='idsubt'>";
            $data.="<option value=''>--Seleccione--</option>";
            //$db->debug=true;
            $sql="select a.id,a.dsm from ecommerce_tblsubcategoriasxcategoria a ";
            $sql.=" ,ecommerce_tblcategoriaxsubcategoria b where a.id>0 and a.idactivo not in (2,9) ";
            $sql.=" and a.id=b.idorigen  and b.iddestino=$idcate";
             $vermas=$db->Execute($sql);
            if(!$vermas->EOF){
            while (!$vermas->EOF) {
            $id=$vermas->fields[0];
            $dsm=utf8_encode($vermas->fields[1]);
            $data.="<option value='$id' if ($idsubt==$id) echo 'selected'>$dsm</option>";
            $vermas->MoveNext();
            }
            
            }$vermas->Close();
            $data.="</select>";

include("../../incluidos_modulos/cerrarconexion.php");


echo $data;