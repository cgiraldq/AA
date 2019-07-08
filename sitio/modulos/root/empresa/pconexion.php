<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Probar conexion</title>
<? include("../../../incluidos_modulos/sub.encabezado.php");?>
</head>

<body>
<?
echo $nomb=$_REQUEST['nombcorreo'];
echo "<br>";
echo $correo=$_REQUEST['correo'];
echo "<br>";
echo $smtp=$_REQUEST['smtp'];
echo "<br>";
echo $usuario=$_REQUEST['usuario'];
echo "<br>";
echo $clave=$_REQUEST['clave'];
echo "<br>";
echo $puerto=$_REQUEST['puerto'];
echo "<br>";


	$asunto="Prueba de conexion";
	$cuerpo="Este correo es una prueba de conexion con el servidor<br>";


include_once('../../../PHPMailer_v5.1/class.phpmailer.php');
include("../../../PHPMailer_v5.1/class.smtp.php");
$mail=new PHPMailer();
$cuerpo=eregi_replace("[\]",'',$cuerpo);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $usuario; // SMTP username
$mail->Password = $clave; // SMTP password
$mail->Port=$puerto;//

$mail->Host       = $smtp; // SMTP server
$mail->From       = $correo;
$mail->FromName   = $nomb;
$mail->Subject    = $asunto;
$mail->IsHTML(true);
$mail->MsgHTML($cuerpo);

$mail->AddAddress($correo, "tvcamaras");
  if(!$mail->Send()) {
   $envio=1;
   $mensaje="NO SE PUDO ESTABLECER CONEXION";
  }else{
   $envio=0;
   $mensaje="CONECTADO CON ÉXITO AL SERVIDOR";
  }
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<table width="70%" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td width="6" align="left" valign="top">
            <img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" />
          </td>

          <td width="615" align="left" valign="middle" background="../../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">
            Resultado de la prueba de conexi&oacute;n
          </td>
        </tr>
</table>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="text1" bgcolor="#CCCCCC"
width=70% class="text1" bgcolor="#CCCCCC"
width=70% class="campos_ingreso">
<tr valign=top bgcolor="#FFFFFF">
<td align="center"><? echo $mensaje?></td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td align="center"><a href="javascript:cerrarcon()" style="color:red">cerrar</a></td>
</tr>

</table>

</body>

</html>

<script>
function cerrarcon(){
 window.close();
}
</script>
