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
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();

$d=$_REQUEST['dsnombre1'];//nombredesde;
$e=$_REQUEST['dscorreo1'];//desdecorreo;
$f=$_REQUEST['dsnombre2'];//nombrehacia;
$g=$_REQUEST['dscorreo2'];//haciacorreo;
$h=$_REQUEST['dscom'];//dscom.value;

?>

<?


if ($d<>"") {

		$asunto="$d te recomienda que visites ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>$f</strong>:<br><br>";
		$cuerpo.="$d te recomienda que visites a $autorizado y revises el siguiente enlace:<br><br>";
		$cuerpo.="<a href='$dsrutax'>$dsrutax</a><br><br>";
		//$cuerpo.="Estos son los comentarios de $d: <br>$h<br><br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";

		//echo $cuerpo;
		//exit();

		include("../../incluidos_modulos/modulos.enviocorreo.php");


		//almacenar en base de datos
		$sql="insert into tblrecomendar ( ";
		$sql.="id,nombredesde,nombrehacia,desdecorreo,haciacorreo,dscom,dsfecha,dstipo";
		$sql.=") values (";
		$sql.="'','$d','$f','$e','$g','$h','".date("Y-m-d h:i:s")."','$dstipo')";
		echo $sql;
		exit();

		$db->Execute($sql);
	$redir="../../index.php";
} else {
	$redir="../../index.php";
}

include("../../incluidos_modulos/cerrarconexion.php");
//exit();
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
alert("Gracias por enviar la Recomendacion");
location.href="<? echo $redir?>";
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>