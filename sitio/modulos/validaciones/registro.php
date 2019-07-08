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
$apagarsql=1;

include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/class.rc4crypt.php");

$rc4 = new rc4crypt();
//$db->debug=true;
$redir=trim($_REQUEST['redir']);
$desdesitio=trim($_REQUEST['desdesitio']);
//dsm,dsapellido,dscorreo,dsclave,dsclave2";
$dsempresa=trim($_REQUEST['dsempresa']);
$dslogin=trim($_REQUEST['dslogin']);
$idactivocorreo=1;
$dsnombre=trim($_REQUEST['dsnombre']);
$dsmovil=trim($_REQUEST['dsmovil']);
$dspais=trim($_REQUEST['dspais']);
$dsdireccion=trim($_REQUEST['dsdireccion']);
$dscondiciones=trim($_REQUEST['dscondiciones']);
if($dscondiciones=="")$dscondiciones="NO";

$dsapellidos=trim($_REQUEST['dsapellido']);
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dsclave=trim($_REQUEST['dscontrasena1']);
$dsfecha =trim($_REQUEST['dsfecha']);
$dstelefono=trim($_REQUEST['dstelefono']);
$dsciudad=trim(reemplazar($_REQUEST['dsciudad']));

$captcha=trim(reemplazar($_REQUEST['captcha']));
$idactivo=1;
$idtipocliente=1; // cliente  de la tienda
if ($_REQUEST['idtipocliente']<>"") $idtipocliente=$_REQUEST['idtipocliente']; // indica distribuidor
if ($idtipocliente<>"") $idactivo=0; // por defecto esta apagado
$idtipocliente=trim(reemplazar($_REQUEST['idtipo']));

$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
$dsclave = urlencode($clavee);

include("../../incluidos_modulos/encabezado_correo.php");


if ($dscorreocliente<>"" && $dsclave<>"" && $captcha<>"") {

		//if(trim($dscorreo)<>"")$mail->AddAddress($dscorreo, "LogrosPublicitarios");
		$sql="select id,dsnombres from tblclientes where dscorreocliente='$dscorreocliente' and idtienda=$idtienda ";
		//$sql="select id,dsnombres from tblclientes where dslogin='$dslogin'  ";

		//echo $sql;
		$resultbx= $db->Execute($sql);
		if ($resultbx->EOF) {
		//almacenar en base de datos
	
		$sql="insert into tblclientes ( ";
		$sql.="dsnombres,dsapellidos,dscorreocliente,dsclave";
		$sql.=",dsfecha,dstelefono,dsciudad,idtienda,idtipocliente,idactivo,dsempresa,dsmovil,dsdireccion,dspais";
		$sql.=" ,dsacepto,dslogin";	
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellidos','$dscorreocliente','$dsclave',";
		$sql.="'".$fechaBase."','$dstelefono','$dsciudad',$idtienda,'$idtipocliente',$idactivo,'$dsempresa','$dsmovil','$dsdireccion'";
		$sql.=" ,'$dspais','$dscondiciones','$dslogin')";
		//echo $sql;
		//exit();
		$db->Execute($sql);
		$sql="select id,dsnombres from tblclientes where dscorreocliente='$dscorreocliente'";
//		$sql="select id,dsnombres from tblclientes where dslogin='$dslogin'";

		$resultx= $db->Execute($sql);
		if (!$resultx->EOF) {
		$id=$resultx->fields[0];
		 $dsnombres=reemplazar($resultx->fields[1]);
		//exit;

	//******************* inicio  session******************//			 
    $sql="select dsnombres,dsapellidos,dsidentificacion,dstelefono,dstelefono2,dscorreocliente,id from tblclientes where id=$id";
    //echo $sql;
    $resultb= $db->Execute($sql);
    if (!$resultb->EOF) {
    $dsnombres=trim($resultb->fields[0]);
	$dsapellidos=trim($resultb->fields[1]);
	$dstelefono=trim($resultb->fields[3]);
	$dscorreocliente=trim($resultb->fields[5]);
	$id=trim($resultb->fields[6]);
    $_SESSION['i_idcliente'] = $id;
    $_SESSION['i_dsnombre'] = $dsnombres." ".$dsapellidos;
    $_SESSION['i_dscorreo'] = $dscorreocliente;
    $_SESSION['i_dstelefono'] = $dstelefono;
    $_SESSION['i_solodsnombre'] = $dsnombres;
    $_SESSION['i_solodsapellido'] = $dsapellidos;
    }
   $resultb->Close();		 


   //******************* inicio  session******************//		



		$asunto="Inscripcion en  ".$autorizado;
		$dstipocliente="Cliente";
	    $cuerpo="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
		$cuerpo.="Se ha generado una $asunto:<br>";
		//$cuerpo.="Login de Acceso: $dslogin<br>";
		$cuerpo.="Nombre / Razon Social: $dsnombres<br>";
		$cuerpo.="Apellidos / Nombre Comercial: $dsapellidos<br>";
		$cuerpo.="Telefono: $dstelefono<br>";
		$cuerpo.="Telefono2: $dstelefono2<br>";
		$cuerpo.="Correo electronico: <u>$dscorreocliente</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
		if ($idtipocliente<>"") {
	    $cuerpoa.="<BR><BR><strong>Recuerde activar este registro para acceso al distribuidor</strong><br><br>";
		}
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";
		//$cuerpo.="Estos son los comentarios: <br>$dscom<br><br>";
		$cuerpo.="IP remota: <br>$remoto<br><br>";
		$cuerpo.="==============================================================<br>";
		$cuerpo.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
		$cuerpo.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
    	$cuerpo=eregi_replace("[\]",'',$cuerpo);


    	include("cuerpo.correo.php");
		include("../../incluidos_modulos/enviadorcorreo.php");

		include_once('../../PHPMailer_v5.1/class.phpmailer.php');
		include("../../PHPMailer_v5.1/class.smtp.php"); 

    	if($tipoenviocorreo==2){
		$maila=new PHPMailer();
		$maila->IsSMTP(); // telling the class to use SMTP
		$maila->SMTPAuth = true; // turn on SMTP authentication
		$maila->Username = $usuariocorreo; // SMTP username
		$maila->Password = $clavebase; // SMTP password
		$maila->Port=$dsport;//
		$maila->Host       = $smtpbase; // SMTP server
		$maila->From       = $correobase;
		$maila->FromName   = $nombreremitente;
		$maila->Subject = $asuntoa;
		$maila->IsHTML(true);
		$maila->MsgHTML($cuerpoa);
        $maila->AddAddress($dscorreocliente);
        if(!$maila->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        //exit();
        } else {
        }
        $maila->ClearAddresses();
	    unset($maila);
	    // fin enviar autorespuesta
    	}

				//$redir="../../registro.paso.2.php?idx=$id&entrar=".$_REQUEST['entrar'];
     			 $redir="../../gracias.php?registro=1&entrar=".$_REQUEST['entrar'];
				if ($desdesitio==1) $redir="../../../sitio/servicio_paso2.php?idx=$id";


					} else {

						$redir="../../registro.php?entrar=".$_REQUEST['entrar'];
						if ($desdesitio==1) $redir="../../../sitio/formulario.php";

					}
					$resultx->close();

		} else {
			$redir="../../registro.php?mensaje=1&entrar=".$_REQUEST['entrar'];
			if ($desdesitio==1) $redir="../../../sitio/formulario.php?mensaje=1";

		}$resultbx->Close();




} else {
	$redir="../../registro.php?entrar=".$_REQUEST['entrar'];
}



include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
?>