
<?
//session_start();
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();


 $id=$_REQUEST['idX'];
$correoenvio=$_REQUEST['correoenvio'];



//exit();
include("../../incluidos_modulos/encabezado_correo.php");



$sql="select dscontrasena,dsm,dsapellidos,dscorreocliente from tblregistro_zonaprivada where id=".$id;
//echo $sql;
$result=$db->Execute($sql);
	if(!$result->EOF){
	//$dscontrasena=$result->fields[0];
	$clavem=$result->fields[0];
	$dscontrasenanm = $rc4->decrypt($s3m1ll4, urldecode($clavem));
	//$dscontrasenanm= urldecode($dscontrasena);
	$dsm=$result->fields[1];
	$dsapellido=$result->fields[2];
	$dscorreo=trim($result->fields[3]);

			$asuntoa="Aprobacion cliente con ".$autorizado;
			$cuerpoa.="<br><font face='Arial' size=-1>Apreciado <strong> $dsm $dsapellido</strong><br>";
			//$cuerpoa.="Aprobaci&oacute;n de cliente con ".$autorizado;
			//$cuerpoa.="<br>Apreciado $nombreusuario.<br>";
			$cuerpoa.="<br>Usted ha sido activado en nuestro sistema, para ingresar en nuestra zona privada ";
			$cuerpoa.="<br>digite su usuario: $dscorreo y contrase&ntilde;a: $dscontrasenanm  <br>";
			//$cuerpoa.="Apellidos: $dsapellidos<br>";
			$cuerpoa.="==============================================================<br>";
			$cuerpoa.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
			$cuerpoa.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
			//echo $asuntoa;







    $mail->ClearAddresses();
    unset($mail);
    if($idtipoenvio==2){


      // enviar autorespuesta
      $mail=new PHPMailer();


      $mail->IsSMTP(); // telling the class to use SMTP
      $mail->SMTPAuth = true; // turn on SMTP authentication
      $mail->Username = $correobase; // SMTP username
      $mail->Password = $clavebase; // SMTP password
      $mail->Port=$dsport;//

      $mail->Host       = $smtpbase; // SMTP server
      $mail->From       = $correobase;
      $mail->FromName   = $autorizado;
      $mail->Subject = $asuntoa;
      $mail->IsHTML(true);
      $mail->MsgHTML($cuerpoa);


      $mail->AddAddress($dscorreo, $dsnombre." ".$dsapellidos);
       if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
          //exit();
        } else {

        }
        $mail->ClearAddresses();
        unset($mail);

      // fin enviar autorespuesta
    }else {

	mail($dscorreo,$asuntoa,$cuerpoa,$headers);
    }


					$sql=" update tblregistro_zonaprivada set ";
					$sql.= "idactivo=1";
					$sql.= " where id=".$id;
					$db->Execute($sql);

$redir="default.php";


} else {

//$redir="../../gracias.php?idg=1";

//}
$redir="default.php";
}
//
//exit;
//exit();
?>

<html>
<head>
<title><? echo $AppNombre;?></title>
<script language="javascript">
<!--
//alert("Envio de correo con exito.");
location.href="<? echo $redir?>";
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>