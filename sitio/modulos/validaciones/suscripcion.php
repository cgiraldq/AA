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
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
$redir=trim($_REQUEST['redir']);

$dstipo=trim($_REQUEST['dstipo']);
$dscorreocliente=trim($_REQUEST['dscorreo_suscrip']);
$dsrutax=trim($_REQUEST['dsrutax']);





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
	$mail->From       = $correobase;
}
//$db->debug=true;

$mail->FromName   = $autorizado;
if ($dscorreocliente<>"") {
$sqlc="select id from tblcontacto where dscorreocliente='$dscorreocliente'";
//echo $sqlc;
//exit();
$resultc = $db->Execute($sqlc);
if ($resultc->EOF) {
		$asunto="Solicitud de Suscripción al Boletín en la tienda de  ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
		$cuerpo.="$asunto<br>";
		$cuerpo.="Email: $dscorreocliente<br>";

		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";

		$cuerpo.="IP remota: <br>$remoto<br><br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";

		if($tipoenviocorreo==1){
		$mail->Subject = $asunto;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpo);
		}
		// enviar aviso de contactenos a los de la configuracion
		$sql="select dscorreo1,dscorreo2,dscorreo3,dscorreo4,dsnombre from tblempresa where id=$idtienda ";
		//echo $sql;
		$resultb = $db->Execute($sql);
       //$atac="";
       if (!$resultb->EOF) {
           $dscorreobase0=trim($resultb->fields[0]);
           $dscorreobase1=trim($resultb->fields[1]);
           $dscorreobase2=trim($resultb->fields[2]);
           $dscorreobase3=trim($resultb->fields[3]);
		   $empresa=trim($resultb->fields[4]);


           if($tipoenviocorreo==1){
           if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") $mail->AddAddress($dscorreobase0, $empresa);
           if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") $mail->AddAddress($dscorreobase1, $empresa);
           if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") $mail->AddAddress($dscorreobase2, $empresa);
           if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") $mail->AddAddress($dscorreobase3, $empresa);

           }else{
               if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") mail($dscorreobase0,$asunto,$cuerpo ,$headers);
               if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") mail($dscorreobase1,$asunto,$cuerpo ,$headers);
               if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") mail($dscorreobase2,$asunto,$cuerpo ,$headers);
               if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") mail($dscorreobase3,$asunto,$cuerpo ,$headers);
           }
       }
       $resultb->Close();
		if($tipoenviocorreo==1){
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			  //exit();
			} else {

			}
		}
		//if(trim($dscorreo)<>"")$mail->AddAddress($dscorreo, "LogrosPublicitarios");


		//almacenar en base de datos
		$sql="insert into tblcontacto ( ";
		$sql.="dscorreocliente,dstipo,dsfecha,idfecha,idtienda";
		$sql.=") values (";
		$sql.="'$dscorreocliente','$dstipo','".date("d/m/Y")."','".date("Ymd")."',1)";
		$db->Execute($sql);//exit();

		$asuntoa="Suscripción al Boletín de la tienda ".$autorizado;
		$cuerpoa.="<font face='Arial' size=-1>Apreciado <strong> $dsm $dsapellido </strong><br><br>";
		$cuerpoa.="Gracias por Suscribirse al Boletín de la tienda  ".$autorizado;
		$cuerpoa.="<br>Correo Electrócnico de la Suscripción<br>";
		$cuerpoa.="Email: $dscorreocliente<br>";
		$cuerpoa.="Fecha de registro: ".date("Y-M-d h:m:s")."<br>";
		$cuerpoa.="==============================================================<br>";
		$cuerpoa.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpoa.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
		mail($dscorreocliente,$asuntoa,$cuerpoa,$headers);

		$redir="../../gracias.php?msg=1";
}else{
	$redir="../../gracias.php?msg=2";
}
$resultc->Close();

} else {
	$redir="../../index.php";
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