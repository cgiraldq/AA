<?
//CONSULTA EN LA BASE DE DATOS INFORMACION DEL REMITENTE				
	$sql="select idformaenvio,dsnombrerem,dscorreorem,dssmtp,dsusuariocorreo,dsclavecorreo,dspuerto from tblempresa where id>0";
	$result=$db->Execute($sql);
 	if(!$result->EOF){
  		$formaenvio=$result->fields[0];
  		$dsnombrerem=$result->fields[1];
  		$dscorreorem=$result->fields[2];
  		$dssmtp=$result->fields[3];
  		$dsusuariocorreo=$result->fields[4];
  		$clavecorreo=$result->fields[5];
  		$dspuerto=$result->fields[6];
		$dsclavecorreo=$rc4->decrypt($s3m1ll4, urldecode($clavecorreo));
	}

 
$headers= "From: $dscorreorem\n";
$headers.= "Organization: $autorizado\n";
$headers.= "MIME-Version: 1.0\n";
$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: $dscorreorem\r\n";

//ruta del mensaje desde origen a destino
$headers .= "Return-path: $dscorreorem\r\n";


$sql="select dscorreo1,dscorreo2,dscorreo3,dscorreo4 from tblempresa";
$resultb = $db->Execute($sql);

if($formaenvio==1){

//Envio con Funcion Mail

  if (!$resultb->EOF) {
		$dscorreobase0=trim($resultb->fields[0]);
		if ($dscorreobase0<>"") mail($dscorreobase0,$asunto,$cuerpo,$headers); 
			$dscorreobase1=trim($resultb->fields[1]);
			if ($dscorreobase1<>"") mail($dscorreobase1,$asunto,$cuerpo,$headers); 
			$dscorreobase2=trim($resultb->fields[2]);
			if ($dscorreobase2<>"") mail($dscorreobase2,$asunto,$cuerpo,$headers); 
			$dscorreobase3=trim($resultb->fields[3]);
			if ($dscorreobase3<>"") mail($dscorreobase3,$asunto,$cuerpo,$headers); 
		}
	$resultb->Close();
	mail($dscorreocliente,$asunto,$cuerpo,$headers);
}else{
//Envio con PHP Mailer
//	echo $dsusuariocorreo;
//	exit();
include_once('../../PHPMailer_v5.1/class.phpmailer.php');
include("../../PHPMailer_v5.1/class.smtp.php"); 
$mail=new PHPMailer();
$cuerpo=eregi_replace("[\]",'',$cuerpo);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $dsusuariocorreo; // SMTP username
$mail->Password = $dsclavecorreo; // SMTP password
$mail->Port=$dspuerto;// 

$mail->Host       = $dssmtp; // SMTP server
$mail->From       = $dscorreorem;
$mail->FromName   = $dsnombrerem;
$mail->Subject    = $asunto;
$mail->IsHTML(true);
$mail->MsgHTML($cuerpo);
			
			
			//enviar aviso de contactenos a los de la configuracion
			if (!$resultb->EOF) {
			$dscorreobase0=trim($resultb->fields[0]);
			if ($dscorreobase0<>"") $mail->AddAddress($dscorreobase0, $dsnombrerem); 
			$dscorreobase1=trim($resultb->fields[1]);
			if ($dscorreobase1<>"") $mail->AddAddress($dscorreobase1, $dsnombrerem); 
			$dscorreobase2=trim($resultb->fields[2]);
			if ($dscorreobase2<>"") $mail->AddAddress($dscorreobase2, $dsnombrerem); 
			$dscorreobase3=trim($resultb->fields[3]);
			if ($dscorreobase3<>"") $mail->AddAddress($dscorreobase3, $dsnombrerem); 
		}
		$resultb->Close();
		$mail->AddAddress($dscorreocliente, $dsnombres." ".$dsapellidos); 
		//$mail->AddAddress("consu@comprandofacil.com", "Consultor web"); 
		if(!$mail->Send()) {
		
		$asuntoerr="Problema con el PHPMailer en el sitio".$autorizado;
		$cuerpoerr.="Se ha generado un $asuntoerr:<br>";
		$cuerpoerr.="Fecha: ".date("Y/m/d h:i:s")."<br>";	
		$cuerpoerr.="Ip: $remoto<br><br>";
		$cuerpoerr.="Datos de configuracion del servidor:<br>";
		$cuerpoerr.="Nombre: $dsnombrerem<br>";	
		$cuerpoerr.="Correo: $dscorreorem<br>";	
		$cuerpoerr.="Servidor SMTP: $dssmtp<br>";		
		$cuerpoerr.="Usuario: $dsusuariocorreo<br>";	
		$cuerpoerr.="Clave: $dsclavecorreo<br>";
		$cuerpoerr.="Puerto: $dspuerto<br>";
					
			mail("consultorweb@comprandofacil.com",$asuntoerr,$cuerpoerr,$headers);
			mail("soporteweb@comprandofacil.com",$asuntoerr,$cuerpoerr,$headers);
			mail("graficoweb@comprandofacil.com",$asuntoerr,$cuerpoerr,$headers);
			
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		
		}

 }



?>
