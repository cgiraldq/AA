<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);


/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fern?ndez <consultorweb@comprandofacil.com>
  Juan Felipe S?nchez <graficoweb@comprandofacil.com>
  Jos? Fernando Pe?a <soporteweb@comprandofacil.com>
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
//$db->debug=true;

$rc4 = new rc4crypt();

$redir=trim($_REQUEST['redir']);
$add=$_REQUEST['add'];
$desdesitio="";
if ($add<>"") $desdesitio=1;
$id=trim($_REQUEST['idx']);
$sel_casillero=$_REQUEST['sel_casillero'];

$dsrequerimiento=($_REQUEST['sel_requerimientos']);

$dslenguaje=($_POST['sel_lenguaje']);

$dscategoria=($_POST['sel_categoria']);


$dsimplementar=trim($_REQUEST['dsimplementar']);

$dsrecibirmovil=trim($_REQUEST['dsrecibirmovil']);
$dsrecibircorreo=trim($_REQUEST['dsrecibircorreo']);
$tienesoat=trim($_REQUEST['dssoat']);
$dsfechavencimiento=trim($_REQUEST['dsfechavencimiento']);
$dstipovehiculo=trim($_REQUEST['dstipovehiculo']);
$dstiquetesn=trim($_REQUEST['dstiquetesn']);
$dstiquetesi=trim($_REQUEST['dstiquetesi']);
$dsparques=trim($_REQUEST['dspaques']);
$dsviajero=trim($_REQUEST['dsviajero']);

$dsviajerootro=trim($_REQUEST['dsviajerootro']);
$dsnombreviajerootro=trim($_REQUEST['dsnombreviajerootro']);
$dsnumeroviajerootro=trim($_REQUEST['dsnumeroviajerootro']);
$otracategoria=trim($_REQUEST['otracategoria']);
$dsotracategoria=trim($_REQUEST['dsotracategoria']);
$dsrecibir=trim($_REQUEST['dsrecibir']);
$dscadavez=trim($_REQUEST['dscadavez']);
$dsacepto=trim($_REQUEST['dsacepto']);



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
if ($id<>"") {
//echo "s";    
    // ACTUALIZAR

    $sql="select dsnombres,dsapellidos,dsidentificacion,dstelefono,dstelefono2,dscorreocliente from tblclientes where id=$id";
    //echo $sql;
    $resultb= $db->Execute($sql);
    if (!$resultb->EOF) {

$dsnombres=trim($resultb->fields[0]);
$dsapellidos=trim($resultb->fields[1]);
$dsidentificacion=trim($resultb->fields[2]);
$dstelefono=trim($resultb->fields[3]);
$dstelefono2=trim($resultb->fields[4]);
$dscorreocliente=trim($resultb->fields[5]);
      $_SESSION['i_idcliente'] = $id;  
      $_SESSION['i_dsnombre'] = $dsnombres." ".$dsapellidos;

    //almacenar en base de datos
    $sql=" update tblclientes set ";
    $sql.=" dsimplementar='$dsimplementar'";
    $sql.=",dsrecibirmovil='$dsrecibirmovil'";
    $sql.=",dsrecibircorreo='$dsrecibircorreo'";
    $sql.=",tienesoat='$tienesoat'";          
    $sql.=",dsfechavencimiento='$dsfechavencimiento'";          
    $sql.=",dstipovehiculo='$dstipovehiculo'";          
    $sql.=",dstiquetesn='$dstiquetesn'";
    $sql.=",dstiquetesi='$dstiquetesi'";

    $sql.=",dspaques='$dsparques'";
    $sql.=",dsviajero='$dsviajero'";
    $sql.=",dsviajerootro='$dsviajerootro'";    
    $sql.=",dsnombreviajerootro='$dsnombreviajerootro'";  
    $sql.=",dsnumeroviajerootro='$dsnumeroviajerootro'";  
    $sql.=",otracategoria='$otracategoria'";  
    $sql.=",dsotracategoria='$dsotracategoria'";  
    $sql.=",dsrecibir='$dsrecibir'";  
    $sql.=",dscadavez='$dscadavez'";  
    $sql.=",dsacepto='$dsacepto'";
    $sql.=" where id=".$id;
    if($db->Execute($sql)){
    }else{

    }
           }
   $resultb->Close();
    if(count($sel_casillero)>0){
                      $tablax="tblclientesxtblcasillero ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($sel_casillero);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$sel_casillero[$c].")";
        // echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }         
    }

    if(count($dsrequerimiento)>0){
                      $tablax="tblclientesxtblrequerimientos ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($dsrequerimiento);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$dsrequerimiento[$c].")";
       // echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }         
    }

if(count($dslenguaje)>0){
                      $tablax="tblclientesxtbllenguajes ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($dslenguaje);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$dslenguaje[$c].")";
       // echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }         
    }

if(count($dscategoria)>0){
                      $tablax="tblclientesxtblcategorias ";
                       $sql="delete from $tablax where idorigen=$id ";
                     $db->Execute($sql);
      //almacenar en base de datos
      $contc=0;
      $contarcasillero=count($dscategoria);
      for ($c=0;$c<$contarcasillero;$c++){
        // borrar las asignaciones de prod e ingresar de nuevo
        $sql="insert into $tablax (idorigen,iddestino) values ($id,".$dscategoria[$c].")";
   //    echo $sql."<br>";
        // exit();
        if($db->Execute($sql)) $contc++;
      }         
    }

  // envio del correo dde aviso de publicacion


		$asunto="Inscripcion en  ".$autorizado;
		$asuntoa="Gracias por registrarse en ".$autorizado;
    
    $cuerpo="<font face='Arial' size=-1>Apreciado <strong>Administrador del sistema</strong>:<br><br>";	
		$cuerpo.="Se ha generado una $asunto:<br>";	
		$cuerpo.="Nombre: $dsnombres<br>";	
		$cuerpo.="Apellidos: $dsapellidos<br>";	
		$cuerpo.="Telefono: $dstelefono<br>";
		$cuerpo.="Telefono2: $dstelefono2<br>";
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
    $cuerpoa.="Nombre: $dsnombres<br>";  
    $cuerpoa.="Apellidos: $dsapellidos<br>"; 
    $cuerpoa.="Telefono: $dstelefono<br>";
    $cuerpoa.="Telefono2: $dstelefono2<br>";
    $cuerpoa.="Correo electronico: <u>$dscorreocliente</u> --> <u><strong>Responder a este correo por favor</strong></u><br>";
    $cuerpoa.="Fecha de registro: ".date("Y-M-d h:m:s")."<br>";  
    $cuerpoa.="==============================================================<br>";  
    $cuerpoa.= " ".$autorizado." On line ". date("Y")  ." <br>Todos los derechos reservados<br>";
    $cuerpoa.="Powered by <a href='http://www.comprandofacil.com/'>http://www.comprandofacil.com</a></font><br>";
    $cuerpoa=eregi_replace("[\]",'',$cuerpoa);

//echo $cuerpo;
//exit();               

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


  $redir="../../gracias_servicio.php?entrar=".$_REQUEST['entrar'];
  if ($desdesitio==1) $redir="../../../sitio/gracias.php";


} else { 
  $redir="../../servicio_paso1.php?entrar=".$_REQUEST['entrar'];
  if ($desdesitio==1) $redir="../../../sitio/formulario.php";
}   


//exit();
include("../../incluidos_modulos/cerrarconexion.php");
include("../../redir.php");
//exit();//para imprimir 
?>