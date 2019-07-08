<?
	$sql="select a.dsemail,a.dsusuario,a.dsclave from $tbl a where a.id=$idc";
	$result=$db->Execute($sql);
	if(!$result->EOF){
	$dsemail=$result->fields[0];
	$dsusuario=$result->fields[1];
	$clave=$result->fields[2];
	if (trim($clave)<>"") { 
	$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));	
	}
	$sql="select a.id,a.idtipo,a.idcantidad,b.dsm,c.dsm,a.dsvalor,a.dsdescuento,a.idproducto";
	$sql.=" from $tabla a left join tblcolor b on a.idcolor=b.id left join tbltalla c on a.idtalla=c.id where a.id>0 ";
	$sql.=" order by a.id desc  ";
	{
		if($result->fields[1]==2){
		$tbl="tblproductos";
		}
		if($result->fields[1]==1){
		$tbl="tblconjuntos";
		}
		$idproducto=$result->fields[7];
		$sqlp="select dsm from $tbl where id=$idproducto";
		//echo $sqlp;
		$resutlp=$db->Execute($sqlp);
		if(!$resutlp->EOF){
			$dsm=$resutlp->fields[0];
		}
	}

	$asunto="Confirmacion de compra por  ".$autorizado;
	$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>$tipoc</strong>:<br><br>";	
	$cuerpo.="Su solicitud de compra ha sido aceptada:<br>";	
	$cuerpo.="Compra Nro:$idcompra<br>";
	$cuerpo.="Para hacer efectiva la compra nos pondremos en contacto con usted.<br>";
	$cuerpo.="Para seguir disfrutando de nuestros servicios ingresar con<br>";	
	$cuerpo.="Usuario: <u>$dsusuario</u><br>";
	$cuerpo.="Clave: <u>$dsclave</u><br>";
	$cuerpo.="En: <a href='http://www.mariangelicaguerra.com/sitio/distribuidores.php'>http://www.mariangelicaguerra.com</a><br><br>";	
	$cuerpo.="==============================================================<br>";	
	$cuerpo.="Gracias por su compra<br>";	
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
		$mail->FromName   = "Mariangelica";
		$mail->Subject    = $asunto;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpo);
		$mail->AddAddress($dsemail, "Mariangelica"); 
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		  $mensajes="<strong>".$men[9]."</strong>";
		} else {
		$mensajes="<strong>".$men[8]."</strong>";
		}
		$sql="update tblcomprasenc set idestado=2 where idcompra=$idcompra";
		$db->Execute($sql);
	}
?>
