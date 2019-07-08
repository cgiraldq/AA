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

$dsnombre=trim($_REQUEST['dsm']);
$dsapellidos=trim($_REQUEST['dsapellido']);
$dscorreocliente=trim($_REQUEST['dscorreo']);
$dsclave=trim($_REQUEST['dsclave']);
$dsfecha =trim($_REQUEST['dsfecha']);
$dstelefono=trim($_REQUEST['dstelefono']);
$dsciudad=trim(reemplazar($_REQUEST['dsciudad']));


$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
$dsclave = urlencode($clavee);
//exit;
if ($dsnombre<>"" &&  $dscorreocliente<>"" && $dsclave<>"") {

		/*$asunto="Solicitud de contacto con  ".$autorizado;
		$cuerpo.="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";
		$cuerpo.="Se ha generado una $asunto:<br>";
		$cuerpo.="Servicio: $idservicio<br>";
		$cuerpo.="Nombre: $dsm<br>";
		$cuerpo.="Apellidos: $dsapellido<br>";
		$cuerpo.="Email: $dscorreo<br>";
		$cuerpo.="Fecha: ".date("Y-M-d h:m:s")."<br>";
		$cuerpo.="Correo electr�nico: <u>$dsemail</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
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
           if (comprobar_email($dscorreobase0) && $dscorreobase0<>"") $mail->AddAddress($dscorreobase0, "Comprandofacil");
           if (comprobar_email($dscorreobase1) && $dscorreobase1<>"") $mail->AddAddress($dscorreobase1, "Comprandofacil");
           if (comprobar_email($dscorreobase2) && $dscorreobase2<>"") $mail->AddAddress($dscorreobase2, "Comprandofacil");
           if (comprobar_email($dscorreobase3) && $dscorreobase3<>"") $mail->AddAddress($dscorreobase3, "Comprandofacil");

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
		//	mail("jmaldonado@comprandofacil.com",$asunto,$cuerpo,$headers);
			//mail("comunicaciones@logrospublicitarios.net",$asunto,$cuerpo,$headers);


		}
		if($tipoenviocorreo==1){
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			  //exit();
			} else {

			}
		}	*/
		//if(trim($dscorreo)<>"")$mail->AddAddress($dscorreo, "LogrosPublicitarios");
		$sql="select id,dsnombres from tblclientes where dscorreocliente='$dscorreocliente' and idtienda=$idtienda ";
		//echo $sql;
		$resultb= $db->Execute($sql);
		if ($resultb->EOF) {
		//almacenar en base de datos
		$sql="insert into tblclientes ( ";
		$sql.="dsnombres,dsapellidos,dscorreocliente,dsclave";
		$sql.=",dsfecha,dstelefono,dsciudad,idtienda";
		$sql.=") values (";
		$sql.="'$dsnombre','$dsapellidos','$dscorreocliente','$dsclave',";
		$sql.="'".$fechaBase."','$dstelefono','$dsciudad',$idtienda)";
		//echo $sql;
		//exit;
		$db->Execute($sql);//exit();


			$sql="select id,dsnombres from tblclientes where dscorreocliente='$dscorreocliente'";
			//echo $sql;
			$resultx= $db->Execute($sql);
			if (!$resultx->EOF) {
				$id=$resultx->fields[0];
				 $dsnombres=reemplazar($resultx->fields[1]);
				//exit;
				$redir="../../servicio_paso2.php?idx=$id&entrar=".$_REQUEST['entrar'];
				if ($desdesitio==1) $redir="../../../sitio/servicio_paso2.php?idx=$id";


					} else {

						$redir="../../servicio_paso1.php?entrar=".$_REQUEST['entrar'];
						if ($desdesitio==1) $redir="../../../sitio/formulario.php";

					}
					$resultx->close();

		} else {
			$redir="../../servicio_paso1.php?mensaje=1&entrar=".$_REQUEST['entrar'];
			if ($desdesitio==1) $redir="../../../sitio/formulario.php?mensaje=1";

		}




} else {
	$redir="../../servicio_paso1.php?entrar=".$_REQUEST['entrar'];
}
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");

//exit();//para imprimir
?>