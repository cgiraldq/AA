<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernandez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sanchez <graficoweb@comprandofacil.com> - Diseno
  Jose Fernando Pena <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// procesos generico de envio de correos
if ($asuntocf<>"" && $asuntocorreocliente<>"") {

// al cuerpo anexarle los datos de contacto de comprandofacil


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

    $asunto=$asuntocf;

    // enviar aviso de contactenos a los de la configuracion
    $sql="select dscorreo1,dscorreo2,dscorreo3,dscorreo4 from tblempresa";
   // echo $sql;
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
    if($tipoenviocorreo==1){
        $mail->Subject = $asunto;
        $mail->IsHTML(true);
        $mail->MsgHTML($cuerpo);

      if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        //exit();
      } else {
      
      }
    $mail->ClearAddresses();  
    unset($mail);
    }   
// constructor del correo hacia el cliente
    $asunto=$asuntocorreocliente;
    if ($dscorreocliente<>""){

      $mail=new PHPMailer();
      $mail->IsSMTP(); // telling the class to use SMTP
      $mail->SMTPAuth = true; // turn on SMTP authentication
      $mail->Username = $correobase; // SMTP username
      $mail->Password = $clavebase; // SMTP password
      $mail->Port=$dsport;// 

      $mail->Host       = $smtpbase; // SMTP server
      $mail->From       = $correobase;
      $mail->FromName   = $autorizado;
      $mail->Subject = $asunto;
      $mail->IsHTML(true);
      $mail->MsgHTML($cuerpo);
  
      $mail->AddAddress($dscorreocliente, $dsnombres." ".$dsapellidos);
       if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
          //exit();
        } else {
        
        }
        $mail->ClearAddresses();  
        unset($mail);

    }
  }  
// fin proceso generico de envio de correo
?>