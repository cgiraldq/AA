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
 Script generico de envio de datos via formulario
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();

$dsnombre=trim($_REQUEST['dsnombre']);
$dscom=trim($_REQUEST['dscomentario']);
$dscorreo=trim($_REQUEST['dscorreo']);
$dsprofesion=trim($_REQUEST['dsprofesion']);
$dsedad=trim($_REQUEST['dsedad']);
//$dsactividad=trim($_REQUEST['dsactividad']);


if ($dsnombre<>"") { 

		$asunto="Solicitud de distribuidor con  ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";	
		$cuerpo.="Se ha generado una $asunto:<br>";
		$cuerpo.="Nombre: $dsnombre <br>";		
		$cuerpo.="Profesion: $dsprofesion<br>";	
		$cuerpo.="Edad: $dsedad<br>";
		//$cuerpo.="Actividad Deportiva: $dsactividad<br>";			
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";	
		$cuerpo.="Correo electrónico: <u>$dscorreo</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";	
		$cuerpo.="==============================================================<br>";	
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
		
		
  	 	include("../../incluidos_modulos/modulos.enviocorreo.php");

	
		//almacenar en base de datos
		/*$sql="insert into tblcontacto ( ";
		$sql.="dsnombre,dsapellido,dstelefono,dscorreocliente,dscom";
		$sql.=",dsfecha,idfecha,dsciudad,dsremoto,dsreferido,dspais,dsempresa,dsmovil";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellido','$dstel',";
		$sql.="'$dscorreo','$dscom',";
		$sql.="'$fechaBaseLarga',$fechaBaseNum,'$dsciudad','$remoto','$referido','$dspais','$dsempresa','$dscel')";*/
		
		//exit();
		
	$db->Execute($sql);//exit();
	$redir="../../gracias.php";
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
//alert("Gracias por enviar la informacion.");
location.href="<? echo $redir?>";
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>