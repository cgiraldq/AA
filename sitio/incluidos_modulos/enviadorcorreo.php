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
Procque de envia correo a las cuenta de la empresa configuradas
*/

// por defecto el envio de correo es mail
if ($idx>0) {
		// enviar aviso de contactenos a los de la configuracion
		$sql1="select dscorreo1,dscorreo2,dscorreo3 from framecf_tbltiposformularios where id=$idx";
		//echo $sql1;
		$resultb = $db->Execute($sql1);
		//$atac="";
		if (!$resultb->EOF) {
		    $dscorreobase0=trim($resultb->fields[0]);
			$dscorreobase1=trim($resultb->fields[1]);
			$dscorreobase2=trim($resultb->fields[2]);


			if($idtipoenvio==2){
				$mail->Subject = $asunto;
				$mail->IsHTML(true);
				$mail->MsgHTML($cuerpox);

			if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") $mail->AddAddress($dscorreobase0,$dscorreobase0);
			if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") $mail->AddAddress($dscorreobase1,$dscorreobase1);
			if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") $mail->AddAddress($dscorreobase2,$dscorreobase2);


			}else{
				if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") mail($dscorreobase0,$asunto,$cuerpox ,$headers);
				if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") mail($dscorreobase1,$asunto,$cuerpox ,$headers);
				if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") mail($dscorreobase2,$asunto,$cuerpox ,$headers);
			}
		}
		$resultb->Close();

		if(!$mail->Send()) {
			 // echo "Mailer Error: " . $mail->ErrorInfo;
			  //exit();
			} else {

			}

		unset($mail);
}
//auto respesta

if (comprobar_email($dscorreox) && $dscorreox<>"") {
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




		if($idtipoenvio==2){

			$mail->Subject = $asuntoa;
			$mail->IsHTML(true);
			$mail->MsgHTML($cuerpo);


			if (comprobar_email($dscorreox) && $dscorreox<>"")$mail->AddAddress($dscorreox,$dscorreox);

			if(!$mail->Send()) {
			  //echo "Mailer Error: " . $mail->ErrorInfo;
			  //exit();
			} else {

			}




		}
	unset($mail);


}

if (comprobar_email($dscorreo2) && $dscorreo2<>"") {
		$mail=new PHPMailer();
		$cuerpo=str_replace("[\]",'',$cuerpo2);
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = $usuariocorreo; // SMTP username
		$mail->Password = $clavebase; // SMTP password
		$mail->Port=$dsport;//
		$mail->Host       = $smtpbase; // SMTP server
		$mail->From       = $correobase;
		$mail->FromName   = $nombreremitente;
		//$mail->SMTPDebug = 2;




		if($idtipoenvio==2){

			$mail->Subject = $asunto2;
			$mail->IsHTML(true);
			$mail->MsgHTML($cuerpo2);


			if (comprobar_email($dscorreo2) && $dscorreo2<>"")$mail->AddAddress($dscorreo2,$dscorreo2);

			if(!$mail->Send()) {
			  //echo "Mailer Error: " . $mail->ErrorInfo;
			  //exit();
			} else {

			}




		}
	unset($mail);


}

?>

