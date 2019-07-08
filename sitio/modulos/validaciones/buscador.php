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
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();
$redir=trim($_REQUEST['redir']);

$dsnombre=trim($_REQUEST['dsnombre']);
$dsapellidos=trim($_REQUEST['dsapellido']);
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dscom=trim($_REQUEST['dscom']);

include("../../incluidos_modulos/encabezado_correo.php");
//$db->debug=true;

$mail->FromName   = $autorizado;
if ($dsnombre<>"" && $_REQUEST['captcha']<>"") {

		$asunto="Solicitud de busqueda en ".$autorizado;

		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
		$cuerpo.="$asunto:<br>";
		$cuerpo.="Nombre: $dsnombre<br>";
		$cuerpo.="Apellidos: $dsapellidos<br>";
		$cuerpo.="Email: $dscorreocliente<br>";
		$cuerpo.="Comentarios: $dscom<br>";
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";
		$cuerpo.="IP remota: <br>$remoto<br><br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.co/' target='_blank'>http://www.comprandofacil.co</a></font><br>";

		// enviar aviso de contactenos a los de la configuracion

       //$atac="";
      include("../../incluidos_modulos/enviadorcorreo.php");

		$sql="insert into tblbuscador ( ";
		$sql.="dsnombre,dsapellidos,dscorreocliente";
		$sql.=",dscom,dsfecha";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellidos','$dscorreocliente',";
		$sql.="'$dscom','".date("d/m/Y")."')";
		//echo $sql;
		//exit;
		$db->Execute($sql);//exit();
			$redir="../../gracias.php?msg=3";
} else {
	$redir="../../index.php";
}

include("../../incluidos_modulos/cerrarconexion.php");
//exit();//para imprimir
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