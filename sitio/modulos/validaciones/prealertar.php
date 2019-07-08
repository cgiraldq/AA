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
 Script generico de envio de datos via formulario para prealetas
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
$redir=trim($_REQUEST['redir']);

$dsnombre=trim($_REQUEST['dsnombre']);
$dstrackingnumber=trim($_REQUEST['dstrackingnumber']);
$dsvalordeclarado=trim($_REQUEST['dsvalordeclarado']);
$dscompania=trim($_REQUEST['dscompania']);
$dstienda=trim($_REQUEST['dstienda']);
$dscom=trim($_REQUEST['dscom']);
$dsfecha =trim($_REQUEST['dsfecha']);
$dsfechallegada=trim($_REQUEST['dsfechallegada']);
// carga de archivo
$carpeta="categoria";
$rutaImagen="../../../contenidos/images/noticias/";
$nombre="archivo";
$nombreant="archivoanterior1";
$borrar=$_REQUEST['borrar1'];
$valimg=$_REQUEST['img1'];
include("../../incluidos_modulos/modulos.cargar.imagen.php");


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
$mail->FromName   = $autorizado;
if ($dsnombre<>"" && $dstrackingnumber<>"" && $dsvalordeclarado<>"" && $dscom<>"")  {
		$asunto="Solicitud de prealertar en ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";	
		$cuerpo.="Se ha generado una $asunto:<br>";	
		$cuerpo.="Nombre: $dsnombre<br>";	
		$cuerpo.="Traking number: $dstrackingnumber<br>";	
		$cuerpo.="Valor declarado: $dsvalordeclarado<br>";				
		$cuerpo.="Transportadora: $dscompania<br>";			
		//$cuerpo.="Movil: $dsmovil<br>";	
		$cuerpo.="Tienda: $dstienda<br>";	
		//$cuerpo.="Direccion: $dsdireccion<br>";	
		$cuerpo.="Descripcion Mercancia: $dscom<br>";
		$cuerpo.="Fecha estimada llegada mercancia: $dsfechallegada<br>";

		if ($imgvec[0]<>"") $cuerpo.="Archivo prueba de compra: <a href='http://$autorizado/contenidos/images/noticias/".$imgvec[0]."' target='_blank'>Ver archivo</a><br>";
		
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";	
		$cuerpo.="Correo electrónico: <u>".$_SESSION['i_dscorreo']."</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		//$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";	
		$cuerpo.="IP remota: $remoto<br><br>";
		$cuerpo.="==============================================================<br>";	
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";


		//echo $cuerpo;				
		//exit;
		

		if($tipoenviocorreo==1){
		$mail->Subject = $asunto;
		$mail->IsHTML(true);
		$mail->MsgHTML($cuerpo);
		}
		// enviar aviso de contactenos a los de la configuracion
		$sql="select dscorreo1,dscorreo2,dscorreo3,dscorreo4,title from tblempresa where id=$idtienda ";
		//echo $sql;
		$resultb = $db->Execute($sql);
       //$atac="";
       if (!$resultb->EOF) {
           $dscorreobase0=trim($resultb->fields[0]);
           $dscorreobase1=trim($resultb->fields[1]);
           $dscorreobase2=trim($resultb->fields[2]);
           $dscorreobase3=trim($resultb->fields[3]);
		   $empresa=trim($resultb->fields[3]);


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
		//$mail->AddAddress("consultorweb@comprandofacil.com", "Consultor web"); 
		if($tipoenviocorreo==1){
			//$mail->AddAddress("consultorweb@comprandofacil.com", "Auxiliar ");
		 
		//$mail->AddBCC("j-edison@hotmail.com", "Auxiliar de soluciones web"); 
		}else{
			//mail("consultorweb@comprandofacil.com",$asunto,$cuerpo,$headers);
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
		
		if ($contacto==1) {
		//almacenar en base de datos
		$sql="insert into tblcontacto_corporativo ( ";
		$sql.="dsnombre,dsapellidos,dscorreocliente,dstelefono,dsciudad";
		$sql.=",dscom,dsfecha";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellidos','$dscorreocliente','$dstelefono','$dsciudad',";
		$sql.="'$dscom','".date("d/m/Y")."')";		
		//echo $sql;				
		//exit;
		$db->Execute($sql);//exit();
					$redir="../../../sitio/gracias.php";

	} else {	
		$sql="insert into tblcontacto_prealertas ( ";
		$sql.="idcliente,dsnombre,dstrackingnumber,dsvalordeclarado,dscompania,dstienda,dsarchivo,dscorreocliente";
		$sql.=",dscom,dsfecha,idfecha,idtienda,dsautorizado,dsfechallegada";
		$sql.=") values (";
		$sql.="".$_SESSION['i_idcliente'].",'$dsnombre','$dstrackingnumber','$dsvalordeclarado','$dscompania','$dstienda',";
		$sql.="'".$imgvec[0]."','".$_SESSION['i_dscorreo']."','$dscom','".date("Y/m/d H:i:s a")."','".date("Ymd")."',$idtienda,'$autorizado','$dsfechallegada')";		
		$db->Execute($sql);//exit();

			$redir="../../zona.privada.php?mensaje=Pre alerta cargada en el sistema";

	}	
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