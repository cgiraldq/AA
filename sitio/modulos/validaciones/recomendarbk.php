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
$headers= "From: $correobase\n";
$headers.= "Organization: $autorizado\n";
$headers.= "MIME-Version: 1.0\n";
$headers.= "Content-Type: text/html; charset=UTF-8\n";

//exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="estilos.css" rel="stylesheet" type="text/css" />
<html>
<head>
<title>&lt;? echo $AppNombre;?&gt;</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<?
$redir=trim($_REQUEST['redir']);
$idproducto=trim($_REQUEST['idproducto']);
$dsnombre=trim($_REQUEST['dsnombre1']);
$dscorreo=trim($_REQUEST['dsemail1']);
$dsnombre2=trim($_REQUEST['dsnombre2']);
$dscorreo2=trim($_REQUEST['dscorreo2']);
$dsrutax=trim($_REQUEST['dsrutax']);

$dscom=trim($_REQUEST['dscom']);


$tipo="Recomendacion";

if($tipoenviocorreo==1){
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
$mail->From       = $correoautorizado;
$mail->FromName   = $autorizado;
}

if ($dsnombre<>"" && $dscom<>"") {

		$asunto="$dsnombre te recomienda que visites ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>$dsnombre2</strong>:<br><br>";
		$cuerpo.="$dsnombre te recomienda que visites a $autorizado y revises el siguiente enlace:<br><br>";
		$cuerpo.="<a href='$dsrutax'>$autorizado</a><br><br>";
		$cuerpo.="Este es el comentario de $dsnombre: <br>$dscom<br><br>";
		$cuerpo.="IP: <br>$remoto<br><br>";

		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";



		if($tipoenviocorreo==1){
		$mail->Subject = $asunto;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpo);
		}
		// enviar aviso de contactenos a los de la configuracion
		$sql="select dscorreo1,dscorreo2,dscorreo3,dscorreo4 from tblempresa";
		//echo $sql;
		$resultb = $db->Execute($sql);
		//$atac="";
		if (!$resultb->EOF) {
			$dscorreobase0=trim($resultb->fields[0]);
			$dscorreobase1=trim($resultb->fields[1]);
			$dscorreobase2=trim($resultb->fields[2]);
			$dscorreobase3=trim($resultb->fields[3]);

			if($tipoenviocorreo==1){
			if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") $mail->AddAddress($dscorreobase0, "Comprandofacil");
			if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") $mail->AddAddress($dscorreobase1, "Comprandofacil");
			if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") $mail->AddAddress($dscorreobase2, "Comprandofacil");
			if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") $mail->AddAddress($dscorreobase3, "Comprandofacil");

			}else{
				if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") mail($dscorreobase0,$asunto,$cuerpo ,$headers);
				if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") mail($dscorreobase1,$asunto,$cuerpo ,$headers);
				if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") mail($dscorreobase2,$asunto,$cuerpo ,$headers);
				if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") mail($dscorreobase3,$asunto,$cuerpo ,$headers);
			}
		}
		$resultb->Close();
		//$mail->AddAddress("consultorweb@comprandofacil.com", "Consultor web");
		if($tipoenviocorreo==1){
			//$mail->AddAddress("jmaldonado@comprandofacil.com", "Auxiliar ");
		 	$mail->AddAddress($dscorreo2,$headers);
		//$mail->AddBCC("j-edison@hotmail.com", "Auxiliar de soluciones web");
		}else{
			//mail("jmaldonado@comprandofacil.com",$asunto,$cuerpo,$headers);
			mail($dscorreo2,$headers);
			//mail("comunicaciones@logrospublicitarios.net",$asunto,$cuerpo,$headers);


		}
		if($tipoenviocorreo==1){
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			  //exit();
			} else {

			}
		}
		//if(trim($dscorreo)<>"")$mail->AddAddress($dscorreo, "LogrosPublicitarios");

		$dsnombre=reemplazar($dsnombre);
		$dsnombre2=reemplazar($dsnombre2);
		$dscorreo=reemplazar($dscorreo);
		$dscorreo2=reemplazar($dscorreo2);
		$dscom=reemplazar($dscom);


		//almacenar en base de datos
		$sql="insert into tblrecomendar ( ";
		$sql.="nombredesde,nombrehacia,desdecorreo,haciacorreo";
		$sql.=",dsfecha,dscom";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsnombre2','$dscorreo','$dscorreo2',";
		$sql.="'".date("Y-M-d h:m:s")."','$dscom')";
		$db->Execute($sql);
		//echo $sql;
		//exit();
		$db->Execute($sql);//exit();
} else {
	$redir="../../gracias.php?dsrutax=$dsrutax";
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