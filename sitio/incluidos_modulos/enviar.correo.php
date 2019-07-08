<?
	if ($_FILES['dsimg1']['name']<>"") {
			// borrar anterior
			$archivoanterior=$_REQUEST['archivoanterior1'];
			if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
			$temp_name = $_FILES['dsimg1']['tmp_name'];
			$nombre1=$tabla.$idx."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);	
			move_uploaded_file($temp_name,$rutaImagen.$nombre1);
		} elseif ($_REQUEST['img1']<>"") { 
		$nombre1=$_REQUEST['img1'];
	}

	
	$asunto=$dsasunto;
	$cuerpo.="<font face='Arial' size=-1>Apreciad@ <strong>$dsnombre</strong>:<br><br>";	
	$cuerpo.=$dscomentario;
	//$cuerpo.="Documentos adjunto <a href='http://www.vallasyavisos.com.co/$rutaImagen.$nombre1'";
	$cuerpo.="<br><br>Su solucitud fue contestada por: ".$funcionario."<br>";	
	$cuerpo.="==============================================================<br>";	
	$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
	$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
	include_once('../../PHPMailer_v5.1/class.phpmailer.php');
	include("../../PHPMailer_v5.1/class.smtp.php"); 
	$mail=new PHPMailer();
	$cuerpo=eregi_replace("[\]",'',$cuerpo);
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->Username = $correobase; // SMTP username
	$mail->Password = $clavebase; // SMTP password
	$mail->Port=$dsport;// 
	if($nombre1<>"")$mail->AddAttachment($rutaImagen.$nombre1);//
	$mail->Host       = $smtpbase; // SMTP server
	$mail->From       = $correobase;
	$mail->FromName   = "Vallas y avisos";
	$mail->Subject    = $asunto;
	$mail->IsHTML(true);
	$mail->MsgHTML($cuerpo);
	$mail->AddAddress($dscorreo, "Algamar");
	//echo $cuerpo;
	if(!$mail->Send()) {
		$mensajes="<strong>".$men[9]."</strong>";
		//echo "123";
	}else{
		$mensajes="<strong>".$men[10]."</strong>";
		$sqlu="update $tabla set idfuncionario='$idfunciuonario',dscomentariofun='$dscomentario',dsdoc='$nombre1' where id=$idcli";
		$db->Execute($sqlu);
	}
	
?>