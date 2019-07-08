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
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<?
$dsnombre=trim($_REQUEST['dsnombre']);
$dscom=trim($_REQUEST['dscom']);
$dscorreocliente=trim($_REQUEST['dsemail']);


$tipo="Contacto";

//exit;
//echo $userfile2;
$id=$_REQUEST['id'];
$r=$_REQUEST['r'];
$nombre=$_REQUEST['nombre'];
	$tabla="tbldesarrollo"; // fotos
	$rutaImagen="../../../imagenes/boletin/";
	$userfile2=$_REQUEST['userfile2'];
    if($_FILES['userfile2']['name']<>"") {	   
			$temp_name = $_FILES['userfile2']['tmp_name'];
			$nombre1=date("ymdhms").$_FILES['userfile2']['name'];
			if (move_uploaded_file($temp_name,$rutaImagen.$nombre1)) { 
				$message2=$nombre1;
			} else { 
				$message2 = "NO";
			}						
	}
	

if ($dsnombre<>"") { 

		$asunto="Solicitud de busqueda con  ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";	
		$cuerpo.="Se ha generado un $asunto:<br>";	
		$cuerpo.="Nombre: $dsnombre <br>";						
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";	
		$cuerpo.="Correo electrónico: <u>$dscorreocliente</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";	
		$cuerpo.="IP remota: <br>$remoto<br><br>";
		$cuerpo.="==============================================================<br>";	
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
		
		//echo $cuerpo;
		//exit();
		
		$dsnombre=reemplazar($dsnombre);
		$dscorreocliente=reemplazar($dscorreocliente);
		$dscom=reemplazar($dscom);
		
		//almacenar en base de datos
		$sql="insert into  tblbuscador( ";
		$sql.="dsnombre,dscorreocliente,dscom";
		$sql.=",dsfecha,dsremoto,dsreferido";
		$sql.=") values (";
		$sql.="'$dsnombre',";
		$sql.="'$dscorreocliente','$dscom',";
		$sql.="'$fechaBaseLarga','$remoto','$referido')";
		//echo $sql;
		$db->Execute($sql);//exit();
	
		$sql="select dscorreo1,dscorreo2 from tblempresa";
		$resultb = $db->Execute($sql);
		$atac="";
		if (!$resultb->EOF) {
			$dscorreobase0=trim($resultb->fields[0]);
			if ($dscorreobase0<>"") mail($dscorreobase0,$asunto,$cuerpo,$headers); 
			$dscorreobase1=trim($resultb->fields[1]);
			if ($dscorreobase1<>"") mail($dscorreobase1,$asunto,$cuerpo,$headers);  
		}
		//mail("jvanegas@comprandofacil.com",$asunto,$cuerpo,$headers);  
		$resultb->Close();
		


/*
include_once('../../PHPMailer_v5.1/class.phpmailer.php');
include("../../PHPMailer_v5.1/class.smtp.php"); 
 
$mail=new PHPMailer();

$cuerpo=eregi_replace("[\]",'',$cuerpo);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $correobase; // SMTP username
$mail->Password = $clavebase; // SMTP password

$mail->Host       = $smtpbase; // SMTP server
$mail->From       = $correobase;
$mail->FromName   = "Solicitud de Contacto";
$mail->Subject    = $asunto;
$mail->IsHTML(true);
$mail->MsgHTML($cuerpo);

		// enviar aviso de contactenos a los de la configuracion
		$sql="select dscorreo1,dscorreo2 from tblempresa";
		$resultb = $db->Execute($sql);
		$atac="";
		if (!$resultb->EOF) {
			$dscorreobase0=trim($resultb->fields[0]);
			if ($dscorreobase0<>"") $mail->AddAddress($dscorreobase0, "Holasa"); 
			$dscorreobase1=trim($resultb->fields[1]);
			if ($dscorreobase1<>"") $mail->AddAddress($dscorreobase1, "Holasa"); 
			$dscorreobase2=trim($resultb->fields[2]);
			if ($dscorreobase2<>"") $mail->AddAddress($dscorreobase2, "Holasa"); 
			$dscorreobase3=trim($resultb->fields[3]);
			if ($dscorreobase3<>"") $mail->AddAddress($dscorreobase3, "Holasa"); 
		}
		$resultb->Close();
		$mail->AddAddress("jvanegas@comprandofacil.com", "Consultor web"); 
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		  exit();
		} else {
		}
*/
		
} else { 
	$redir="../../index.php";
}		

include("../../incluidos_modulos/cerrarconexion.php");

?>
<script language="javascript">
<!--
alert("Gracias por enviar la informacion.")
location.href="<? echo $redir?>";
//alert("<? echo $dsdireccion?>");
//-->
</script>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1></body></html>