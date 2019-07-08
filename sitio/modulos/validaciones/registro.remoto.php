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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com>
  Juan Felipe S�nchez <graficoweb@comprandofacil.com>
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Script generico de envio de datos via formulario
*/
session_start();

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");

$rc4 = new rc4crypt();

$redir=trim($_REQUEST['redir']);
$desdesitio=trim($_REQUEST['desdesitio']);
//dsm,dsapellido,dscorreo,dsclave,dsclave2";
$dsnombre=trim($_REQUEST['dsnombre']);
$dsapellidos=trim($_REQUEST['dsapellidos']);
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dstipoidentificacion=trim($_REQUEST['dstipoidentificacion']);
$dsidentificacion=trim($_REQUEST['dsidentificacion']);
$dsdia=trim($_REQUEST['dsdia']);
$dsmes=trim($_REQUEST['dsmes']);
$dsanio=trim($_REQUEST['dsanio']);
$idfechanacimiento=$dsanio.$dsmes.$dsdia;
$dstelefono=trim($_REQUEST['dstelefono']);
$dstelefono2=trim($_REQUEST['dstelefono2']);
$dsmovil=trim($_REQUEST['dsmovil']);
$dsfax=trim($_REQUEST['dsfax']);
$dsdireccion=trim($_REQUEST['dsdireccion']);
$dsempresa=trim($_REQUEST['dsempresa']);
$dscargo=trim($_REQUEST['dscargo']);
$dsclave=trim($_REQUEST['dsclave']);
$dsfecha =trim($_REQUEST['dsfecha']);
$dsciudad=trim(reemplazar($_REQUEST['dsciudad']));
$dscodigo=trim(reemplazar($_REQUEST['dscodigo']));
$idtienda=$_REQUEST['idtienda'];
$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
$dsclave = urlencode($clavee);


if($tipoenviocorreo==1){
include_once('../../PHPMailer_v5.1/class.phpmailer.php');
include("../../PHPMailer_v5.1/class.smtp.php");

$mail=new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $correobase; // SMTP username
$mail->Password = $clavebase; // SMTP password
$mail->Port=$dsport;//

$mail->Host       = $smtpbase; // SMTP server
$mail->From       = $correobase;
}
$mail->FromName   = $autorizado;


//exit;
if ($dsnombre<>"" &&  $dscorreocliente<>"" && $dsclave<>"" && $_REQUEST['captcha']<>"") {
//echo "entro con validacion";
	//exit;
		$sql="select id,dsnombres from tblclientes where dscorreocliente='$dscorreocliente' and idtienda=$idtienda ";
		//echo $sql;
		$resultb= $db->Execute($sql);
		if ($resultb->EOF) {
		//almacenar en base de datos
		$sql="insert into tblclientes ( ";
		$sql.="dsnombres,dsapellidos,dscorreocliente,dsclave";
		$sql.=",dsfecha,dstelefono,dsciudad,idtienda,dstipoidentificacion,dsidentificacion,idfechanacimiento,dstelefono2,dsmovil,dsfax,dsdireccion,dsempresa";
		$sql.=",dscargo,dscodigo";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellidos','$dscorreocliente','$dsclave',";
		$sql.="'".$fechaBase."','$dstelefono','$dsciudad',$idtienda,'$dstipoidentificacion','$dsidentificacion',$idfechanacimiento,'$dstelefono2','$dsmovil'";
		$sql.=",'$dsfax','$dsdireccion','$dsempresa','$dscargo','$dscodigo')";
		//echo $sql;
		//exit;
		$db->Execute($sql);//exit();
		/*	$sql="select id,dsnombres from tblclientes where dscorreocliente='$dscorreocliente' and idtienda=$idtienda ";
			//echo $sql;
			$resultx= $db->Execute($sqlx);
			if (!$resultx->EOF) {
				$id=$resultx->fields[0];
				 $dsnombres=reemplazar($resultx->fields[1]);
						$sql=" update tblclientes set ";
						$sql.=" dsnombres='$dsnombre'";
						$sql.=",dsapellidos='$dsapellidos'";
						$sql.=",dstipoidentificacion='$dstipoidentificacion'";
						$sql.=",dsidentificacion='$dsidentificacion'";
						$sql.=",dsfechanacimiento='$dsfechanacimiento'";
						$sql.=",idfechanacimiento='$idfechanacimiento'";
						$sql.=",dscorreocliente='$dscorreocliente'";
						$sql.=",dstelefono='$dstelefono'";
						$sql.=",dstelefono2='$dstelefono2'";
						$sql.=",dsmovil='$dsmovil'";
						$sql.=",dsdireccion='$dsdireccion'";
						$sql.=",dsfax='$dsfax'";
						$sql.=",dsempresa='$dsempresa'";
						$sql.=",dscargo='$dscargo'";
						$sql.=",dsciudad='$dsciudad'";
						$sql.=",dsdepartamento='$dsdepartamento'";
						//$sql.=",dsfacebook='$dsfacebook'";
						//$sql.=",dstwitter='$dstwitter'";
						$sql.=",dscodigo='$dscodigo'";
						$sql.=" where id=".$id;
						if($db->Execute($sqlx)){
							*/

		$autorizado=$_REQUEST['dedondeviene'];
		$asunto="Inscripcion en  ".$autorizado;
		$asuntoa="Gracias por registrarse en ".$autorizado;
		$cuerpo="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
		$cuerpo.="Se ha generado una $asunto:<br>";
		$cuerpo.="Nombre: $dsnombre<br>";
		$cuerpo.="Apellidos: $dsapellidos<br>";
		$cuerpo.="Tel&eacute;fono: $dstelefono<br>";
		$cuerpoa.="Tel&eacute;fono oficina : $dstelefono2<br>";
		$cuerpo.="codigo radiomunera: $dscodigo<br>";
		$cuerpo.="Correo electronico: <u>$dscorreocliente</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";
		//$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";
		$cuerpo.="IP remota: <br>$remoto<br><br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
		$cuerpo=eregi_replace("[\]",'',$cuerpo);

		$cuerpoa="<font face='Arial' size=-1>Apreciado <strong>cliente</strong>:<br><br>";
		$cuerpoa.="Estos son sus datos principales:<br>";
		$cuerpoa.="Nombre: $dsnombre<br>";
		$cuerpoa.="Apellidos: $dsapellidos<br>";
		$cuerpoa.="Tel&eacute;fono: $dstelefono<br>";
		$cuerpoa.="Tel&eacute;fono oficina : $dstelefono2<br>";
		$cuerpoa.="codigo radiomunera: $dscodigo<br>";
		$cuerpoa.="Correo electronico: <u>$dscorreocliente</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		$cuerpoa.="Fecha de registro: ".date("Y-M-d h:m:s")."<br>";
		$cuerpoa.="==============================================================<br>";
		$cuerpoa.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpoa.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
		$cuerpoa=eregi_replace("[\]",'',$cuerpoa);


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
    $mail->ClearAddresses();
    unset($mail);

    if($tipoenviocorreo==1){
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

      $mail->AddAddress($dscorreocliente, $dsnombres." ".$dsapellidos);
       if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
          //exit();
        } else {

        }
        $mail->ClearAddresses();
        unset($mail);

      // fin enviar autorespuesta
    }
				//echo "entra si no estoy registrado";
							$redir="http://www.comprandofacilenusa.com/sitio/gracias.php?idg=4";  // para redirecconar al gracias por su registro
							//if ($desdesitio==1) $redir="../../../sitio/servicio_paso3.php?idx=$id";
							//exit;
						}else{ // ejecuta resultado del update

				//echo "entra si  estoy registrado";

			$redir="http://www.comprandofacilenusa.com/sitio/contacto.php?idg=1";// para mandar usted ya se encuntra registrado
			//if ($desdesitio==1) $redir="../../../sitio/formulario.php?mensaje=1";
			//exit;
			}

} else {
	$redir="../../servicio_paso1.php?entrar=".$_REQUEST['entrar']; // en caso de envio de reigstros malicioso reenviar al index cmprandofacil en sua
}
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");

//exit();//para imprimir
?>