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
//exit;
//echo "dsdsdsdsd";
//exit;
$idservicio=trim($_REQUEST['idservicio']);
$nom_servicio=seldato("dsm","id","tblservicios",$idservicio,1);//
$dsnombre=trim($_REQUEST['dsnombre']);
$dsapellidos=trim($_REQUEST['dsapellidos']);
$dsemail=trim($_REQUEST['dsemail']);
$dsempresa=trim($_REQUEST['dsempresa']);
$dscargo=trim($_REQUEST['dscargo']);
$dspais=trim($_REQUEST['dspais']);
$dsciudad=trim($_REQUEST['dsciudad']);
$dstelefono=trim($_REQUEST['dstelefono']);
$dsmovil=trim($_REQUEST['dsmovil']);
$dsdireccion=trim($_REQUEST['dsdireccion']);
$dscom=trim($_REQUEST['dscom']);
$dsfecha =trim($_REQUEST['dsfecha ']);

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
$mail->FromName   = "Herzig";
}
if ($dsnombre<>"") {
		$asunto="Solicitud de servicio con  ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";	
		$cuerpo.="Se ha generado un $asunto:<br>";	
		$cuerpo.="Servicio: $nom_servicio<br>";	
		$cuerpo.="Nombre: $dsnombre<br>";	
		$cuerpo.="Apellidos: $dsapellidos<br>";	
		$cuerpo.="Telefono: $dstelefono<br>";			
		$cuerpo.="Movil: $dsmovil<br>";
		$cuerpo.="Empresa: $dsempresa<br>";
		$cuerpo.="Cargo: $dscargo<br>";
		$cuerpo.="Pais: $dspais<br>";			
		$cuerpo.="Ciudad: $dsciudad<br>";	
		$cuerpo.="Direccion: $dsdireccion<br>";	
		$cuerpo.="Comentarios: $dscom<br>";
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";	
		$cuerpo.="Correo electrónico: <u>$dsemail</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		//$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";	
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
		$sql="select dscorreo1,dscorreo2,dscorreo3,dscorreo4 from tblempresa";
		//echo $sql;
		$resultb = $db->Execute($sql);
		//$atac="";
		if (!$resultb->EOF) {
			$dscorreobase0=trim($resultb->fields[0]);
			$dscorreobase1=trim($resultb->fields[1]);
			$dscorreobase2=trim($resultb->fields[2]);
			$dscorreobase3=trim($resultb->fields[3]);

			if($tipoenviocorreo==1){
			if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") $mail->AddAddress($dscorreobase0, "Herzig"); 
			if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") $mail->AddAddress($dscorreobase1, "Herzig"); 
			if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") $mail->AddAddress($dscorreobase2, "Herzig"); 
			if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") $mail->AddAddress($dscorreobase3, "Herzig"); 
			
			}else{
				if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") mail($dscorreobase0,$asunto,$cuerpo ,$headers); 
				if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") mail($dscorreobase1,$asunto,$cuerpo ,$headers); 
				if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") mail($dscorreobase2,$asunto,$cuerpo ,$headers); 
				if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") mail($dscorreobase3,$asunto,$cuerpo ,$headers); 
			}
		}
		$resultb->Close();
		//$mail->AddAddress("consultorweb@comprandofacil.com", "Consultor web"); 
		if($tipoenviocorreo==1){
			//$mail->AddAddress("jmaldonado@comprandofacil.com", "Auxiliar ");
		 
		//$mail->AddBCC("j-edison@hotmail.com", "Auxiliar de soluciones web"); 
		}else{
			//mail("jmaldonado@comprandofacil.com",$asunto,$cuerpo,$headers);
			//mail("comunicaciones@logrospublicitarios.net",$asunto,$cuerpo,$headers);
	

		}
		if($tipoenviocorreo==1){
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			  //exit();
			} else {
			
			}
		}		
		//if(trim($dscorreo)<>"")$mail->AddAddress($dscorreo, "LogrosPublicitarios"); 
	
		//almacenar en base de datos
		$sql="insert into tblsolicitar_servicios ( ";
		$sql.="idservicio,dsnombre,dsapellidos,dsemail,dsempresa,dscargo,dspais,dsciudad,dstelefono,dsmovil,dsdireccion";
		$sql.=",dscom,dsfecha,idactivo";
		$sql.=") values (";
		$sql.="$idservicio,'$dsnombre','$dsapellidos',";
		$sql.="'$dsemail','$dsempresa','$dscargo','$dspais','$dsciudad','$dstelefono','$dsmovil','$dsdireccion',";
		$sql.="'$dscom','".date("d/m/Y")."',1)";		
		//echo $sql;				
		//exit;
		$db->Execute($sql);//exit();
		$redir="../../gracias.solicitar.php?idg=1";
} else { 
	$redir="../../gracias.solicitar.php?idg=1";
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