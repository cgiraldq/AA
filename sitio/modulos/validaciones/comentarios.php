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
 Registro de cliente en el sistema
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();

//$redir="../../registrarse.php";
//$rutax=$_REQUEST['ruta'];
$idc=$_REQUEST['idcx'];
$dsnombre=trim($_REQUEST['dsnombre']);
$dsemail=trim($_REQUEST['dsemail']);
$dscom=trim($_REQUEST['dscom']);
//echo $dscorreo;
//exit();

include_once('../../PHPMailer_v5.1/class.phpmailer.php');
include("../../PHPMailer_v5.1/class.smtp.php"); 
$mail=new PHPMailer();
$cuerpo=eregi_replace("[\]",'',$cuerpo);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $correobase; // SMTP username
$mail->Password = $clavebase; // SMTP password
$mail->Port=$dsport;// 

$mail->Host       = $smtpbase; // SMTP server
$mail->From       = $correobase;
$mail->FromName   = "herzig.com.co";

$sql="insert into tblcomentarios (dsnombre,dsemail,dscom,dsfecha,idactivo,idnoticia) values('$dsnombre','$dsemail','$dscom','".date("d/m/Y")."',1,$idc)";
//echo $sql;
//exit;
$result = $db->Execute($sql);
		
 		$asuntoa="Comentario en $autorizado";
 		$cuerpoa.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
 		$cuerpoa.="Se ha generado un $asuntoa:<br>";
 		$cuerpoa.="Nombre: $dsnombre<br>";				
		$cuerpoa.="Email: $dsemail<br>";				
		$cuerpoa.="Comentario:$dscom<br>";				
		$cuerpoa.="Fecha: ".date("Y-m-d")."<br><br>";	
		$cuerpoa.="<strong>Para habilitar el comentario por favor ingrese al administrador de contenidos<br></strong>";	
		$cuerpoa.="==============================================================<br>";	
		$cuerpoa.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpoa.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
		//	
	

		$cuerpoa=eregi_replace("[\]",'',$cuerpoa);
		$mail->Subject    = $asuntoa;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpoa);
		$mail->AddAddress("jmaldonado@comprandofacil.com"); 
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		 //exit();
		} else {
		}
 		$redir="../../noticias_detalle.php?idc=".$_REQUEST['idcx'];// 2
 		$alert="Su comentario se ha enviado satisfactoriamente";
 	include("../../incluidos_modulos/cerrarconexion.php");
//	exit();
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
alert('<? echo $alert?>');
location.href="<? echo $redir;?>";
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>