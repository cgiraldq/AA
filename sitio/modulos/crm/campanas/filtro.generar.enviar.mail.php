<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/

if (comprobar_email($dscorreox) && $dscorreox<>"") {
		
		$mail=new PHPMailer();
		$cuerpo=str_replace("[\]",'',$cuerpomail);
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = $usuarioacceso; // SMTP username
		$mail->Password = $claveacceso; // SMTP password
		$mail->Port=	  $puertodeacceso;//
		$mail->Host       = $SMTP; // SMTP server
		$mail->From       = $correoremitente;
		$mail->FromName   = $dsmremitente;
		//$mail->SMTPDebug = 2;


		$mail->Subject = $asuntomail;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpo);


		if (comprobar_email($dscorreox) && $dscorreox<>"")$mail->AddAddress($dscorreox,$dscorreox);

		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		  //exit();
		} else {
			$contarenvio++;
		}


	unset($mail);


}
?>