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
 Recomendar un contenido
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();


//
$d=$_REQUEST['dsnombre1'];//nombredesde;
$e=$_REQUEST['dscorreo1'];//desdecorreo;
$f=$_REQUEST['dsnombre2'];//nombrehacia;
$g=$_REQUEST['dscorreo2'];//haciacorreo;
$h=$_REQUEST['dscom'];//dscom.value;

$dsrutax=$_REQUEST["ruta"];
$autorizado=str_replace("/","",$autorizado);

include("../../incluidos_modulos/encabezado_correo.php");
if ($d<>"" && $_REQUEST['captcha']<>"") {

		$asunto="$d te recomienda que visites ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>$f</strong>:<br><br>";
		$cuerpo.="$d te recomienda que visites a $autorizado y revises el siguiente enlace:<br><br>";
		$cuerpo.="<a href='http://$dsrutax'>$dsrutax</a><br><br>";
		$cuerpo.="Estos son los comentarios de $d: <br>$h<br><br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.co/'>http://www.comprandofacil.co</a></font><br>";

		$dscorreox=$g;
		$dsnombrex=$f;

		include("../../incluidos_modulos/enviadorcorreo.php");
		//almacenar en base de datos
		$sql="insert into tblrecomendar ( ";
		$sql.="id,nombredesde,nombrehacia,desdecorreo,haciacorreo,dscom,dsfecha";
		$sql.=") values (";
		$sql.="'','$d','$f','$e','$g','$h','".date("Y-m-d h:i:s")."')";
		//echo $sql;
		//exit();
		$db->Execute($sql);
	$redir="../../gracias.php?msg=5&dsrutax=$dsrutax";
} else {
	$redir="../../gracias.php?msg=5&dsrutax=$dsrutax";
}

include("../../incluidos_modulos/cerrarconexion.php");
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
//alert("Gracias por enviar la Recomendacion");
location.href="<? echo $redir?>";
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>