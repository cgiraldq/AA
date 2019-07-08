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
$tipodata=$_REQUEST['tipodata'];
$valorbase=$_REQUEST['valorbase'];
$aniox=$_REQUEST['aniox'];
$idmesx=$_REQUEST['idmesx'];
$valor=$_REQUEST['param'];
$fechai=$aniox.$idmesx."01";
$fechaf=$aniox.$idmesx."31";
//$idusuario=$_REQUEST['idusuario'];
//echo $valor;
//exit();
//$data.="<ul id='livefilter-list'>";
if($_SESSION['idioma']==1){
$sql="select a.id,a.dsm,a.dsruta from blogtblblog a where a.idactivo in (1,3) and  (a.idfechain between $fechai and $fechaf)";
}

if($_SESSION['idioma']==2){
$sql="select a.id,a.dsmingles,a.dsrutaingles from blogtblblog a where a.idactivo in (1,3) and  (a.idfechain between $fechai and $fechaf)";
}
//echo $sql;
$result=$db->Execute($sql);
if(!$result->EOF){
$data="<div  id='idtipo'>";
$data="<ul>";
while(!$result->EOF){
		 $idp=$result->fields[0];
		 $dsm=$result->fields[1];
		 $dsruta=$result->fields[2];
		 //$dsrutax=$rutalocal."/blog_holasa/holasablog/".$dsruta;

		$dsrutax=$rutalocal."/mis_blogs/".$dsruta;
  			if ($rutaAmiga>1) $dsrutax="blog.php?id=".$idp;

$data.="<li><P>";
 if ($id==$valor)  $data.="<a href='$dsrutax' class='vinculo_calendario'>";
$data.="";
$data.=utf8_encode($dsm)."<P></li>";
$result->MoveNext();
}
$data.="</ul>";

$data.="</div>";
} else {

if($_SESSION['idioma']==1){
$data="No hay datos asociados. Intente de nuevo";
}
if($_SESSION['idioma']==2){
$data="There is no associated data. Try again";
}

}
$result->Close();
include ("../../incluidos_modulos/cerrarconexion.php");
echo $data;
?>
