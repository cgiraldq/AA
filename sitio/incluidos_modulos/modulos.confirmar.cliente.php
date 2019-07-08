<?
	$sql="select a.dsemail,a.dsusuario,a.dsclave,a.id from $tabla a where a.id=$idc";
	$result=$db->Execute($sql);
	if(!$result->EOF){
	$dsemail=$result->fields[0];
	$dsusuario=$result->fields[1];
	$clave=$result->fields[2];
	$id=$result->fields[3];
	if (trim($clave)<>"") { 
	$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));	
	}

	$asunto="Confirmacion de activacion por  ".$autorizado;
	$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Distribuidor</strong>:<br><br>";	
	$cuerpo.="Su solicitud de registro como distribuidor ha sido aceptada:<br>";	
	$cuerpo.="Para disfrutar de nuestros servicios debes ingresar con<br>";	
	$cuerpo.="Usuario: <u>$dsusuario</u><br>";
	$cuerpo.="Clave: <u>$dsclave</u><br>";
	$cuerpo.="En: <a href='http://www.mariangelicaguerra.com/sitio/distribuidores.php'>http://www.mariangelicaguerra.com</a><br><br>";	
	$cuerpo.="==============================================================<br>";	
	$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
	$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
	

	$cuerpo=eregi_replace("[\]",'',$cuerpo);
	
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
		$mail->FromName   = "Algamar";
		$mail->Subject    = $asunto;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpo);
		$mail->AddAddress($dsemail, "Algamar"); 
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		  $mensajes="<strong>".$men[9]."</strong>";
		} else {
		$mensajes="<strong>".$men[8]."</strong>";
		}
		$sql="update tbldistribuidor set idactivo=1 where id=$id";
		$db->Execute($sql);
	}
?>
