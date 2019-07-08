<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
Carga generica del php mailer
*/
	include_once('../../PHPMailer_v5.1/class.phpmailer.php');
	include("../../PHPMailer_v5.1/class.smtp.php"); 

$mail=new PHPMailer();
$cuerpo=str_replace("[\]",'',$cuerpo);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $usuariocorreo; // SMTP username
$mail->Password = $clavebase; // SMTP password
$mail->Port=$dsport;//
$mail->Host       = $smtpbase; // SMTP server
$mail->From       = $correobase;
$mail->FromName   = $nombreremitente;
//$mail->SMTPDebug = 2;


?>

